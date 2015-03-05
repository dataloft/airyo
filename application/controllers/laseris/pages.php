<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Frontend {

	public function __construct() {
		parent::__construct();
		$this->load->model('content_model');
		$this->load->model('menu_model');
        $this->load->helper('url');
	}

	public function index($page = '') {
		
        $page = $this->uri->uri_string();
		
		$this->oData['page'] = $this->content_model->getToAlias($page, true);
        
		if ($this->oData['page']) {
			
			$this->load->library('SmartCodes');
            $this->oData['page']['content'] = $this->smartcodes->parseString($this->oData['page']['content']);
            
			$this->oData['view'] = 'laseris/pages/'.$this->oData['page']['template'];
			
		}
		else {
			show_404();
		}
	}
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */