<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');


class Frontend extends CI_Controller
{
	protected $oData = array();


	public function __construct() {
		parent::__construct();
		
		$this->load->model('menu_model');
		$this->load->model('counters_model');
		$this->load->helper('url');

		$this->oData['menu'] = $this->menu_model->getListTree(1);
		$this->oData['mainmenu'] = $this->menu_model->getListTree(2);
	}


	public function _remap($method, $params = array()) {
		
		if ($counters = $this->counters_model->getCounters($this->input->ip_address(), $_SERVER['HTTP_HOST'])) $this->oData['counters'] = $counters; else $this->oData['counters'] = '';
			
		if(method_exists($this, $method)) {
		
			$result = call_user_func_array(array($this, $method), $params);
			
			//$this->load->view('laseris/common/header', $this->oData);
			$this->load->view($this->oData['view'], $this->oData);
			//$this->load->view('laseris/common/footer', $this->oData);
			
			return $result;
		}
		show_404();
	}


}