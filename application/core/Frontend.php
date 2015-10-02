<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');


class Frontend extends CI_Controller
{
	protected $data = array();
	

	public function __construct() {
		parent::__construct();
		
		$this->load->library('pagination');
		$this->load->model('startbootstrap/menu_model');
		$this->load->model('startbootstrap/counters_model');
		$this->load->model('startbootstrap/chunks_model');
		$this->load->helper('url');


		//$this->data['menu'] = $this->menu_model->getListTree(1);
		//$this->data['mainmenu'] = $this->menu_model->getListTree(2);
		
		$this->data['menu'] = $this->menu_model->getList(1,true);
		$this->data['mainmenu'] = $this->menu_model->getList(1,true);
		
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