<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Frontend {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('content_model');
        $this->load->helper('url');
        $this->load->library('SmartCodes');
	}

	public function index() {
		
        $this->data['page'] = $this->content_model->getToAlias($this->uri->uri_string(), true);
        
		if ($this->data['page']) {
			
			//$data['smart'] = $this->smartcodes->parseString($this->oData['page']['content']);
			
			//$this->smartcodes->Parse($this->oData['page']['content']);
			
			
            //$this->data['page']['content'] = $this->smartcodes->Parse($this->data['page']['content']);
            
            $this->smartcodes->Parse($this->data['page']['content']);
            $this->data['page']['content'] = $this->smartcodes->data['output'];
            unset($this->smartcodes->data['output']);
            $this->data = array_merge($this->data, $this->smartcodes->data);
            
            //var_dump($this->data);
            
            $this->load->view('laseris/pages/'.$this->data['page']['template'], $this->data);
            
			//$this->data['view'] = 'laseris/pages/'.$this->data['page']['template'];
			
		}
		else {
			show_404();
		}
	}
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */