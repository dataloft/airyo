<?php

class Sliders_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_list() {
		$this->db->select('*');
		$result = $this->db->get($this->db->dbprefix('sliders'));
		return $result->result_array();
	}

	public function get_by_id($id) {
		$result = $this->db->query("SELECT * FROM ".$this->db->dbprefix('slide')." 
			WHERE sliders_id = '".$id."'
		");
		
        return $result->result_array();
	}

	public function update() {

	}

	public function delete() {
		
	}
}