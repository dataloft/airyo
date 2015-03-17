<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class CommonAdminController
 *
 * @author N.Kulchinskiy
 */
class Airyo extends CI_Controller
{
	protected $data = array();
	protected $user;


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

		if($this->user) {
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
		
		$this->updateLogs();
	}

	/**
	 * Обновление журнала посещения
	 *
	 * @author N.Kulchinskiy
	 */
	private function updateLogs(){
		$aNotUpdate = array(
			'admin', 'airyo/logout'
		);

		if(!in_array($this->uri->uri_string, $aNotUpdate)) {
			$this->logs_model->updateLogs(array(
				'user_id'       => $this->ion_auth->get_user_id(),
				'type'          => 'redirect',
				'description'   => $this->uri->uri_string
			));
		}
	}

	/**
	 * Получение конфигурации для пагинации
	 *
	 * @return array
	 *
	 * @author N.Kulchinskiy
	 */
	/*protected function getPaginationConfig(){
		$config = array(
			'full_tag_open'     => '<ul class="pagination pagination-sm">',
			'full_tag_close'    => '</ul>',
			'first_link'        => '&laquo;',
			'first_tag_open'    => '<li>',
			'first_tag_close'   => '</li>',
			'last_link'         => '&raquo;',
			'last_tag_open'     => '<li>',
			'last_tag_close'    => '</li>',
			'next_link'         => '&raquo',
			'next_tag_open'     => '<li>',
			'next_tag_close'    => '</li>',
			'prev_link'         => '&laquo',
			'prev_tag_open'     => '<li>',
			'prev_tag_close'    => '</li>',
			'cur_tag_open'      => '<li class="active"><span>',
			'cur_tag_close'     => '<span class="sr-only">(current)</span></span></li>',
			'num_tag_open'      => '<li>',
			'num_tag_close'     => '</li>',
			'base_url'          => '',
			'total_rows'        => '',
			'uri_segment'       => 3,
			'per_page'          => 20
		);

		return $config;
	}*/
}