<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Frontend {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('content_model');
        $this->load->helper('url');
        $this->load->library('SmartCodes');
	}

	public function index() {
		
        $this->data['page'] = $this->content_model->getByAlias($this->uri->uri_string(), true);
        
		if ($this->data['page'])
		{
			$this->smartcodes->Parse($this->data['page']['content']);
            $this->data['page']['content'] = $this->smartcodes->data['output'];
            unset($this->smartcodes->data['output']);
            $this->data = array_merge($this->data, $this->smartcodes->data);
            
            $this->load->view('laseris/pages/'.$this->data['page']['template'], $this->data);
		}
		else {
			show_404();
		}
	}
}