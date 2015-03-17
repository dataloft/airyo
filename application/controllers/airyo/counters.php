<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Counters extends Airyo {

    public function __construct() {
        parent::__construct();
        $this->load->model('airyo/counters_model');
        $this->load->model('airyo/trash_model');
    }

    public function index() {
	    $this->data['main_menu'] = 'counters';

	    $this->data['menu'] = array();
	    $this->data['usermenu'] = array();

	    $this->data['type'] = '';
	    $this->data['search'] = '';
        $counters = new ArrayObject;
	    $this->data['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';
	    $this->data['counters'] = $this->counters_model->getCounters();

        if (empty($this->data['counters']))
            show_404();

        if ($this->input->post('save')) {
            $counters->text = $this->input->post('text');
            $counters->ip = $this->input->post('ip');
            $counters->domain = $this->input->post('domain');
            $counters->id = $this->data['counters']->id;
	        $this->data['counters'] = $counters;
            $additional_data = array(
                'text' => $counters->text,
                'ip' => $counters->ip,
                'domain' =>  $counters->domain
            );

            if ($this->counters_model->Update($counters->id, $additional_data)) {
	            $this->data['message'] = array(
                    'type' => 'success',
                    'text' => 'Запись обновлена'
                );
            } else {
                $counters->text = $this->input->post('text');
                $counters->ip = $this->input->post('ip');
                $counters->domain = $this->input->post('domain');
                $counters->id = $this->data['counters']->id;
	            $this->data['counters'] = $counters;
	            $this->data['message'] = array(
                    'type' => 'danger',
                    'text' => validation_errors()
                );
            }
        }
        
        $this->load->view('airyo/counters/counters', $this->data);
	    //$this->data['view'] = 'airyo/counters/counters';
    }
}

