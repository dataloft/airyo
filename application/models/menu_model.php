<?php
class Menu_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function getList($type=false) {
        $this->db->select('*');
        if (!empty($type))
            $this->db->where('menu_group',$type);
        $q =  $this->db->get('menu');
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

	public function get($page) {
		$q = $this->db;
		$this->sql = "
			SELECT * FROM pages WHERE alias = '".$page."' and enabled = 1
		";
		$q = $q->query($this->sql);
		return $q->row();
	}

    public function getMenuGroup($id="") {
        $this->db->select('*');
        if (!empty($id))
            $this->db->where('id',$id);
        $q =  $this->db->get('menu_group');
        return  $q->result_array();
    }

    public function getToId($id) {
        $q = $this->db;
        $this->sql = "
			SELECT * FROM menu WHERE id = '".$id."'
		";
        $q = $q->query($this->sql);
        if ($q->num_rows() > 0)
            return $q->row();

        return false;
    }

    public function getToAlias($alias) {
        $q = $this->db;
        $this->sql = "
			SELECT * FROM pages WHERE alias = '".$alias."'
		";
        $q = $q->query($this->sql);
        if ($q->num_rows() > 0)
            return $q->row();

        return false;
    }

    public function Add ($data)
    {
        $this->db->insert('menu', $data);
        $return = $this->db->insert_id();

        return $return;
    }

    public function Update ($id, $data)
    {
       if ($this->db->update('menu', $data, array('id' => $id)))
        //$return = $this->db->affected_rows() == 1;
            return true;
        else
            return false;
    }

	public function get_all_langs() {
		
	}

	public function delete() {
		
	}

}

/* End of file page.php */
/* Location: ./system/application/models/page_model.php */