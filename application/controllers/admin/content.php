<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model('content_model');
        $this->load->model('template_model');
        $this->load->model('trash_model');
        $this->load->helper('file');
        $this->lang->load('content');
        $this->load->helper('language');
        if(!$this->ion_auth->logged_in()) {
           show_404();
        }
    }

    public function index($page = '') {
        if(!$this->ion_auth->logged_in()) {
            redirect('admin', 'refresh');
        }

        $data['main_menu'] = 'content';
        $data['menu'] = array();
        $data['usermenu'] = array();
        $data['type'] = '';
        $data['search'] = '';
        $data['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';
        if ($this->input->post('typeSelect'))
            $data['type'] = $this->input->post('typeSelect');
        if ($this->input->post('search'))
            $data['search'] = $this->input->post('search');


        $data['content']  = $this->content_model->getList($data['type'],$data['search']);
        $data['type_list']  = $this->content_model->getType();
        $this->load->view('admin/header', $data);
        $this->load->view('admin/content/list', $data);
        $this->load->view('admin/footer', $data);
    }

    public function add() {
        $data = array();
        $data['id'] = '';
        $data['message'] = '';
        $data['main_menu'] = 'content';
        $data['menu'] = array();
        $data['usermenu'] = array();
        $data['template_list'] = $this->template_model->getList();
        $page = new ArrayObject;
        $data['title'] = "Добавить/редактировать страницу";
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        $data['type_list']  = $this->content_model->getType();

        $this->form_validation->set_rules('h1', '', 'required');
        $this->form_validation->set_rules('template', '', 'required');
        $this->form_validation->set_rules('alias', '', 'is_unique[content.alias]');
       /* $page->content = $this->input->post('content');*/
        $page->h1 = $this->input->post('h1');
        $page->alias = $this->input->post('alias');
        $page->title = $this->input->post('title');
        $page->meta_description = $this->input->post('meta_description');
        $page->meta_keywords = $this->input->post('meta_keywords');
        $page->type = $this->input->get('type')?$this->input->get('type'):$this->input->post('type');
        $page->template = $this->input->post('template');
        $page->enabled = $this->input->post('enabled');
        $data['page'] = $page;
        if ($this->form_validation->run() == true)
        {
            $additional_data = array(
                'template' => $page->template,
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

        $this->load->view('admin/footer', $data);
    }

    public function edit($id = '') {
        $data = array();
        $data['id'] = '';
        $data['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';
        $data['main_menu'] = 'content';
        $data['menu'] = array();
        $data['usermenu'] = array();
        $page = new ArrayObject;
        $data['title'] = "Добавить/редактировать страницу";
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        $data['type_list']  = $this->content_model->getType();
        /* $this->form_validation->set_rules('content', '', 'required');*/

        // Если передан Ид ищем содержание стр в БД
        if (!empty($id))
        {
            $data['page'] = $this->content_model->getToId($id);

            if (empty($data['page']))
                show_404();
                        //echo (serialize(array('type'=>'textarea','label'=>'H1', 'required'=>'1','attributes'=>array('rows'=>20, 'cols'=>10))));
            $fields = $this->template_model->getTemplatesConfig($data['page']['template']);


            foreach ($fields as $i => $field)
            {
               $data['fields'][$i]['field_name'] = $field['field_name'];
               $params = unserialize($field['field_param']);
               foreach ($params as $key => $param)
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
               if (!empty($data['fields'][$i]['required']))
               {
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
                foreach ($data['fields'] as $key => $param)
                {
                   $data['page'][$param['field_name']] = $this->input->post($param['field_name']);
                   $content[$param['field_name']] = $this->input->post($param['field_name']);
                   if ($param['type'] == 'file')
                   {

                       $upload = isset($_FILES[$param['field_name']]) ?
                           $_FILES[$param['field_name']] : null;
                       if ($upload ) {
                           // param_name is an array identifier like "files[]",
                           // $_FILES is a multi-dimensional array:
                           echo '2';
                           $pth = 'public'.DIRECTORY_SEPARATOR.'content';
                           $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.$pth;
                           $config['allowed_types'] = '*';
                           $this->load->library('upload', $config);

                           $this->upload->initialize($config);
                           // print_r( $this->config->item('not_allowed_mimes'));


                           $_FILES[$param['field_name']] = array (
                               'name'=> $upload['name'],
                               'type'=> $upload['type'],
                               'tmp_name'=> $upload['tmp_name'],
                               'error'=> $upload['error'],
                               'size'=> $upload['size']);
                           if ($this->upload->do_upload($param['field_name']))
                           {
                               $tmp_data = $this->upload->data();
                              // print_r($tmp_data);
                               $content[$param['field_name']] = $pth.DIRECTORY_SEPARATOR.$tmp_data['file_name'];

                           }
                           else
                           {
                               $data['page'][$param['field_name']] = '';
                           }
                       }
                   }
                }

                $save_data['content'] = serialize($content);
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
            elseif($this->input->post('id')==$id)
            {


                //$fields = $this->template_model->getTemplatesConfig($data['page']->template);

                //$page->content = $this->input->post('content',TRUE);
                $data['page'] = array(
                 //   'content' => serialize($content),
                    'h1' => $this->input->post('h1',TRUE),
                    'alias' =>  $this->input->post('alias',TRUE),
                    'type' =>  $this->input->post('type',TRUE),
                    'title' =>  $this->input->post('title',TRUE),
                    'meta_description' =>   $this->input->post('meta_description',TRUE),
                    'meta_keywords' =>  $this->input->post('meta_keywords',TRUE),
                    'enabled' =>  $this->input->post('enabled',TRUE)
                );

                foreach ($data['fields'] as $key => $param)
                {
                    $this->input->post($param['field_name'])?$data['page'][$param['field_name']] = $this->input->post($param['field_name']):$data['page'][$param['field_name']] = '';
                    //$content[$param['field_name']] = $this->input->post($param['field_name']);
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

/* End of file page.php */
/* Location: ./application/controllers/page.php */