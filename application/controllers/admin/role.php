<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 后台管理员角色管理
 * @Description: Enter description here ...
 * @author Dezhi
 * @date 2014-6-10 上午10:15:22
 */
class Role extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

	/**
	 * 添加角色
	 */
	public function add () {
		try {
			//加载页面Css和Js文件
			$css = array('assets' => array('jquery-ui-1.10.3.custom.min', 'validationEngine.jquery'));
			$this->template->set('page_css', $css);
			
			//加载Role_model
			$this->load->model('Role_model', 'role');
			
			//获取表单数据,进行保存
			if ($form_data = $this->input->post(NULL, TRUE)) {
				//获取表单数据
				$data['name'] = $form_data['name'];
				if ($form_data['description']) {
					$data['description'] = $form_data['description'];
				}
				$data['time'] = time();
				if ($form_data['id']) {
					//如果有id,则表示为修改记录
					$iid = $this->role->update($form_data['id'], $data, TRUE);
					//记录日志
					$this->olog->write("修改角色(管理组){$data['name']}的信息", "update");
				} else {
					//如果没有id 则表示新增记录
					$iid = $this->role->insert($data, TRUE);
					//记录日志
					$this->olog->write('添加角色(管理组)', 'insert');
					//添加默认可以访问的URL权限
					if ($iid > 1) {
						$this->load->model('Permission_model', 'permission');
						$this->permission->select('id');
						$pids = $this->permission->get_many_by("key IN('auth-login','auth-logout','main-index')");
						if (count($pids) > 0) {
							$ids_arr = array();
							foreach ($pids as $pv) {
								$ids_arr[] = $pv->id;
							}
							$this->load->model('Role_permission_model', 'role_permission');
							$this->role_permission->role_permission($iid, $ids_arr);
						}
					}
				}
				if ($iid > 0) {
					$this->template->set_message("操作成功！", "alert-success");
				} else {
					$this->template->set_message("操作失败！", "alert-danger");
				}
			}
			//将新角色信息赋值到页面 显示出来.
			if ($id = $this->input->get('id', TRUE)) {
				$role = $this->role->get($id);
				$this->template->set('role', $role);
			}
			$this->template->render();
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}

	/**
	 * 角色（管理组）列表
	 * @return html [description]
	 */
	public function role_lists() {
		try {
			$params = array_filter($this->input->get(NULL, TRUE));
			$this->template->set('search', $params);

			$page = isset($params['page']) ? intval($params['page']) : 1;
			$options = array('page' => $page, 'offset' => PAGE_OFFSET);
			$this->load->model('Role_model', 'role');
			
			$data = $this->role->get_role_list($params, $options);
			$this->template->set('list', $data['list']);
			$this->template->set('total', $data['total']);

			$page_array = array(
				'total' => $data['total'],
				'cur' => $page,
				'offset' => PAGE_OFFSET,
				'links' => 5
			);
			$this->load->helper('page');
			$page_links = show_back_page($page_array, $params);
			$this->template->set('page_links', $page_links);
			$this->template->render();
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}

	/**
	 * 添加|修改URL
	 * @return html [description]
	 */
	public function operate_permission() {
		try {
			//加载页面Css和Js文件
			$css = array('assets' => array('jquery-ui-1.10.3.custom.min', 'validationEngine.jquery'));
			$this->template->set('page_css', $css);
			$this->load->model('Permission_model', 'permission');
			//如果接受到id设置默认值
			if ($id = $this->input->get('id', TRUE)) {
				$permission = $this->permission->get($id);
				$this->template->set('permission', $permission);
			}
			//如果post数据进入添加或修改
			if ($form_data = $this->input->post(NULL, TRUE)) {
				$form_data['time'] = time();
				if (isset($form_data['id'])) {
					$id = $form_data['id'];
					unset($form_data['id']);
					$iid = $this->permission->update($id, $form_data, TRUE);
					//记录日志
					$this->olog->write("修改{$form_data['group']}的信息", "update");
					if ($iid > 0) {
						redirect(base_url() . 'admin/role/permission');
					} else {
						$this->template->set_message("修改失败！", 'alert-danger');
					}
				} else {
					$next_order = $this->permission->get_next_order(array('group'=>$form_data['group']));
					$form_data['order'] = $next_order;
					$iid = $this->permission->insert($form_data, TRUE);
					//记录日志
					$this->olog->write("添加角色（管理组）", "insert");
					if ($iid > 0) {
						redirect(base_url() . 'admin/role/permission');
					} else {
						$this->template->set_message("添加失败！", "alert-danger");
					}
				}
			}
			$this->template->set('group_name', $this->input->get('group'));
			$this->template->render();
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}

	/**
	 * 所有权限URL（预览|分配）
	 * @return html [description]
	 */
	public function permission() {
		try {
			//加载页面Css和Js文件
			$css = array('assets' => array('jquery-ui-1.10.3.custom.min', 'chosen', 'validationEngine.jquery'));
			$this->template->set('page_css', $css);
			$this->load->model('Permission_model', 'permission');
			//取得所有URL
			$this->permission->select("id,group,url,order");
			$this->permission->order_by('order');
			$urls = $this->permission->get_all();
			$url_array = array();
			if (count($urls) > 0) {
				foreach ($urls as $u) {
					$url_array[$u->group][$u->id] = $u->url;
				}
			}
			$this->template->set('urls', $url_array);
			//如果rid存在，进入分配页面
			if ($rid = $this->input->get('rid', TRUE)) {
				$this->load->model('Role_permission_model', 'role_permission');
				$rows = $this->role_permission->get_many_by(array('role_id'=>$rid));
				if (count($rows) > 0) {
					$pids = array();
					foreach ($rows as $pv) {
						$pids[] = $pv->permission_id;
					}
				}
				$this->template->set('pids', $pids);
				$this->template->set('role_id', $rid);
				$role_name = $this->input->get('name', TRUE);
				$this->template->set('role_name', $role_name);
			}
			$this->template->render();
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}

	/**
	 * Ajax处理分配URL
	 * @return json [description]
	 */
	public function assign_permission() {
		try {
			if ($post_data = $this->input->post(NULL, TRUE)) {
				$this->load->model('Role_permission_model', 'role_permission');
				$result = $this->role_permission->role_permission($post_data['roleid'], $post_data['ids']);
				if ($result) {
					echo json_encode(array('save'=>true));
				} else {
					echo json_encode(array('save'=>false));
				}
				return;
			}
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}

	/**
	 * 检查角色是否已注册
	 * @return [json] [description]
	 */
	public function check_role_name () {
		try {
			$name = trim($this->input->post('name', TRUE));
			$this->load->model('Role_model', 'role');
			$row = $this->role->get_by("name LIKE '%{$name}%'");
			if (count($row) > 0) {
				echo json_encode(array('name',false));
			} else {
				echo json_encode(array('name',true));
			}
			return;
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}

	/**
	 * 检查键值是否存在
	 * @return json [description]
	 */
	public function check_key() {
		try {
			$key = trim($this->input->post('key', TRUE));
			$this->load->model('Permission_model', 'permission');
			$row = $this->permission->get_by(array('key'=>$key));
			if (count($row) > 0) {
				echo json_encode(array('key',false));
			} else {
				echo json_encode(array('key',true));
			}
			return;
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}

	/**
	 * 检查url是否存在
	 * @return json [description]
	 */
	public function check_url() {
		try {
			$url = trim($this->input->post('url', TRUE));
			$this->load->model('Permission_model', 'permission');
			$row = $this->permission->get_by(array('url'=>$url));
			if (count($row) > 0) {
				echo json_encode(array('url',false));
			} else {
				echo json_encode(array('url',true));
			}
			return;
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}
}

/* End of file role.php */
/* Location: ./application/controllers/admin/role.php */