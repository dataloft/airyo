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
	 * @author N.Kulchinskiy
	 */
	public function getUsers(array $aParams = array()){
		$aParams = self::validateData($aParams);

		$this->db->select($this->db->dbprefix('users').'.*');
		$this->db->select($this->db->dbprefix('rules').'.id AS rule_id');
		$this->db->select($this->db->dbprefix('rules').'.title AS rule_title');

		$this->db->join($this->db->dbprefix('users_rules'), $this->db->dbprefix('users') . '.id = ' . $this->db->dbprefix('users_rules') . '.user_id', 'left');
		$this->db->join($this->db->dbprefix('rules'), $this->db->dbprefix('rules') . '.id = ' . $this->db->dbprefix('users_rules') . '.rule_id', 'left');

		if (isset($aParams['iUserId'])) {
			$this->db->where($this->db->dbprefix('users').'.id', $aParams['iUserId']);
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

		return $aValidParams;
	}
}

/* End of file page.php */
/* Location: ./system/application/models/page_model.php */