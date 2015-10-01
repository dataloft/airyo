<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logs_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Ведение лога действий
	 *
	 * @param array $aParams
	 * @return mixed
	 *
	 * @author N.Kulchinskiy
	 */
	public function updateLogs(array $aParams = array()){
		$this->db->insert($this->db->dbprefix('logs'), $aParams);

		return $this->db->insert_id();
	}

	/**
	 * Получение логов пользователей
	 *
	 * @param array $aParams
	 *
	 * @return mixed
	 *
	 * @author N.Kulchinskiy
	 */
	public function getlogs(array $aParams = array()){

		$this->db->select('*');

		if (isset($aParams['iId']) AND $iId = intval($aParams['iId']) AND $iId > 0) {
			$this->db->where($this->db->dbprefix('logs').'.id', $iId);
		}
		if (isset($aParams['iUserId']) AND $iUserId = intval($aParams['iUserId']) AND $iUserId > 0) {
			$this->db->where($this->db->dbprefix('logs').'.user_id', $iUserId);
		}

		$this->db->order_by($this->db->dbprefix('logs').'.id','asc');

		$aQuery = $this->db->get($this->db->dbprefix('logs'));
		if($aRecord = $aQuery->result()) {
			return $aRecord;
		}
	}

	/**
	 * Получение последнего лога по условию
	 *
	 * @param array $aParams
	 * @return mixed
	 *
	 * @author N.Kulchinskiy
	 */
	public function getLastLog(array $aParams = array()){
		$this->db->select('MAX(id) AS max_id');

		/** Проверка ID пользователя */
		if (isset($aParams['iUserId']) AND $iUserId = intval($aParams['iUserId']) AND $iUserId > 0) {
			$this->db->where($this->db->dbprefix('logs').'.user_id', $iUserId);
		}
		/** Проверка типа лога */
		if (isset($aParams['sType'])) {
			$this->db->where($this->db->dbprefix('logs').'.type', $aParams['sType']);
		}

		$aQuery = $this->db->get($this->db->dbprefix('logs'));

		if($aRecord = $aQuery->row()) {
			if($aLogs = $this->getlogs(array('iId' => $aRecord->max_id))) {
				if(count($aLogs) > 0) {
					return array_pop($aLogs);
				}
			}
		}
	}
}

/* End of file logs.php */
/* Location: ./system/application/models/logs_model.php */