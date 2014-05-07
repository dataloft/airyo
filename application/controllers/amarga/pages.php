<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('content_model');
		$this->load->model('menu_model');
	}

	public function index($page = '') {
        $page = $this->uri->uri_string();
		$data['page'] = $this->content_model->get($page);
        $data['menu'] = $this->menu_model->getList(1,true);
        
		if($data['page']) {
			$this->load->view('amarga/header', $data);
			$this->load->view('amarga/menu', $data);
			
			if ($this->uri->uri_string != '') {
				$this->load->view('amarga/pages_inner', $data);
			}
			else {
				$this->load->view('amarga/pages_home', $data);
			}
			
			$this->load->view('amarga/copyright');
			$this->load->view('amarga/footer');
		} else {
			show_404();
		}
	}
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */