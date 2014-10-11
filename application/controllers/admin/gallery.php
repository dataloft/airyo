<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CommonAdminController {
	/** @var string  */
	protected $sHomeFolder = 'gallery';

	public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		$this->config->load('not_allowed_mimes');
		$this->load->model('gallery_model');
	}

	public function index($sAlbumLabel = '') {
		$this->oData['main_menu'] = 'gallery';

		$this->oData['result'] = array();
		$this->oData['message'] =  $this->session->flashdata('message')? $this->session->flashdata('message'):'';
		$this->oData['scripts'] = array(
			'/themes/airyo/js/FileUpload/js/vendor/jquery.ui.widget.js',
			'/themes/airyo/js/FileUpload/js/jquery.iframe-transport.js',
			'/themes/airyo/js/FileUpload/js/jquery.fileupload.js',
			'/themes/airyo/js/Gallery/js/ekko-lightbox.js',
			'/themes/airyo/js/gallery.js'
		);
		$this->oData['styles'] = array(
			'/themes/airyo/js/FileUpload/css/jquery.fileupload.css',
			'/themes/airyo/js/FileUpload/css/jquery.fileupload-ui.css',
			'/themes/airyo/js/FileUpload/css/style.css',
			'/themes/airyo/js/Gallery/css/ekko-lightbox.css',
			'/themes/airyo/css/gallery.css'
		);
		$aPaginationConfig = $this->getPaginationConfig();
		$this->pagination->initialize($aPaginationConfig);

		if(empty($sAlbumLabel)) {
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$this->oData["albums"] = $this->gallery_model->fetch_countries_albums($aPaginationConfig["per_page"], $page);

			$this->oData['profile_id'] = $this->oUser->id;
			$this->oData['pagination'] = $this->pagination;

			$this->oData['view'] = 'admin/gallery/albums';
		} else {
			$this->oData["album"] = $this->gallery_model->getAlbumByLabel($sAlbumLabel);

			$iPage = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$this->oData["images"] = $this->gallery_model->fetch_countries_images($sAlbumLabel, $aPaginationConfig["per_page"], $iPage);

			$this->oData['profile_id'] = $this->oUser->id;
			$this->oData['pagination'] = $this->pagination;

			$this->oData['view'] = 'admin/gallery/album';
		}
	}

	/**
	 * Создание нового альбома
	 *
	 * @author N.Kulchinskiy
	 */
	public function createAlbum() {
		$this->form_validation->set_rules('album_title', 'Название', 'required|trim|min_length[2]|xss_clean');
		$this->form_validation->set_rules('album_description', 'Описание', 'trim|min_length[2]|xss_clean');

		if ($this->form_validation->run() == true) {
			$sLabelAlbum = 'album'.time();

			$aAlbumData = array(
				'label'         => $sLabelAlbum,
				'title'         => $this->input->post('album_title',TRUE),
				'description'   => $this->input->post('album_description',TRUE),
				'image_id'      => 1,
				'user_id'       => $this->oUser->id,
				'create_date'   => date('Y-m-d H:i:s'),
				'enable'        => 1
			);

			if($this->gallery_model->addAlbum($aAlbumData)) {
				$sPath = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.$this->sHomeFolder;

				if (!is_dir($sPath.DIRECTORY_SEPARATOR.$sLabelAlbum)) {
					mkdir($sPath.DIRECTORY_SEPARATOR.$sLabelAlbum);
				} else {
					$this->oData['message'] = $this->session->set_flashdata('message', array(
							'type' => 'danger',
							'text' => 'Альбом с таким именем уже есть'
						)
					);
				}
			} else {
				$this->oData['message'] = $this->session->set_flashdata('message', array(
						'type' => 'danger',
						'text' => 'Ошибка при создании альбома'
					)
				);
			}
		} else {
			$this->oData['message'] = $this->session->set_flashdata('message', array(
					'type' => 'danger',
					'text' => 'Ошибка при проверке названия или описания альбома'
				)
			);
		}

		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}

	/**
	 * Загрузка изображения в альбом
	 *
	 * @return string
	 *
	 * @author N.Kulchinskiy
	 */
	public function uploadImages(){
		$upload = isset($_FILES['file']) ? $_FILES['file'] : null;
		$error = '';

		var_dump($this->input->data());
		die();
		if ($upload ) {
			$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.$this->sHomeFolder.DIRECTORY_SEPARATOR.$_POST['album'];
			$config['allowed_types'] = '*';
			$this->load->library('upload', $config);

			$this->upload->initialize($config);
			if (in_array($upload['type'],$this->config->item('not_allowed_mimes'))) {
				$this->oData['message'] = $this->session->set_flashdata('message',  array(
						'type' => 'danger',
						'text' => $upload['type'].' not allowed mime'
					)
				);

				return json_encode(array('path'=>'/admin/gallery/'.$_POST['album'], 'err' =>$upload['type'].' not allowed mime'));
			}

			$oAlbum = $this->gallery_model->getAlbumByLabel($_POST['album']);

			$upload['name'] = $this->translitIt($upload['name']);

			$_FILES['file'] = array (
				'name'=> $upload['name'],
				'type'=> $upload['type'],
				'tmp_name'=> $upload['tmp_name'],
				'error'=> $upload['error'],
				'size'=> $upload['size']
			);

			$aImageData = array(
				'label'         => $upload['name'],
				'title'         => $upload['name'],
				'album_id'      => $oAlbum->id,
				'user_id'       => $this->oUser->id,
				'create_date'   => date('Y-m-d H:i:s'),
				'enable'        => 1
			);

			if($this->gallery_model->addImage($aImageData)) {
				if ($this->upload->do_upload('file')) {
					$tmp_data = $this->upload->data();
					$files_data[] = $tmp_data['full_path'];
				} else {
					$files_data[] = $this->upload->display_errors();
				}

				$this->oData['message'] = $this->session->set_flashdata('message',  array(
						'type' => 'success',
						'text' => 'Файлы загружены'
					)
				);
			} else {
				$this->oData['message'] = $this->session->set_flashdata('message',  array(
						'type' => 'danger',
						'text' => 'Ошибка при загрузке файла'
					)
				);
			}
		} else {
			$this->oData['message'] = $this->session->set_flashdata('message',  array(
					'type' => 'danger',
					'text' => 'Not files'
				)
			);
		}

		return json_encode(array('path'=>'/admin/gallery/'.$_POST['album'], 'err' =>$error, 'res' =>  implode('/n',$files_data)));
	}

	/**
	 * Транслитерация строки
	 *
	 * @param $sString
	 * @return string
	 *
	 * @author N.Kulchinskiy
	 */
	function translitString($sString) {
		$aTranslit = array(
			"А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
			"Д"=>"D","Е"=>"E","Ж"=>"J","З"=>"Z","И"=>"I",
			"Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
			"О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
			"У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH",
			"Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"YI","Ь"=>"",
			"Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b",
			"в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
			"з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
			"м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
			"с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
			"ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
			"ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya"
		);
		return strtr($sString, $aTranslit);
	}
}

/* End of file gallery.php */
/* Location: ./application/controllers/admin/gallery.php */