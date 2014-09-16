<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Users
 *
 * @editor N.Zakharenko
 */
class Users extends CommonAdminController {

	/** @var  int */
	protected $iUserId;

	public function __construct() {
		parent::__construct();
		$this->load->model('users_model');
		$this->iUserId = $this->ion_auth->get_user_id();
	}

	public function index() {
		$data_header['main_menu'] = 'users';
		$data_header['menu'] = array();
		$data_header['usermenu'] = array();

		$config = array(
				'full_tag_open'     => '<ul class="pagination pagination-sm">',
				'full_tag_close'    => '</ul>',
				'first_link'        => '&laquo;',
				'first_tag_open'    => '<li>',
				'first_tag_close'   => '</li>',
				'last_link'         => '&raquo;',
				'last_tag_open'     => '<li>',
				'last_tag_close'    => '</li>',
				'next_link'         => '&raquo',
				'next_tag_open'     => '<li>',
				'next_tag_close'    => '</li>',
				'prev_link'         => '&laquo',
				'prev_tag_open'     => '<li>',
				'prev_tag_close'    => '</li>',
				'cur_tag_open'      => '<li class="active"><span>',
				'cur_tag_close'     => '<span class="sr-only">(current)</span></span></li>',
				'num_tag_open'      => '<li>',
				'num_tag_close'     => '</li>',
				'base_url'          => '/admin/users/',
				'total_rows'        => $this->users_model->record_count(),
				'per_page'          => '20'
		);

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data_body["users"] = $this->users_model->fetch_countries($config["per_page"], $page);

		$data_body['profile_id'] = $this->iUserId;
		$data_body['pagination'] = $this->pagination;

		$data_body['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';

		$this->header_vars = $data_header;
		$this->body_vars = $data_body;
		$this->body_file = 'admin/users/list';
	}

	/**
	 * Отображение/редактирование пользователя
	 *
	 * @param $iId
	 *
	 * @return edit view
	 */
	public function edit($iId) {
		$iId = intval($iId);
		if($iId == $this->iUserId) {
			redirect("admin/users/profile", 'refresh');
		} else {
			$data_header['main_menu'] = 'users';
			$data_header['menu'] = array();
			$data_header['usermenu'] = array();

			$oPost = (object) $this->input->post();

			if(!empty($oPost->form_edit)) {
				$aMessage = $this->updateProfile($iId);

				/** Оповещение */
				$this->session->set_flashdata('message', $aMessage);
			}

			$data_body['user']  = $this->users_model->getUserById($iId);
			$data_body['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';

			$this->header_vars = $data_header;
			$this->body_vars = $data_body;
			$this->body_file = 'admin/users/edit';
		}
	}

	/**
	 * Отображение/редактирование профиля
	 *
	 * @author N.Zakharenko
	 */
	public function profile() {
		$data_header['main_menu'] = 'users';
		$data_header['menu'] = array();
		$data_header['usermenu'] = array();

		$oPost = (object) $this->input->post();

		if(!empty($oPost->form_edit)) {
			$aMessage = array();

			if($oPost->form_edit == "profile") {
				$aMessage = $this->updateProfile($this->iUserId);
			}
			elseif($oPost->form_edit == "password") {
				$this->form_validation->set_rules('password', 'Пароль', 'trim|required|matches[passconf]|md5');
				$this->form_validation->set_rules('passconf', 'Подтверждение пароля', 'trim|required');
				$this->form_validation->set_rules('newpass', 'Новый пароль', 'trim|required');

				if ($this->form_validation->run() == true) {
					$identity = $this->session->userdata($this->config->item('identity', 'ion_auth'));
					$OldPassword = $oPost->password;
					$NewPassword = $oPost->newpass;

					$aMessage = $this->changePassword($identity, $OldPassword, $NewPassword);
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

		$data_body['user']  = $this->users_model->getUserById($this->iUserId);
		$data_body['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';

		$this->header_vars = $data_header;
		$this->body_vars = $data_body;
		$this->body_file = 'admin/users/profile';
	}

	/**
	 * Обновление профиля
	 *
	 * @param $iId
	 * @return array
	 */
	private function updateProfile($iId){
		$aMessage = array();

		$iId = intval($iId);
		if($iId > 0) {
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

				if ($this->users_model->Update($iId, $aProfileData)) {
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
		} else {
			$aMessage = array(
				'type' => 'warning',
				'text' =>  'Ошибка при сохранении'
			);
		}

		return $aMessage;
	}

	/**
	 * Изменение пароля
	 *
	 * @param $iId
	 * @param $sOld
	 * @param $sNew
	 * @return bool
	 *
	 * @author N.Kulchinskiy
	 */
	private function changePassword($iId, $sOld, $sNew) {
		if ($this->ion_auth->change_password($iId, $sOld, $sNew)) {
			$aMessage = array(
				'type' => 'success',
				'text' => 'Пароль изменён'
			);
		} else {
			$aMessage = array(
				'type' => 'warning',
				'text' => "Неверный пароль"
			);
		}

		return $aMessage;
	}
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */