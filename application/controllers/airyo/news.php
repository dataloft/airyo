<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends Airyo {


    protected $img_path;
    protected $thumbs_size = array(
        array(
            'w' =>  140,
            'h' =>  140,
            'thumb_marker' => '_s'
        ),
        array(
            'w' =>  800,
            'h' =>  800,
            'thumb_marker' => '_m'
        ),
    );
    

    public function __construct() {
        parent::__construct();
        
        $this->config->load('pagination');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('airyo/news_model');
        $this->load->model('airyo/trash_model');
        $this->lang->load('airyo_news', 'russian');
        
        $this->data['main_menu'] = 'news';
        $this->img_path = $_SERVER['DOCUMENT_ROOT'].'/public/news/';
    }

    
    // Список новостей
    public function index($page = '')
    {
	    $this->data['notice'] = @$this->session->flashdata('notice');
	    
	    // Готовим конфиг для пагинации
	    $pg = $this->config->item('pagination_airyo');
	    $pg['total_rows'] = $this->news_model->count();
	    $pg['base_url'] = '/airyo/news';
	    $pg['uri_segment'] = 3;
		$pg['per_page'] = 25;
		$pg["num_links"] = 5;
		
	    $this->pagination->initialize($pg);
	    $page = ($this->uri->segment($pg['uri_segment'])) ? $this->uri->segment($pg['uri_segment']) : 0;
	    
	    // Получаем список новостей для текущей страницы
	    $this->data['news']  = $this->news_model->getList($pg["per_page"], $page);
	    $this->data['pagination'] = $this->pagination->create_links();
	    
	    $this->load->view('airyo/news/list', $this->data);
	    
	    $this->updateLogs();
    }

    
    // Добавление, редактирование
    public function edit($id = '') {
    	
    	// Сначала получаем из БД новость с указанным id и картинки к ней
    	$this->data['page'] = $this->news_model->get_by_id($id);
        $this->data['thumbs'] = $this->get_thumbs($id);
        
        // Если запись, не существует, то генерируем дату для подстановки в форму
        if (!isset($this->data['page']['date'])) $this->data['page']['date'] = date("d.m.Y");
        
        // Если форма отправлена
        if ($this->input->post())
        {
	        // Устанавливаем правила проверки полей формы
	        $this->form_validation->set_rules('title',	'', 'trim|required');
	        $this->form_validation->set_rules('anons',	'', 'trim|required');
	        //$this->form_validation->set_rules('content','', 'required');
	        $this->form_validation->set_rules('alias',	'', 'trim|strtolower|required|callback_check_alias');
	        $this->form_validation->set_rules('date',	'', 'callback_validate_date');
	        
            // Удаляем картинки, если отмечен чекбокс
            if (@$this->input->post('img_delete'))
            {
	            $this->img_delete($id);
	            $this->data['thumbs'] = array();
            }
        	
        	// Проверяем данные формы и готовим их для сохранения
        	if ($this->form_validation->run())
    		{
	        	$input = array(
	                'title'		=> $this->input->post('title',TRUE),
	                'alias'		=> $this->input->post('alias',TRUE),
	                'anons'		=> $this->input->post('anons'),
	                'content'	=> $this->input->post('content'),
	                'enabled'	=> $this->input->post('enabled',TRUE),
	                'date'		=> $this->input->post('date'),
	            );
	        }
	        
	        //Если есть корректные данные - сохраняем
	        if (@$input)
	        {
	        	// Если редактирование
	        	if (@$this->data['page']['id'])
	        	{
	        		$input['id'] = $id;
	        		
	        		if ($this->news_model->update($input))
	                {
	                    $this->image_upload($id);
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
		        	if ($new_id = $this->news_model->add($input))
		            {
		                $this->image_upload($new_id);
		                $this->notice_push($this->lang->line('notice_add_sucsess'), 'success');
		                redirect('airyo/news/edit/'.$new_id, 'refresh');
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
        
        $this->load->view('airyo/news/edit', $this->data);
    }
    
    
	public function image_upload($id)
	{
        if (is_uploaded_file($_FILES['img']['tmp_name']))
	    {
			$this->img_delete($id);
			
			$config = array(
	        	'upload_path'	=> $this->img_path,
	        	'allowed_types' => 'gif|jpg|png',
	        	'file_name'		=> $id,
	        	'overwrite'		=> true,
	        );
	
	        $this->upload->initialize($config);
	        
	        if ($this->upload->do_upload('img'))
	        {
	        	$img_data = $this->upload->data();
	        	
	        	$data = array(
	        		'id'	=> $id,
	        		'img_ext' 	=> $img_data['file_ext'],
	        	);
	        	$this->news_model->update($data);
	        	
	        	foreach ($this->thumbs_size as $thumb)
                {
                    $config = array();
                    $config['source_image'] = $this->img_path.$id.$img_data['file_ext'];
                    $config['width'] = $thumb['w'];
                    $config['height'] = $thumb['h'];
                    $config['thumb_marker'] = $thumb['thumb_marker'];
                    $config['create_thumb'] = true;
                    
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
	        }
        }
	}
	
	
	public function img_delete($id)
	{
		$row = $this->news_model->get_by_id($id);
		
		$this->news_model->update(
			array(
        		'id'	=> $id,
        		'img_ext' 	=> '',
        	)
		);
		
		@unlink($this->img_path.$id.$row['img_ext']);
		
		foreach ($this->thumbs_size as $thumb)
            @unlink($this->img_path.$id.$thumb['thumb_marker'].$row['img_ext']);
	}


    public function get_thumbs($id)
    {
	    $row = $this->news_model->get_by_id($id);
	    
	    $thumbs = array();
	    
	    if ($row) {
		    foreach ($this->thumbs_size as $thumb)
	        {
	           	if (file_exists($this->img_path.$id.$thumb['thumb_marker'].$row['img_ext'])) {
	           		$thumbs[$thumb['thumb_marker']]['name'] = $id.$thumb['thumb_marker'].$row['img_ext'];
	           		$thumbs[$thumb['thumb_marker']]['prop'] = getimagesize($this->img_path.$id.$thumb['thumb_marker'].$row['img_ext']);
	           	}
	        }
        }
        
        return $thumbs;
    }
    
    
    // Проверка при добавлении
    public function check_alias($alias)
    {
    	// Первая проверка на допустимые символы
    	if (!preg_match('/^[a-z0-9-\.\_]+$/', $alias)){
            $this->form_validation->set_message(__FUNCTION__, 'Некорректные символы в алиасе');
            return false;
        }
    	
    	// Вторая проверка - отсутствие другой записи с тем же алиасом
    	$r = $this->news_model->get_by_alias($alias);
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
            
                $data['page'] = $this->news_model->get_by_id($id);

                if (!empty($data['page'])) {
                    $aAdditionalData = array(
                        'deleted_id' => $id,
                        'type' => 'page',
                        'data' => serialize($data['page'])
                    );

                    if ($this->trash_model->Add($aAdditionalData)) {
                    	
                    	$this->img_delete($id);
                    	
                        if ($this->news_model->delete($id))
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

