<?php

class Sliders extends Airyo 
{

    public function __construct() 
    {
        parent::__construct();

        $this->load->model('airyo/sliders_model');
        $this->data['main_menu'] = 'sliders';
    }

	public function index() 
	{
		$this->data['sliders'] = $this->sliders_model->get_list();
		$this->load->view('airyo/sliders/list', $this->data);
	}

	public function edit($id = false) {
		
		
		$this->load->view('airyo/sliders/edit', $this->data);
	}

	public function delete() {
		
	}

}