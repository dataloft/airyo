<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	/** @var  int */
	private $iUserId;

	public function __construct() {
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->model('users_model');
		$this->lang->load('content');
		$this->load->helper('language');
		$this->iUserId = $this->ion_auth->get_user_id();

		if(!$this->ion_auth->logged_in()) {
			show_404();
		}
	}

	public function index() {
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			redirect('auth', 'refresh');
		}

		$data['main_menu'] = 'users';
		$data['menu'] = array();
		$data['usermenu'] = array();

		$data['user']  = $this->users_model->getUserById($this->iUserId);
		$data['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';

		$this->load->view('admin/header', $data);
		$this->load->view('admin/users/list', $data);
		$this->load->view('admin/footer', $data);
	}

	/**
	 * Отображение/редактирование профиля пользователя
	 *
	 * @author N.Zakharenko
	 */
	public function profile() {
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			redirect('auth', 'refresh');
		}

		$data['main_menu'] = 'users';
		$data['menu'] = array();
		$data['usermenu'] = array();

		$data['user']  = $this->users_model->getUserById($this->iUserId);

		$oPost = (object) $this->input->post();

		if(!empty($oPost->form_edit)) {
			$aMessage = array();

			if($oPost->form_edit == "profile") {
				$this->form_validation->set_rules('username', 'Пользователь', 'trim|required|min_length[5]|max_length[25]|alpha_numeric');
				$this->form_validation->set_rules('first_name', 'Имя', 'trim|min_length[2]|xss_clean');
				$this->form_validation->set_rules('last_name', 'Фамилия', 'trim|min_length[2]|xss_clean');
				$this->form_validation->set_rules('email', 'Почтовый адрес', 'trim|required|valid_email|xss_clean');
				$this->form_validation->set_rules('company', 'Название компании', 'trim|min_length[3]|xss_clean');
				$this->form_validation->set_rules('phone', 'Телефонный номер', 'trim|alpha_dash');

				if ($this->form_validation->run() == true) {
					$aProfileData = array(
						'username'      => $this->input->post('username',TRUE),
						'first_name'    => $this->input->post('first_name',TRUE),
						'last_name'     => $this->input->post('last_name',TRUE),
						'email'         => $this->input->post('email',TRUE),
						'company'       => $this->input->post('company',TRUE),
						'phone'         => $this->input->post('phone',TRUE),
					);

					if ($this->users_model->Update($this->iUserId, $aProfileData)) {
						$aMessage = array(
							'type' => 'success',
							'text' => 'Успешное сохранение профиля'
						);
					}
				} else {
					$aMessage = array(
						'type' => 'danger',
						'text' =>  validation_errors()
					);
				}
			}
			elseif($oPost->form_edit == "password") {
				$this->form_validation->set_rules('password', 'Пароль', 'trim|required|matches[passconf]|md5');
				$this->form_validation->set_rules('passconf', 'Подтверждение пароля', 'trim|required');
				$this->form_validation->set_rules('newpass', 'Новый пароль', 'trim|required');


				if ($this->form_validation->run() == true) {
					if($data['user']->password === $this->input->post('password',TRUE)) {
						if ($this->users_model->Update($this->iUserId, array('password' => $this->input->post('newpass',TRUE)))) {
							$aMessage = array(
									'type' => 'success',
									'text' => 'Пароль изменён'
							);
						}
					} else {
						$aMessage = array(
							'type' => 'warning',
							'text' => "Неверный пароль"
						);
					}
				} else {
					$aMessage = array(
						'type' => 'danger',
						'text' =>  validation_errors()
					);
				}
			}
			/** Оповещение */
			$this->session->set_flashdata('message', $aMessage);
		}

		$data['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';

		$this->load->view('admin/header', $data);
		$this->load->view('admin/users/profile', $data);
		$this->load->view('admin/footer', $data);
	}
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */