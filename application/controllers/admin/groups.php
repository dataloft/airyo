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

		$aParams['footer']['scripts'] = array(
			'/themes/airyo/js/groups.js'
		);

		$aGroups = $this->ion_auth->groups()->result_array();

		$aParams['body']["groups"] = $aGroups;
		$aParams['body']['message'] =  $this->session->flashdata('message') ? $this->session->flashdata('message') : '';

		$this->header_vars = $aParams['header'];
		$this->body_vars = $aParams['body'];
		$this->footer_vars = $aParams['footer'];
		$this->body_file = 'admin/groups/index';
	}

	public function add() {
		$aParams = parent::add();
		$aParams['header']['main_menu'] = 'groups';

		$aParams['body']['id'] = '';
		$aParams['body']['message'] = '';

		$oGroups = new stdClass();
		$aParams['body']['title'] = "Добавить/редактировать группу";

		if (!$this->ion_auth->is_admin()) {
			redirect('auth', 'refresh');
		}

		$this->form_validation->set_rules('name', '', 'required');
		$this->form_validation->set_rules('description', '', 'required');

		$oGroups->name = $this->input->post('name');
		$oGroups->description = $this->input->post('description');

		$aParams['body']['group'] = $oGroups;
		if ($this->form_validation->run() == true) {
			if ($iId = $this->ion_auth->create_group($oGroups->name, $oGroups->description)) {
				$this->session->set_flashdata('message',  array(
						'type' => 'success',
						'text' => 'Группа создана'
					)
				);
				redirect("admin/groups/edit/$iId", 'refresh');
			} else {
				$aParams['body']['message'] = array(
					'type' => 'danger',
					'text' => 'Произошла ошибка при сохранении записи.'
				);
			}
		}
		elseif ($this->input->post('action') == 'add') {
			$aParams['body']['message'] = array(
				'type' => 'danger',
				'text' =>  validation_errors()
			);
		}

		$this->body_vars = $aParams['body'];
		$this->body_file = 'admin/groups/edit';
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
	public function edit($iId = 0) {
		$aParams = parent::edit();
		$aParams['header']['main_menu'] = 'groups';

		$aParams['footer']['scripts'] = array(
			'/themes/airyo/js/groups.js'
		);

		$aParams['body']['id'] = '';
		$aParams['body']['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';

		$oGroup = new stdClass();
		$aParams['body']['title'] = "Добавить/редактировать группу";

		if (!$this->ion_auth->is_admin()) {
			redirect('auth', 'refresh');
		}

		$this->form_validation->set_rules('name', '', 'required');
		$this->form_validation->set_rules('description', '', 'required');

		// Если передан ID, сохраняем группу
		if (!empty($iId) AND $iId = intval($iId) AND $iId > 0) {
			$aParams['body']['group'] = $this->ion_auth->group($iId)->row();

			$aParams['body']['id'] = $iId;

			if ($this->form_validation->run() == true) {
				$oGroup->name = $this->input->post('name',TRUE);
				$oGroup->description = $this->input->post('description',TRUE);

				$aParams['body']['group'] = $oGroup;
				if ($this->ion_auth->update_group($iId, $oGroup->name, $oGroup->description)) {
					$aParams['body']['message'] = array(
						'type' => 'success',
						'text' => 'Запись обновлена'
					);
				} else {
					$aParams['body']['message'] = array(
						'type' => 'danger',
						'text' => 'Произошла ошибка при обновлении записи.'
					);
				}
			}
			elseif($this->input->post('id') == $iId) {
				$oGroup->name = $this->input->post('name',TRUE);
				$oGroup->description = $this->input->post('description',TRUE);

				$aParams['body']['group'] = $oGroup;
				$aParams['body']['message'] = array(
					'type' => 'danger',
					'text' => validation_errors()
				);
			}
		} else { //Вставляем новую запись
			redirect("admin/groups/add", 'refresh');
		}

		$this->header_vars = $aParams['header'];
		$this->body_vars = $aParams['body'];
		$this->footer_vars = $aParams['footer'];
		$this->body_file = 'admin/groups/edit';
	}

	/**
	 * @author N.Kulchinskiy
	 */
	public function delete () {
		echo json_encode($_POST);
		return true;
		if (isset($_POST)) {
			$id = $this->input->post('id');
			if ($id) {
				$data['menu'] = $this->menu_model->getToId($id);
				if (!empty($data['menu'])) {
					$additional_data = array(
						'deleted_id' => $id,
						'type' =>  'menu',
						'data' =>     serialize($data['menu'])
					);
					if ($this->trash_model->Add($additional_data)) {
						if ($this->menu_model->delete($id)) {
							$output['success']='success';
							$this->session->set_flashdata('message',  array(
									'type' => 'success',
									'text' => 'Запись удалена'
								)
							);
						} else {
							$output['error']='error';
						}
					} else {
						$output['error']='error';
					}
					echo json_encode($output);
				}
			}
		}
	}
}

/* End of file groups.php */
/* Location: ./application/controllers/admin/groups.php */