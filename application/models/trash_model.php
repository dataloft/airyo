<?php
class Trash_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

    public function Add ($data)
    {
        $this->db->insert($this->db->dbprefix('trash'), $data);
        $return = $this->db->insert_id();

        return $return;
    }

    public function batchAdd ($data)
    {
        $this->db->insert_batch($this->db->dbprefix('trash'), $data);
        if ($this->db->affected_rows())
            return true;
        else
            return false;
    }
}

/* End of file page.php */
/* Location: ./system/application/models/page_model.php */