<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups_model extends CI_Model {

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
	 * Получение групп пользвоателей
	 *
	 * @param array $aParams
	 *
	 * @return mixed
	 *
	 * @author N.Kulchinskiy
	 */
	public function getGroups(array $aParams = array()){
		$aParams = self::validateData($aParams);

		$this->db->select('*');

		if (isset($aParams['iGroupId'])) {
			$this->db->where($this->db->dbprefix('groups').'.id',$aParams['iId']);
		}

		$this->db->order_by($this->db->dbprefix('groups').'.id','asc');

		$aQuery = $this->db->get($this->db->dbprefix('groups'));
		if($aRecord = $aQuery->result()) {
			return $aRecord;
		}
	}

	/**
	 * Метод получения групп пользователей
	 *
	 * @param $aParams
	 * @return object
	 *
	 * @author N.Kulchinskiy
	 */
	public function getUsersGroups(array $aParams = array()){
		$aParams = self::validateData($aParams);

		$this->db->select('*');

		$this->db->from($this->db->dbprefix('groups'));

		$this->db->join($this->db->dbprefix('users_groups'), $this->db->dbprefix('groups') . '.id = ' . $this->db->dbprefix('users_groups') . '.group_id');

		if (isset($aParams['iGroupId'])) {
			$this->db->where($this->db->dbprefix('users_groups').'.group_id',$aParams['iGroupId']);
		}

		if (isset($aParams['iUserId'])) {
			$this->db->where($this->db->dbprefix('users_groups').'.user_id',$aParams['iUserId']);
		}

		$this->db->order_by($this->db->dbprefix('users_groups').'.id','asc');

		$aQuery = $this->db->get();

		//var_dump($this->db->last_query());

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
	 * @author N.Kulchinskiy
	 */
	public function getGroupById($iUserId) {
		if($iId = intval($iUserId) and $iUserId > 0 and $aGroup = $this->getUsers(array('iGroupId' => $iId))) {
			if(count($aGroup) > 0) {
				return array_pop($aUser);
			}
		}
	}

	/**
	 * Валидация данных пользователя
	 *
	 * @param $aParams
	 * @return array
	 *
	 * @autor N.Kulchinskiy
	 */
	private static function validateData($aParams){
		$aValidParams = array();

		// Проверка id пользователя
		if(isset($aParams['iUserId']) AND $iId = intval($aParams['iUserId']) AND $iId > 0) {
			$aValidParams['iUserId'] = $iId;
		}
		// Проверка id группы
		if(isset($aParams['iGroupId']) AND $iId = intval($aParams['iGroupId']) AND $iId > 0) {
			$aValidParams['iGroupId'] = $iId;
		}

		return $aValidParams;
	}
}

/* End of file page.php */
/* Location: ./system/application/models/page_model.php */