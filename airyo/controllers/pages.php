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

	public function add() {
		$this->data['page'] = $this->pages_model->get_pages_view();
		$this->load->helper('form');

		if ($this->input->post()) {
			$this->form_validation->set_rules('h1', 'lang:h1', 'trim|required|htmlentities|xss_clean');
			$this->form_validation->set_rules('alias', 'lang:alias', 'trim|strtolower|htmlentities|xss_clean|callback_check_alias|is_unique[airyo_pages.alias]');
			$this->form_validation->set_rules('enabled', '', 'trim|xss_clean');
			$this->form_validation->set_rules('template', 'lang:template', 'trim|required|xss_clean');
			$this->form_validation->set_message('required', 'Поле %s обязательно для заполнения!');
			$this->form_validation->set_message('is_unique', 'Значение поля %s уже используется! Выберите другое!');

			$input_data = array();
			if ($this->form_validation->run()) {
				$input_data = array(
					'content'	=> $this->input->post('content'),
					'h1'		=> $this->input->post('h1'),
					'alias'		=> $this->input->post('alias'),
					'enabled'	=> $this->input->post('enabled'),
					'template'	=> $this->input->post('template'),
				);
			}

			if ($input_data) {
				if ($this->pages_model->add($input_data)) {
					$this->notice_push($this->lang->line('notice_add_sucsess'), 'success');
					redirect('/airyo/pages');
				}
				else {
					$this->notice_push($this->lang->line('notice_add_model_error'), 'danger');
				}
			}

			else {
				$this->notice_push($this->lang->line('notice_form_incorrect'), 'warning');
			}
		}

		$this->data['notice'] = $this->notice_pull();
		$this->load->view('pages/add', $this->data);
	}


	public function edit($id = false) {

		$this->data['page'] = $this->pages_model->get_by_id($id);

		if ($this->input->post()) {
			//$this->form_validation->set_rules('content', 'lang:content', 'trim|required|htmlentities|xss_clean');
			$this->form_validation->set_rules('h1', 'lang:h1', 'trim|required|htmlentities|xss_clean');
			$this->form_validation->set_rules('alias', '', 'trim|strtolower|htmlentities|xss_clean|callback_check_alias');
			$this->form_validation->set_rules('enabled', '', 'trim|xss_clean');
			$this->form_validation->set_message('required', 'Поле %s обязательно для заполнения!');

			$input = array();
			if ($this->form_validation->run()) {
				$input = array(
					'content'	=> $this->input->post('content'),
					'h1'		=> $this->input->post('h1'),
					'alias'		=> $this->input->post('alias'),
					'enabled'	=> $this->input->post('enabled'),
				);
			}

			if ($input) {
			 	if ($this->data['page']['id']) {
					$input['id'] = $id;
					if ($this->pages_model->update($input)) {
						$this->notice_push($this->lang->line('notice_update_sucsess'), 'success');
						redirect($this->uri->uri_string());
					}
					else {
						$this->notice_push($this->lang->line('notice_update_model_error'), 'danger');
					}
				}
			}

			else {
				$this->notice_push($this->lang->line('notice_form_incorrect'), 'warning');
			}

			$this->data['page'] = $this->input->post();
		}

		$this->data['notice'] = $this->notice_pull();
		$this->load->view('pages/edit', $this->data);
	}


	public function check_alias ($alias) {
		// Первая проверка на допустимые символы
    	/*if (!preg_match('/^[a-z0-9-\.\_]+$/', $alias)){
            $this->form_validation->set_message(__FUNCTION__, 'Некорректные символы в алиасе');
            return false;
        }
    	
    	// Вторая проверка - отсутствие другой записи с тем же алиасом
    	$r = $this->pages_model->get_by_alias($alias);
    	if (sizeof($r) >= 1 && @$r[0]['id'] != @$this->data['page']['id']) {
    		$this->form_validation->set_message(__FUNCTION__, 'The alias you entered is already used.');
    		return false;
    	}*/
    	
    	return true;
	}


	public function delete () {
		if (isset($_POST)) {
			$id = $this->input->post('id');
			if ($id) {
				$data['page'] = $this->pages_model->getToId($id);

				if (!empty($data['page'])) {
					$aAdditionalData = array(
						'deleted_id' => $id,
						'type' => 'page',
						'data' => serialize($data['page'])
					);

					if ($this->trash_model->Add($aAdditionalData)) {
						if ($this->pages_model->delete($id)) {
							$output['success']='success';
							$this->session->set_flashdata('message',  array(
								'type' => 'success',
								'text' => 'Запись удалена'
								)
							);
						} 
						else {
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