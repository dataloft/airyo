<?php
class Menu_model extends CI_Model {

	private $parentslinks = array();

	public function __construct() {
		parent::__construct();
	}

	public function getList($type=false,$first_lvl=false) {
        $this->db->select('*');
        if (!empty($type))
            $this->db->where('menu_group',$type);
        if (!empty($first_lvl))
            $this->db->where('parent_id',0);
        //$this->db->order_by('order','asc');
        //$this->db->order_by('parent_id','asc');
        //$this->db->order_by('id','asc');
		$this->db->order_by('name','asc');

        $q =  $this->db->get($this->db->dbprefix('menu'));
        if ($q->num_rows() > 0)
        {
            foreach ( $q->result() as $row )
            {
                $result[] = $row;
            }
            return  $result;
        }
        return false;
	}

    public function getOrderList($menu_group) {
        $this->db->select('*');
           $this->db->where('menu_group',$menu_group);
        $this->db->order_by('parent_id','asc');
        $this->db->order_by('order','asc');
        $q =  $this->db->get($this->db->dbprefix('menu'));
        if ($q->num_rows() > 0)
        {
           return  $q->result();
        }
        return false;
    }

    public function updateOrderList($data) {
        if ($this->db->update($this->db->dbprefix('menu'), $data, array('id' => $data->id)))
            //$return = $this->db->affected_rows() == 1;
            return true;
        else
            return false;
    }

	public function getMenuGroup($id="") {
        $this->db->select('*');
        if (!empty($id))
            $this->db->where('id',$id);
        $q =  $this->db->get($this->db->dbprefix('menu_group'));
        return  $q->result_array();
    }

    public function getMaxOrder($parent_id) {
        $this->db->select('order');
        $this->db->where('parent_id',$parent_id);
        $this->db->order_by('order','desc');
        $this->db->limit(1);
        $q = $this->db->get($this->db->dbprefix('menu'));
        if ($q->num_rows() > 0)
        {
            $row = $q->row();
            return $row->order;
        }
        return false;
    }

    public function ckeckUniqueOrder($parent_id, $order, $id = false) {
        $this->db->select('id');
        $this->db->where('parent_id', $parent_id);
        $this->db->where('order', $order);
        $this->db->where('id !=', $id);
        $q = $this->db->get($this->db->dbprefix('menu'));
        if ($q->num_rows() > 0)
        {
            $row = $q->row();
            return $row->id;
        }
        return false;
    }

    public function getToId($id) {
        $q = $this->db;
        $this->sql = "
			SELECT * FROM ".$this->db->dbprefix('menu')." WHERE id = '".$id."'
		";
        $q = $q->query($this->sql);
        if ($q->num_rows() > 0)
            return $q->row();

        return false;
    }

    public function Add ($data)
    {
        $this->db->insert($this->db->dbprefix('menu'), $data);
        $return = $this->db->insert_id();
        return $return;
    }

    public function Update ($id, $data)
    {
       if ($this->db->update($this->db->dbprefix('menu'), $data, array('id' => $id)))
            return true;
        else
            return false;
    }

	public function get_all_langs() {
		
	}

    public function delete($id)
    {
        if ($this->db->delete($this->db->dbprefix('menu'), array('id' => $id)))
            //$return = $this->db->affected_rows() == 1;
            return true;
        else
            return false;
    }

    public function batchDelete($data)
    {
        $this->db->where_in('id',$data);//
        $this->db->delete($this->db->dbprefix('menu'));
        if ($this->db->affected_rows())
            //$return = $this->db->affected_rows() == 1;
            return true;
        else
            return false;
    }

	public function getListTree($type=1, $parent_id=0) {
        $this->db->select('*');
        if (!empty($type))
            $this->db->where('menu_group',$type);
        
        $this->db->where('parent_id',$parent_id);
		$this->db->where('enabled',1);
        //$this->db->order_by('order','asc');
        //$this->db->order_by('parent_id','asc');
        //$this->db->order_by('id','asc');
		$this->db->order_by('name','asc');

        $rows =  $this->db->get($this->db->dbprefix('menu'))->result_array();
		if(!count($rows)) return false;
		
		$ret = array();
		foreach($rows as $row){
			$row['childs'] = $this->getListTree($type, $row['id']);
			$ret[] = $row;
		}
		
		return $ret;
		
	}

	public function getSorterMenuGroups(){
		$rows =  $this->db->get($this->db->dbprefix('menu_group'))->result_array();
        $ret = array();
		foreach($rows as $row) $ret[$row['id']] = $row;
		return  $ret;
	}

	public function generatemenutree($menu){
		$returning = '';
		if(!is_array($menu) || !count($menu)) return $returning;
		$returning .= '<ul>';
		foreach ($menu as $item){
			$class='';
			if($this->uri->uri_string() == $item['url'] or current_url() == $item['url']) $class='class="active"';
			$returning .= '<li '.$class.'><a href="/'.$item['url'].'">'.$item['name'].'</a>';
			if(is_array($item['childs']) && count($item['childs'])) $returning .= $this->generatemenutree($item['childs']);
			$returning .= '</li>';
		}
		$returning .= '</ul>';
		return $returning;
	}

	public function getChildsLinksArray($id, $first=0){
		if($first) $this->parentslinks=array();
		$cur_links = $this->db->select('id, url')->where('parent_id', $id)->where('enabled', 1)->get($this->db->dbprefix('menu'))->result_array();
		if(is_array($cur_links) && count($cur_links)){
			foreach($cur_links as $item){
				if(!isset($this->parentslinks[$item['url']])){
					$this->parentslinks[$item['url']] = 1;
				}
				$this->getChildsLinksArray($item['id']);
			}
		}
		return $this->parentslinks;
	}

}

/* End of file page.php */
/* Location: ./system/application/models/page_model.php */