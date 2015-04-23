<?php
class Chunks_model extends CI_Model {


	public function __construct() {
		parent::__construct();
	}


	public function get_list($limit, $start)
	{
        $this->db->limit($limit, $start);
        $this->db->select('*');
        $this->db->order_by("id", "DESC");
        
        $q = $this->db->get($this->db->dbprefix('chunks'));
        
        return $q->result_array();
	}

	
    public function count()
    {
        $this->db->from($this->db->dbprefix('chunks'));
        
        return $this->db->count_all_results();
	}


    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        
        $q = $this->db->get($this->db->dbprefix('chunks'));
		
        return $q->row_array();
    }
    
    
    public function get_by_alias($alias)
    {
       	$this->db->select('*');
        $this->db->where('alias', $alias);
        
        $q = $this->db->get($this->db->dbprefix('chunks'));
        
        return  $q->result_array();
    }


    public function add($data)
    {
        $this->db->insert($this->db->dbprefix('chunks'), $data);
        $return = $this->db->insert_id();

        return $return;
    }
    

    public function update($data)
    {
       if ($this->db->update($this->db->dbprefix('chunks'), $data, array('id' => $data['id'])))
            return true;
       else
            return false;
    }


	public function delete($id)
    {
        if ($this->db->delete($this->db->dbprefix('chunks'), array('id' => $id)))
            return true;
        else
            return false;
	}

}

/* End of file page.php */
/* Location: ./system/application/models/page_model.php */