<?php
class Pages_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function getList($type=false, $search=false) {
        $this->db->select('*');
        if (!empty($type))
            $this->db->where('type',$type);
        if (!empty($search))
        {
            $this->db->like('h1',$search);
            $this->db->or_like('alias',$search);
            $this->db->or_like('title',$search);
            $this->db->or_like('content',$search);
            $this->db->or_like('meta_description',$search);
            $this->db->or_like('meta_keywords',$search);

        }

        $q =  $this->db->get($this->db->dbprefix('pages'));
        return  $q->result_array();
	}

	public function getType() {
		$q = $this->db;
		$this->sql = "SELECT * FROM ".$this->db->dbprefix('type_content');
		$q = $q->query($this->sql);
		return $q->result();
	}

    public function next_id(){
        $sql = "SELECT `AUTO_INCREMENT` inc FROM `information_schema`.`TABLES` WHERE (`TABLE_NAME`='".$this->db->dbprefix('pages')."')";
        return $this->db->query($sql)->row()->inc;
    }

    public function get($page) {
		$q = $this->db;
		$this->sql = "
			SELECT * FROM ".$this->db->dbprefix('pages')." WHERE alias = '".$page."' and enabled = 1
		";
		$q = $q->query($this->sql);
		return $q->row();
	}

    public function getToId($id) {
        $q = $this->db;
        $this->sql = "
			SELECT * FROM ".$this->db->dbprefix('pages')." WHERE id = '".$id."'
		";
        $q = $q->query($this->sql);
        if ($q->num_rows() > 0)
            return $q->row_array();

        return false;
    }

    public function getByAlias($alias, $array = false) {
        $q = $this->db;
        $this->sql = "
			SELECT * FROM ".$this->db->dbprefix('pages')." WHERE alias = '".$alias."' && enabled = '1'
		";
        $q = $q->query($this->sql);
        if ($q->num_rows() > 0)
            if (!$array)
                return $q->row();
            else
                return $q->row_array();

        return false;
    }

}

/* End of file page.php */
/* Location: ./system/application/models/page_model.php */