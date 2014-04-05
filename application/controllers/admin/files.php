<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Files extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('ion_auth');
	}

	public function index() {

		if(!$this->ion_auth->logged_in()) {
			redirect('admin', 'refresh');
		}

		$data['menu'] = array();
		$data['main_menu'] = 'files';
		$data['usermenu'] = array();
		
		$this->load->view('admin/header', $data);
		$this->load->view('admin/files/list');
		$this->load->view('admin/footer', $data);
	}
	
	public function edit($id = '') {
		
		
	}
	
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */