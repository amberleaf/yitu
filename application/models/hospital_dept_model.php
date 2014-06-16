<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 医院所辖科室管理Model
 */
class Hospital_dept_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 根据条件获取某个医院的科室列表
	 * @param  array  $params  检索条件参数数组
	 * @param  array  $options 相关分页参数数组
	 * @return array           列表$list,总数$total  array('list'=>$list,'total'=>$total)
	 */
	public function get_dept_list($params = array(), $options = array()) {
		try { 
			$sql='';
			$limitStr='';
			//TODO 根据参数获取某个医院的科室列表
			$query = $this->db->query($sql . $limitStr);
			$list = $query->result();
			return array('list' => $list, 'total' => $count);
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}
}
// END Hospital_dept_model class

/* End of file hospital_dept_model.php */
/* Location: ./application/models/hospital_dept_model.php */