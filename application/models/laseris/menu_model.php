<?php
class Menu_model extends CI_Model {

	private $parentslinks = array();

	public function __construct() {
		parent::__construct();
	}

	public function getListTree($type=1, $parent_id=0) {
        $this->db->select('*');
        if (!empty($type))
            $this->db->where('menu_group',$type);
        
        $this->db->where('parent_id',$parent_id);
		$this->db->where('enabled',1);
        $this->db->order_by('order','asc');

        $rows =  $this->db->get($this->db->dbprefix('menu'))->result_array();
		if(!count($rows)) return false;
		
		$ret = array();
		foreach($rows as $row){
			$row['childs'] = $this->getListTree($type, $row['id']);
			$ret[] = $row;
		}
		
		return $ret;
		
	}


}

/* End of file page.php */
/* Location: ./system/application/models/page_model.php */