<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MY_Controller {
	 function __construct(){
		parent::__construct();
	}
	 
	public function index()
	{
		$this->template->render();
	}
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */