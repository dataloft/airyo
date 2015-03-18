<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Frontend {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('laseris/pages_model');
        $this->load->helper('url');
        $this->load->library('Smart_codes');
	}

	public function index() {
		
        $this->data['page'] = $this->pages_model->getByAlias($this->uri->uri_string(), true);
        
		if ($this->data['page'])
		{
			$this->data['page']['content'] = $this->smart_codes->Parse($this->data['page']['content']);
            
            $this->load->view('laseris/pages/'.$this->data['page']['template'], $this->data);
		}
		else {
			show_404();
		}
	}
}