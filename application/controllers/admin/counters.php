<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Counters extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
		$this->load->model('content_model');
		$this->load->model('trash_model');
        $this->lang->load('content');
        $this->load->helper('language');
	}

	public function index() {
        if(!$this->ion_auth->logged_in()) {
			redirect('admin', 'refresh');
		}

		$data['main_menu'] = 'content';
		$data['menu'] = array();
		$data['usermenu'] = array();
        $data['type'] = '';
        $data['search'] = '';
        $data['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';
		$this->load->view('admin/header', $data);
		$this->load->view('admin/counters/counters', $data);
		$this->load->view('admin/footer', $data);
	}
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */