<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 维护全部科室的Model
 */
class Dept_model extends MY_Model {

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
	public function get_dept_list($params = array(), $options = array()) {
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
						case 's_name':
							$where .= " AND d.name LIKE '%{$w}%' ";
							break;
						 
						case 'page':
							break;
							
						default:
							$where .= " AND {$k}='{$w}' ";
							break;
					}
				}
			}
			$sql = "SELECT  d.* FROM yt_depts d " . $where;
			$querynum = $this->db->query($sql);
			$count = $querynum->num_rows();
			$sqllist="select d.*,dp.name as parent_name "
				." from yt_depts d inner join yt_depts dp on d.pid=dp.id ". $where;
			$query = $this->db->query($sqllist . $limitStr);
			$list = $query->result();
			return array('list' => $list, 'total' => $count);
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}
}
// END Dept_model class

/* End of file dept_model.php */
/* Location: ./application/models/dept_model.php */