<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Метод получения групп
	 *
	 * @param $aParams
	 * @return object
	 *
	 * @author N.Kulchinskiy
	 */
	public function getGroups(array $aParams = array()){
		$aParams = $this->validateGroupData($aParams);

		$this->db->select('*');

		if (isset($aParams['iId'])) {
			$this->db->where('id',$aParams['iId']);
		}
		$this->db->order_by('id','asc');

		$aQuery = $this->db->get($this->db->dbprefix('groups'));
		if($aRecord = $aQuery->result()) {
			return $aRecord;
		}
	}

	/**
	 * Получение группы пользователя по ID
	 *
	 * @param int $iGroupId
	 * @return object $oUser
	 *
	 * @author N.Kulchinskiy
	 */
	public function getGroupById($iGroupId) {
		if($iId = intval($iGroupId) and $iGroupId > 0 and $aGroups = $this->getGroups(array('iId' => $iId))) {
			if(count($aGroups) > 0) {
				return array_pop($aGroups);
			}
		}
	}

	/**
	 * Валидация данных пользователя
	 *
	 * @param $aParams
	 * @return array
	 *
	 * @autor N.Zakharenko
	 */
	private static function validateGroupData($aParams){
		$aValidParams = array();

		// Проверка id пользователя
		if(isset($aParams['iId']) AND $iId = intval($aParams['iId']) AND $iId > 0) {
			$aValidParams['iId'] = $iId;
		}

		return $aValidParams;
	}
}

/* End of file page.php */
/* Location: ./system/application/models/page_model.php */