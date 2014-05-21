<?php
class Counters_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

    public function getCounters($ip=false, $domian = false)
    {
        $this->db->select('*');
        if (!empty($ip))
            $this->db->not_like('ip', $ip);

        if (!empty($domian))
        {
            list($x1,$x2) = explode('.',strrev($domian));
            $xdomain = $x1.'.'.$x2;
            $xdomain = strrev($xdomain);
            $this->db->where("(domian LIKE ('%".$domian."%') or domian LIKE ('%*.".$xdomain."%'))");
        }

        $this->db->order_by('id','desc');
        $q =  $this->db->get('counters');
        if ($q->num_rows() > 0)
            return $q->row();
        else
            return false;
    }

    public function Update ($id, $data)
    {
        if ($this->db->update('counters', $data, array('id' => $id)))
            //$return = $this->db->affected_rows() == 1;
            return true;
        else
            return false;
    }
}

/* End of file page.php */
/* Location: ./system/application/models/page_model.php */