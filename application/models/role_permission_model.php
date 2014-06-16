<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 后台管理员角色分配权限Model
 */
class Role_permission_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 给角色（管理组）分配URL
	 * @param  int|string $role_id  角色ID
	 * @param  array  $id_array permission_id数组
	 * @return boolen           [description]
	 */
	public function role_permission($role_id = NULL, $id_array = array()) {
		try {
			if ($role_id && count($id_array) > 0) {
				//开启事物
				$this->db->trans_begin();
				//先删除原来$role_id拥有的permission
				$this->db->delete('yt_role_permissions', array('role_id'=>$role_id));
				//再添加新的permission
				foreach ($id_array as $id) {
					$this->db->insert('yt_role_permissions', array('role_id'=>$role_id, 'permission_id'=>$id));
				}
				if ($this->db->trans_status() === FALSE) {
					 $this->db->trans_rollback();
					 return FALSE;
				} else {
					$this->db->trans_commit();
					//记录日志
					$this->olog->write("更新管理组ID={$role_id}的权限URL");
					return TRUE;
				}
			}
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}
}
// END Role_permission_model class

/* End of file role_permission_model.php */
/* Location: ./application/models/role_permission_model.php */