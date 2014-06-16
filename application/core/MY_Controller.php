<?php
/**
 * 公共控制器,所有的controller都要继承自这个类哦.
 */
class MY_Controller extends CI_Controller {

	//保存后台管理员登录信息.
	public $_session_info = NULL;

	//构造函数
	public function __construct() {
		parent::__construct();
		
		$this->load->driver('cache', array('adapter' => 'redis'));
		$this->cache = $this->cache->redis;
		$this->load->helper('url');
		$init = $this->template->group . '_init';
		$this->$init();
	}

	/**
	 * 前台初始化方法
	 * @return [type] [description]
	 */
	protected function home_init() {
		//从session获取前台登录状态
		$login_info = $this->session->all_userdata();
		$this->_session_info = $login_info;
	}

	/**
	 * 后台初始化方法
	 * @return [type] [description]
	 */
	protected function admin_init() {
		//不需要登录的controller-method
		$no_need_login = array('auth-send_mail', 'auth-reset_password');
		$controller = $this->uri->rsegment(1);
		$method = $this->uri->rsegment(2);
		if (!in_array($controller . '-' . $method, $no_need_login)) {
			//加载日志类
			$this->load->library('olog');
			//从session获取登录信息
			$login_info = $this->session->all_userdata();
			$this->_session_info = $login_info;
			if (isset($login_info['admin_login']) && $login_info["admin_login"] == true) {
				//检查是否有权限访问， 如果是超级管理员（$login_info['admin_role'] == 1）则不处理
				if ($login_info['admin_role'] != 1) {
					if (!$this->acl->has_permission($controller . '-' . $method)) {
						show_error("对不起您没有权限访问！");
					}
				}
				//取得当前登录管理员的URL数组，判断左侧菜单栏目是否要显示
				$this->load->model('Acl_model', 'aclmod');
				$nav_permission = $this->aclmod->permissions_array($this->_session_info['admin_role']);
				$this->template->set('nav_permission', $nav_permission);
				$this->template->set('admin_role', intval($login_info['admin_role']));
				
				//拼接页面公共部分
				$this->template->set_block('navbar', 'admin/public/navbar');		//设置头部HTML
				$this->template->set_block('shortcut', 'admin/public/shortcut');	//设置左侧一部分HTML
				$this->template->set_block('nav-list', 'admin/public/nav-list');	//设置左侧菜单栏HTML
				$this->template->set_block('settings', 'admin/public/settings');	//设置页面的设置部分HTML
				
				//
				if ($this->router->class == 'auth' &&  $this->router->method == 'login') {
					redirect(base_url() . 'admin/main/index');
				} else {
					$this->template->set('login_info', $login_info);
				}
			}
		
			//未登录
			if (($login_info["admin_login"] !== true || !isset($login_info['admin_login'])) && $this->router->method != 'login') {
				redirect(base_url() . 'admin/auth/login');
			}
		}
	}

	
	
	public function test() {
		echo "this is a test!";
	}

	public function Index() {
		echo "this is a index!";
	}
}
