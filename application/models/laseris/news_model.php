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
        $this->db->where('enabled', 1);
        $this->db->order_by("date_unformated", "DESC");
        
        $q =  $this->db->get($this->db->dbprefix('news'));
        
        return  $q->result_array();
	}

	
    public function count() {
        $this->db->where('enabled', 1);
        $this->db->from($this->db->dbprefix('news'));
        
        return $this->db->count_all_results();
	}
    
    
    public function get_by_alias($alias)
    {
        $this->db->select('*');
		$this->db->where('alias', $alias);
		$this->db->where('enabled', 1);
        
        $q =  $this->db->get($this->db->dbprefix('news'));
        
        return  $q->row_array();
    }


}

/* End of file page.php */
/* Location: ./system/application/models/page_model.php */