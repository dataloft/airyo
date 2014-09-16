<?php

class CommonAdminController extends CI_Controller
{
	protected $header_file = 'admin/common/header';
	protected $body_file;
	protected $footer_file = 'admin/common/footer';
	protected $header_vars = array();
	protected $body_vars = array();
	protected $footer_vars = array();

	public function __construct($bLogin = true) {
		parent::__construct();

		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->helper('url');
		$this->load->helper('language');
		$this->lang->load('content');
		$this->iUserId = $this->ion_auth->get_user_id();

		if(!$this->ion_auth->logged_in() AND $bLogin) {
			redirect('admin', 'refresh');
		}
	}

	public function _remap($method, $params = array())
	{
		// you can set default variables to send to the template here
		$this->header_vars['title'] = 'My website';
		$this->body_file = strtolower(get_class($this)).'/'.$method;
		if (method_exists($this, $method))
		{
			$result = call_user_func_array(array($this, $method), $params);
			$this->load->view($this->header_file, $this->header_vars);
			$this->load->view($this->body_file, $this->body_vars);
			$this->load->view($this->footer_file, $this->footer_vars);
			return $result;
		}
		show_404();
	}
}