<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('pages_model');
	}

	public function index($page = '') {
		$data['page'] = $this->pages_model->get($page);
		
		if($data['page']) {
			$this->load->view('header');
			$this->load->view('pages', $data);
			$this->load->view('footer');
		} else {
			show_404();
		}
	}
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */