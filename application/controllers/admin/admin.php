<?php
/**
 * Created by PhpStorm.
 * User: N.Kulchinskiy
 * Date: 16.09.14
 * Time: 15:02
 */

if(!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CommonAdminController {

	public function __construct() {
		parent::__construct();
	}

	public function index(){
		$data_header['main_menu'] = 'admin';
		$data_header['menu'] = array();
		$data_header['usermenu'] = array();

		$this->header_vars = $data_header;
		$this->body_file = 'admin/main/index';
	}
}
