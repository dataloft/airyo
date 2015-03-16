<?php
class Template_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function getList() {
        $this->db->select('*');
        $q =  $this->db->get($this->db->dbprefix('templates'));
        return  $q->result_array();
	}

    public function getTemplatesConfig($id) {
        $this->db->select('*');
        $this->db->where('tmpl_id',$id);
        $q =  $this->db->get($this->db->dbprefix('templates_config'));
        return  $q->result_array();
    }

}

/* End of file page.php */
/* Location: ./system/application/models/page_model.php */