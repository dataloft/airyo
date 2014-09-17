<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CommonAdminController {

    public function __construct() {
        parent::__construct();
        $this->load->model('content_model');
        $this->load->model('trash_model');
    }

    public function index($page = '') {
	    $aParams = parent::index();
	    $aParams['header']['main_menu'] = 'content';

	    $data_body['type'] = '';
	    $data_body['search'] = '';
	    $data_body['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';
        if ($this->input->post('typeSelect'))
	        $data_body['type'] = $this->input->post('typeSelect');
        if ($this->input->post('search'))
	        $data_body['search'] = $this->input->post('search');

	    $data_body['content']  = $this->content_model->getList($data_body['type'], $data_body['search']);
	    $data_body['type_list']  = $this->content_model->getType();

	    $this->header_vars = $aParams['header'];
	    $this->body_vars = $data_body;
	    $this->body_file = 'admin/content/list';
    }

    public function add() {
	    $aParams = parent::add();
	    $aParams['header']['main_menu'] = 'content';

	    $aParams['body']['id'] = '';
	    $aParams['body']['message'] = '';

        $page = new stdClass();
	    $aParams['body']['title'] = "Добавить/редактировать страницу";
        if (!$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        $data['type_list']  = $this->content_model->getType();
        $this->form_validation->set_rules('h1', '', 'required');
        $this->form_validation->set_rules('alias', '', 'is_unique[content.alias]');
        $page->content = $this->input->post('content');
        $page->h1 = $this->input->post('h1');
        $page->alias = $this->input->post('alias');
        $page->title = $this->input->post('title');
        $page->meta_description = $this->input->post('meta_description');
        $page->meta_keywords = $this->input->post('meta_keywords');
        $page->type = $this->input->get('type')?$this->input->get('type'):$this->input->post('type');
        $page->enabled = $this->input->post('enabled');
	    $aParams['body']['page'] = $page;

        if ($this->form_validation->run() == true) {
            $additional_data = array(
                'content' => $page->content,
                'h1' => $page->h1,
                'alias' =>  $page->alias,
                'type' =>  $page->type,
                'title' =>  $page->title,
                'meta_description' =>  $page->meta_description,
                'meta_keywords' =>  $page->meta_keywords,
                'enabled' =>    $page->enabled
            );
            if ($id = $this->content_model->Add($additional_data)) {
                $this->session->set_flashdata('message',  array(
                        'type' => 'success',
                        'text' => 'Запись создана'
                    )
                );
                redirect("admin/content/edit/$id", 'refresh');
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

        $alias = 'edit';
        foreach ($data['type_list'] as $item) {
            if ($page->type == $item->id) {
	            $alias = $item->alias;
            } else {
                continue;
            }
        }

	    $this->header_vars = $aParams['header'];
	    $this->body_vars = $aParams['body'];
	    $this->body_file = 'admin/content/'.$alias;
    }

	public function edit($id = '') {
		$aParams = parent::edit();
		$aParams['header']['main_menu'] = 'content';

		$aParams['body']['id'] = '';
		$aParams['body']['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';

		$page = new stdClass();
		$aParams['body']['title'] = "Добавить/редактировать страницу";

		if (!$this->ion_auth->is_admin()) {
			redirect('auth', 'refresh');
		}

		$aParams['body']['type_list']  = $this->content_model->getType();
		/* $this->form_validation->set_rules('content', '', 'required');*/
		$this->form_validation->set_rules('h1', '', 'required');
		$this->form_validation->set_rules('alias', '', 'callback_check_alias');
		// Если передан Ид ищем содержание стр в БД
		if (!empty($id)) {
			$aParams['body']['page'] = $this->content_model->getToId($id);
			if (empty($aParams['body']['page'])) {
				show_404();
			}
			$aParams['body']['id'] = $id;

			if ($this->form_validation->run() == true) {
				$page->content = $this->input->post('content');
				$page->h1 = $this->input->post('h1',TRUE);
				$page->alias = $this->input->post('alias',TRUE);
				$page->title = $this->input->post('title',TRUE);
				$page->meta_description = $this->input->post('meta_description',TRUE);
				$page->meta_keywords = $this->input->post('meta_keywords',TRUE);
				$page->type = $this->input->post('type',TRUE);
				$page->enabled = $this->input->post('enabled',TRUE);
				$aParams['body']['page'] = $page;

				$additional_data = array(
					'content' => $page->content,
					'h1' => $page->h1,
					'alias' =>  $page->alias,
					'type' =>  $page->type,
					'title' =>  $page->title,
					'meta_description' =>  $page->meta_description,
					'meta_keywords' =>  $page->meta_keywords,
					'enabled' =>  $page->enabled
				);

				if($this->content_model->Update($aParams['body']['id'],$additional_data)) {
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
			elseif($this->input->post('id')==$id) {
				$page->content = $this->input->post('content',TRUE);
				$page->h1 = $this->input->post('h1',TRUE);
				$page->alias = $this->input->post('alias',TRUE);
				$page->title = $this->input->post('title',TRUE);
				$page->meta_description = $this->input->post('meta_description',TRUE);
				$page->meta_keywords = $this->input->post('meta_keywords',TRUE);
				$page->type = $this->input->post('type',TRUE);
				$page->enabled = $this->input->post('enabled',TRUE);

				$aParams['body']['page'] = $page;
				$aParams['body']['message'] = array(
					'type' => 'danger',
					'text' => validation_errors()
				);
			}
		} else { 		//Вставляем новую запись
			redirect("admin/content/add?type=".$this->input->get('type'), 'refresh');
		}

		$alias = 'edit';

		foreach($aParams['body']['type_list'] as $item) {
			if ( $aParams['body']['page']->type == $item->id) {
				$alias = $item->alias;
			}else {
				continue;
			}
		}

		$this->header_vars = $aParams['header'];
		$this->body_vars = $aParams['body'];
		$this->body_file = 'admin/content/'.$alias;
	}

	public function check_alias() {
		$page =  $this->content_model->getToAlias($this->input->post('alias'));
		$this->form_validation->set_message(__FUNCTION__, 'The alias you entered is already used.');
		if (empty($page)) {
			return true;
		}
		if ($this->input->post('id') == $page->id) {
			return true;
		} else {
			return false;
		}
	}

	public function delete () {
		if (isset($_POST)) {
			$id = $this->input->post('id');
			if ($id) {
				$data['page'] = $this->content_model->getToId($id);

				if (!empty($data['page'])) {
					$aAdditionalData = array(
					'deleted_id' => $id,
					'type' =>  'page',
					'data' =>     serialize($data['page'])
					);

					if ($this->trash_model->Add($aAdditionalData)) {
						if ($this->content_model->delete($id)) {
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

/* End of file content.php */
/* Location: ./application/controllers/admin/content.php */