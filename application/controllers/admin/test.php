<?php
/**
 * Created by PhpStorm.
 * User: zna
 * Date: 14.09.14
 * Time: 19:10
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CommonAdminController {

	public function __construct() {
		parent::__construct();
	}


	public function index() {
		parent::index();

		$this->body_file = 'admin/test/test';
	}
} 