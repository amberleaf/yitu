<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 维护医生信息Model
 */
class Docter_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 字段验证
	 * @param  array $data [description]
	 * @return boolen       [description]
	 */
	protected function _run_validation($data) {
		if (count($data) > 0) {
			foreach ($data as $k => $v) {
				switch ($k) {
					case 'username':
						# code...
						break;
					
					default:
						# code...
						break;
				}
			}
		}
	}

	/**
	 * 根据条件获取医生列表
	 * @param  array  $params  检索条件参数数组
	 * @param  array  $options 相关分页参数数组
	 * @return array           列表$list,总数$total  array('list'=>$list,'total'=>$total)
	 */
	public function get_docter_list($params = array(), $options = array()) {
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
							$where .= " AND name LIKE '%{$w}%' ";
							break;
						case 's_title':
							$where .= " AND title LIKE '%{$w}%' ";
							break;
						case 's_canbuy':
							$where .= " AND canbuy = '%{$w}%' ";
							break;
					 
						case 'page':
							break;
						default:
							$where .= " AND {$k}='{$w}' ";
							break;
					}
				}
			}
			$csql = "SELECT * FROM yt_docters " . $where;
			$querynum = $this->db->query($csql);
			$count = $querynum->num_rows();
			$sql = "SELECT a.* FROM yt_docters AS a" . $where;
			$query = $this->db->query($sql . $limitStr);
			$list = $query->result();
			return array('list' => $list, 'total' => $count);
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}

	
}
// END Docter_model class

/* End of file Docter_model.php */
/* Location: ./application/models/Docter_model.php */