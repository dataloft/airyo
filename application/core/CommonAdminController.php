<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class CommonAdminController
 *
 * @author N.Kulchinskiy
 */
class CommonAdminController extends CI_Controller
{
	protected $oData = array();
	/** @var object */
	protected $oUser;

	public function __construct($bLogin = true) {
		parent::__construct();

		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->helper('url');
		$this->load->helper('language');
		$this->lang->load('content');
		$this->load->model('modules_model');
		$this->load->model('users_model');
		$this->load->model('logs_model');

		$this->oUser = $this->users_model->getUserById($this->ion_auth->get_user_id());
		$this->oData['main_menu'] = '';
		$this->oData['menu'] = array();
		$this->oData['usermenu'] = array();

		$this->oData['message'] = '';
		$this->oData['user_data'] = $this->oUser;
		$this->oData['headermenu_modules'] = new stdClass();

		if($this->oUser) {
			switch($this->oUser->role_id) {
				case 1:
					$this->oData['headermenu_modules'] = $this->modules_model->getUserModules(array('iUserId' => $this->ion_auth->get_user_id()));
					break;
				case 2:
					$this->oData['headermenu_modules'] = $this->modules_model->getModules();
					break;
			}
			if($this->oUser->role_id != 2) {
				$aUrl = $this->uri->segments;
				if(sizeof($aUrl) > 1) {
					if($this->modules_model->getModuleByName($aUrl[2])) {
						$aModulesList = $this->modules_model->getUserModules(array('iUserId' => $this->oUser->id));

						$aUserModules = array();
						foreach ($aModulesList as $aModule) {
							$aUserModules[] = $aModule->alias;
						}

						if(!empty($aUserModules)) {
							if (!in_array($aUrl[2], $aUserModules)) {
								if ($aUrl[2] == 'users' AND isset($aUrl[4]) AND $aUrl[4] == $this->oUser->id) {
									return $this->updateLogs();
								} else {
									$sRandomModule = array_shift($aUserModules);
									redirect('admin/'.$sRandomModule, 'refresh');
								}
							}
						} else {
							$this->ion_auth->logout();
						}
					}
				}
			}
		}

		if(!$this->ion_auth->logged_in() AND $bLogin) {
			redirect('admin', 'refresh');
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
			'admin', 'admin/logout'
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
	 * Формирование отображения
	 *
	 * @param       $method
	 * @param array $params
	 *
	 * @return mixed
	 *
	 * @author N.Kulchinskiy
	 */
	public function _remap($method, $params = array()) {

		// you can set default variables to send to the template here
		$this->header['title'] = 'Airyo project';
		//$this->body['view'] = strtolower(get_class($this)).'/'.$method;

		if(method_exists($this, $method)) {
			$result = call_user_func_array(array($this, $method), $params);
			$this->load->view('admin/common/header', $this->oData);
			$this->load->view($this->oData['view'], $this->oData);
			$this->load->view('admin/common/footer', $this->oData);
			return $result;
		}
		show_404();
	}

	/**
	 * Получение конфигурации для пагинации
	 *
	 * @return array
	 *
	 * @author N.Kulchinskiy
	 */
	protected function getPaginationConfig(){
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
	}
}