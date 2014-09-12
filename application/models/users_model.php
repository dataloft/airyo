<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function record_count() {
		return $this->db->count_all("users");
	}

	public function fetch_countries($limit, $start) {
		$this->db->limit($limit, $start);
		$query = $this->db->get("users");

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	/**
	 * Метод получения пользователей
	 *
	 * @param $aParams
	 * @return object
	 *
	 * @author N.Zakharenko
	 */
	public function getUsers(array $aParams = array()){
		$aParams = self::validateUserData($aParams);

		$this->db->select('*');

		if (isset($aParams['iId'])) {
			$this->db->where('id',$aParams['iId']);
		}
		$this->db->order_by('id','asc');

		$aQuery = $this->db->get($this->db->dbprefix('users'));
		if($aRecord = $aQuery->result()) {
			return $aRecord;
		}
	}

	/**
	 * Получение пользователя по ID
	 *
	 * @param int $iUserId
	 * @return object $oUser
	 *
	 * @author N.Zakharenko
	 */
	public function getUserById($iUserId) {
		if($iId = intval($iUserId) and $iUserId > 0 and $aUser = $this->getUsers(array('iId' => $iId))) {
			if(count($aUser) > 0) {
				return array_pop($aUser);
			}
		}
	}

	public function Update ($id, $data) {
		if ($this->db->update($this->db->dbprefix('users'), $data, array('id' => $id))) {
			return true;
		} else {
			return false;
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
	private static function validateUserData($aParams){
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