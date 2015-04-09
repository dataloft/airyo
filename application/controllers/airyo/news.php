<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends Airyo {


    protected $default;
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
    }


    public function index($page = '') {
    
	    $this->data['main_menu'] = 'news';

	    //$this->data['type'] = '';
	    //$this->data['search'] = '';
	    
	    $this->data['notice'] = @$this->session->flashdata('notice');

	    $this->data['news']  = $this->news_model->getList();
	    
	    $this->load->view('airyo/news/list', $this->data);
	    
	    $this->updateLogs();
    }


    public function add() {
    	
	    $this->data['main_menu'] = 'news';
	    $this->data['id'] = '';
	    $this->data['message'] = '';
	    $this->data['meta_title'] = "Добавить/редактировать новость";
        $this->data['id'] = '';
        $this->data['message'] = '';
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        }
        $this->form_validation->set_rules('title', '', 'required');
        $this->form_validation->set_rules('anons', '', 'required');
        $this->form_validation->set_rules('content', '', 'required');
        $this->form_validation->set_rules('alias', '', 'callback_check_alias');
        if (!empty($_POST['change']))
            $_POST = array();
        $this->data['page']['title'] = $this->input->post('title');
        $this->data['page']['alias'] = $this->input->post('alias');
        $this->data['page']['anons'] = $this->input->post('anons');
        $this->data['page']['meta_title'] = $this->input->post('meta_title');
        $this->data['page']['meta_description'] = $this->input->post('meta_description');
        $this->data['page']['meta_keywords'] = $this->input->post('meta_keywords');
        $this->data['page']['enabled'] = $this->input->post('enabled');
        $this->data['page']['content'] = $this->input->post('content',TRUE);
        if ($this->form_validation->run() == true)
        {
            $additional_data = array(
                'title' => $this->input->post('title',TRUE),
                'alias' =>  $this->input->post('alias',TRUE),
                'anons' =>  $this->input->post('anons',TRUE),
                'meta_title' =>  $this->input->post('meta_title',TRUE),
                'meta_description' =>   $this->input->post('meta_description',TRUE),
                'meta_keywords' =>  $this->input->post('meta_keywords',TRUE),
                'enabled' =>  $this->input->post('enabled',TRUE)
            );
            $additional_data['content'] = $this->input->post('content',TRUE);
            if ($id = $this->news_model->Add($additional_data))
            {
                $this->session->set_flashdata('message',  array(
                        'type' => 'success',
                        'text' => 'Новость создана'
                    )
                );
                redirect("admin/news/edit/$id", 'refresh');
            }
            else
            {
                $this->data['message'] = array(
                    'type' => 'danger',
                    'text' => 'Произошла ошибка при сохранении новости.'
                );
            }
        }
        elseif ($this->input->post('action') == 'add')
        {
            $this->data['message'] = array(
                'type' => 'danger',
                'text' =>  validation_errors()
            );
        }
        
        
        $this->load->view('airyo/news/edit', $this->data);
        
        /*$this->data['scripts'] = array(
            '/themes/airyo/js/content.js',
        );*/
    }


    public function edit($id = '') {
    	
        $this->data['id'] = '';
        $this->data['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';
        $this->data['main_menu'] = 'news';
        $this->data['template_list'] = $this->config->item('templates');
        $this->data['meta_title'] = "Добавить/редактировать страницу";
        
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        }
        
        // Если передан Ид ищем содержание стр в БД
        if (!empty($id))
        {
            $this->data['page'] = $this->news_model->getToId($id);
            if (empty($this->data['page']))
                show_404();

            $this->data['id'] = $id;
            $this->form_validation->set_rules('title', '', 'required');
            $this->form_validation->set_rules('anons', '', 'required');
            $this->form_validation->set_rules('content', '', 'required');
            $this->form_validation->set_rules('alias', '', 'callback_check_alias');
           
            if ($this->form_validation->run() == true)
            {
                $this->data['page'] = array(
                    'title' => $this->input->post('title',TRUE),
                    'alias' =>  $this->input->post('alias',TRUE),
                    'anons' =>  $this->input->post('anons',TRUE),
                    'enabled' =>  $this->input->post('enabled',TRUE)
                );
                
                $save_data = $this->data['page'];
                
                $save_data['content'] = $this->input->post('content',TRUE);
                $this->data['page']['content'] = $this->input->post('content',TRUE);
                
                if ($this->news_model->Update($this->data['id'], $save_data))
                {
                    $this->data['message'] = array(
                        'type' => 'success',
                        'text' => 'Запись обновлена'
                    );
                    
                    
                    
                    
                    
                    
                    
                    if (!empty($_FILES['img']))
                    {
			            $config = array();
			            $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/public/news/';
			            $config['allowed_types'] = 'gif|jpg|png';
			            $config['file_name'] = $this->data['id'];
			            $config['overwrite'] = true;
			            
			            /*if (!is_dir($config['upload_path']))
			            {
			                mkdir($config['upload_path']);
			            }*/

		                $this->upload->initialize($config);
		                
		                /*$_FILES['img'] = array (
		                    'name'=> $this->input->post('alias', TRUE).'.'.end(explode('.', $upload['name'])),
		                    'type'=> $upload['type'],
		                    'tmp_name'=> $upload['tmp_name'],
		                    'error'=> $upload['error'],
		                    'size'=> $upload['size']);*/
		                    
		                if ($this->upload->do_upload('img'))
		                {
		                    $tmp_data = $this->upload->data();
		                    
		                    foreach ($this->thumbs_size as $thumb)
		                    {
		
		                        $config = array();
		                        $config['source_image'] = $_SERVER['DOCUMENT_ROOT'].'/public/news/'.$tmp_data['file_name'];
		                        $config['new_image'] = $_SERVER['DOCUMENT_ROOT'].'/public/news/'.$tmp_data['file_name'];
		                        $config['width'] = $thumb['w'];
		                        $config['height'] = $thumb['h'];
		                        $config['thumb_marker'] = $thumb['thumb_marker'];
		                        $config['create_thumb'] = true;
		                        
		                        
		                        $this->image_lib->initialize($config);
		                        
		                        
		                        if ($this->image_lib->resize())
		                        {
		                            //echo $config['new_image'];
		                        }
		                        else
		                        {
			                        //echo $this->image_lib->display_errors();
		                        }
		                    }
		                    
		                    
		                    /*$tmp_data = $this->upload->data();
		                    $content['img'] = $pth.DIRECTORY_SEPARATOR.$tmp_data['file_name'];
		                    $this->oData['page']['img'] =  $pth.DIRECTORY_SEPARATOR.$tmp_data['file_name'];
		                    $additional_data['img'] =  $pth.DIRECTORY_SEPARATOR.$tmp_data['file_name'];
		                    $this->load->library('image_lib');
		                    foreach ($this->thumbs_size as $thumb)
		                    {
		
		                        $config = array();
		                        $config['source_image'] = $pth.DIRECTORY_SEPARATOR.$tmp_data['file_name'];
		                        $config['new_image'] = $pth.DIRECTORY_SEPARATOR.$this->input->post('alias',TRUE).'-'.$thumb['w'].'x'.$thumb['h'].'.'.end(explode('.',$upload['name']));
		                        $config['width'] = $thumb['w'];
		                        $config['height'] = $thumb['h'];
		                        $this->image_lib->initialize($config);
		                        if ($this->image_lib->resize())
		                        {
		                            echo $config['new_image'];
		                        }
		                    }*/
		                }
		                else
						{
							//$data = array('upload_data' => $this->upload->data());
							//$this->load->view('upload_success', $data);
						}
                    }
                    
                    
                    
                    
                    
                    
                }
                else
                {
                    $this->data['message'] = array(
                        'type' => 'danger',
                        'text' => 'Произошла ошибка при обновлении записи.'
                    );
                }
            }
            elseif($this->input->post('id') == $id)
            {
                $this->data['page'] = array(
                    'title' => $this->input->post('title',TRUE),
                    'alias' =>  $this->input->post('alias',TRUE),
                    'anons' =>  $this->input->post('anons',TRUE),
                    'enabled' =>  $this->input->post('enabled',TRUE)
                );

                    $this->data['page']['content'] = $this->input->post('content',TRUE);


                $this->data['message'] = array(
                    'type' => 'danger',
                    'text' => validation_errors()
                );

            }
        }
        //Вставляем новую запись
        else
        {
            redirect("admin/news/add", 'refresh');
        }
        
        
        $this->load->view('airyo/news/edit', $this->data);
        
        /*$alias = 'content';
        
        $this->data['view'] = 'admin/news/'.$alias;*/
        
    }


    public function check_alias()
    {

        if (!empty($_POST['alias']) && !preg_match('/^[a-z0-9-\/\.]+$/', $this->input->post('alias'))){
            $this->form_validation->set_message(__FUNCTION__, 'Некорректно указан адрес страницы');
            return false;
        }
        else
        {
            $page =  $this->news_model->getToAlias($this->input->post('alias'));
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
    
        if (isset($_POST)) {
        
            $id = $this->input->post('id');
            
            if ($id) {
            
                $data['page'] = $this->news_model->getToId($id);

                if (!empty($data['page'])) {
                    $aAdditionalData = array(
                        'deleted_id' => $id,
                        'type' =>  'page',
                        'data' =>     serialize($data['page'])
                    );

                    if ($this->trash_model->Add($aAdditionalData)) {
                        if ($this->news_model->delete($id)) {
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

/* End of file news.php */
/* Location: ./application/controllers/admin/news.php */