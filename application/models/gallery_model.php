<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function record_count() {
		return $this->db->count_all("albums");
	}

	public function fetch_countries_albums($limit, $start) {
		$this->db->limit($limit, $start);
		$query = $this->db->get("albums");

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
	public function getAlbums(array $aParams = array()){
		$aParams = self::validateData($aParams);

		$this->db->select('*');

		if (isset($aParams['iUserId'])) {
			$this->db->where($this->db->dbprefix('albums').'.id', $aParams['iUserId']);
		}

		$this->db->order_by($this->db->dbprefix('albums').'.id','asc');

		$aQuery = $this->db->get($this->db->dbprefix('albums'));
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
	public function getAlbumById($iUserId) {
		if($iId = intval($iUserId) and $iUserId > 0 and $aUser = $this->getAlbums(array('iUserId' => $iId))) {
			if(count($aUser) > 0) {
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

		return $aValidParams;
	}
}

/* End of file gallery_model.php */
/* Location: ./system/application/models/gallery_model.php */