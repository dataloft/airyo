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

	public function add($mid=0) {
		$aParams = parent::add();
		$aParams['header']['main_menu'] = 'groups';

		$aParams['body']['id'] = '';
		$aParams['body']['message'] = '';

		$menu = new ArrayObject;
		$aParams['body']['title'] = "Добавить/редактировать группу";

		if (!$this->ion_auth->is_admin()) {
			redirect('auth', 'refresh');
		}

		$aParams['body']['menu_group'] = $mid;

		$this->form_validation->set_rules('name', '', 'required');
		$this->form_validation->set_rules('url', '', 'required');
		$menu->name = $this->input->post('name');
		$menu->url = $this->input->post('url');
		$menu->order = $this->input->post('order',TRUE);
		$menu->menu_group = $this->input->post('menu_group');
		$aParams['body']['menu'] = $menu;
		if ($this->form_validation->run() == true) {
			if ($check = $this->menu_model->ckeckUniqueOrder($this->input->post('level_menu',TRUE), $this->input->post('order',TRUE))) {
				$check_order = $this->menu_model->getMaxOrder($this->input->post('level_menu',TRUE))+1;
				$this->menu_model->Update($check, array('order' => $check_order));
				$menu->order = $this->input->post('order',TRUE);
			} else {
				$menu->order = $this->input->post('order',TRUE);
			}
			$additional_data = array(
				'name' => $menu->name,
				'url' => $menu->url,
				'menu_group' =>  $mid,
				'parent_id' =>  $this->input->post('level_menu'),
				'order' =>  $menu->order
			);
			if ($id = $this->menu_model->Add($additional_data)) {
				$this->session->set_flashdata('message',  array(
						'type' => 'success',
						'text' => 'Пункт меню создан'
					)
				);
				redirect("admin/groups/edit/$id", 'refresh');
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
	public function edit($iId = '') {
		$aParams = parent::edit();
		$aParams['header']['main_menu'] = 'groups';

		$aParams['body']['id'] = '';

		$aParams['body']['id'] = '';
		$aParams['body']['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';

		$oGroup = new stdClass();
		$aParams['body']['title'] = "Добавить/редактировать группу";

		if (!$this->ion_auth->is_admin()) {
			redirect('auth', 'refresh');
		}

		$this->form_validation->set_rules('name', '', 'required');
		$this->form_validation->set_rules('description', '', 'required');

		// Если передан Ид ищем содержание стр в БД
		if (!empty($iId)) {
			$aParams['body']['group'] = $this->ion_auth->group($iId)->row();

			$aParams['body']['id'] = $iId;

			if ($this->form_validation->run() == true) {

				$oGroup->name = $this->input->post('name',TRUE);
				$oGroup->url = $this->input->post('url',TRUE);
				//Если сменился родитель добавляем пункт к новому родитель в конец списка
				if ($check = $this->menu_model->ckeckUniqueOrder($this->input->post('level_menu',TRUE), $this->input->post('order',TRUE), $id))
				{
					$check_order = $this->menu_model->getMaxOrder($this->input->post('level_menu',TRUE))+1;
					$this->menu_model->Update($check, array('order' => $check_order));
					$oGroup->order = $this->input->post('order',TRUE);

				}
				else
				{
					$oGroup->order = $this->input->post('order',TRUE);
				}

				$oGroup->menu_group = $aParams['body']['menu']->menu_group;

				$aParams['body']['group'] = $oGroup;
				$additional_data = array(
					'name' => $oGroup->name,
					'url' => $oGroup->url,
					'order' => $oGroup->order
				);
				if ($this->groups_model->Update($aParams['body']['id'],$additional_data))
				{
					$aParams['body']['message'] = array(
						'type' => 'success',
						'text' => 'Запись обновлена'
					);
				}
				else
				{
					$aParams['body']['message'] = array(
						'type' => 'danger',
						'text' => 'Произошла ошибка при обновлении записи.'
					);
				}
			}
			elseif($this->input->post('id')== $iId)
			{
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
		$this->body_file = 'admin/groups/edit';
	}
}

/* End of file groups.php */
/* Location: ./application/controllers/admin/groups.php */