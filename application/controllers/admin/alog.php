<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 后台管理员关键操作日志
 * 
 * @Description: Enter description here ...
 * @author TSH
 * @date 2014-6-15 上午10:11:41
 */
class Alog extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

	/**
	 * 管理主页面
	 * @return [type] [description]
	 */
	public function index() {
		try {
			//获取相关查询参数
			$params = array_filter($this->input->get(NULL, TRUE));
			$this->template->set('search', $params);

			//分页设置
			$page = isset($params['page']) ? intval($params['page']) : 1;
			$options = array('page' => $page, 'offset' => PAGE_OFFSET, 'order' => 'id DESC');
			
			//加载相关model
			$this->load->model('Admin_log_model', 'logmod');
			
			//根据参数查询日志
			$data = $this->logmod->get_log_list($params, $options);
			
			//设置到视图模版变量中
			$this->template->set('list', $data['list']);
			$this->template->set('total', $data['total']);

			$page_array = array(
				'total' => $data['total'],
				'cur' => $page,
				'offset' => PAGE_OFFSET,
				'links' => 5
			);
			
			//加载自定义的page助手类
			$this->load->helper('page');
			
			//设置页码
			$page_links = show_back_page($page_array, $params);
			$this->template->set('page_links', $page_links);
			
			//显示到页面
			$this->template->render();
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}

}

/* End of file alog.php */
/* Location: ./application/controllers/admin/alog.php */