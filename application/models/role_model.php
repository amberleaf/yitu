<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 处理后台角色Model
 */
class Role_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 获取角色（管理组）列表
	 * @param  array  $params  [description]
	 * @param  array  $options [description]
	 * @return [type]          [description]
	 */
	public function get_role_list($params = array(), $options = array()) {
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
						case 'page':
							break;
						default:
							$where .= " AND {$k}='{$w}' ";
							break;
					}
				}
			}
			$sql = "SELECT * FROM yt_roles " . $where;
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
// END Role_model class

/* End of file role_model.php */
/* Location: ./application/models/role_model.php */