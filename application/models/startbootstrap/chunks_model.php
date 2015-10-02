<?php
class Chunks_model extends CI_Model {


	public function __construct() {
		parent::__construct();
	}


	public function get()
	{
        $this->db->select('*');
        
        $q = $this->db->get($this->db->dbprefix('chunks'));
        
        $list = $q->result_array();
        
        $chunks = array();
        
        foreach ($list as $chunk)
        {
	        $chunks[$chunk['alias']] = $chunk['content'];
        }
        
        return $chunks;
	}


}