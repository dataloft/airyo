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
			'/themes/airyo/js/FileUpload/js/main.js',
			'/themes/airyo/js/Gallery/js/jquery.blueimp-gallery.min.js',
			'/themes/airyo/js/Gallery/js/bootstrap-image-gallery.js'
		);
		$this->oData['styles'] = array(
			'/themes/airyo/js/FileUpload/css/jquery.fileupload.css',
			'/themes/airyo/js/FileUpload/css/jquery.fileupload-ui.css',
			'/themes/airyo/js/FileUpload/css/style.css',
			'/themes/airyo/js/Gallery/css/blueimp-gallery.css',
			'/themes/airyo/js/Gallery/css/bootstrap-image-gallery.css',
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
			if($iAlbum = intval(substr($sAlbumLabel, 5)) AND $iAlbum > 0) {
				$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
				$this->oData["images"] = $this->gallery_model->fetch_countries_images($iAlbum, $aPaginationConfig["per_page"], $page);

				$this->oData['profile_id'] = $this->oUser->id;
				$this->oData['pagination'] = $this->pagination;

				$this->oData['view'] = 'admin/gallery/album';
			}
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

			$aProfileData = array(
				'label'         => $sLabelAlbum,
				'title'         => $this->input->post('album_title',TRUE),
				'description'   => $this->input->post('album_description',TRUE),
				'image_id'      => 1,
				'user_id'       => $this->oUser->id,
				'create_date'   => date('Y-m-d H:i:s'),
				'enable'        => 1
			);

			if($this->gallery_model->addAlbum($aProfileData)) {
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

	public function createImage(){
		
	}
}

/* End of file gallery.php */
/* Location: ./application/controllers/admin/gallery.php */