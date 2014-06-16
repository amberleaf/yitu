<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * @Description: 后台城市的维护
 * @author Dezhi
 * @date 2014-6-13 上午10:50:50
 */
class City extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

	/**
	 * 获取省市县数据
	 * @return [type] [description]
	 */
	public function get_cities() {
		try {
			$pid = $this->input->post('pid', TRUE) ? $this->input->post('pid', TRUE) : 1;
			$level = $this->input->post('level', TRUE) ? $this->input->post('level', TRUE) : 1;
			$where = array('parentid' => $pid, 'level' => $level);
			$this->load->model('City_model', 'city');
			$cities = $this->city->get_many_by($where);
			if ($this->input->is_ajax_request()) {
				echo json_encode($cities);
			}
			return;
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}


}

/* End of file city.php */
/* Location: ./application/controllers/admin/city.php */