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

	public function get_by_id() {

	}

	public function edit() {

	}

	public function delete() {

	}
}