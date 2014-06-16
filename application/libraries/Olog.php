<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Olo Class
 *
 * 记录所有敏感信息日志
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    Libraries
 */
class Olog {

	protected $CI;

	/**
	 * Constructor
	 *
	 * @param   array   $config
	 */
	public function __construct()
	{
		$this->CI = &get_instance();

		// Load Admin_log_model model
		$this->CI->load->model('Admin_log_model', 'logmod');

		log_message('debug', 'Olog Class Initialized');
	}

	// --------------------------------------------------------------------
	public function write($msg = '', $type = NULL) {
		if ($msg != '') {
			$log['data'] = $msg;
			$log['type'] = $type;
			//获取controller
			$log['controller'] = $this->CI->uri->rsegment(1);
			//获取method
			$log['method'] = $this->CI->uri->rsegment(2);
			//获取当前访问的URI
			$log['uri'] = $_SERVER['REQUEST_URI'];
			//获取当前登录管理员
			$log['admin'] = $this->CI->session->userdata('admin_user');
			//获取ip地址
			$log['ip'] = $this->CI->input->ip_address();
			//获取时间
			$log['time'] = time();
			//写入数据库
			$id = $this->CI->logmod->insert($log, TRUE);
		}
	}

}
// END Olog class

/* End of file Olog.php */
/* Location: ./application/libraries/Olog.php */