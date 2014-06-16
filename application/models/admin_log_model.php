<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 后台管理员关键操作日志Model
 */
class Admin_log_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 操作日志列表
	 * @param  array  $params  [description]
	 * @param  array  $options [description]
	 * @return [type]          [description]
	 */
	public function get_log_list($params = array(), $options = array()) {
		try {
			$limitStr = "";
			if (isset($options['page']) && isset($options['offset'])) {
				$limit = $options['offset'] * ($options['page'] - 1);
				$offset = $options['offset'];
				$limitStr .= " LIMIT {$limit},{$offset} ";
			}
			if (isset($options['order'])) {
				$order_str = " ORDER BY {$options['order']} ";
			}
			$where = " WHERE 1=1 ";
			foreach ($params as $k => $w) {
				if (isset($params[$k])) {
					switch ($k) {
						case 's_controller':
							$where .= " AND controller LIKE '%{$w}%' ";
							break;
						case 's_method':
							$where .= " AND method LIKE '%{$w}%' ";
							break;
						case 'page':
							break;
						default:
							$where .= " AND {$k}='{$w}' ";
							break;
					}
				}
			}
			$sql = "SELECT * FROM yt_admin_logs " . $where;
			$querynum = $this->db->query($sql);
			$count = $querynum->num_rows();
			$query = $this->db->query($sql . $order_str . $limitStr);
			$list = $query->result();
			return array('list' => $list, 'total' => $count);
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}
}
// END city_model class

/* End of file city_model.php */
/* Location: ./application/models/city_model.php */