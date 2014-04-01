<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model('menu_model');
        //$this->lang->load('menu');
        $this->load->helper('language');
	}

	public function index() {

        if(!$this->ion_auth->logged_in()) {
            redirect('admin', 'refresh');
        }

        $data['menu'] = array();
        $data['usermenu'] = array();
        $data['menu_group'] = '';
        $data['menu_list'] =  $this->menu_model->getMenuGroup();
        $data['menu_group'] = $data['menu_list'][0]['id'];
        if ($this->input->post('typeSelect'))
            $data['menu_group'] = $this->input->post('typeSelect');
        if ($list = $this->menu_model->getList($data['menu_group']))
            $data['content']  = $this->printTreeList($this->buildTree($list));
        else
            $data['content'] = '';
                $this->load->view('admin/header', $data);
        $this->load->view('admin/menu/list', $data);
        $this->load->view('admin/footer', $data);
	}

    public function buildTree($array_items) {

        if (is_array($array_items)) {

            $items_count = count($array_items);

            for ($i = 0; $i < $items_count; $i++) {

                $item = clone($array_items[$i]);

                if ($item->parent_id == 0) { //верхний уровень

                    $children = $this->getChildNode($array_items, $item->id);

                    $item->child = $children;

                    $result[] = $item;

                }

            }

        }

        return (isset($result)) ? $result : false;

    }

    public function getChildNode($array, $id) {

        $count = count($array);

        for ($i = 0; $i < $count; $i++) { // перебор массива

            $item = clone($array[$i]);

            if ($item->parent_id == $id) { // 2 уровень найден

                $children = $this->getChildNode($array, $item->id);

                $item->child = $children;

                $child_array[] = $item; // добавить 2 уровень

            }

        }

        if (isset($child_array)) {

            return $child_array;

        }

        else {

            return false;

        }

    }

    /**
     * @param $items
     * @param int $current
     * @param int $level
     * @var string $echo
     * @return string
     */
    function printSelectList($items, $current=0, $level=0) {

        $echo = '';

        foreach ($items as $item) {

            $echo.= '<option value="'.$item->id . '"';
            if ($current == $item->id)
                $echo.= 'selected';
            $echo.= '>';
            for ($i = 0; $i < $level;$i++)
                $echo.=' - ';

            $echo.=$item->name . '</option>';

            if ($item->child !== false) {

                $level++;

                $echo.= $this->printSelectList($item->child, $item->id, $level);

                $level--;

            }



        }
        return $echo;
    }

    function printTreeList($items, $current=0, $level=0) {
        $echo = '';
         //$level == 0 ? $echo = '<ul class="list-group">' : $echo = '<ul>';

        foreach ($items as $item) {

            $echo.= '<li class="list-group-item">';

            if ($item->id != $current) {

                $echo.= '<a href="menu/edit/'.$item->id . '">' . $item->name . '</a>';

            }

            else {

                $echo.= '<span>' . $item->name . '</span>';

            }

            if ($item->child !== false) {

                $level++;

                $echo.= $this->printTreeList($item->child, $item->id, $level);

                $level--;

            }

            $echo.= '</li>';

        }

        //$echo.= '</ul>';
        return $echo;

    }

    public function add($mid=0) {
        $data = array();
        $data['id'] = '';
        $data['message'] = '';
        $data['menu'] = array();
        $data['usermenu'] = array();
        $menu = new ArrayObject;
        $data['title'] = "Добавить/редактировать пункт меню";
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        $data['menu_group'] = $mid;
        if ($list = $this->menu_model->getList($data['menu_group']))
            $data['lvl_menu']  = $this->printSelectList($this->buildTree($list));
        else
            $data['lvl_menu'] = '';
       // $data['lvl_menu']  = $this->printSelectList($this->buildTree($this->menu_model->getList($data['menu_group'])));
        //$data['menu_group'] =  $this->menu_model->getMenuGroup();
        $this->form_validation->set_rules('name', '', 'required');
        $this->form_validation->set_rules('url', '', 'required');
       // $this->form_validation->set_rules('menu_group', '', 'required');
        $menu->name = $this->input->post('name');
        $menu->url = $this->input->post('url');
        $menu->menu_group = $this->input->post('menu_group');
        $data['menu'] = $menu;
        if ($this->form_validation->run() == true)
        {
            $additional_data = array(
                'name' => $menu->name,
                'url' => $menu->url,
                'menu_group' =>  $mid,
                'parent_id' =>  $this->input->post('level_menu')
            );
            if ($id = $this->menu_model->Add($additional_data))
            {
                $this->session->set_flashdata('message',  array(
                        'type' => 'success',
                        'text' => 'Пункт меню создан'
                    )
                );
                redirect("admin/menu/edit/$id", 'refresh');
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
        $this->load->view('admin/menu/edit', $data);
        $this->load->view('admin/footer', $data);

    }

    public function edit($id = '') {
        $data = array();
        $data['id'] = '';
        $data['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';
        $data['menu'] = array();
        $data['usermenu'] = array();
        $menu = new ArrayObject;
        $data['title'] = "Добавить/редактировать пункт меню";

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }

        $this->form_validation->set_rules('name', '', 'required');
        $this->form_validation->set_rules('url', '', 'required');
        // Если передан Ид ищем содержание стр в БД
        if (!empty($id))
        {
            $data['menu'] = $this->menu_model->getToId($id);
            if (empty($data['menu']))
                show_404();
            $data['id'] = $id;
            $menu->level_menu = $data['menu']->parent_id;
            if ($list = $this->menu_model->getList($data['menu']->menu_group))
                $data['lvl_menu']  = $this->printSelectList($this->buildTree($list),$menu->level_menu);
            else
                $data['lvl_menu'] = '';
            if ($this->form_validation->run() == true)
            {

                $menu->name = $this->input->post('name',TRUE);
                $menu->url = $this->input->post('url',TRUE);
                $menu->menu_group = $data['menu']->menu_group;
                
                $data['menu'] = $menu;
                $additional_data = array(
                    'name' => $menu->name,
                    'url' => $menu->url,
                    'menu_group' =>   $data['menu']->menu_group,
                    'parent_id' =>   $this->input->post('level_menu',TRUE),
                );
                if ($this->menu_model->Update($data['id'],$additional_data))
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
                $menu->name = $this->input->post('name',TRUE);
                $menu->url = $this->input->post('url',TRUE);
                $menu->menu_group = $this->input->post('menu_group',TRUE);

                $data['menu'] = $menu;
                $data['message'] = array(
                    'type' => 'danger',
                    'text' => validation_errors()
                );

            }
        }
        //Вставляем новую запись
        else
        {
            redirect("admin/menu/add", 'refresh');
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/menu/edit', $data);
        $this->load->view('admin/footer', $data);

    }
	
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */