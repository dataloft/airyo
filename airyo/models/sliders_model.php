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
		$this->db->order_by("order","asc");
		$result=$this->db->get();
		return $result->result_array();
	}

	public function update($data) 
	{
		if (!empty($data))
		{
			if (!$this->db->update_batch($this->db->dbprefix('slide'), $data, 'id'))
			{
            	return true;
           	}
            
        }

        return false;
	}

	public function update_state($change)
    {
        if (!empty($change))
        {
            if ($this->db->query("
					UPDATE ".$this->db->dbprefix('slide')." SET `enabled` = NOT `enabled`
					WHERE id IN (".implode(',',$change).")
				"))
            {
                return true;
            }
        }

        return false;
    }

    public function sort_order($id, $order) {
		$this->db->update($this->db->dbprefix('slide'), array('order' => $order), array('id' => $id));
	}

	public function delete() {
		
	}
}