<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 后台权限列表Model
 */
class Permission_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 获取添加下一个url时的排序数
	 * @param  array $where array('group'=>$group)
	 * @return int        [description]
	 */
	public function get_next_order($where) {
		$condition = " WHERE 1=1 ";
		if (count($where) > 0) {
			foreach ($where as $k => $v) {
				$condition .= "AND `{$k}` = '{$v}' ";
			}
		}
		$sql = "SELECT MAX(`order`) AS o FROM yt_permissions" . $condition;
        $query = $this->db->query($sql);
        $row = $query->row();
        return intval($row->o) + 1;
	}
}
// END Permission_model class

/* End of file permission_model.php */
/* Location: ./application/models/permission_model*/