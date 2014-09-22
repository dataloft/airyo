<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CommonAdminController {

	public function __construct() {
		parent::__construct();
		$this->load->model('menu_model');
		$this->load->model('trash_model');
	}

	public function index() {
	$aParams = parent::index();
		$aParams['header']['main_menu'] = 'menu';

		$body_data['menu_group'] = '';
		$body_data['menu_list'] =  $this->menu_model->getMenuGroup();
		$body_data['menu_group'] = $body_data['menu_list'][0]['id'];

		if ($this->input->post('typeSelect')) {
			$body_data['menu_group'] = $this->input->post('typeSelect');
		}

		if ($list = $this->menu_model->getList($body_data['menu_group'])) {
			$body_data['content']  = $this->printTreeList($this->buildTree($list));
		} else {
			$body_data['content'] = '';
		}
		$body_data['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';

		$this->header_vars = $aParams['header'];
		$this->body_vars = $body_data;
		$this->body_file = 'admin/menu/list';
	}

	/**
	 * Построекние дерева
	 *
	 * @param $array_items
	 *
	 * @return array|bool
	 *
	 * @editor N.Kulchinskiy
	 */
	public function buildTree($array_items)	{
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

	/**
	 * Получение пунктов меню
	 *
	 * @param $array
	 * @param $id
	 *
	 * @return array|bool
	 *
	 * @editor N.Kulchinskiy
	 */
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
		} else {
			return false;
		}
	}

    function printSelectList($items, $current=0, $level=0, $id=0, $mem_lvl = -1)
    {
        $echo = '';
        foreach ($items as $item)
        {
            $echo.= '<option value="'.$item->id . '"';
            if ($current == $item->id)
                $echo.= 'selected';
            if ($mem_lvl>=$level)
                $mem_lvl = -1;
            if ($id && $id == $item->id)
                $mem_lvl = $level;
            if (($id && $id == $item->id) or ($mem_lvl>-1 && $level>$mem_lvl))
                $echo.= 'disabled';
            $echo.= '>';
            for ($i = 0; $i < $level;$i++)
                $echo.=' - ';
            $echo.=$item->name .'</option>';
            if ($item->child !== false)
            {
                $level++;
                $echo.= $this->printSelectList($item->child, $current, $level, $id, $mem_lvl);
                $level--;
            }
        }
        return $echo;
    }

    function printTreeList($items, $current=0, $level=0)
    {
        $echo = '';
        foreach ($items as $item) {
            $echo.= '<li class="list-group-item">';
            if ($item->id != $current)
            {
                $echo.= '<a href="menu/edit/'.$item->id . '"';
                if ($level>0)
                    $echo.='style="margin-left:'.($level*20).'px"';
               $echo.=  '>' . $item->name . '</a>';
            }
            else
            {
                $echo.= '<span>' . $item->name . '</span>';
            }
            if ($item->child !== false)
            {
                $level++;
                $echo.= $this->printTreeList($item->child, $item->id, $level);
                $level--;
            }
            $echo.= '</li>';
        }
        return $echo;
    }

    public function add($mid=0) {
	    $aParams = parent::add();
	    $aParams['header']['main_menu'] = 'menu';

	    $aParams['body']['id'] = '';
	    $aParams['body']['message'] = '';

        $menu = new ArrayObject;
	    $aParams['body']['title'] = "Добавить/редактировать пункт меню";

        if (!$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

	    $aParams['body']['menu_group'] = $mid;
        if ($list = $this->menu_model->getList($aParams['body']['menu_group'])) {
	        $aParams['body']['lvl_menu']  = $this->printSelectList($this->buildTree($list));
        } else {
	        $aParams['body']['lvl_menu'] = '';
        }

        $this->form_validation->set_rules('name', '', 'required');
        $this->form_validation->set_rules('url', '', 'required');
        $menu->name = $this->input->post('name');
        $menu->url = $this->input->post('url');
        $menu->order = $this->input->post('order',TRUE);
        $menu->menu_group = $this->input->post('menu_group');
	    $aParams['body']['menu'] = $menu;
        if ($this->form_validation->run() == true) {
            if ($check = $this->menu_model->ckeckUniqueOrder($this->input->post('level_menu',TRUE), $this->input->post('order',TRUE))) {
                $check_order = $this->menu_model->getMaxOrder($this->input->post('level_menu',TRUE))+1;
                $this->menu_model->Update($check, array('order' => $check_order));
                $menu->order = $this->input->post('order',TRUE);
            } else {
                $menu->order = $this->input->post('order',TRUE);
            }
            $additional_data = array(
                'name' => $menu->name,
                'url' => $menu->url,
                'menu_group' =>  $mid,
                'parent_id' =>  $this->input->post('level_menu'),
                'order' =>  $menu->order
            );
            if ($id = $this->menu_model->Add($additional_data)) {
                $this->session->set_flashdata('message',  array(
                        'type' => 'success',
                        'text' => 'Пункт меню создан'
                    )
                );
                redirect("admin/menu/edit/$id", 'refresh');
            } else {
	            $aParams['body']['message'] = array(
                    'type' => 'danger',
                    'text' => 'Произошла ошибка при сохранении записи.'
                );
            }
        }
        elseif ($this->input->post('action') == 'add') {
	        $aParams['body']['message'] = array(
                'type' => 'danger',
                'text' =>  validation_errors()
            );
        }

	    $this->body_vars = $aParams['body'];
	    $this->body_file = 'admin/menu/edit';
    }

    public function edit($id = '') {
	    $aParams = parent::edit();
	    $aParams['header']['main_menu'] = 'menu';

	    $aParams['body']['id'] = '';

	    $aParams['body']['id'] = '';
	    $aParams['body']['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';

        $menu = new stdClass();
	    $aParams['body']['title'] = "Добавить/редактировать пункт меню";

        if (!$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        $this->form_validation->set_rules('name', '', 'required');
        $this->form_validation->set_rules('url', '', 'required');
        // Если передан Ид ищем содержание стр в БД
        if (!empty($id)) {
	        $aParams['body']['menu'] = $this->menu_model->getToId($id);

            if (empty($aParams['body']['menu']))
                show_404();
	        $aParams['body']['id'] = $id;
            $old_parent_id = $aParams['body']['menu']->parent_id;
            if ($this->input->post('level_menu',TRUE))
                $menu->level_menu = $this->input->post('level_menu',TRUE);
            else
                $menu->level_menu = $aParams['body']['menu']->parent_id;
            if ($list = $this->menu_model->getList($aParams['body']['menu']->menu_group))
	            $aParams['body']['lvl_menu']  = $this->printSelectList($this->buildTree($list),$menu->level_menu, 0, $id);
            else
	            $aParams['body']['lvl_menu'] = '';
            if ($this->form_validation->run() == true) {

                $menu->name = $this->input->post('name',TRUE);
                $menu->url = $this->input->post('url',TRUE);
                //Если сменился родитель добавляем пункт к новому родитель в конец списка
                if ($old_parent_id != $this->input->post('level_menu',TRUE))
                    $menu->order = $this->menu_model->getMaxOrder($this->input->post('level_menu',TRUE)) + 1;
                elseif ($check = $this->menu_model->ckeckUniqueOrder($this->input->post('level_menu',TRUE), $this->input->post('order',TRUE), $id))
                {
                    $check_order = $this->menu_model->getMaxOrder($this->input->post('level_menu',TRUE))+1;
                    $this->menu_model->Update($check, array('order' => $check_order));
                    $menu->order = $this->input->post('order',TRUE);

                }
                else
                {
                    $menu->order = $this->input->post('order',TRUE);
                }

                $menu->menu_group = $aParams['body']['menu']->menu_group;

	            $aParams['body']['menu'] = $menu;
                $additional_data = array(
                    'name' => $menu->name,
                    'url' => $menu->url,
                    'order' => $menu->order,
                    'menu_group' =>   $aParams['body']['menu']->menu_group,
                    'parent_id' =>   $this->input->post('level_menu',TRUE),
                );
                if ($this->menu_model->Update($aParams['body']['id'],$additional_data))
                {
                    $this->reOrder($aParams['body']['menu']->menu_group);
	                $aParams['body']['message'] = array(
                        'type' => 'success',
                        'text' => 'Запись обновлена'
                    );
                }
                else
                {
	                $aParams['body']['message'] = array(
                        'type' => 'danger',
                        'text' => 'Произошла ошибка при обновлении записи.'
                    );
                }
            }
            elseif($this->input->post('id')==$id)
            {
                $menu->name = $this->input->post('name',TRUE);
                $menu->url = $this->input->post('url',TRUE);
                $menu->order = $this->input->post('order',TRUE);
                $menu->menu_group = $this->input->post('menu_group',TRUE);

	            $aParams['body']['menu'] = $menu;
	            $aParams['body']['message'] = array(
                    'type' => 'danger',
                    'text' => validation_errors()
                );

            }
        } else { //Вставляем новую запись
            redirect("admin/menu/add", 'refresh');
        }

	    $this->header_vars = $aParams['header'];
	    $this->body_vars = $aParams['body'];
	    $this->body_file = 'admin/menu/edit';
    }

    // Пресортировка пунктов меню
    public function reOrder ($menu_group = 1) {
        $old_parent_id = 0;
        $order = 0;
        $order_list = $this->menu_model->getOrderList($menu_group);
        foreach ($order_list as $row) {
            if ($old_parent_id == $row->parent_id) {
                $order ++;
                $row->order = $order;
            } else {
                $old_parent_id = $row->parent_id;
                $order = 1;
                $row->order = $order;

            }
            $this->menu_model->UpdateOrderList($row);
        }
    }

    public function delete () {
        if (isset($_POST)) {
            $id = $this->input->post('id');
            if ($id) {
                $data['menu'] = $this->menu_model->getToId($id);
                if (!empty($data['menu'])) {
                    $additional_data = array(
                        'deleted_id' => $id,
                        'type' =>  'menu',
                        'data' =>     serialize($data['menu'])
                    );
                    if ($this->trash_model->Add($additional_data)) {
                        if ($this->menu_model->delete($id)) {
                            $output['success']='success';
                            $this->session->set_flashdata('message',  array(
                                    'type' => 'success',
                                    'text' => 'Запись удалена'
                                )
                            );
                        } else {
                            $output['error']='error';
                        }
                    } else {
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