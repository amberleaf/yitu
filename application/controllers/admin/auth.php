<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * @Description: 后台管理员注册/登陆/增删改相关
 * @author TSH
 * @date 2014-6-10 晚上11:18:20
 */
class Auth extends MY_Controller {

	/**
	 * 构造函数
	 */
	public function __construct(){
		parent::__construct();
	}

	/**
	 * 取得公共数据
	 * @param  string $type 自定义数据类型标示
	 * @return null       null
	 */
	protected function _base_data($type=NULL) {
		switch ($type) {
			
			//取得管理组列表
			case 'role':
				$this->load->model('Role_model', 'role');
				$roles = $this->role->get_all();
				$this->template->set('roles', $roles);
			default:
				break;
		}
	}

	/**
	 * 获取管理员详细信息
	 * @return html ajax
	 */
	public function admin_detail() {
		try {
			$id = $this->input->post('id', TRUE);
			//取得管理员详细信息
			$this->load->model('Admin_model', 'admin');
			$row = $this->admin->get($id);
			
			//取得创建者数据
			if ($row->id == $row->creator) {
				$row->creator_name = $row->realname ? $row->realname : $row->username;
			} else {
				$this->admin->select(array('id','username','realname'));
				$creator_row = $this->admin->get($row->creator);
				$row->creator_name = $creator_row->realname ? $creator_row->realname : $creator_row->username;
			}
			$this->template->set('detail', $row);
			$this->_base_data('category');	//获取类型
			$this->template->render();
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}

	/**
	 * 管理员列表
	 * @return [type] [description]
	 */
	public function lists() {
		try {
			//获取查询条件
			$params = array_filter($this->input->get(NULL, TRUE));
			$this->template->set('search', $params);

			//获取页码
			$page = isset($params['page']) ? intval($params['page']) : 1;
			$options = array('page' => $page, 'offset' => PAGE_OFFSET);
			
			//加载model
			$this->load->model('Admin_model', 'admin');
			
			//查询管理员列表
			$data = $this->admin->get_admin_list($params, $options);
			
			//赋值数据给模板
			$this->template->set('list', $data['list']);
			$this->template->set('total', $data['total']);

			//设置页码
			$page_array = array(
				'total' => $data['total'],
				'cur' => $page,
				'offset' => PAGE_OFFSET,
				'links' => 5
			);
			$this->load->helper('page');
			$page_links = show_back_page($page_array, $params);
			$this->template->set('page_links', $page_links);

			$this->_base_data('role');			//取得管理组数据


			//展示页面
			$this->template->render();
			
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}

	/**
	 * 后台登陆
	 * @return [type] [description]
	 */
	public function login()
	{
		try {
			if ($postData = $this->input->post(NULL, TRUE)) {
				$name = trim($postData['username']);
				$pwd = md5(trim($postData['password']));
				$this->load->model('Admin_model', 'admin');
				//根据用户名从数据库取得管理员信息
				$row = $this->admin->get_by('username', $name);
				//管理员不存在
				if (empty($row)) {
					$this->template->set_message("用户名不存在，请重新输入！","alert-danger");
					redirect(base_url() . 'admin/auth/login');
				}
				//密码不正确
				if ($pwd != $row->password) {
					$this->template->set_message("密码不正确，请重新输入！","alert-danger");
					$this->olog->write("{$name}尝试登录");	//记录日志
					redirect(base_url() . 'admin/auth/login');
				}
				//管理员没有激活
				if ($row->status == 0) {
					$this->template->set_message("该管理员没有激活，请联系超级管理员激活后才能登录！", "alert-danger");
					redirect(base_url() . 'admin/auth/login');
				}
				//登录成功，记录session
				$user_session = array(
					'admin_id' => $row->id,
					'admin_user' => $row->username,
					'admin_role' => $row->role_id,
					'admin_login' => TRUE
				);
				$this->session->set_userdata($user_session);
				$this->olog->write("{$row->username}登录成功！");
				redirect(base_url() . 'admin/main/index');
			}
			$this->template->render(NULL, FALSE, TRUE);
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}

	/**
	 * 后台添加/修改管理员
	 * @return [type] [description]
	 */
	public function register()
	{
		try {
			//加载页面Css和Js文件
			$css = array('assets' => array('jquery-ui-1.10.3.custom.min', 'chosen', 'validationEngine.jquery'));
			$this->template->set('page_css', $css);
			$this->load->model('Admin_model', 'admin');
			if ($form_data = $this->input->post(NULL, TRUE)) {
				$data['username'] = $form_data['username'];
				$data['password'] = md5($form_data['password']);
				$data['realname'] = $form_data['realname'];
				$data['sex'] = $form_data['sex'];
				$data['mobil'] = $form_data['mobil'];
				$data['role_id'] = $form_data['role'];
				
				$data['creator'] = $this->_session_info['admin_id'];
				$data['cratetime'] = time();
				$data['status'] = $form_data['status'];
				
				if (isset($form_data['qq'])) {
					$data['qq'] = $form_data['qq'];
				}
				if (isset($form_data['uemail'])) {
					$data['email'] = $form_data['uemail'];
				} 
				if ($form_data['id']) {
					$iid = $this->admin->update($form_data['id'], $data, TRUE);
					$this->olog->write("修改管理员{$form_data['username']}的信息","update");	//记录日志
					$mes_success = "修改成功！";
					$mes_danger = "修改失败！";
				} else {
					$iid = $this->admin->insert($data, TRUE);
					$this->olog->write("新添加了一个管理员，ID是{$iid}", "insert");	//记录日志
					$mes_success = "添加成功！恭喜您成为本站第{$iid}位管理员！";
					$mes_danger = "添加失败！请重新审核数据！";
				}
				if ($iid > 0) {
					$this->template->set_message($mes_success, "alert-success");
					redirect(base_url() . 'admin/auth/lists');
				} else {
					$this->template->set_message($mes_danger, "alert-danger");
				}
			}
			if ($id = $this->input->get('id')) {
				$row = $this->admin->get($id);
				$this->template->set('admin', $row);
			}
			
			$this->_base_data('role');		//取得管理组数据 

			$this->template->render();
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}

	/**
	 * 退出系统
	 * @return [type] [description]
	 */
	public function logout()
	{
		//记录日志
		$this->olog->write("管理员{$this->_session_info['admin_user']}退出系统");
		//清除管理后台用户session
		$logout_arr = array('admin_id' => '', 'admin_user' => '', 'admin_role' => '', 'admin_login' => '');
		$this->session->unset_userdata($logout_arr);
		redirect(base_url() . 'admin/auth/login');
	}
	
	/**
	 * 重置密码
	 * @return [type] [description]
	 */
	public function reset_password() {
		try {
			$this->load->model('Admin_model', 'admin');
			//接受新密码，修改密码
			if ($data = $this->input->post(NULL, TRUE)) {
				$password = md5($data['newpwd']);
				$result = $this->admin->update($data['id'], array('password'=>$password));
				if ($result > 0) {
					$this->template->set_message("修改成功，可以重新登录！", "alert-success");
					redirect(base_url() . 'admin/auth/login');
				} else {
					$this->template->set_message("修改失败，可尝试重新修改！", "alert-danger");
					redirect(base_url() . 'admin/auth/login');
				}
			}
			$user = $this->input->get('user', TRUE);
			$mail = $this->input->get('mail', TRUE);
			//检查这个用户是否存在
			$row = $this->admin->get_by('username', $user);
			if (empty($row)) {
				$this->template->set_message("用户不存在！", "alert-danger");
				redirect(base_url() . 'admin/auth/login');
			}
			//检查绑定的邮箱是否和当前邮箱相同
			if ($mail != $row->email) {
				$this->template->set_message("邮箱和您账户绑定的邮箱不一致！", "alert-danger");
				redirect(base_url() . 'admin/auth/login');
			}
			$get_hash = $this->input->get('hash', TRUE);
			$this->config->load('mail');
			$hash = md5($row->username . $row->email . $this->config->item('mail-hash-key'));
			if ($hash != $get_hash) {
				show_error("非法请求！");
			}
			if ($hash != $this->session->userdata('mail-hash-key')) {
				show_error("已经操作或连接超时！");
			}
			//请求过一次之后，清空mail-hash-key的Session
			$this->session->unset_userdata(array('mail-hash-key'=>''));
			$this->template->set('id', $row->id);
			$this->template->render(NULL, FALSE, TRUE);
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}
	
	/**
	 * Ajax检查管理员用户名
	 * @return [type] [description]
	 */
	public function check_admin_username () {
		try {
			$username = trim($this->input->post('username', TRUE));
			$this->load->model('Admin_model', 'admin');
			$row = $this->admin->get_by(array('username' => $username));
			if (count($row) > 0) {
				echo json_encode(array('username',false));
			} else {
				echo json_encode(array('username',true));
			}
			return;
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}
	
	/**
	 * 忘记密码，发送电子邮件，取得密码
	 * @return [type] [description]
	 */
	public function send_mail() {
		try {
			if ($data = $this->input->post(NULL, TRUE)) {
				$user = trim($data['user']);
				$to = trim($data['to']);
				//TODO 需要检查是否有此用户
				
				//加载mail类
				$this->load->library('email');
				//取得配置文件参数
				$this->config->load('mail');
				//初始化email类
				$this->email->initialize($this->config->item('mail'));
				//设置发件人
				$this->email->from('service@dezhi.com', '德智教育');
				//设置收件人
				$this->email->to($to);
				//设置主题
				$this->email->subject('医图在线-修改密码');
				//设置信息内容
				$hash = md5($user . $to . $this->config->item('mail-hash-key'));
				$this->session->set_userdata(array('mail-hash-key'=>$hash));
				$href = base_url() . "admin/auth/reset_password?user=".$user."&mail=".$to."&hash=".$hash;
				$this->email->message("请点击下面链接重置密码：<br/><a href='".$href."' target='_blank'>" . $href . "</a>");
				//发送邮件
				if ($this->email->send()) {
					$this->template->set_message("邮件已发送至您的邮箱{$to}，请在30分钟内登录您的邮箱完成操作！", "alert-success");
					redirect(base_url() . 'admin/auth/login');
				} else {
					$this->template->set_message("发送失败！", "alert-danger");
					redirect(base_url() . 'admin/auth/login');
				}
			}
		} catch (Exception $e) {
			show_error($e->getMessage());
		}
	}

}

/* End of file session.php */
/* Location: ./application/controllers/admin/auth.php */