<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 后台管理员相关操作Model
 */
class Admin_model extends MY_Model {

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
	 * 根据条件获取管理员列表
	 * @param  array  $params  检索条件参数数组
	 * @param  array  $options 相关分页参数数组
	 * @return array           列表$list,总数$total  array('list'=>$list,'total'=>$total)
	 */
	public function get_admin_list($params = array(), $options = array()) {
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
							$where .= " AND username LIKE '%{$w}%' ";
							break;
						case 's_realname':
							$where .= " AND realname LIKE '%{$w}%' ";
							break;
						case 's_mobil':
							$where .= " AND mobil LIKE '%{$w}%' ";
							break;
						case 's_email':
							$where .= " AND email LIKE '%{$w}%' ";
							break; 
						case 's_role':
							$where .= " AND role_id='{$w}' ";
							break;
						
						case 'page':
							break;
						default:
							$where .= " AND {$k}='{$w}' ";
							break;
					}
				}
			}
			$csql = "SELECT * FROM yt_admins " . $where;
			$querynum = $this->db->query($csql);
			$count = $querynum->num_rows();
			$sql = "SELECT a.*, r.name AS rolename FROM yt_admins AS a 
					LEFT JOIN yt_roles AS r ON a.role_id = r.id " . $where;
			$query = $this->db->query($sql . $limitStr);
			$list = $query->result();
			return array('list' => $list, 'total' => $count);
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}

	/**
	 * 按类别统计管理员总数
	 * @return array [description]
	 */
	public function get_type_admins() {
		try {
			$sql = "SELECT case typ when 1 then '系统管理员' when 2 then '应用管理员' when 3 then '销售' end as typ,
			COUNT(*) AS num FROM yt_admins GROUP BY typ";
			$query = $this->db->query($sql);
			return $query->result();
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}
}
// END Admin_model class

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */