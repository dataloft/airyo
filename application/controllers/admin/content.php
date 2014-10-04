<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CommonAdminController {

    public function __construct() {
        parent::__construct();
        $this->load->model('content_model');
        $this->load->model('trash_model');
    }

    public function index($page = '') {
	    $this->oData['main_menu'] = 'content';

	    $this->oData['type'] = '';
	    $this->oData['search'] = '';
	    $this->oData['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';
	    if ($this->input->post('typeSelect'))
	        $this->oData['type'] = $this->input->post('typeSelect');
	    if ($this->input->post('search'))
	        $this->oData['search'] = $this->input->post('search');

	    $this->oData['content']  = $this->content_model->getList($this->oData['type'], $this->oData['search']);
	    $this->oData['type_list']  = $this->content_model->getType();
	    $this->oData['view'] = 'admin/content/list';
    }

    public function add() {
	    $this->oData['main_menu'] = 'content';

	    $this->oData['id'] = '';
	    $this->oData['message'] = '';

        $page = new stdClass();
	    $this->oData['title'] = "Добавить/редактировать страницу";
        if (!$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

	    $this->oData['type_list']  = $this->content_model->getType();
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
	    $this->oData['page'] = $page;

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

        $alias = 'edit';
        foreach ($this->oData['type_list'] as $item) {
            if ($page->type == $item->id) {
	            $alias = $item->alias;
            } else {
                continue;
            }
        }
	    $this->oData['view'] = 'admin/content/'.$alias;
    }

	public function edit($id = '') {
		$this->oData['id'] = '';
		$this->oData['main_menu'] = 'content';
		$this->oData['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';

		$page = new stdClass();
		$this->oData['title'] = "Добавить/редактировать страницу";

		if (!$this->ion_auth->is_admin()) {
			redirect('auth', 'refresh');
		}

		$this->oData['type_list']  = $this->content_model->getType();
		/* $this->form_validation->set_rules('content', '', 'required');*/
		$this->form_validation->set_rules('h1', '', 'required');
		$this->form_validation->set_rules('alias', '', 'callback_check_alias');
		// Если передан Ид ищем содержание стр в БД
		if (!empty($id)) {
			$this->oData['page'] = $this->content_model->getToId($id);
			if (empty($this->oData['page'])) {
				show_404();
			}
			$this->oData['id'] = $id;

			if ($this->form_validation->run() == true) {
				$page->content = $this->input->post('content');
				$page->h1 = $this->input->post('h1',TRUE);
				$page->alias = $this->input->post('alias',TRUE);
				$page->title = $this->input->post('title',TRUE);
				$page->meta_description = $this->input->post('meta_description',TRUE);
				$page->meta_keywords = $this->input->post('meta_keywords',TRUE);
				$page->type = $this->input->post('type',TRUE);
				$page->enabled = $this->input->post('enabled',TRUE);
				$this->oData['page'] = $page;

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

				if($this->content_model->Update($this->oData['id'],$additional_data)) {
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
			elseif($this->input->post('id')==$id) {
				$page->content = $this->input->post('content',TRUE);
				$page->h1 = $this->input->post('h1',TRUE);
				$page->alias = $this->input->post('alias',TRUE);
				$page->title = $this->input->post('title',TRUE);
				$page->meta_description = $this->input->post('meta_description',TRUE);
				$page->meta_keywords = $this->input->post('meta_keywords',TRUE);
				$page->type = $this->input->post('type',TRUE);
				$page->enabled = $this->input->post('enabled',TRUE);

				$this->oData['page'] = $page;
				$this->oData['message'] = array(
					'type' => 'danger',
					'text' => validation_errors()
				);
			}
		} else { 		//Вставляем новую запись
			redirect("admin/content/add?type=".$this->input->get('type'), 'refresh');
		}

		$alias = 'edit';

		foreach($this->oData['type_list'] as $item) {
			if ($this->oData['page']->type == $item->id) {
				$alias = $item->alias;
			}else {
				continue;
			}
		}

		$this->oData['view'] = 'admin/content/'.$alias;
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