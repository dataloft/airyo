<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chunks extends Airyo {
    

    public function __construct() {
        parent::__construct();
        
        $this->config->load('pagination');
        $this->load->model('airyo/chunks_model');
        $this->load->model('airyo/trash_model');
        $this->lang->load('airyo_chunks', 'russian');
        
        $this->data['main_menu'] = 'chunks';
    }

    
    // Список фрагментов
    public function index($page = '')
    {
	    // Готовим конфиг для пагинации
	    $pg = $this->config->item('pagination_airyo');
	    $pg['total_rows'] = $this->chunks_model->count();
	    $pg['base_url'] = '/airyo/chunks';
	    $pg['uri_segment'] = 3;
		$pg['per_page'] = 25;
		$pg["num_links"] = 5;
		
	    $this->pagination->initialize($pg);
	    $page = ($this->uri->segment($pg['uri_segment'])) ? $this->uri->segment($pg['uri_segment']) : 0;
	    
	    // Получаем список новостей для текущей страницы
	    $this->data['list']  = $this->chunks_model->get_list($pg["per_page"], $page);
	    
	    $this->load->view('airyo/chunks/list', $this->data);
	   
	    $this->updateLogs();
    }

    
    // Добавление, редактирование
    public function edit($id = '') {
    	
    	// Сначала получаем из БД новость с указанным id и картинки к ней
    	$this->data['page'] = $this->chunks_model->get_by_id($id);
        
        // Если запись, не существует, то генерируем дату для подстановки в форму
        //if (!isset($this->data['page']['date'])) $this->data['page']['date'] = date("d.m.Y");
        
        // Если форма отправлена
        if ($this->input->post())
        {
	        // Устанавливаем правила проверки полей формы
	        $this->form_validation->set_rules('name',	'', 'trim|required');
	        $this->form_validation->set_rules('content','', 'required');
	        //$this->form_validation->set_rules('alias',	'', 'trim|strtolower|required|callback_check_alias');
        	
        	// Проверяем данные формы и готовим их для сохранения
        	if ($this->form_validation->run())
    		{
	        	$input = array(
	                'name'		=> $this->input->post('name',TRUE),
	                //'alias'		=> $this->input->post('alias',TRUE),
	                'content'	=> $this->input->post('content'),
	            );
	        }
	        
	        //Если есть корректные данные - сохраняем
	        if (@$input)
	        {
	        	// Если редактирование
	        	if (@$this->data['page']['id'])
	        	{
	        		$input['id'] = $id;
	        		
	        		if ($this->chunks_model->update($input))
	                {
	                    $this->notice_push($this->lang->line('notice_update_sucsess'), 'success');
	                    redirect($this->uri->uri_string());
	                }
	                else {
	                    $this->notice_push($this->lang->line('notice_update_model_error'), 'danger');
	                }
	        	}
	        	// Если добавление
		        else
		        {
		        	if ($new_id = $this->chunks_model->add($input))
		            {
		                $this->notice_push($this->lang->line('notice_add_sucsess'), 'success');
		                redirect('airyo/chunks/edit/'.$new_id, 'refresh');
		            }
		            else {
		                $this->notice_push($this->lang->line('notice_update_model_error'), 'danger');
		            }
		        } 
		    }
		    // Если данные формы некорректны - выводим нотис
		    else
		    {
			    $this->notice_push($this->lang->line('notice_form_incorrect'), 'warning');
		    }
        	
        	// Данные для формы, если валидация не прошла
        	$this->data['page'] = $this->input->post();
        }
        
        $this->data['notice'] = $this->notice_pull();
        
        $this->load->view('airyo/chunks/edit', $this->data);
    }
    
    
    public function check_alias($alias)
    {
    	// Первая проверка на допустимые символы
    	if (!preg_match('/^[a-z0-9-\.\_]+$/', $alias)){
            $this->form_validation->set_message(__FUNCTION__, 'Некорректные символы в алиасе');
            return false;
        }
    	
    	// Вторая проверка - отсутствие другой записи с тем же алиасом
    	$r = $this->chunks_model->get_by_alias($alias);
    	if (sizeof($r) >= 1 && @$r[0]['id'] != @$this->data['page']['id']) {
    		$this->form_validation->set_message(__FUNCTION__, 'The alias you entered is already used.');
    		return false;
    	}
    	
    	return true;
    }


    public function delete()
    {
    
        if (isset($_POST)) {
        
            $id = $this->input->post('id');
            
            if ($id) {
            
                $data['page'] = $this->chunks_model->get_by_id($id);

                if (!empty($data['page']))
                {
                    $aAdditionalData = array(
                        'deleted_id' => $id,
                        'type' => 'page',
                        'data' => serialize($data['page'])
                    );

                    if ($this->trash_model->Add($aAdditionalData)) {
                    	
                        if ($this->chunks_model->delete($id))
                        {
                        	$output['success']='success';
                            $this->notice_push($this->lang->line('notice_delete_sucsess'), 'success');
                            
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

