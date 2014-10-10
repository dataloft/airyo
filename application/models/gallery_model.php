<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function record_count() {
		return $this->db->count_all("albums");
	}

	public function fetch_countries_albums($iLimit, $iStart) {
		$this->db->select('
				album.*,
				image.label AS images_label,
				(SELECT alb.label FROM airyo_albums AS alb WHERE alb.id = image.album_id) AS images_path,
				(SELECT COUNT(img.id) FROM airyo_images AS img WHERE img.album_id = image.album_id) AS images_count
			');
		$this->db->from('albums AS album');
		$this->db->join('images AS image', 'album.image_id = image.id');
		$this->db->limit($iLimit, $iStart);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function fetch_countries_images($iAlbumId, $iLimit, $iStart){
		$this->db->select('*');
		$this->db->from('images');
		$this->db->where('album_id' . ' = ' . $iAlbumId);
		$this->db->limit($iLimit, $iStart);

		$query = $this->db->get();

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

		if (isset($aParams['iAlbumId'])) {
			$this->db->where($this->db->dbprefix('albums').'.id', $aParams['iAlbumId']);
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
	 * @param int $iAlbumId
	 * @return object $oUser
	 *
	 * @author N.Kulchinskiy
	 */
	public function getAlbumById($iAlbumId) {
		if($iId = intval($iAlbumId) and $iId > 0 and $aAlbum = $this->getAlbums(array('iAlbumId' => $iId))) {
			if(count($aAlbum) > 0) {
				return array_pop($aAlbum);
			}
		}
	}

	/**
	 * Создание альбома
	 *
	 * @param $aData
	 * @return mixed
	 *
	 * @author N.Kulchinskiy
	 */
	public function addAlbum($aData) {
		$this->db->insert($this->db->dbprefix('albums'), $aData);
		$return = $this->db->insert_id();
		return $return;
	}
}

/* End of file gallery_model.php */
/* Location: ./system/application/models/gallery_model.php */