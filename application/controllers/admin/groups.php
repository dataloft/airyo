<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Groups
 *
 * @editor N.Kulchinskiy
 */
class Groups extends CommonAdminController {

	public function __construct() {
		parent::__construct();
		$this->load->model('groups_model');
	}

	/**
	 * Получение списка групп пользователей,
	 *
	 * @author N.Kulchinskiy
	 */
	public function index() {
		$aParams = parent::index();
		$aParams['header']['main_menu'] = 'groups';

		$aParams['header']['styles'] = array(
			'/themes/airyo/css/typeahead.css',
		);

		$aParams['footer']['scripts'] = array(
			'/themes/airyo/js/typeahead.bundle.js',
			'/themes/airyo/groups/js/groups.js'
		);

		$aGroups = $this->ion_auth->groups()->result_array();
		foreach ($aGroups as $iKey => $aGroup) {
			$aGroups[$iKey]['users'] = $this->ion_auth->users($aGroup['id'])->result_array();
		}

		$aParams['body']["groups"] = $aGroups;
		$aParams['body']['message'] =  $this->session->flashdata('message') ? $this->session->flashdata('message') : '';

		$this->header_vars = $aParams['header'];
		$this->body_vars = $aParams['body'];
		$this->footer_vars = $aParams['footer'];
		$this->body_file = 'admin/groups/index';
	}

	/**
	 * Отображение/редактирование группы пользователя
	 *
	 * @param $iId
	 *
	 * @return edit view
	 *
	 * @author N.Kulchinskiy
	 */
	public function edit($iId) {
		$aParams = parent::edit();

		var_dump($_POST);
		die();

		$iId = intval($iId);
		if($iId == $this->oUser->id) {
			redirect("admin/users/profile", 'refresh');
		} else {
			$aParams['header']['main_menu'] = 'users';

			$oPost = (object) $this->input->post();

			if(!empty($oPost->form_edit)) {
				$aMessage = $this->updateProfile($iId);

				/** Оповещение */
				$this->session->set_flashdata('message', $aMessage);
			}

			$aParams['body']['user']  = $this->users_model->getUserById($iId);
			$aParams['body']['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';

			$this->header_vars = $aParams['header'];
			$this->body_vars = $aParams['body'];
			$this->body_file = 'admin/users/edit';
		}
	}
}

/* End of file groups.php */
/* Location: ./application/controllers/admin/groups.php */