<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
	}

	public function index() {
		$this->load->view('admin/header');
		$this->load->view('admin/login');
		$this->load->view('admin/footer');
	}
	
	public function logout() {
		redirect('/admin', 'location');
	}
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */