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
		$this->db->select('*');
		$this->db->from('slide');
		$this->db->where('sliders_id', $id);
		$this->db->where('enabled', 1);
		$this->db->order_by("order","asc");
		$result=$this->db->get();
		return $result->result_array();
	}

}