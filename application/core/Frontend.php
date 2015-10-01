<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');


class Frontend extends CI_Controller
{
	protected $data = array();
	

	public function __construct() {
		parent::__construct();
		
		$this->load->library('pagination');
		$this->load->model('laseris/menu_model');
		$this->load->model('laseris/counters_model');
		$this->load->model('laseris/chunks_model');
		$this->load->helper('url');


		$this->data['menu'] = $this->menu_model->getListTree(1);
		$this->data['mainmenu'] = $this->menu_model->getListTree(2);
		$this->data['chunks'] = $this->chunks_model->get();
		
		
		if ($counters = $this->counters_model->getCounters(
				$this->input->ip_address(), $_SERVER['HTTP_HOST'])
			){
			$this->data['counters'] = $counters; 
		}
		else {
			$this->data['counters'] = '';
		}
			
		
	}
	

}