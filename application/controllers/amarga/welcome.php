<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('pages_model');
		$this->load->model('menu_model');
	}

	public function index($page = '') {
		$data['page'] = $this->pages_model->get($page);
        $data['menu'] = $this->menu_model->getList(1,true);
		if($data['page']) {
			$this->load->view('amarga/header');
			$this->load->view('amarga/menu', $data);
			$this->load->view('amarga/pages_home', $data);
			$this->load->view('amarga/copyright');
			$this->load->view('amarga/footer');
		} else {
			show_404();
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */