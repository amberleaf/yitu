<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 合作医院维护控制器
 * 包括:
 * 	1 医院表相关
 *  2科室表相关
 *  3医院科室表相关
 *  4 
 * @Description: Enter description here ...
 * @author Dezhi
 * @date 2014-6-14 上午10:23:43
 */
class Hospital extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

	/**
	 * 医院列表主页面
	 * @return [type] [description]
	 */
	public function lists() {
		try {
			$params = array_filter($this->input->get(NULL, TRUE));
			$this->template->set('search', $params);

			$page = isset($params['page']) ? intval($params['page']) : 1;
			$options = array('page' => $page, 'offset' => PAGE_OFFSET);
			$this->load->model('Hospital_model', 'hospital');
			
			$data = $this->hospital->get_hospital_list($params, $options);
			$this->template->set('list', $data['list']);
			$this->template->set('total', $data['total']);

			$page_array = array(
				'total' => $data['total'],
				'cur' => $page,
				'offset' => PAGE_OFFSET,
				'links' => 5
			);
			$this->load->helper('page');
			$page_links = show_back_page($page_array, $params);
			$this->template->set('page_links', $page_links);
			
			//获取省份列表
			$this->load->model('City_model', 'city');
			$provinces = $this->city->get_many_by(array('parentid' => 1, 'level' => 1));
			$this->template->set('provinces', $provinces);
			
			//输出
			$this->template->render();
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}
	/**
	 * 创建／修改医院
	 * @return [type] [description]
	 */
	public function edit_hospital() {
		try {
			//获取省份列表
			$this->load->model('City_model', 'city');
			$provinces = $this->city->get_many_by(array('parentid' => 1, 'level' => 1));
			$this->template->set('provinces', $provinces);
			
			//加载页面Css和Js文件
			$css = array('assets' => array('jquery-ui-1.10.3.custom.min', 'validationEngine.jquery', 'jquery.fileupload'));
			$this->template->set('page_css', $css);
			$this->load->model('Hospital_model', 'hospital');
			if ($id = $this->input->get('id', TRUE)) {
				$Hospital = $this->hospital->get($id);
				$this->template->set('Hospital', $Hospital);
			}
			if ($form_data = $this->input->post(NULL, TRUE)) {
				$form_data['time'] = time();
				if (isset($form_data['id'])) {
					$id = $form_data['id'];
					unset($form_data['id']);
					$iid = $this->hospital->update($form_data);
					//记录日志
					$this->olog->write("更新医院{$form_data['Hospitalname']}的信息", "update");
				} else {
					$iid = $this->hospital->insert($form_data, TRUE);
					//记录日志
					$this->olog->write("添加医院，ID是{$iid}", "insert");
				}
				if ($iid > 0) {
					$this->template->set_message("操作成功！", "alert-success");
				} else {
					$this->template->set_message("操作失败！", "alert-danger");
				}
			}
			$this->template->render();
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}

	/**
	 * 删除医院
	 * @return [type] [description]
	 */
	public function delete_hospital() {
		try {
			show_404(NULL,'未完成功能');
			//TODO 
			
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}
	/**
	 * 科室列表
	 * @return [type] [description]
	 */
	public function dept_lists() {
		try {
			$params = array_filter($this->input->get(NULL, TRUE));
			$this->template->set('search', $params);

			$page = isset($params['page']) ? intval($params['page']) : 1;
			$options = array('page' => $page, 'offset' => PAGE_OFFSET);
			$this->load->model('Dept_model', 'dept');
			
			$data = $this->dept->get_dept_list($params, $options);
			$this->template->set('list', $data['list']);
			$this->template->set('total', $data['total']);

			$page_array = array(
				'total' => $data['total'],
				'cur' => $page,
				'offset' => PAGE_OFFSET,
				'links' => 5
			);
			$this->load->helper('page');
			$page_links = show_back_page($page_array, $params);
			$this->template->set('page_links', $page_links);
			 
			//输出
			$this->template->render();
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}
	/**
	 * 添加/编辑科室
	 * @return [type] [description]
	 */
	public function edit_dept() {
		try {
			show_404(NULL,'未完成功能');
			//TODO 
			
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}
	/**
	 * 删除科室
	 * @return [type] [description]
	 */
	public function delete_dept() {
		try {
			show_404(NULL,'未完成功能');
			//TODO 
			
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}
}

/* End of file hospital.php */
/* Location: ./application/controllers/admin/hospital.php */