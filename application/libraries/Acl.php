<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter ACL Class
 *
 * This class enables you to apply permissions to controllers, controller and models, as well as more fine tuned
 * permissions at code level.
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    Libraries
 * @author      David Freerksen
 * @link        https://github.com/dfreerksen/ci-acl
 */
class Acl {
	//CI超级对象
	protected $CI;

	protected $user = 0;//用户
	protected $role = 0;//角色
	protected $permissions = array();//权限列表数组

	//初始配置(如无config的话使用这个)
	protected $_config = array(
		'acl_table_roles' => 'yt_roles',
		'acl_table_users' => 'yt_admins',
		'acl_users_fields' => array(
			'id' => 'id',
			'role_id' => 'role_id'
		),
		'acl_table_permissions' => 'yt_permissions',
		'acl_permissions_fields' => array(
			'id' => 'id',
			'key' => 'key'
		),
		'acl_table_role_permissions' => 'yt_role_permissions',
		'acl_role_permissions_fields' => array(
			'id' => 'id',
			'role_id' => 'role_id',
			'permission_id' => 'permission_id'
		),
		'acl_user_session_key' => 'admin_id',
		'acl_restricted' => array() // @TODO: Add IP based access to acl_restricted
	);

	/**
	 * Constructor
	 * 构造函数
	 * @param   array   $config
	 */
	public function __construct($config = array())
	{
		$this->CI = &get_instance();

		// Load Session library
		// 加载session
		$this->CI->load->library('session');

		// Load ACL model
		//加载acl model
		$this->CI->load->model('acl_model');

		//如果有配置文件,则根据配置文件,重新初始化
		if ( ! empty($config))
		{
			$this->initialize($config);
		}

		log_message('debug', 'ACL Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Initialize config values
	 * 重新初始化配置文件
	 * @access  public
	 * @param   array
	 */
	public function initialize($config = array())
	{
		foreach ($config as $key => $val)
		{
			if ($key == 'acl_restricted')
			{
				foreach ($val as $k => $v)
				{
					// In case they aren't defined, we need default values
					// 如果有相应的配置,则使用配置文件,没有则用默认值
					$allow_roles = ( ! array_key_exists('allow_roles', $v)) ? array() : (array)$v['allow_roles'];
					$allow_users = ( ! array_key_exists('allow_users', $v)) ? array() : (array)$v['allow_users'];
					$error_msg = ( ! array_key_exists('error_msg', $v)) ? 'You do not have access to this section.' : $v['error_msg'];

					// Set the restrictions
					$this->_config[$key][$k] = array(
						'allow_roles' => $allow_roles,
						'allow_users' => $allow_users,
						'error_msg' => $error_msg
					);
				}
			}

			else
			{
				if (array_key_exists($key, $this->_config))
				{
					$this->_config[$key] = $val;
				}
			}
		}
	}

	// --------------------------------------------------------------------

	/**
	 * get magic method
	 *
	 * @param   $key
	 * @return  mixed
	 */
	public function __get($key)
	{
		return array_key_exists($key, $this->_config) ? $this->_config[$key] : NULL;
	}

	// --------------------------------------------------------------------

	/**
	 * set magic method
	 *
	 * @param   $key
	 * @param   $value
	 * @return  void
	 */
	public function __set($key, $value)
	{
		if (array_key_exists($key, $this->_config))
		{
			$this->_config[$key] = $value;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Check is controller/method has access for role
	 * 检查是否有进入某个controller/method的权限.
	 * @access  public
	 * @param   string
	 * @return  bool
	 */
	public function has_access()
	{
		foreach ($this->_config['acl_restricted'] as $key => $restriction)
		{
			// Make sure it is in controller/method format
			$uri = explode('/', $key);
			if ( ! array_key_exists(0, $uri))
			{
				$uri[0] = '*';
			}

			if ( ! array_key_exists(1, $uri))
			{
				$uri[1] = '*';
			}

			// Only run it if we are inside the controller/method
			if ($uri[0] === '*' OR $uri[0] === $this->CI->uri->rsegment(1))
			{
				if ($uri[1] === '*' OR $uri[1] === $this->CI->uri->rsegment(2))
				{
					// Default allow roles array
					if ( ! array_key_exists('allow_roles', $restriction))
					{
						$restriction['allow_roles'] = array();
					}

					// Default deny roles array
					if ( ! array_key_exists('deny_roles', $restriction))
					{
						$restriction['deny_roles'] = array();
					}

					// Deny for roles they are denied access as well as roles that are not in the list of allowed roles
					if ( ! in_array($this->_user_role(), $restriction['allow_roles']) OR in_array($this->_user_role(), $restriction['deny_roles']))
					{
						return FALSE;
					}
				}
			}
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Test if user has permission (permissions set in database)
	 *
	 * @access  public
	 * @param   string
	 * @return  bool
	 */
	public function has_permission($key = '')
	{
		return $this->CI->acl_model->has_permission($key);
	}

	// --------------------------------------------------------------------

	/**
	 * Return the value of user id from the session. Returns 0 if not logged in
	 *
	 * @access  private
	 * @return  int
	 */
	private function _session_user()
	{
		if ($this->user == NULL)
		{
			$user = $this->CI->session->userdata($this->_config['acl_user_session_key']);

			if ($user === FALSE)
			{
				$user = 0;
			}

			$this->user = $user;
		}

		return $this->user;
	}

	// --------------------------------------------------------------------

	/**
	 * Return user role
	 *
	 * @return  int
	 */
	public function role()
	{
		return $this->_user_role();
	}

	// --------------------------------------------------------------------

	/**
	 * Return the role id user
	 *
	 * @access  private
	 * @return  int
	 */
	private function _user_role()
	{
		if ($this->role == NULL)
		{
			// Current user
			$user = $this->_session_user();

			// Set the role
			$this->role = $this->CI->acl_model->user_role($user);
		}

		return $this->role;
	}

}
// END Acl class

/* End of file Acl.php */
/* Location: ./application/libraries/Acl.php */