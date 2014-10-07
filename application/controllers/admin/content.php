<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CommonAdminController {

    protected $default;

    public function __construct() {
        parent::__construct();
        $this->load->model('content_model');
        $this->load->model('template_model');
        $this->load->model('trash_model');
        $this->load->helper('file');
        $this->lang->load('content');
        $this->config->load('templates');
        $this->default = $this->config->item('default_template');
        $this->load->helper('language');
        if(!$this->ion_auth->logged_in()) {
           show_404();
        }

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
        $data = array();
        $data['id'] = '';
        $data['message'] = '';
        $data['main_menu'] = 'content';
        $data['menu'] = array();
        $data['usermenu'] = array();
        $data['template_list'] = $this->config->item('templates');

        $page = new ArrayObject;
        $data['title'] = "Добавить/редактировать страницу";
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        $data['type_list']  = $this->content_model->getType();
        /*$this->form_validation->set_rules('content', '', 'required');*/
        $this->form_validation->set_rules('h1', '', 'required');
        $this->form_validation->set_rules('template', '', 'required');
        $this->form_validation->set_rules('alias', '', 'is_unique[content.alias]');
        $page->content = $this->input->post('content');
        $page->h1 = $this->input->post('h1');
        $page->alias = $this->input->post('alias');
        $page->title = $this->input->post('title');
        $page->meta_description = $this->input->post('meta_description');
        $page->meta_keywords = $this->input->post('meta_keywords');
        $page->type = $this->input->get('type')?$this->input->get('type'):$this->input->post('type');
        $page->enabled = $this->input->post('enabled');
        $data['page'] = $page;
        if ($this->form_validation->run() == true)
        {
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
            if ($id = $this->content_model->Add($additional_data))
            {
                $this->session->set_flashdata('message',  array(
                        'type' => 'success',
                        'text' => 'Запись создана'
                    )
                );
                redirect("admin/content/edit/$id", 'refresh');
            }
            else
            {
                $data['message'] = array(
                    'type' => 'danger',
                    'text' => 'Произошла ошибка при сохранении записи.'
                );
            }
        }
        elseif ($this->input->post('action') == 'add')
        {
            $data['message'] = array(
                'type' => 'danger',
                'text' =>  validation_errors()
            );
        }
        $this->load->view('admin/header', $data);
        $alias = 'add';
        /*foreach ($data['type_list'] as $item) {
            if ($page->type == $item->id)
                $alias = $item->alias;
            else
                continue;
        }*/
        $this->load->view('admin/content/'.$alias, $data);
        $data['scripts'] = array(
            '/themes/airyo/js/content.js',
        );
        $this->load->view('admin/footer', $data);
    }

    public function edit($id = '') {
        $data = array();
        $data['id'] = '';
        $data['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';
        $data['main_menu'] = 'content';
        $data['menu'] = array();
        $data['usermenu'] = array();
        $data['template_list'] = $this->config->item('templates');
        //$page = new ArrayObject;
        $data['title'] = "Добавить/редактировать страницу";
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        $data['type_list']  = $this->content_model->getType();

        // Если передан Ид ищем содержание стр в БД
        if (!empty($id))
        {
            $data['page'] = $this->content_model->getToId($id);
            //($data['page']['template'] != $this->default) ? $template = $data['page']['template'] : $template = 0;
            $template = $data['page']['template'];
            if (empty($data['page']))
                show_404();
              if (!empty($data['template_list'][$template]['fields']))
            {
                $fields = $data['template_list'][$template]['fields'];
                foreach ($fields as $i => $field)
                {
                    $data['fields'][$i]['field_name'] = $i;

                    foreach ($field as $key => $param)
                    {
                        if ($key == 'attributes'){
                            $attributes='';
                            foreach ($param as $k => $attr)
                            {
                                $attributes .= $k.'="'.$attr.'" ';
                            }
                            $data['fields'][$i][$key] = $attributes;
                        } else
                            $data['fields'][$i][$key] = $param;


                    }
                    if ($data['fields'][$i]['type'] != 'file' and !empty($data['fields'][$i]['required']))
                        $this->form_validation->set_rules($data['fields'][$i]['field_name']  , '', 'required');
                    if ($data['fields'][$i]['type'] == 'file' and !empty($data['fields'][$i]['required']))
                    {
                        if(!$this->input->post($data['fields'][$i]['field_name'].'_hidden') and (empty($_FILES) or $_FILES[$data['fields'][$i]['field_name']]['error'] == 4))
                            $this->form_validation->set_rules($data['fields'][$i]['field_name']  , '', 'required');

                    }
                    $data['page'][$data['fields'][$i]['field_name']] = '';

                }

                if (!empty($data['page']['content']))
                {
                   $content = unserialize($data['page']['content']);
                      foreach ($content as $i => $item)
                        {
                            $data['page'][$i] = $item;
                        }
                }
            }
            $data['id'] = $id;
            $this->form_validation->set_rules('h1', '', 'required');
            $this->form_validation->set_rules('alias', '', 'callback_check_alias');


            if ($this->form_validation->run() == true)
            {
                $data['page'] = array(

                    'h1' => $this->input->post('h1',TRUE),
                    'alias' =>  $this->input->post('alias',TRUE),
                    'type' =>  $this->input->post('type',TRUE),
                    'title' =>  $this->input->post('title',TRUE),
                    'meta_description' =>   $this->input->post('meta_description',TRUE),
                    'meta_keywords' =>  $this->input->post('meta_keywords',TRUE),
                    'enabled' =>  $this->input->post('enabled',TRUE)

                );
                $save_data = $data['page'];
                if (!empty($data['template_list'][$template]['fields']))
                {
                    foreach ($data['fields'] as $key => $param)
                    {
                       $data['page'][$param['field_name']] = $this->input->post($param['field_name']);

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
                                   $data['page'][$param['field_name']] =  $pth.DIRECTORY_SEPARATOR.$tmp_data['file_name'];
                               }
                               else
                               {
                                   if ($this->input->post($param['field_name'].'_delete'))
                                   {
                                       @unlink($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.$this->input->post($param['field_name'].'_hidden'));
                                       $data['page'][$param['field_name']] = '';
                                   }
                                   elseif($this->input->post($param['field_name'].'_hidden'))
                                       $data['page'][$param['field_name']] = $this->input->post($param['field_name'].'_hidden');
                                   else
                                       $data['page'][$param['field_name']] = '';
                               }
                           }
                           else
                           {
                               if ($this->input->post($param['field_name'].'_delete'))
                               {
                                   @unlink($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.$this->input->post($param['field_name'].'_hidden'));
                                   $data['page'][$param['field_name']] = '';
                               }

                               elseif($this->input->post($param['field_name'].'_hidden'))
                                   $data['page'][$param['field_name']] = $this->input->post($param['field_name'].'_hidden');
                               else
                                   $data['page'][$param['field_name']] = '';
                           }
                       }
                    }
                    $save_data['content'] = serialize($content);
                }
                else
                {
                    $save_data['content'] = $this->input->post('content',TRUE);
                    $data['page']['content'] = $this->input->post('content',TRUE);
                }

                if ($this->content_model->Update($data['id'],$save_data))
                {
                    $data['message'] = array(
                        'type' => 'success',
                        'text' => 'Запись обновлена'
                    );
                }
                else
                {
                    $data['message'] = array(
                        'type' => 'danger',
                        'text' => 'Произошла ошибка при обновлении записи.'
                    );
                }
            }
            elseif($this->input->post('id') == $id)
            {
                $data['page'] = array(
                    'h1' => $this->input->post('h1',TRUE),
                    'alias' =>  $this->input->post('alias',TRUE),
                    'type' =>  $this->input->post('type',TRUE),
                    'title' =>  $this->input->post('title',TRUE),
                    'meta_description' =>   $this->input->post('meta_description',TRUE),
                    'meta_keywords' =>  $this->input->post('meta_keywords',TRUE),
                    'enabled' =>  $this->input->post('enabled',TRUE),
                    'template' =>  $this->input->post('template',TRUE)
                );
                if (!empty($data['template_list'][$template]['fields']))
                {
                    foreach ($data['fields'] as $key => $param)
                    {
                        $this->input->post($param['field_name'])?$data['page'][$param['field_name']] = $this->input->post($param['field_name']):$data['page'][$param['field_name']] = '';
                        //$content[$param['field_name']] = $this->input->post($param['field_name']);

                    }
                }
                else
                {
                    $data['page']['content'] = $this->input->post('content',TRUE);
                }

                $data['message'] = array(
                    'type' => 'danger',
                    'text' => validation_errors()
                );

            }
        }
        //Вставляем новую запись
        else
        {
            redirect("admin/content/add?type=".$this->input->get('type'), 'refresh');
        }
        $this->load->view('admin/header', $data);
        $alias = 'edit';
        /*foreach ($data['type_list'] as $item) {
            if ( $data['page']->type == $item->id)
                $alias = $item->alias;
            else
                continue;
        }*/
        //if (empty($data['page']->content))
        //print_r(unserialize($data['page']->content));
        $this->load->view('admin/content/'.$alias, $data);
        $this->load->view('admin/footer', $data);

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

    public function delete ()
    {
        if (isset($_POST)) {
            $id = $this->input->post('id');
            if ($id)
            {
                $data['page'] = $this->content_model->getToId($id);
                if (!empty($data['page']))
                {
                    $additional_data = array(
                        'deleted_id' => $id,
                        'type' =>  'page',
                        'data' =>     serialize($data['page'])
                    );
                    if ($this->trash_model->Add($additional_data))
                    {
                        if ($this->content_model->delete($id))
                        {
                            $output['success']='success';
                            $this->session->set_flashdata('message',  array(
                                    'type' => 'success',
                                    'text' => 'Запись удалена'
                                )
                            );
                        }
                        else
                        {
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