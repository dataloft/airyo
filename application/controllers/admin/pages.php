<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CommonAdminController {

    protected $default;

    public function __construct() {
        parent::__construct();
        $this->load->model('content_model');
        $this->load->model('trash_model');
        $this->config->load('templates');
        $this->default = $this->config->item('default_template');
    }

    public function index($page = '') {
	    $this->oData['main_menu'] = 'pages';

	    $this->oData['type'] = '';
	    $this->oData['search'] = '';
	    $this->oData['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';
	    if ($this->input->post('typeSelect'))
	        $this->oData['type'] = $this->input->post('typeSelect');
	    if ($this->input->post('search'))
	        $this->oData['search'] = $this->input->post('search');

	    $this->oData['content']  = $this->content_model->getList($this->oData['type'], $this->oData['search']);
	    $this->oData['type_list']  = $this->content_model->getType();
	    $this->oData['view'] = 'admin/pages/list';
    }

    public function add() {
    
	    $this->oData['main_menu'] = 'pages';
	    
	    $this->oData['id'] = '';
	    $this->oData['message'] = '';
	    $this->oData['title'] = "Добавить/редактировать страницу";
        $this->oData['id'] = '';
        $this->oData['message'] = '';
        $this->oData['template_list'] = $this->config->item('templates');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        }
        $this->oData['type_list']  = $this->content_model->getType();
        $this->form_validation->set_rules('h1', '', 'required');
        $this->form_validation->set_rules('template', '', 'required');
        $this->form_validation->set_rules('alias', '', 'callback_check_alias');
        $this->oData['page']['template'] = $this->input->post('template') ? $this->input->post('template') : $this->default;
        //echo $this->oData['page']['template'];

        if (!empty($_POST['change']))
            $_POST = array();
        $this->oData['page']['h1'] = $this->input->post('h1');
        $this->oData['page']['alias'] = $this->input->post('alias');
        $this->oData['page']['title'] = $this->input->post('title');
        $this->oData['page']['meta_description'] = $this->input->post('meta_description');
        $this->oData['page']['meta_keywords'] = $this->input->post('meta_keywords');
        $this->oData['page']['type'] = $this->input->get('type')?$this->input->get('type'):$this->input->post('type');
        $this->oData['page']['enabled'] = $this->input->post('enabled');

        if (!empty($this->oData['template_list'][$this->oData['page']['template']]['fields']))
        {
            $fields = $this->oData['template_list'][$this->oData['page']['template']]['fields'];
            foreach ($fields as $i => $field)
            {
                $this->oData['fields'][$i]['field_name'] = $i;
                $params = $field;
                foreach ($params as $key => $param)
                {
                    if ($key == 'attributes'){
                        $attributes='';
                        foreach ($param as $k => $attr)
                        {
                            $attributes .= $k.'="'.$attr.'" ';
                        }
                        $this->oData['fields'][$i][$key] = $attributes;
                    } else
                        $this->oData['fields'][$i][$key] = $param;


                }
                if ($this->oData['fields'][$i]['type'] != 'file' and !empty($this->oData['fields'][$i]['required']))
                    $this->form_validation->set_rules($this->oData['fields'][$i]['field_name']  , '', 'required');
                if ($this->oData['fields'][$i]['type'] == 'file' and !empty($this->oData['fields'][$i]['required']))
                {
                    if(empty($_FILES) or $_FILES[$this->oData['fields'][$i]['field_name']]['error'] == 4)
                        $this->form_validation->set_rules($this->oData['fields'][$i]['field_name']  , '', 'required');
                }

                $this->oData['page'][$this->oData['fields'][$i]['field_name']] = $this->input->post($this->oData['fields'][$i]['field_name']);

            }

        }
        else
        {
            $this->oData['page']['content'] = $this->input->post('content');
        }

        if ($this->form_validation->run() == true)
        {
            $additional_data = array(

                'template' => $this->input->post('template'),
                'h1' => $this->input->post('h1'),
                'alias' =>  $this->input->post('alias'),
                'type' =>  $this->input->post('type'),
                'title' =>  $this->input->post('title'),
                'meta_description' =>   $this->input->post('meta_description'),
                'meta_keywords' =>  $this->input->post('meta_keywords'),
                'enabled' =>  $this->input->post('enabled')
            );

            if (!empty($this->oData['template_list'][$this->oData['page']['template']]['fields']))
            {
                foreach ($this->oData['fields'] as $key => $param)
                {
                    $this->oData['page'][$param['field_name']] = $this->input->post($param['field_name']);

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
                                $this->oData['page'][$param['field_name']] =  $pth.DIRECTORY_SEPARATOR.$tmp_data['file_name'];
                            }
                            else
                            {
                                if ($this->input->post($param['field_name'].'_delete'))
                                {
                                    @unlink($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.$this->input->post($param['field_name'].'_hidden'));
                                    $this->oData['page'][$param['field_name']] = '';
                                }
                                elseif($this->input->post($param['field_name'].'_hidden'))
                                    $this->oData['page'][$param['field_name']] = $this->input->post($param['field_name'].'_hidden');
                                else
                                    $this->oData['page'][$param['field_name']] = '';
                            }
                        }
                        else
                        {
                            if ($this->input->post($param['field_name'].'_delete'))
                            {
                                @unlink($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.$this->input->post($param['field_name'].'_hidden'));
                                $this->oData['page'][$param['field_name']] = '';
                            }

                            elseif($this->input->post($param['field_name'].'_hidden'))
                                $this->oData['page'][$param['field_name']] = $this->input->post($param['field_name'].'_hidden');
                            else
                                $this->oData['page'][$param['field_name']] = '';
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
                redirect("admin/pages/edit/$id", 'refresh');
            }
            else
            {
                $this->oData['message'] = array(
                    'type' => 'danger',
                    'text' => 'Произошла ошибка при сохранении записи.'
                );
            }
        }
        elseif ($this->input->post('action') == 'add')
        {
            $this->oData['message'] = array(
                'type' => 'danger',
                'text' =>  validation_errors()
            );
        }
        
        $alias = 'add';
        $this->oData['view'] = 'admin/pages/'.$alias;
        $this->oData['scripts'] = array(
            '/themes/airyo/js/content.js',
        );
    }

    public function edit($id = '') {
        $this->oData['id'] = '';
        $this->oData['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';
        $this->oData['main_menu'] = 'pages';
        $this->oData['template_list'] = $this->config->item('templates');
        $this->oData['title'] = "Добавить/редактировать страницу";
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        }
        $this->oData['type_list']  = $this->content_model->getType();

        // Если передан Ид ищем содержание стр в БД
        if (!empty($id))
        {
            $this->oData['page'] = $this->content_model->getToId($id);
            $template = $this->oData['page']['template'];
            if (empty($this->oData['page']))
                show_404();
            if (!empty($this->oData['template_list'][$template]['fields']))
            {
                $fields = $this->oData['template_list'][$template]['fields'];
                foreach ($fields as $i => $field)
                {
                    $this->oData['fields'][$i]['field_name'] = $i;

                    foreach ($field as $key => $param)
                    {
                        if ($key == 'attributes'){
                            $attributes='';
                            foreach ($param as $k => $attr)
                            {
                                $attributes .= $k.'="'.$attr.'" ';
                            }
                            $this->oData['fields'][$i][$key] = $attributes;
                        } else
                            $this->oData['fields'][$i][$key] = $param;


                    }
                    if ($this->oData['fields'][$i]['type'] != 'file' and !empty($this->oData['fields'][$i]['required']))
                        $this->form_validation->set_rules($this->oData['fields'][$i]['field_name']  , '', 'required');
                    if ($this->oData['fields'][$i]['type'] == 'file' and !empty($this->oData['fields'][$i]['required']))
                    {
                        if(!$this->input->post($this->oData['fields'][$i]['field_name'].'_hidden') and (empty($_FILES) or $_FILES[$this->oData['fields'][$i]['field_name']]['error'] == 4))
                            $this->form_validation->set_rules($this->oData['fields'][$i]['field_name']  , '', 'required');

                    }
                    $this->oData['page'][$this->oData['fields'][$i]['field_name']] = '';

                }

                if (!empty($this->oData['page']['content']))
                {
                    $content = unserialize($this->oData['page']['content']);
                    foreach ($content as $i => $item)
                    {
                        $this->oData['page'][$i] = $item;
                    }
                }
            }
            $this->oData['id'] = $id;
            $this->form_validation->set_rules('h1', '', 'required');
            $this->form_validation->set_rules('alias', '', 'callback_check_alias');


            if ($this->form_validation->run() == true)
            {
                $this->oData['page'] = array(

                    'h1' => $this->input->post('h1'),
                    'alias' =>  $this->input->post('alias'),
                    'type' =>  $this->input->post('type'),
                    'title' =>  $this->input->post('title'),
                    'meta_description' =>   $this->input->post('meta_description'),
                    'meta_keywords' =>  $this->input->post('meta_keywords'),
                    'enabled' =>  $this->input->post('enabled')

                );
                
                $save_data = $this->oData['page'];
                
                if (!empty($this->oData['template_list'][$template]['fields']))
                {
                    foreach ($this->oData['fields'] as $key => $param)
                    {
                        $this->oData['page'][$param['field_name']] = $this->input->post($param['field_name']);

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
                                    $this->oData['page'][$param['field_name']] =  $pth.DIRECTORY_SEPARATOR.$tmp_data['file_name'];
                                }
                                else
                                {
                                    if ($this->input->post($param['field_name'].'_delete'))
                                    {
                                        @unlink($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.$this->input->post($param['field_name'].'_hidden'));
                                        $this->oData['page'][$param['field_name']] = '';
                                    }
                                    elseif($this->input->post($param['field_name'].'_hidden'))
                                        $this->oData['page'][$param['field_name']] = $this->input->post($param['field_name'].'_hidden');
                                    else
                                        $this->oData['page'][$param['field_name']] = '';
                                }
                            }
                            else
                            {
                                if ($this->input->post($param['field_name'].'_delete'))
                                {
                                    @unlink($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.$this->input->post($param['field_name'].'_hidden'));
                                    $this->oData['page'][$param['field_name']] = '';
                                }

                                elseif($this->input->post($param['field_name'].'_hidden'))
                                    $this->oData['page'][$param['field_name']] = $this->input->post($param['field_name'].'_hidden');
                                else
                                    $this->oData['page'][$param['field_name']] = '';
                            }
                        }
                    }
                    
                    $save_data['content'] = serialize($content);
                }
                else
                {
                    $save_data['content'] = $this->input->post('content');
                    $this->oData['page']['content'] = $this->input->post('content');
                }

                if ($this->content_model->Update($this->oData['id'],$save_data))
                {
                    $this->oData['message'] = array(
                        'type' => 'success',
                        'text' => 'Запись обновлена'
                    );
                }
                else
                {
                    $this->oData['message'] = array(
                        'type' => 'danger',
                        'text' => 'Произошла ошибка при обновлении записи.'
                    );
                }
            }
            elseif($this->input->post('id') == $id)
            {
                $this->oData['page'] = array(
                    'h1' => $this->input->post('h1'),
                    'alias' =>  $this->input->post('alias'),
                    'type' =>  $this->input->post('type'),
                    'title' =>  $this->input->post('title'),
                    'meta_description' =>   $this->input->post('meta_description'),
                    'meta_keywords' =>  $this->input->post('meta_keywords'),
                    'enabled' =>  $this->input->post('enabled'),
                    'template' =>  $this->input->post('template')
                );
                if (!empty($this->oData['template_list'][$template]['fields']))
                {
                    foreach ($this->oData['fields'] as $key => $param)
                    {
                        $this->input->post($param['field_name'])?$this->oData['page'][$param['field_name']] = $this->input->post($param['field_name']):$this->oData['page'][$param['field_name']] = '';
                        //$content[$param['field_name']] = $this->input->post($param['field_name']);

                    }
                }
                else
                {
                    $this->oData['page']['content'] = $this->input->post('content');
                }

                $this->oData['message'] = array(
                    'type' => 'danger',
                    'text' => validation_errors()
                );

            }
        }
        //Вставляем новую запись
        else
        {
            redirect("admin/pages/add", 'refresh');
        }

        $alias = 'edit';
        $this->oData['view'] = 'admin/pages/'.$alias;

    }

    public function check_alias ()
    {
        $page =  $this->content_model->getToAlias($this->input->post('alias'));
        $this->form_validation->set_message(__FUNCTION__, 'The alias you entered is already used.');
        if (empty($page))
            return true;
        if ($this->input->post('id') == $page->id)
            return true;
        else
            return false;
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