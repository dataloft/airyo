<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Метод получения альбомов
	 *
	 * @param $aParams
	 * @return object
	 *
	 * @author N.Kulchinskiy
	 */
	public function getFetchCountriesAlbums($aParams) {
		$this->db->select('album.*');
		$this->db->select('(SELECT i.label FROM ' . $this->db->dbprefix('images') . ' AS i WHERE i.album_id = album.id ORDER BY id DESC LIMIT 1) AS random_image_label');
		$this->db->select('(SELECT COUNT(img.id) FROM ' . $this->db->dbprefix('images') . ' AS img WHERE img.album_id = album.id) AS images_count');

		$this->db->from('albums AS album');

		if (isset($aParams['iAlbumId'])) {
			$this->db->where('album.id', $aParams['iAlbumId']);
		}
		if (isset($aParams['sAlbumLabel'])) {
			$this->db->where('album.label', $aParams['sAlbumLabel']);
		}

		$this->db->order_by("create_date", "DESC");

		if(isset($aParams['iLimit']) AND isset($aParams['iStart'])) {
			$this->db->limit($aParams['iLimit'], $aParams['iStart']);
		}

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
	 * Метод получения изображений
	 *
	 * @param $aParams
	 * @return object
	 *
	 * @author N.Kulchinskiy
	 */
	public function getFetchCountriesImages($aParams){
		$this->db->select('*');
		$this->db->from('images');

		if(isset($aParams['sAlbumLabel'])) {
			$this->db->where('album_id' . ' = (SELECT id FROM ' . $this->db->dbprefix('albums') . ' WHERE label = "' . $aParams['sAlbumLabel'] . '")');
		}
		if (isset($aParams['iImageId'])) {
			$this->db->where($this->db->dbprefix('images') . '.id', $aParams['iImageId']);
		}

		$this->db->order_by("id", "DESC");
		if (isset($aParams['iLimit']) AND isset($aParams['iStart'])) {
			$this->db->limit($aParams['iLimit'], $aParams['iStart']);
		}

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
	 * Получение альбома по ID
	 *
	 * @param int $iAlbumId
	 * @return object $oUser
	 *
	 * @author N.Kulchinskiy
	 */
	public function getAlbumById($iAlbumId) {
		if($iId = intval($iAlbumId) and $iId > 0 and $aAlbum = $this->getFetchCountriesAlbums(array('iAlbumId' => $iId))) {
			if(count($aAlbum) > 0) {
				return array_pop($aAlbum);
			}
		}
	}

	/**
	 * Получение альбома по параметру label
	 *
	 * @param int $sAlbumLabel
	 * @return object $oUser
	 *
	 * @author N.Kulchinskiy
	 */
	public function getAlbumByLabel($sAlbumLabel) {
		$sAlbumLabel = strip_tags(htmlspecialchars($sAlbumLabel));
		if($aAlbum = $this->getFetchCountriesAlbums(array('sAlbumLabel' => $sAlbumLabel))) {
			if(count($aAlbum) > 0) {
				return array_pop($aAlbum);
			}
		}
	}

	/**
	 * Получение изображения по ID
	 *
	 * @param int $iImageId
	 * @return object $oUser
	 *
	 * @author N.Kulchinskiy
	 */
	public function getImageById($iImageId) {
		if($iId = intval($iImageId) and $iId > 0 and $aImage = $this->getFetchCountriesImages(array('iImageId' => $iId))) {
			if(count($aImage) > 0) {
				return array_pop($aImage);
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
		return $this->db->insert_id();
	}

	/**
	 * Добавление изображения в альбом
	 *
	 * @param $aData
	 * @return mixed
	 *
	 * @author N.Kulchinskiy
	 */
	public function addImage($aData) {
		$this->db->insert($this->db->dbprefix('images'), $aData);
		return $this->db->insert_id();
	}
}

/* End of file gallery_model.php */
/* Location: ./system/application/models/gallery_model.php */