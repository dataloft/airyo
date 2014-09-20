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
		$aParams = parent::index();
		$aParams['header']['main_menu'] = 'admin';

		$this->header_vars = $aParams['header'];
		$this->body_vars = $aParams['body'];
		$this->body_file = 'admin/main/index';
	}
}
