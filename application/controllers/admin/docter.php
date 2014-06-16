<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * 医生维护控制器
 * 包括:
 * 	1医生信息表相关
 *  2医生出诊表相关
 *  3医生评价表相关
 * @Description: Enter description here ...
 * @author Dezhi
 * @date 2014-6-15 下午02:20:43
 */
class Docter extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

	/**
	 * 医生列表
	 * @return [type] [description]
	 */
	public function lists() {
		try {
			//获取参数
			$params = array_filter($this->input->get(NULL, TRUE));
			$datas['search']= $params ;

			$page = isset($params['page']) ? intval($params['page']) : 1;
			$options = array('page' => $page, 'offset' => PAGE_OFFSET);
			
			//加载model
			$this->load->model('Docter_model', 'docter');
			
			//获取列表
			$data = $this->docter->get_docter_list($params, $options);
			$datas['list']= $data['list'] ;
			$datas['total']= $data['total'] ;

			$page_array = array(
				'total' => $data['total'],
				'cur' => $page,
				'offset' => PAGE_OFFSET,
				'links' => 5
			);
			$this->load->helper('page');
			$page_links = show_back_page($page_array, $params);
			$datas['page_links']= $page_links ;

			$this->template->render();
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}

	/**
	 * 添加 编辑医生
	 * @return [type] [description]
	 */
	public function edit() {
		try {
			show_404(NULL,'未完成功能');
			  //TODO 
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}
	
	
}

/* End of file docter.php */
/* Location: ./application/controllers/admin/docter.php */