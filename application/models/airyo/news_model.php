<?php
class News_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function getList($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->select('*');
        $this->db->select('date AS date_unformated');
        $this->db->select('DATE_FORMAT(date, ("%d.%m.%Y")) AS date');
        $this->db->order_by("date_unformated", "DESC");
        $q =  $this->db->get($this->db->dbprefix('news'));
        
        return  $q->result_array();
	}

    public function getLastNews($limit = 3) {
        $this->db->select('*');
        $this->db->where('enabled',1);
        $this->db->order_by("add_date", "DESC");
        $this->db->limit($limit);
        $q =  $this->db->get($this->db->dbprefix('news'));
        return  $q->result_array();
	}
	
    public function count() {
        //$this->db->where('enabled',1);
        $this->db->from($this->db->dbprefix('news'));
        return $this->db->count_all_results();
	}
	
    public function getNewsList($limit = false, $offset = false) {
        $this->db->select('*');
        $this->db->where('enabled',1);
        $this->db->order_by("add_date", "DESC");
        //$this->db->offset($offset);
        //$this->db->limit($limit);
        $this->db->limit($offset, $limit);
         $q =  $this->db->get($this->db->dbprefix('news'));
        return  $q->result_array();
	}



	public function getType() {
		$q = $this->db;
		$this->sql = "SELECT * FROM ".$this->db->dbprefix('type_news');
		$q = $q->query($this->sql);
		return $q->result();
	}

    public function next_id(){
        $sql = "SELECT `AUTO_INCREMENT` inc FROM `information_schema`.`TABLES` WHERE (`TABLE_NAME`='".$this->db->dbprefix('news')."')";
        return $this->db->query($sql)->row()->inc;
    }

    public function get($page) {
		$q = $this->db;
		$this->sql = "
			SELECT * FROM ".$this->db->dbprefix('news')." WHERE alias = '".$page."' and enabled = 1
		";
		$q = $q->query($this->sql);
		return $q->row();
	}


    public function get_by_id($id)
    {
        $q = $this->db->query("
			SELECT *, DATE_FORMAT(date, ('%d.%m.%Y')) AS date
			FROM ".$this->db->dbprefix('news')." WHERE id = '".$id."'
		");
		
        return $q->row_array();
    }


    public function getToAlias($alias, $array = false) {
        $q = $this->db;
        $this->sql = "
			SELECT * FROM ".$this->db->dbprefix('news')." WHERE alias = '".$alias."'
		";
        $q = $q->query($this->sql);
        if ($q->num_rows() > 0)
            if (!$array)
                return $q->row();
            else
                return $q->row_array();

        return false;
    }

    public function add ($data)
    {
        if (isset($data['date'])) $data['date'] = date("Y-m-d", strtotime($data['date']));
        
        $this->db->insert($this->db->dbprefix('news'), $data);
        $return = $this->db->insert_id();

        return $return;
    }
    

    public function update($data)
    {
       if (isset($data['date'])) $data['date'] = date("Y-m-d", strtotime($data['date']));
       
       if ($this->db->update($this->db->dbprefix('news'), $data, array('id' => $data['id'])))
            return true;
       else
            return false;
    }


	public function get_all_langs() {
		
	}

	public function delete($id)
    {
        if ($this->db->delete($this->db->dbprefix('news'), array('id' => $id)))
            //$return = $this->db->affected_rows() == 1;
            return true;
        else
            return false;
	}

}

/* End of file page.php */
/* Location: ./system/application/models/page_model.php */