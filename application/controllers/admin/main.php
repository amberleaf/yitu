<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 后台主页面
 * @Description: Enter description here ...
 * @author Dezhi
 * @date 2014-6-12 上午11:24:13
 */
class Main extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

	/**
	 * 管理主页面
	 * @return [type] [description]
	 */
	public function index() {
		$this->template->render();
	}

	/**
	 * 上传文件
	 * @return [type] [description]
	 */
	public function do_upload() {
		//可定制图片的宽度高度max_width,max_height
		$config = array(
			'upload_path' => './datas/upload',
			'allowed_types' => 'gif|png|jpg|jpeg',
			'max_size' => '5000',
			'overwrite' => TRUE,
			'remove_spaces' => TRUE
		);
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload()) {
			$errors = $this->upload->display_errors();
			echo json_encode(array('errors', $errors));
		} else {
			$data = $this->upload->data();
			$data['url'] = substr($data['full_path'], strpos($data['full_path'], 'datas')-1);
			$files = array('files' => array($data));
			echo json_encode($files);
		}
		return true;
	}
}

/* End of file main.php */
/* Location: ./application/controllers/admin/main.php */