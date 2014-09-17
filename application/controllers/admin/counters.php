<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Counters extends CommonAdminController {

    public function __construct() {
        parent::__construct();
        $this->load->model('counters_model');
        $this->load->model('trash_model');
    }

    public function index() {
	    $aParams = parent::index();
	    $aParams['header']['main_menu'] = 'admin';

	    $aParams['header']['main_menu'][0] = 'modules';
	    $aParams['header']['main_menu'][1] = 'counters';
	    $aParams['header']['menu'] = array();
	    $aParams['header']['usermenu'] = array();

	    $aParams['body']['type'] = '';
	    $aParams['body']['search'] = '';
        $counters = new ArrayObject;
	    $aParams['body']['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';
	    $aParams['body']['counters'] = $this->counters_model->getCounters();

        if (empty($aParams['body']['counters']))
            show_404();

        if ($this->input->post('save')) {
            $counters->text = $this->input->post('text');
            $counters->ip = $this->input->post('ip');
            $counters->domain = $this->input->post('domain');
            $counters->id = $aParams['body']['counters']->id;
	        $aParams['body']['counters'] = $counters;
            $additional_data = array(
                'text' => $counters->text,
                'ip' => $counters->ip,
                'domain' =>  $counters->domain
            );

            if ($this->counters_model->Update($counters->id, $additional_data)) {
	            $aParams['body']['message'] = array(
                    'type' => 'success',
                    'text' => 'Запись обновлена'
                );
            } else {
                $counters->text = $this->input->post('text');
                $counters->ip = $this->input->post('ip');
                $counters->domain = $this->input->post('domain');
                $counters->id = $aParams['body']['counters']->id;
	            $aParams['body']['counters'] = $counters;
	            $aParams['body']['message'] = array(
                    'type' => 'danger',
                    'text' => validation_errors()
                );
            }
        }

	    $this->header_vars = $aParams['header'];
	    $this->body_vars = $aParams['body'];
	    $this->body_file = 'admin/counters/counters';
    }
}

/* End of file counters.php */
/* Location: ./application/controllers/admin/counters.php */