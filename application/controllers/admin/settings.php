<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->model('settings_model');
		$this->load->model('users_model');
		$this->lang->load('content');
		$this->load->helper('language');

		if(!$this->ion_auth->logged_in()) {
			show_404();
		}
	}

	public function index() {
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			redirect('auth', 'refresh');
		}

		$data['main_menu'] = 'settings';
		$data['menu'] = array();
		$data['usermenu'] = array();

		$data['user']  = $this->users_model->getUserById($this->ion_auth->get_user_id());

		$oPost = (object) $this->input->post();

		if(!empty($oPost->form_edit)) {
			$this->form_validation->set_rules('username', '', 'required');
			$this->form_validation->set_rules('first_name', '', 'required');
			$this->form_validation->set_rules('last_name', '', 'required');
			$this->form_validation->set_rules('email', '', 'required');

			if ($this->form_validation->run() == true) {

				$aValidParams = array(
					'username'      => $oPost->username,
					'first_name'    => $oPost->first_name,
					'last_name'     => $oPost->last_name,
				);

				$this->session->set_flashdata('message',  array(
						'type' => 'success',
						'text' => 'Успешное сохранение'
					)
				);
			} else {
				$this->session->set_flashdata('message',   array(
						'type' => 'danger',
						'text' =>  validation_errors()
					)
				);
			}
		}

		$data['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';

		$this->load->view('admin/header', $data);
		$this->load->view('admin/settings/edit', $data);
		$this->load->view('admin/footer', $data);
	}
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */