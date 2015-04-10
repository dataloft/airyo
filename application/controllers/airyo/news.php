<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends Airyo {


    protected $default;
    protected $img_path;
    protected $img_tmp_path;
    protected $thumbs_size = array(
        array(
            'w' =>  120,
            'h' =>  80,
            'thumb_marker' => '_s'
        ),
        /*array(
            'w' =>  325,
            'h' =>  215,
            'thumb_marker' => '_m'
        ),
        array(
            'w' =>  800,
            'h' =>  500,
            'thumb_marker' => '_l'
        ),*/
    );
    

    public function __construct() {
        parent::__construct();
        
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('airyo/news_model');
        $this->load->model('airyo/trash_model');
        $this->lang->load('airyo_news', 'russian');
        
        $this->data['main_menu'] = 'news';
        $this->img_path = $_SERVER['DOCUMENT_ROOT'].'/public/news/';
    }

    
    // Список новостей
    public function index($page = '') {
	    $this->data['notice'] = @$this->session->flashdata('notice');
	    $this->data['news']  = $this->news_model->getList();
	    
	    $this->load->view('airyo/news/list', $this->data);
	    $this->updateLogs();
    }

    
    // Добавление, редактирование
    public function edit($id = '') {
    	
        $this->data['thumbs'] = $this->get_thumbs($id);
        
        // Если форма отправлена
        if ($this->input->post())
        {
	        $this->form_validation->set_rules('title',	'', 'required');
	        $this->form_validation->set_rules('anons',	'', 'required');
	        $this->form_validation->set_rules('content','', 'required');
	        $this->form_validation->set_rules('alias',	'', 'callback_check_alias');
	        
	        $input = array(
                    'title'		=> $this->input->post('title',TRUE),
                    'alias'		=> $this->input->post('alias',TRUE),
                    'anons'		=> $this->input->post('anons'),
                    'content'	=> $this->input->post('content'),
                    'enabled'	=> $this->input->post('enabled',TRUE),
            );
            
            if (@$this->input->post('img_delete'))
            {
	            $this->img_delete($id);
            }
        	
        	// Если поля заполнены корректно, формируем массив из отправленных данных
        	if ($this->form_validation->run())
    		{
	        	// Если редактирование
	        	if (!empty($id))
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
        // Если нужно просто показать форму
        else {
	        $this->data['page'] = $this->news_model->get_by_id($id);
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
	        		'img' 	=> $img_data['file_name'],
	        	);
	        	$this->news_model->update($data);
	        	
	        	foreach ($this->thumbs_size as $thumb)
                {
                    $config = array();
                    $config['source_image'] = $this->img_path.$img_data['file_name'];
                    $config['new_image'] = $this->img_path.$img_data['file_name'];
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
        		'img' 	=> '',
        	)
		);
		
		@unlink($this->img_path.$row['img']);
		
		$ext = end(explode(".", $row['img']));
		
		foreach ($this->thumbs_size as $thumb)
            @unlink($this->img_path.$id.$thumb['thumb_marker'].'.'.$ext);
	}


    public function get_thumbs($id)
    {
	    $row = $this->news_model->get_by_id($id);
	    
	    $thumbs = array();
	    
	    $ext = end(explode(".", $row['img']));
	    
	    foreach ($this->thumbs_size as $thumb)
        {
           	if (file_exists($this->img_path.$row['id'].$thumb['thumb_marker'].'.'.$ext)) {
           		$thumbs[$thumb['thumb_marker']]['name'] = $row['id'].$thumb['thumb_marker'].'.'.$ext;
           		$thumbs[$thumb['thumb_marker']]['prop'] = getimagesize($this->img_path.$row['id'].$thumb['thumb_marker'].'.'.$ext);
           	}
        }
        
        return $thumbs;
    }


    public function delete () {
    
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
                    	
                        if ($this->news_model->delete($id)) {
                        	$output['success']='success';
                            $this->session->set_flashdata('notice',  array(
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

/* End of file news.php */
/* Location: ./application/controllers/admin/news.php */