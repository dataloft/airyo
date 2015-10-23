<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Airyo {


	//protected $default;


	public function __construct() {
		parent::__construct();

		$this->load->model('pages_model');
		//$this->load->model('trash_model');

		//$this->config->load('templates');

		$this->lang->load('airyo_pages', 'russian');

		//$this->default = $this->config->item('default_template');

		$this->data['main_menu'] = 'pages';
	}


	public function index() {

		$this->data['notice'] = $this->notice_pull();

		$this->data['content'] = $this->pages_model->get_list();

		$this->load->view('pages/list', $this->data);

		$this->updateLogs();
	}


	public function edit($id = false) {

		$this->data['page'] = $this->pages_model->get_by_id($id);
		
		
		
		

		$this->load->view('pages/edit', $this->data);
	}


	public function check_alias () {
		if (!empty($_POST['alias']) && !preg_match('/^[a-z0-9-\/\.]+$/', $this->input->post('alias'))){
			$this->form_validation->set_message(__FUNCTION__, 'Некорректно указан адрес страницы');
			return false;
		}
		else
		{
			$page = $this->pages_model->getByAlias($this->input->post('alias'));
			$this->form_validation->set_message(__FUNCTION__, 'The alias you entered is already used.');

			if (empty($page))
				return true;

			if ($this->input->post('id') == $page->id)
				return true;
			else
				return false;
		}
	}


	public function delete () {
		if (isset($_POST))
		{
			$id = $this->input->post('id');

			if ($id)
			{
				$data['page'] = $this->pages_model->getToId($id);

				if (!empty($data['page']))
				{
					$aAdditionalData = array(
						'deleted_id' => $id,
						'type' => 'page',
						'data' => serialize($data['page'])
					);

					if ($this->trash_model->Add($aAdditionalData))
					{
						if ($this->pages_model->delete($id)) {
							$output['success']='success';
							$this->session->set_flashdata('message',  array(
								'type' => 'success',
								'text' => 'Запись удалена'
							)
																					 );
						} else {
							$output['error']='error';
						}
					}
					else {
						$output['error']='error';
					}

					echo json_encode($output);
				}
			}
		}
	}


}