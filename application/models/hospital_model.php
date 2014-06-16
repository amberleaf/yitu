<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 后台维护合作医院Model
 */
class Hospital_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 根据条件获取医院列表
	 * @param  array  $params  检索条件参数数组
	 * @param  array  $options 相关分页参数数组
	 * @return array           列表$list,总数$total  array('list'=>$list,'total'=>$total)
	 */
	public function get_hospital_list($params = array(), $options = array()) {
		try {
			$limitStr = "";
			if (isset($options['page']) && isset($options['offset'])) {
				$limit = $options['offset'] * ($options['page'] - 1);
				$offset = $options['offset'];
				$limitStr .= " LIMIT {$limit},{$offset} ";
			}
			$where = " WHERE 1=1 ";
			foreach ($params as $k => $w) {
				if (isset($params[$k])) {
					switch ($k) {
						case 's_fname':
							$where .= " AND fname LIKE '%{$w}%' ";
							break;
						case 's_extel':
							$where .= " AND extel LIKE '%{$w}%' ";
							break;
						case 's_address':
							$where .= " AND address LIKE '%{$w}%' ";
							break;
						case 's_status':
							$where .= " AND status='{$w}' ";
							break;
							
						case 'page':
							break;
							
						default:
							$where .= " AND {$k}='{$w}' ";
							break;
					}
				}
			}
			$sql = "SELECT  * FROM yt_hospitals " . $where;
			$querynum = $this->db->query($sql);
			$count = $querynum->num_rows();
			$sqllist="select h.*,y.name as province_name,y2.name as city_name "
				." from yt_hospitals h left join yt_cities y on h.province=y.id "
				."left join yt_cities y2 on h.city=y2.id ". $where;
			$query = $this->db->query($sqllist . $limitStr);
			$list = $query->result();
			return array('list' => $list, 'total' => $count);
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}
}
// END Hospital_model class

/* End of file Hospital_model.php */
/* Location: ./application/models/hospital_model.php */