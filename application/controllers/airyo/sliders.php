<?php

class Sliders extends Airyo 
{

    public function __construct() 
    {
        parent::__construct();

        $this->load->model('airyo/sliders_model');
        $this->data['main_menu'] = 'sliders';
    }

	public function index($page = '') 
	{
		$this->data['sliders'] = $this->sliders_model->get_list();
		$this->load->view('airyo/sliders/list', $this->data);
	}

	public function one_slide($page = '') 
	{
		$this->load->view('airyo/sliders/slide', $this->data);
	}

	public function edit() {

	}

	public function delete() {

	}

}