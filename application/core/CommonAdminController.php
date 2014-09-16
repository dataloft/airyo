<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class CommonAdminController
 *
 * @author N.Kulchinskiy
 */
class CommonAdminController extends CI_Controller
{
	/** @var string  */
	protected $header_file = 'admin/common/header';
	/** @var string  */
	protected $body_file;
	/** @var string  */
	protected $footer_file = 'admin/common/footer';
	/** @var array  */
	protected $header_vars = array();
	/** @var array  */
	protected $body_vars = array();
	/** @var array  */
	protected $footer_vars = array();
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
		$this->load->model('users_model');

		$this->oUser = $this->users_model->getUserById($this->ion_auth->get_user_id());

		if(!$this->ion_auth->logged_in() AND $bLogin) {
			redirect('admin', 'refresh');
		}
	}

	protected function index() {
		$aData['header']['main_menu'] = '';
		$aData['header']['menu'] = array();
		$aData['header']['usermenu'] = array();
		$aData['header']['user_data'] = $this->oUser;

		return $aData;
	}

	protected function edit() {
		$aData['header']['main_menu'] = '';
		$aData['header']['menu'] = array();
		$aData['header']['usermenu'] = array();
		$aData['header']['user_data'] = $this->oUser;

		return $aData;
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
		$this->header_vars['title'] = 'Airyo project';
		$this->body_file = strtolower(get_class($this)).'/'.$method;

		if(method_exists($this, $method)) {
			$result = call_user_func_array(array($this, $method), $params);
			$this->load->view($this->header_file, $this->header_vars);
			$this->load->view($this->body_file, $this->body_vars);
			$this->load->view($this->footer_file, $this->footer_vars);
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
			'per_page'          => '20'
		);

		return $config;
	}
}