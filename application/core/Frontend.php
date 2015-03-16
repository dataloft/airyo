<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');


class Frontend extends CI_Controller
{
	protected $data = array();
	

	public function __construct() {
		parent::__construct();
		
		$this->load->model('laseris/menu_model');
		$this->load->model('laseris/counters_model');
		$this->load->helper('url');

		$this->data['menu'] = $this->menu_model->getListTree(1);
		$this->data['mainmenu'] = $this->menu_model->getListTree(2);
		
		
		if ($counters = $this->counters_model->getCounters(
				$this->input->ip_address(), $_SERVER['HTTP_HOST'])
			){
			$this->data['counters'] = $counters; 
		}
		else {
			$this->data['counters'] = '';
		}
			
		
	}


	/*public function _remap($method, $params = array()) {
		
		if ($counters = $this->counters_model->getCounters($this->input->ip_address(), $_SERVER['HTTP_HOST'])) $this->data['counters'] = $counters; else $this->data['counters'] = '';
			
		if (method_exists($this, $method)) {
		
			$result = call_user_func_array(array($this, $method), $params);
			
			//var_dump($this->data);
			
			$this->load->view($this->data['view'], $this->data);
			
			return $result;
		}
		
		show_404();
	}*/


}