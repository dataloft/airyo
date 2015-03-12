<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Counters extends Airyo {

    public function __construct() {
        parent::__construct();
        $this->load->model('counters_model');
        $this->load->model('trash_model');
    }

    public function index() {
	    $this->oData['main_menu'] = 'counters';

	    $this->oData['menu'] = array();
	    $this->oData['usermenu'] = array();

	    $this->oData['type'] = '';
	    $this->oData['search'] = '';
        $counters = new ArrayObject;
	    $this->oData['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';
	    $this->oData['counters'] = $this->counters_model->getCounters();

        if (empty($this->oData['counters']))
            show_404();

        if ($this->input->post('save')) {
            $counters->text = $this->input->post('text');
            $counters->ip = $this->input->post('ip');
            $counters->domain = $this->input->post('domain');
            $counters->id = $this->oData['counters']->id;
	        $this->oData['counters'] = $counters;
            $additional_data = array(
                'text' => $counters->text,
                'ip' => $counters->ip,
                'domain' =>  $counters->domain
            );

            if ($this->counters_model->Update($counters->id, $additional_data)) {
	            $this->oData['message'] = array(
                    'type' => 'success',
                    'text' => 'Запись обновлена'
                );
            } else {
                $counters->text = $this->input->post('text');
                $counters->ip = $this->input->post('ip');
                $counters->domain = $this->input->post('domain');
                $counters->id = $this->oData['counters']->id;
	            $this->oData['counters'] = $counters;
	            $this->oData['message'] = array(
                    'type' => 'danger',
                    'text' => validation_errors()
                );
            }
        }

	    $this->oData['view'] = 'airyo/counters/counters';
    }
}

