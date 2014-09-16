<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Counters extends CommonAdminController {

    public function __construct() {
        parent::__construct();
        $this->load->model('counters_model');
        $this->load->model('trash_model');
    }

    public function index() {
	    $header_data['main_menu'][0] = 'modules';
	    $header_data['main_menu'][1] = 'counters';
	    $header_data['menu'] = array();
	    $header_data['usermenu'] = array();

	    $body_data['type'] = '';
	    $body_data['search'] = '';
        $counters = new ArrayObject;
	    $body_data['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';
	    $body_data['counters'] = $this->counters_model->getCounters();

        if (empty($body_data['counters']))
            show_404();

        if ($this->input->post('save'))
        {
            $counters->text = $this->input->post('text');
            $counters->ip = $this->input->post('ip');
            $counters->domain = $this->input->post('domain');
            $counters->id = $body_data['counters']->id;
	        $body_data['counters'] = $counters;
            $additional_data = array(
                'text' => $counters->text,
                'ip' => $counters->ip,
                'domain' =>  $counters->domain
            );

            if ($this->counters_model->Update($counters->id, $additional_data)) {
	            $body_data['message'] = array(
                    'type' => 'success',
                    'text' => 'Запись обновлена'
                );
            } else {
                $counters->text = $this->input->post('text');
                $counters->ip = $this->input->post('ip');
                $counters->domain = $this->input->post('domain');
                $counters->id = $body_data['counters']->id;
	            $body_data['counters'] = $counters;
	            $body_data['message'] = array(
                    'type' => 'danger',
                    'text' => validation_errors()
                );
            }
        }

	    $this->header_vars = $header_data;
	    $this->body_vars = $body_data;
	    $this->body_file = 'admin/counters/counters';

    }
}

/* End of file counters.php */
/* Location: ./application/controllers/admin/counters.php */