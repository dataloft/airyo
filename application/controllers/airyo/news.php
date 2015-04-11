<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends Airyo {


    protected $img_path;
    protected $thumbs_size = array(
        array(
            'w' =>  200,
            'h' =>  2000,
            'thumb_marker' => '_s'
        ),
        array(
            'w' =>  670,
            'h' =>  2000,
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
	    
	    $pg = $this->config->item('pagination_airyo');
	    $pg['total_rows'] = $this->news_model->count();
	    $pg['base_url'] = '/airyo/news';
	    $pg['uri_segment'] = 3;
		$pg['per_page'] = 25;
		$pg["num_links"] = 5;
		
	    $this->pagination->initialize($pg);
	    $page = ($this->uri->segment($pg['uri_segment'])) ? $this->uri->segment($pg['uri_segment']) : 0;
	    
	    $this->data['news']  = $this->news_model->getList($pg["per_page"], $page);
	    
	    $this->load->view('airyo/news/list', $this->data);
	    $this->updateLogs();
    }

    
    // Добавление, редактирование
    public function edit($id = '') {
    	
    	$this->data['page'] = $this->news_model->get_by_id($id);
        $this->data['thumbs'] = $this->get_thumbs($id);
        
        // Если запись, не существует, то добавляем новую, а для этого подставляем дату
        if (!isset($this->data['page']['date'])) $this->data['page']['date'] = date("d.m.Y");
        
        // Если форма отправлена
        if ($this->input->post())
        {
	        $this->form_validation->set_rules('title',	'', 'required');
	        $this->form_validation->set_rules('anons',	'', 'required');
	        $this->form_validation->set_rules('content','', 'required');
	        $this->form_validation->set_rules('alias',	'', 'required|callback_check_alias');
	        $this->form_validation->set_rules('date',	'', 'callback_validate_date');
	        
	        $input = array(
                'title'		=> trim($this->input->post('title',TRUE)),
                'alias'		=> trim($this->input->post('alias',TRUE)),
                'anons'		=> $this->input->post('anons'),
                'content'	=> $this->input->post('content'),
                'enabled'	=> $this->input->post('enabled',TRUE),
                'date'		=> $this->input->post('date'),
            );
            
            if (@$this->input->post('img_delete'))
            {
	            $this->img_delete($id);
	            $this->data['thumbs'] = array();
            }
        	
        	// Если поля заполнены корректно
        	if ($this->form_validation->run())
    		{
	        	// Если редактирование
	        	if ($id == @$this->data['page']['id'])
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
	        	// Если добавление (пустой id)
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
		    else
		    {
			    $this->notice_push($this->lang->line('notice_form_incorrect'), 'warning');
		    }
        	
        	$this->data['page'] = $input;
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
    
    
    public function check_alias()
    {
    	
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

