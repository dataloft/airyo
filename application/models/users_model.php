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
		$query = $this->db->get("users");
		$this->db->limit($limit, $start);

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
	 * @author N.Kulchinskiy
	 */
	public function getUsers(array $aParams = array()){
		$aParams = self::validateData($aParams);

		$this->db->select($this->db->dbprefix('users').'.*');

		if (isset($aParams['iUserId']) AND !isset($aParams['iRuleId'])) {
			$this->db->where($this->db->dbprefix('users').'.id', $aParams['iUserId']);
		}

		if (isset($aParams['iUserId']) AND isset($aParams['iRuleId'])) {
			if ($aParams['iRuleId'] == 1) {
				$this->db->where($this->db->dbprefix('users').'.rule_id', 0);
				$this->db->or_where($this->db->dbprefix('users').'.id', $aParams['iUserId']);
			}
		}

		if (isset($aParams['iLimit']) AND isset($aParams['iStart'])) {
			$this->db->limit($aParams['iLimit'], $aParams['iStart']);
		}

		$this->db->order_by($this->db->dbprefix('users').'.id','asc');

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
	 * @author N.Kulchinskiy
	 */
	public function getUserById($iUserId) {
		if($iId = intval($iUserId) and $iUserId > 0 and $aUser = $this->getUsers(array('iUserId' => $iId))) {
			if(count($aUser) > 0) {
				return array_pop($aUser);
			}
		}
	}

	/**
	 * Обновление профиля
	 *
	 * @param $id
	 * @param $data
	 * @return bool
	 *
	 * @author N.Kulchinskiy
	 */
	public function Update($id, $data) {
		if ($this->db->update($this->db->dbprefix('users'), $data, array('id' => $id))) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Создание профиля
	 *
	 * @param $data
	 * @return bool
	 *
	 * @author N.Kulchinskiy
	 */
	public function addUser($data){
		if ($iId = $this->db->insert($this->db->dbprefix('users'), $data)) {
			return $iId;
		} else {
			return false;
		}
	}

	/**
	 * Получение списка ролей
	 *
	 * @return array $result
	 */
	public function getRules()
	{
		$this->db->select('*')->from($this->db->dbprefix('rules'));
		$query = $this->db->get();

		if($result = $query->result()) {
			return $result;
		}
	}

	/**
	 * Обновление роли пользователя
	 *
	 * @param $iId
	 * @param $iRuleId
	 * @return bool
	 *
	 * @author N.Kulchinskiy
	 */
	public function updateRule($iId, $iRuleId){
		$aUser = $this->getUserById($iId);
		if(!empty($aUser->rule_id)) {

			$this->db->where('user_id', $iId);
			if($this->db->update($this->db->dbprefix('users_rules'), array('rule_id' => $iRuleId))) {
				return true;
			}

		} else {
			if($this->db->insert($this->db->dbprefix('users_rules'), array('user_id' => $iId, 'rule_id' => $iRuleId))) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Валидация данных пользователя
	 *
	 * @param $aParams
	 * @return array
	 *
	 * @author N.Kulchinskiy
	 */
	private static function validateData($aParams){
		$aValidParams = array();

		// Проверка id пользователя
		if(isset($aParams['iUserId']) AND $iId = intval($aParams['iUserId']) AND $iId > 0) {
			$aValidParams['iUserId'] = $iId;
		}

		// Проверка id роли
		if(isset($aParams['iRuleId']) AND $iId = intval($aParams['iRuleId']) AND $iId > 0) {
			$aValidParams['iRuleId'] = $iId;
		}

		// Проверка лимита
		if(isset($aParams['iLimit']) AND $iId = intval($aParams['iLimit']) AND $iId > 0) {
			$aValidParams['iLimit'] = $iId;
		}

		// Проверка номера страницы
		if(isset($aParams['iStart']) AND $iId = intval($aParams['iStart']) AND $iId > 0) {
			$aValidParams['iStart'] = $iId;
		}

		return $aValidParams;
	}
}

/* End of file page.php */
/* Location: ./system/application/models/page_model.php */