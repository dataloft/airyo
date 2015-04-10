<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Airyo extends CI_Controller
{
	protected $data = array();
	protected $user;
	protected $notice = false;


	public function __construct() {
		parent::__construct();

		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->helper('url');
		$this->load->helper('language');
		$this->lang->load('content');
		$this->load->model('airyo/modules_model');
		$this->load->model('airyo/users_model');
		$this->load->model('airyo/logs_model');
		
		$this->lang->load('airyo', 'russian');

		$this->user = $this->users_model->getUserById($this->ion_auth->get_user_id());
		
		$this->data['main_menu'] = '';
		$this->data['menu'] = array();
		$this->data['usermenu'] = array();

		$this->data['message'] = '';
		$this->data['show_breadcrumbs'] = true;
		$this->data['user_data'] = $this->user;
		$this->data['headermenu_modules'] = new stdClass();

		if ($this->user) {
			switch($this->user->role_id) {
				case 1:
					$this->data['headermenu_modules'] = $this->modules_model->getUserModules(array('iUserId' => $this->ion_auth->get_user_id()));
					break;
				case 2:
					$this->data['headermenu_modules'] = $this->modules_model->getModules();
					break;
			}
			if($this->user->role_id != 2) {
				$aUrl = $this->uri->segments;
				if(sizeof($aUrl) > 1) {
					if($this->modules_model->getModuleByName($aUrl[2])) {
						$aModulesList = $this->modules_model->getUserModules(array('iUserId' => $this->user->id));

						$aUserModules = array();
						foreach ($aModulesList as $aModule) {
							$aUserModules[] = $aModule->alias;
						}

						if(!empty($aUserModules)) {
							if (!in_array($aUrl[2], $aUserModules)) {
								if ($aUrl[2] == 'users' AND isset($aUrl[4]) AND $aUrl[4] == $this->user->id) {
									$this->data['show_breadcrumbs'] = false;
								} else {
									die('sd');
									$sRandomModule = array_shift($aUserModules);
									redirect('airyo/'.$sRandomModule, 'refresh');
								}
							}
						} else {
							$this->ion_auth->logout($this->lang->line('login_unsuccessful'));
						}
					}
				}
			}
		}
		
		if(!$this->ion_auth->logged_in() && $this->config->item('auth') != $this->uri->uri_string()) {
			show_404();
		}
		
	}


	public function updateLogs()
	{	
		$this->logs_model->updateLogs(array(
			'user_id'       => $this->ion_auth->get_user_id(),
			'type'          => 'redirect',
			'description'   => $this->uri->uri_string
		));
	}
	
	
	public function notice_push($notice, $type = '')
	{	
		$this->session->set_flashdata('notice', 
			array(
                'type' => $type,
                'text' => $notice
            )
        );
        
        $this->notice = 
        	array(
                'type' => $type,
                'text' => $notice
            );
	}
	
	public function notice_pull()
	{	
		$notice = $this->notice ? $this->notice : $this->session->flashdata('notice');
		$this->session->set_flashdata('notice', false);
		return $notice;
	}


}