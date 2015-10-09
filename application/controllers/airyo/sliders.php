<?php

class Sliders extends Airyo {

	protected $default;


    public function __construct() {
        parent::__construct();
        
        $this->load->model('airyo/pages_model');
        $this->load->model('airyo/trash_model');
        $this->config->load('templates');
        
        $this->lang->load('airyo_pages', 'russian');
        
        $this->default = $this->config->item('default_template');
        
        $this->data['main_menu'] = 'pages';
    }

	public function index($page = '')
	{
		$this->load->view('airyo/sliders/list', $this->data);
	}

	public function sliderNum($page = '') 
	{
		$this->load->view('airyo/sliders/slide', $this->data);
	}
}