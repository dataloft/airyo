<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Groups
 *
 * @editor N.Kulchinskiy
 */
class Groups extends Airyo {

	public function __construct() {
		parent::__construct();
		$this->load->model('trash_model');
	}

	/**
	 * Получение списка групп пользователей,
	 *
	 * @author N.Kulchinskiy
	 */
	public function index() {
		$this->oData['main_menu'] = 'groups';

		$this->oData['scripts'] = array(
			'/themes/airyo/js/groups.js'
		);

		$aGroups = $this->ion_auth->groups()->result_array();

		$this->oData["groups"] = $aGroups;

		$this->oData['view'] = 'airyo/groups/index';
	}

	public function add() {
		$this->oData['main_menu'] = 'groups';

		$this->oData['id'] = '';
		$this->oData['message'] = '';

		$oGroups = new stdClass();
		$this->oData['title'] = "Добавить/редактировать группу";

		$this->form_validation->set_rules('name', '', 'required');
		$this->form_validation->set_rules('description', '', 'required');

		$oGroups->name = $this->input->post('name');
		$oGroups->description = $this->input->post('description');

		$this->oData['group'] = $oGroups;
		if ($this->form_validation->run() == true) {
			if ($iId = $this->ion_auth->create_group($oGroups->name, $oGroups->description)) {
				$this->oData['message'] = array(
					'type' => 'success',
					'text' => 'Группа создана'
				);
				redirect("airyo/groups/edit/$iId", 'refresh');
			} else {
				$this->oData['message'] = array(
					'type' => 'danger',
					'text' => 'Произошла ошибка при сохранении записи.'
				);
			}
		}
		elseif ($this->input->post('action') == 'add') {
			$this->oData['message'] = array(
				'type' => 'danger',
				'text' =>  validation_errors()
			);
		}

		$this->oData['view'] = 'airyo/groups/edit';
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
		$this->oData['main_menu'] = 'groups';

		$this->oData['scripts'] = array(
			'/themes/airyo/js/groups.js'
		);

		$oGroup = new stdClass();
		$this->oData['title'] = "Добавить/редактировать группу";
		$this->oData['id'] = '';

		$this->form_validation->set_rules('name', '', 'required');
		$this->form_validation->set_rules('description', '', 'required');

		// Если передан ID, сохраняем группу
		if (!empty($iId) AND $iId = intval($iId) AND $iId > 0) {
			$this->oData['group'] = $this->ion_auth->group($iId)->row();

			$this->oData['id'] = $iId;

			if ($this->form_validation->run() == true) {
				$oGroup->name = $this->input->post('name',TRUE);
				$oGroup->description = $this->input->post('description',TRUE);

				$this->oData['group'] = $oGroup;
				if ($this->ion_auth->update_group($iId, $oGroup->name, $oGroup->description)) {
					$this->oData['message'] = array(
						'type' => 'success',
						'text' => 'Запись обновлена'
					);
				} else {
					$this->oData['message'] = array(
						'type' => 'danger',
						'text' => 'Произошла ошибка при обновлении записи.'
					);
				}
			}
			elseif($this->input->post('id') == $iId) {
				$oGroup->name = $this->input->post('name',TRUE);
				$oGroup->description = $this->input->post('description',TRUE);

				$this->oData['group'] = $oGroup;
				$this->oData['message'] = array(
					'type' => 'danger',
					'text' => validation_errors()
				);
			}
		} else { //Вставляем новую запись
			redirect("airyo/groups/add", 'refresh');
		}

		$this->oData['view'] = 'airyo/groups/edit';
	}

	/**
	 * Удаление группы пользователя
	 *
	 * @author N.Kulchinskiy
	 */
	public function delete () {
		if(!$this->ion_auth->logged_in()) {
			redirect('admin', 'refresh');
		}

		if (isset($_POST)) {
			if ($iId = $this->input->post('id')) {
				$data['group'] = $this->ion_auth->get_users_groups($iId);
				if (!empty($data['group'])) {
					$additional_data = array(
						'deleted_id'    => $iId,
						'type'          => 'group',
						'data'          => serialize($data['group'])
					);
					if ($this->trash_model->Add($additional_data)) {
						if ($this->ion_auth->delete_group($iId)) {
							$output['success']='success';
							$this->session->set_flashdata('message',  array(
									'type' => 'success',
									'text' => 'Группа удалена'
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