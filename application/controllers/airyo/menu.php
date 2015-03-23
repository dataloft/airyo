<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends Airyo {


	protected $logging = true;


	public function __construct() {
		parent::__construct();
		$this->load->model('airyo/menu_model');
		$this->load->model('airyo/trash_model');
	}

	public function index($selected_menu=1) {
		
		$selected_menu = (int) $selected_menu;
		
		if(!$selected_menu) $selected_menu=1;
		
		$this->data['main_menu'] = 'menu';

		//$this->data['menu_group'] = '';
		$this->data['menu_list'] =  $this->menu_model->getMenuGroup();
		
		//$this->data['menu_group'] = $this->data['menu_list'][0]['id'];
		$this->data['menu_group'] = $selected_menu;

		if ($this->input->post('typeSelect')) {
			$this->data['menu_group'] = $this->input->post('typeSelect');
		}

		if ($list = $this->menu_model->getList($this->data['menu_group'])) {
			$this->data['content']  = $this->printTreeList($this->buildTree($list));
		} else {
			$this->data['content'] = '';
		}
		$this->data['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';
		
		
		$this->data['menu'] = $this->menu_model->getListTree($this->data['menu_group']);
		
		
		$this->load->view('airyo/menu/list', $this->data);
		//$this->data['view'] = 'airyo/menu/list';
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
                $echo.= '<a href="/airyo/menu/edit/'.$item->id . '"';
                if ($level>0)
                    $echo.='style="margin-left:'.($level*20).'px"';
                $echo.=  '>' . $item->name . '</a> <small class="text-muted">' . $item->url . '</small>';
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

    /**
     * Получаем id всех наследуемых пунктов
     * @param $items
     * @param int $current
     * @param int $level
     * @param int $id
     * @param $mem_lvl
     * @return string
     */
    function ChildList($items, $current=0, $level=0, $id=0, $mem_lvl = -1)
    {
        $arr ='';
        foreach ($items as $item)
        {
            if ($mem_lvl>=$level)
                $mem_lvl = -1;
            if ($id && $id == $item->id)
                $mem_lvl = $level;
            if (($id && $id == $item->id) or ($mem_lvl>-1 && $level>$mem_lvl))
                $arr.= $item->id.' ';
            if ($item->child !== false)
            {
                $level++;
                $arr.= $this->ChildList($item->child, $current, $level, $id, $mem_lvl);
                $level--;
            }
        }
        if(!empty($arr))
            return $arr;
    }

    public function add($mid=0) {
	    
		$this->data['main_menu'] = 'menu';
		
		$this->data['bc_menu'] = $this->menu_model->getSorterMenuGroups();
		if(!isset($this->data['bc_menu'][$mid])) redirect("/airyo/menu");

	    $this->data['id'] = '';
	    $this->data['message'] = '';

        $menu = new ArrayObject;
	    $this->data['title'] = "Добавить/редактировать пункт меню";

	    $this->data['menu_group'] = $mid;
        if ($list = $this->menu_model->getList($this->data['menu_group'])) {
	        $this->data['lvl_menu']  = $this->printSelectList($this->buildTree($list));
        } else {
	        $this->data['lvl_menu'] = '';
        }

        $this->form_validation->set_rules('name', '', 'required');
        $this->form_validation->set_rules('url', '', 'required');
        $menu->name = $this->input->post('name');
        $menu->url = $this->input->post('url');
        //$menu->order = $this->input->post('order',TRUE);
        $menu->menu_group = $this->input->post('menu_group');
		$menu->enabled = (int) $this->input->post('enabled');
		if($menu->enabled >1 ) $menu->enabled=1;
	    $this->data['menu'] = $menu;
       
        if ($this->form_validation->run() == true) {
			
			
			/*if ($check = $this->menu_model->ckeckUniqueOrder($this->input->post('level_menu',TRUE), $this->input->post('order',TRUE))) {
                $check_order = $this->menu_model->getMaxOrder($this->input->post('level_menu',TRUE))+1;
                $this->menu_model->Update($check, array('order' => $check_order));
                $menu->order = $this->input->post('order',TRUE);
            } else {
                $menu->order = $this->input->post('order',TRUE);
            }*/
            
            $order = $this->menu_model->getMaxOrder($this->input->post('level_menu'), $this->data['menu_group']) + 1;
            //echo $order; exit;
            
            
            $additional_data = array(
                'name' => $menu->name,
                'url' => $menu->url,
                'menu_group' =>  $mid,
                'parent_id' =>  $this->input->post('level_menu'),
                'order' =>  $order,
				'enabled' => $menu->enabled
            );
            if ($id = $this->menu_model->Add($additional_data)) {
                $this->session->set_flashdata('message',  array(
                        'type' => 'success',
                        'text' => 'Пункт меню создан'
                    )
                );
                redirect("airyo/menu/edit/$id", 'refresh');
            } else {
	            $this->data['message'] = array(
                    'type' => 'danger',
                    'text' => 'Произошла ошибка при сохранении записи.'
                );
            }
        }
        elseif ($this->input->post('action') == 'add') {
	        $this->data['message'] = array(
                'type' => 'danger',
                'text' =>  validation_errors()
            );
        }
        
        $this->load->view('airyo/menu/edit', $this->data);
	    //$this->data['view'] = 'airyo/menu/edit';
    }


    public function edit($id = '') {
	    $this->data['main_menu'] = 'menu';

	    $this->data['id'] = '';
	    $this->data['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';

        $menu = new stdClass();
	    //$this->data['title'] = "Добавить/редактировать пункт меню";

        $this->form_validation->set_rules('name', '', 'required');
        $this->form_validation->set_rules('url', '', 'required');
        
        // Если передан Ид ищем содержание стр в БД
        if (!empty($id)) {
	        
			$this->data['menu'] = $this->menu_model->getToId($id);
			
			//if(!$this->data['menu']) redirect("airyo/menu/add", 'refresh');
			
			$this->data['bc_menu'] = $this->menu_model->getSorterMenuGroups();
			$this->data['menu_group'] = $this->data['menu']->menu_group;
			

            //if (empty($this->data['menu']))
            //    show_404();
                
	        $this->data['id'] = $id;
            $old_parent_id = $this->data['menu']->parent_id;
            
            
            if ($this->input->post('level_menu',TRUE))
                $menu->level_menu = $this->input->post('level_menu',TRUE);
            else
                $menu->level_menu = $this->data['menu']->parent_id;
            if ($list = $this->menu_model->getList($this->data['menu']->menu_group)) {
	            $this->data['lvl_menu']  = $this->printSelectList($this->buildTree($list),$menu->level_menu, 0, $id);
            } else {
	            $this->data['lvl_menu'] = '';
            }
            
            
            if ($this->form_validation->run() == true) {

                $menu->name = $this->input->post('name',TRUE);
                $menu->url = $this->input->post('url',TRUE);
                
                //Если сменился родитель добавляем пункт к новому родитель в конец списка
                /*if ($old_parent_id != $this->input->post('level_menu',TRUE))
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
                }*/

                $menu->menu_group = $this->data['menu']->menu_group;

	            $this->data['menu'] = $menu;
                
                $additional_data = array(
                    'name' => $menu->name,
                    'url' => $menu->url,
                    //'order' => $menu->order,
                    'menu_group' =>   $this->data['menu']->menu_group,
                    'parent_id' =>   $this->input->post('level_menu',TRUE),
					'enabled' => (int) $this->input->post('enabled')
                );
				
                if ($this->menu_model->Update($this->data['id'], $additional_data))
                {
                    //$this->reOrder($this->data['menu']->menu_group);
	                $this->data['message'] = array(
                        'type' => 'success',
                        'text' => 'Запись обновлена'
                    );
					$this->data['menu'] = $this->menu_model->getToId($id);
                }
                else {
	                $this->data['message'] = array(
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
				$menu->enabled = (int) $this->input->post('enabled');
				var_dump($menu->enabled);

	            $this->data['menu'] = $menu;
	            $this->data['message'] = array(
                    'type' => 'danger',
                    'text' => validation_errors()
                );

            }
        } else { //Вставляем новую запись
            //redirect("airyo/menu/add", 'refresh');
        }
        
        $this->load->view('airyo/menu/edit', $this->data);
	    //$this->data['view'] = 'airyo/menu/edit';
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
                    $list = $this->menu_model->getList($data['menu']->menu_group);
                    $arr = explode(' ',trim($this->ChildList($this->buildTree($list),$id, 0, $id)));
                    foreach($arr as $item)
                        $additional_data[] = array(
                            'deleted_id' => $item,
                            'type' =>  'menu',
                            'data' =>     serialize($this->menu_model->getToId($item))
                        );
                    if ($this->trash_model->batchAdd($additional_data)) {
                        if ($this->menu_model->batchDelete($arr)) {
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
    
    
    public function ajax_rebuild($menu_group) {
		
		//var_dump($this->input->post('list')); exit;
		
		$this->menu_model->update_branch($this->input->post('list'), 0);
		
		$this->session->set_flashdata('message',  array( //Надо сделать реальные проверки
                'type' => 'success',
                'text' => 'Меню успешно обновлено'
            )
        );
	}
   
    
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */