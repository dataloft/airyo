<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modules_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function record_count() {
		return $this->db->count_all("modules");
	}

	public function fetch_countries($limit, $start) {
		$this->db->limit($limit, $start);
		$query = $this->db->get("modules");

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	/**
	 * Получение списка модулей
	 *
	 * @param array $aParams
	 *
	 * @return mixed
	 *
	 * @author N.Kulchinskiy
	 */
	public function getModules(array $aParams = array()){
		$aParams = self::validateData($aParams);

		$this->db->select('*');
		$this->db->from($this->db->dbprefix('modules'));

		if (isset($aParams['iModuleId'])) {
			$this->db->where($this->db->dbprefix('modules').'.id', $aParams['iModuleId']);
		}

		$this->db->order_by($this->db->dbprefix('modules').'.position','asc');
		$aQuery = $this->db->get();

		if ($aResult = $aQuery->result()) {
			return $aResult;
		}
	}

	/**
	 * Получение списка модулей пользователей
	 *
	 * @param array $aParams
	 *
	 * @return mixed
	 *
	 * @author N.Kulchinskiy
	 */
	public function getUserModules(array $aParams = array()){
		$aParams = self::validateData($aParams);

		$this->db->select('*');
		$this->db->from($this->db->dbprefix('users_modules'));
		$this->db->join($this->db->dbprefix('modules'), $this->db->dbprefix('modules') . '.id = ' . $this->db->dbprefix('users_modules') . '.module_id', 'left');
		$this->db->join($this->db->dbprefix('users'), $this->db->dbprefix('users') . '.id = ' . $this->db->dbprefix('users_modules') . '.user_id', 'left');

		if (isset($aParams['iModuleId'])) {
			$this->db->where($this->db->dbprefix('modules').'.id', $aParams['iModuleId']);
		}

		if (isset($aParams['iUserId'])) {
			$this->db->where($this->db->dbprefix('users_modules').'.user_id', $aParams['iUserId']);
		}

		$this->db->order_by($this->db->dbprefix('modules').'.position','asc');
		$aQuery = $this->db->get();

		return $aRecord = ($aParams['bAsArray']) ? $aQuery->result_array() : $aQuery->result();
	}

	/**
	 * Получение модуля по ID
	 *
	 * @param int $iModuleId
	 * @return object $oUser
	 *
	 * @author N.Kulchinskiy
	 */
	public function getGroupById($iModuleId) {
		if($iId = intval($iModuleId) and $iModuleId > 0 and $aModule = $this->getGroups(array('iModuleId' => $iId))) {
			if(count($aModule) > 0) {
				return array_pop($aModule);
			}
		}
	}

	/**
	 * Удаление модулей у пользователя
	 *
	 * @param $iUserId
	 * @return bool
	 */
	public function removeUserModules($iUserId){
		return $this->db->delete($this->db->dbprefix('users_modules'), array('user_id' => $iUserId));
	}

	/**
	 * Добавление модулей пользователю
	 *
	 * @param $iUserId
	 * @param $iModuleId
	 * @return bool
	 */
	public function addUserModules($iUserId, $iModuleId){
		$dataModule = array(
			'user_id'   => $iUserId ,
			'module_id' => $iModuleId ,
		);

		return $this->db->insert($this->db->dbprefix('users_modules'), $dataModule);
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
		// Проверка id модуля
		if(isset($aParams['iModuleId']) AND $iId = intval($aParams['iModuleId']) AND $iId > 0) {
			$aValidParams['iModuleId'] = $iId;
		}
		// Тип вывода
		if(isset($aParams['bAsArray']) AND $aParams['bAsArray']) {
			$aValidParams['bAsArray'] = true;
		} else {
			$aValidParams['bAsArray'] = false;
		}

		return $aValidParams;
	}
}

/* End of file modules_model.php */
/* Location: ./system/application/models/modules_model.php */