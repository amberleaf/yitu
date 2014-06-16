<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 用户相关操作Model
 */
class User_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 根据条件获取用户列表
	 * @param  array  $params  检索条件参数数组
	 * @param  array  $options 相关分页参数数组
	 * @return array           列表$list,总数$total  array('list'=>$list,'total'=>$total)
	 */
	public function get_user_list($params = array(), $options = array()) {
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
						case 's_tel':
							$where .= " AND tel LIKE '%{$w}%' ";
							break;
						case 'page':
							break;
						default:
							$where .= " AND {$k}='{$w}' ";
							break;
					}
				}
			}
			$sql = "SELECT * FROM yt_users " . $where;
			$querynum = $this->db->query($sql);
			$count = $querynum->num_rows();
			$query = $this->db->query($sql . $limitStr);
			$list = $query->result();
			return array('list' => $list, 'total' => $count);
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}
}
// END user_model class

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */