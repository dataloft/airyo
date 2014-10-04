<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Users
 *
 * @editor N.Kulchinskiy
 */
class Users extends CommonAdminController {

	public function __construct() {
		parent::__construct();

		$this->load->model('groups_model');
	}

	/**
	 * Получение списка пользователей
	 *
	 * @author N.Kulchinskiy
	 */
	public function index() {
		$this->oData['main_menu'] = 'users';

		$aPaginationConfig = $this->getPaginationConfig();
		$aPaginationConfig['base_url'] = '/admin/users/';
		$aPaginationConfig['total_rows'] = $this->users_model->record_count();

		$this->pagination->initialize($aPaginationConfig);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->oData["users"] = $this->users_model->fetch_countries($aPaginationConfig["per_page"], $page);

		foreach ($this->oData["users"] as $iKey => $aUser) {
			$this->oData["users"][$iKey]->groups = $this->ion_auth->get_users_groups($aUser->id)->result_array();
		}

		$this->oData['profile_id'] = $this->oUser->id;
		$this->oData['pagination'] = $this->pagination;

		$this->oData['view'] = 'admin/users/list';
	}

	/**
	 * Отображение/редактирование пользователя
	 *
	 * @param $iId
	 *
	 * @return edit view
	 *
	 * @author N.Kulchinskiy
	 */
	public function edit($iId) {
		$iId = intval($iId);
		if($iId == $this->oUser->id) {
			redirect("admin/users/profile", 'refresh');
		} else {
			$this->oData['main_menu'] = 'users';

			$oPost = (object) $this->input->post();

			if(!empty($oPost->form_edit)) {
				/** Оповещение */
				$this->oData['message'] = $this->updateProfile($iId);
				$this->oData['message']['form'] = "profile";
			}

			$this->oData['user']  = $this->users_model->getUserById($iId);
			$this->oData['groups']  = $this->ion_auth->groups()->result_array();
			$aUserGroups = $this->groups_model->getUsersGroups(array('iUserId' => $iId));

			$aGroups = array();
			foreach ($aUserGroups as $aGroup) {
				array_push($aGroups, $aGroup->group_id);
			}

			$this->oData['user_groups'] = $aGroups;

			$this->oData['view'] = 'admin/users/edit';
		}
	}

	/**
	 * Отображение/редактирование профиля
	 *
	 * @author N.Zakharenko
	 */
	public function profile() {
		$this->oData['main_menu'] = 'users';

		$oPost = (object) $this->input->post();

		if(!empty($oPost->form_edit)) {
			$aMessage = array();

			if($oPost->form_edit == "profile") {
				$aMessage = $this->updateProfile($this->oUser->id);
			}
			elseif($oPost->form_edit == "password") {
				$this->form_validation->set_rules('oldpassword', 'Пароль', 'trim|required|md5');
				$this->form_validation->set_rules('newpass', 'Новый пароль', 'trim|required');
				$this->form_validation->set_rules('passconf', 'Подтверждение пароля', 'trim|required|matches[newpass]');

				if ($this->form_validation->run() == true) {
					$identity = $this->session->userdata($this->config->item('identity', 'ion_auth'));
					$OldPassword = $oPost->oldpassword;
					$NewPassword = $oPost->newpass;

					$aMessage = $this->changePassword($identity, $OldPassword, $NewPassword);
				} else {
					$aMessage = array(
						'type' => 'danger',
						'text' =>  validation_errors()
					);
				}
				$aMessage['form'] = 'password';
			}
			/** Оповещение */
			$this->oData['message'] =  $aMessage;
		}

		$aUserGroups = $this->groups_model->getUsersGroups(array('iUserId' => $this->oUser->id));
		$aGroups = array();
		if($aUserGroups) {
			foreach ($aUserGroups as $aGroup) {
				array_push($aGroups, $aGroup->group_id);
			}
		}

		$this->oData['user']  = $this->users_model->getUserById($this->oUser->id);
		$this->oData['user_groups']  = $aGroups;
		$this->oData['groups']  = $this->ion_auth->groups()->result_array();

		$this->oData['view'] = 'admin/users/profile';
	}

	/**
	 * Обновление профиля
	 *
	 * @param $iId
	 * @return array
	 *
	 * @author N.Kulchinskiy
	 */
	private function updateProfile($iId){
		$aMessage = array();

		$iId = intval($iId);
		if($iId > 0) {
			$this->form_validation->set_rules('username', 'Пользователь', 'trim|required|min_length[3]|max_length[25]|alpha_numeric');
			$this->form_validation->set_rules('first_name', 'Имя', 'trim|min_length[2]|xss_clean');
			$this->form_validation->set_rules('last_name', 'Фамилия', 'trim|min_length[2]|xss_clean');
			$this->form_validation->set_rules('email', 'Почтовый адрес', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('company', 'Название компании', 'trim|min_length[3]|xss_clean');
			$this->form_validation->set_rules('phone', 'Телефонный номер', 'trim|alpha_dash');
			$this->form_validation->set_rules('groups', 'Группа', 'required');

			if ($this->form_validation->run() == true) {
				$aProfileData = array(
					'username'      => $this->input->post('username',TRUE),
					'first_name'    => $this->input->post('first_name',TRUE),
					'last_name'     => $this->input->post('last_name',TRUE),
					'email'         => $this->input->post('email',TRUE),
					'company'       => $this->input->post('company',TRUE),
					'phone'         => $this->input->post('phone',TRUE)
				);
				$aGroups = $this->input->post('groups',TRUE);
				if ($this->users_model->Update($iId, $aProfileData)) {
					if($this->ion_auth->remove_from_group(false, $iId)) {
						foreach ($aGroups as $iGroupId) {
							if(!$this->ion_auth->add_to_group($iGroupId, $iId)) {
								return $aMessage = array(
									'type' => 'warning',
									'text' => 'Ошибка при добавлении в группу'
								);
							}
						}
					}

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
/* Location: ./application/controllers/admin/users.php */