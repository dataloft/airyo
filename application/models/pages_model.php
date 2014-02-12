<?php
class Pages_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_list() {
		
	}

	public function get($page) {
		$q = $this->db;
		$this->sql = "
			SELECT * FROM pages WHERE alias = '".$page."'
		";
		$q = $q->query($this->sql);
		return $q->row();
	}

	public function get_all_langs() {
		
	}

	public function delete() {
		
	}

}

/* End of file page.php */
/* Location: ./system/application/models/page_model.php */