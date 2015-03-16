<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Airyo {

    protected $default;

    public function __construct() {
        parent::__construct();
        $this->load->model('content_model');
        $this->load->model('trash_model');
        $this->config->load('templates');
        
        $this->lang->load('airyo_pages', 'russian');
        
        $this->default = $this->config->item('default_template');
    }

    public function index($page = '') {
	    $this->data['main_menu'] = 'pages';

	    $this->data['type'] = '';
	    $this->data['search'] = '';
	    $this->data['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';
	    if ($this->input->post('typeSelect'))
	        $this->data['type'] = $this->input->post('typeSelect');
	    if ($this->input->post('search'))
	        $this->data['search'] = $this->input->post('search');

	    $this->data['content']  = $this->content_model->getList($this->data['type'], $this->data['search']);
	    $this->data['type_list']  = $this->content_model->getType();
	    $this->data['view'] = 'airyo/pages/list';
    }

    public function add() {
    
	    $this->data['main_menu'] = 'pages';
	    
	    $this->data['id'] = '';
	    $this->data['message'] = '';
	    //$this->data['title'] = "Добавить/редактировать страницу";
        $this->data['id'] = '';
        $this->data['message'] = '';
        $this->data['template_list'] = $this->config->item('templates');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        }
        $this->data['type_list']  = $this->content_model->getType();
        $this->form_validation->set_rules('h1', '', 'trim|xss_clean|strip_tags|required');
        $this->form_validation->set_rules('template', '', 'required');
        $this->form_validation->set_rules('alias', '', 'callback_check_alias');
        $this->data['page']['template'] = $this->input->post('template') ? $this->input->post('template') : $this->default;
        //echo $this->data['page']['template'];

        if (!empty($_POST['change']))
            $_POST = array();
        $this->data['page']['h1'] = $this->input->post('h1',TRUE);
        $this->data['page']['alias'] = $this->input->post('alias');
        $this->data['page']['title'] = $this->input->post('title',TRUE);
        $this->data['page']['meta_description'] = $this->input->post('meta_description');
        $this->data['page']['meta_keywords'] = $this->input->post('meta_keywords');
        $this->data['page']['type'] = $this->input->get('type')?$this->input->get('type'):$this->input->post('type');
        $this->data['page']['enabled'] = $this->input->post('enabled');

        if (!empty($this->data['template_list'][$this->data['page']['template']]['fields']))
        {
            $fields = $this->data['template_list'][$this->data['page']['template']]['fields'];
            foreach ($fields as $i => $field)
            {
                $this->data['fields'][$i]['field_name'] = $i;
                $params = $field;
                foreach ($params as $key => $param)
                {
                    if ($key == 'attributes'){
                        $attributes='';
                        foreach ($param as $k => $attr)
                        {
                            $attributes .= $k.'="'.$attr.'" ';
                        }
                        $this->data['fields'][$i][$key] = $attributes;
                    } else
                        $this->data['fields'][$i][$key] = $param;


                }
                if ($this->data['fields'][$i]['type'] != 'file' and !empty($this->data['fields'][$i]['required']))
                    $this->form_validation->set_rules($this->data['fields'][$i]['field_name']  , '', 'required');
                if ($this->data['fields'][$i]['type'] == 'file' and !empty($this->data['fields'][$i]['required']))
                {
                    if(empty($_FILES) or $_FILES[$this->data['fields'][$i]['field_name']]['error'] == 4)
                        $this->form_validation->set_rules($this->data['fields'][$i]['field_name']  , '', 'required');
                }

                $this->data['page'][$this->data['fields'][$i]['field_name']] = $this->input->post($this->data['fields'][$i]['field_name']);

            }

        }
        else
        {
            $this->data['page']['content'] = $this->input->post('content');
        }

        if ($this->form_validation->run() == true)
        {
            $additional_data = array(

                'template' => $this->input->post('template'),
                'h1' => $this->input->post('h1',TRUE),
                'alias' =>  $this->input->post('alias'),
                'type' =>  $this->input->post('type'),
                'title' =>  $this->input->post('title',TRUE),
                'meta_description' =>   $this->input->post('meta_description'),
                'meta_keywords' =>  $this->input->post('meta_keywords'),
                'enabled' =>  $this->input->post('enabled')
            );

            if (!empty($this->data['template_list'][$this->data['page']['template']]['fields']))
            {
                foreach ($this->data['fields'] as $key => $param)
                {
                    $this->data['page'][$param['field_name']] = $this->input->post($param['field_name']);

                    $content[$param['field_name']] = $this->input->post($param['field_name']);
                    if ($param['type'] == 'file')
                    {
                        $upload = !empty($_FILES[$param['field_name']]) ?
                            $_FILES[$param['field_name']] : null;

                        $next_id = $this->content_model->next_id();
                        $pth = 'public'.DIRECTORY_SEPARATOR.'content'.DIRECTORY_SEPARATOR.$next_id;
                        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.$pth;
                        if (!is_dir($config['upload_path']))
                        {
                            mkdir($config['upload_path']);
                        }
                        $config['allowed_types'] = '*';

                        if ($upload ) {
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            $_FILES[$param['field_name']] = array (
                                'name'=> $upload['name'],
                                'type'=> $upload['type'],
                                'tmp_name'=> $upload['tmp_name'],
                                'error'=> $upload['error'],
                                'size'=> $upload['size']);
                            if ($this->upload->do_upload($param['field_name']))
                            {
                                $tmp_data = $this->upload->data();
                                $content[$param['field_name']] = $pth.DIRECTORY_SEPARATOR.$tmp_data['file_name'];
                                $this->data['page'][$param['field_name']] =  $pth.DIRECTORY_SEPARATOR.$tmp_data['file_name'];
                            }
                            else
                            {
                                if ($this->input->post($param['field_name'].'_delete'))
                                {
                                    @unlink($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.$this->input->post($param['field_name'].'_hidden'));
                                    $this->data['page'][$param['field_name']] = '';
                                }
                                elseif($this->input->post($param['field_name'].'_hidden'))
                                    $this->data['page'][$param['field_name']] = $this->input->post($param['field_name'].'_hidden');
                                else
                                    $this->data['page'][$param['field_name']] = '';
                            }
                        }
                        else
                        {
                            if ($this->input->post($param['field_name'].'_delete'))
                            {
                                @unlink($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.$this->input->post($param['field_name'].'_hidden'));
                                $this->data['page'][$param['field_name']] = '';
                            }

                            elseif($this->input->post($param['field_name'].'_hidden'))
                                $this->data['page'][$param['field_name']] = $this->input->post($param['field_name'].'_hidden');
                            else
                                $this->data['page'][$param['field_name']] = '';
                        }
                    }
                }
                $additional_data['content'] = serialize($content);
            }
            else
                $additional_data['content'] = $this->input->post('content');

            if ($id = $this->content_model->Add($additional_data))
            {
                $this->session->set_flashdata('message',  array(
                        'type' => 'success',
                        'text' => 'Запись создана'
                    )
                );
                redirect("airyo/pages/edit/$id", 'refresh');
            }
            else
            {
                $this->data['message'] = array(
                    'type' => 'danger',
                    'text' => 'Произошла ошибка при сохранении записи.'
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
        
        $alias = 'add';
        $this->data['view'] = 'airyo/pages/'.$alias;
        $this->data['scripts'] = array(
            '/themes/airyo/js/content.js',
        );
    }

    public function edit($id = '') {
        $this->data['id'] = '';
        $this->data['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';
        $this->data['main_menu'] = 'pages';
        $this->data['template_list'] = $this->config->item('templates');
        //$this->data['title'] = "Добавить/редактировать страницу";
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        }
        $this->data['type_list']  = $this->content_model->getType();

        // Если передан Ид ищем содержание стр в БД
        if (!empty($id))
        {
            $this->data['page'] = $this->content_model->getToId($id);
            $template = $this->data['page']['template'];
            if (empty($this->data['page']))
                show_404();
            if (!empty($this->data['template_list'][$template]['fields']))
            {
                $fields = $this->data['template_list'][$template]['fields'];
                foreach ($fields as $i => $field)
                {
                    $this->data['fields'][$i]['field_name'] = $i;

                    foreach ($field as $key => $param)
                    {
                        if ($key == 'attributes'){
                            $attributes='';
                            foreach ($param as $k => $attr)
                            {
                                $attributes .= $k.'="'.$attr.'" ';
                            }
                            $this->data['fields'][$i][$key] = $attributes;
                        } else
                            $this->data['fields'][$i][$key] = $param;


                    }
                    if ($this->data['fields'][$i]['type'] != 'file' and !empty($this->data['fields'][$i]['required']))
                        $this->form_validation->set_rules($this->data['fields'][$i]['field_name']  , '', 'required');
                    if ($this->data['fields'][$i]['type'] == 'file' and !empty($this->data['fields'][$i]['required']))
                    {
                        if(!$this->input->post($this->data['fields'][$i]['field_name'].'_hidden') and (empty($_FILES) or $_FILES[$this->data['fields'][$i]['field_name']]['error'] == 4))
                            $this->form_validation->set_rules($this->data['fields'][$i]['field_name']  , '', 'required');

                    }
                    $this->data['page'][$this->data['fields'][$i]['field_name']] = '';

                }

                if (!empty($this->data['page']['content']))
                {
                    $content = unserialize($this->data['page']['content']);
                    foreach ($content as $i => $item)
                    {
                        $this->data['page'][$i] = $item;
                    }
                }
            }
            $this->data['id'] = $id;
            $this->form_validation->set_rules('h1', '', 'required|trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('alias', '', 'callback_check_alias');

            if ($this->form_validation->run() == true)
            {
                $this->data['page'] = array(

                    'h1' => $this->input->post('h1',TRUE),
                    'alias' =>  $this->input->post('alias'),
                    'type' =>  $this->input->post('type'),
                    'title' =>  $this->input->post('title',TRUE),
                    'meta_description' =>   $this->input->post('meta_description'),
                    'meta_keywords' =>  $this->input->post('meta_keywords'),
                    'enabled' =>  $this->input->post('enabled')

                );
                
                $save_data = $this->data['page'];
                
                if (!empty($this->data['template_list'][$template]['fields']))
                {
                    foreach ($this->data['fields'] as $key => $param)
                    {
                        $this->data['page'][$param['field_name']] = $this->input->post($param['field_name']);

                        $content[$param['field_name']] = $this->input->post($param['field_name']);
                        
                        if ($param['type'] == 'file')
                        {
                            $upload = !empty($_FILES[$param['field_name']]) ?
                                $_FILES[$param['field_name']] : null;

                            $pth = 'public'.DIRECTORY_SEPARATOR.'content';
                            $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.$pth;
                            $config['allowed_types'] = '*';

                            if ($upload ) {
                                $this->load->library('upload', $config);
                                $this->upload->initialize($config);
                                $_FILES[$param['field_name']] = array (
                                    'name'=> $upload['name'],
                                    'type'=> $upload['type'],
                                    'tmp_name'=> $upload['tmp_name'],
                                    'error'=> $upload['error'],
                                    'size'=> $upload['size']);
                                if ($this->upload->do_upload($param['field_name']))
                                {
                                    $tmp_data = $this->upload->data();
                                    $content[$param['field_name']] = $pth.DIRECTORY_SEPARATOR.$tmp_data['file_name'];
                                    $this->data['page'][$param['field_name']] =  $pth.DIRECTORY_SEPARATOR.$tmp_data['file_name'];
                                }
                                else
                                {
                                    if ($this->input->post($param['field_name'].'_delete'))
                                    {
                                        @unlink($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.$this->input->post($param['field_name'].'_hidden'));
                                        $this->data['page'][$param['field_name']] = '';
                                    }
                                    elseif($this->input->post($param['field_name'].'_hidden')){
                                        $this->data['page'][$param['field_name']] = $this->input->post($param['field_name'].'_hidden');
                                        $content[$param['field_name']] = $this->input->post($param['field_name'].'_hidden');
                                    }
                                    else
                                        $this->data['page'][$param['field_name']] = '';
                                }
                            }
                            else
                            {
                                if ($this->input->post($param['field_name'].'_delete'))
                                {
                                    @unlink($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.$this->input->post($param['field_name'].'_hidden'));
                                    $this->data['page'][$param['field_name']] = '';
                                }

                                elseif($this->input->post($param['field_name'].'_hidden'))
                                {
                                        $content[$param['field_name']] = $this->input->post($param['field_name'].'_hidden');
                                        $this->data['page'][$param['field_name']] = $this->input->post($param['field_name'].'_hidden');
                                }
                                else
                                    $this->data['page'][$param['field_name']] = '';
                            }
                        }
                    }
                    
                    $save_data['content'] = serialize($content);
                }
                else
                {
                    $save_data['content'] = $this->input->post('content');
                    $this->data['page']['content'] = $this->input->post('content');
                }

                if ($this->content_model->Update($this->data['id'],$save_data))
                {
                    $this->data['message'] = array(
                        'type' => 'success',
                        'text' => 'Запись обновлена'
                    );
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
                    'h1' => $this->input->post('h1',TRUE),
                    'alias' =>  $this->input->post('alias'),
                    'type' =>  $this->input->post('type'),
                    'title' =>  $this->input->post('title',TRUE),
                    'meta_description' =>   $this->input->post('meta_description'),
                    'meta_keywords' =>  $this->input->post('meta_keywords'),
                    'enabled' =>  $this->input->post('enabled'),
                    'template' =>  $this->input->post('template')
                );
                if (!empty($this->data['template_list'][$template]['fields']))
                {
                    foreach ($this->data['fields'] as $key => $param)
                    {
                        $this->input->post($param['field_name'])?$this->data['page'][$param['field_name']] = $this->input->post($param['field_name']):$this->data['page'][$param['field_name']] = '';
                        //$content[$param['field_name']] = $this->input->post($param['field_name']);
                        if($this->input->post($param['field_name'].'_hidden'))
                        {
                        $content[$param['field_name']] = $this->input->post($param['field_name'].'_hidden');
                        $this->data['page'][$param['field_name']] = $this->input->post($param['field_name'].'_hidden');
                        }

                    }
                }
                else
                {
                    $this->data['page']['content'] = $this->input->post('content');
                }

                $this->data['message'] = array(
                    'type' => 'danger',
                    'text' => validation_errors()
                );

            }
        }
        //Вставляем новую запись
        else
        {
            redirect("airyo/pages/add", 'refresh');
        }

        $alias = 'edit';
        $this->data['view'] = 'airyo/pages/'.$alias;

    }

    public function check_alias ()
    {

            if (!empty($_POST['alias']) && !preg_match('/^[a-z0-9-\/\.]+$/', $this->input->post('alias'))){
                $this->form_validation->set_message(__FUNCTION__, 'Некорректно указан адрес страницы');
                return false;
            }
            else
            {
            $page =  $this->content_model->getByAlias($this->input->post('alias'));
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