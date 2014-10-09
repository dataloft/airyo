<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CommonAdminController {

	protected $start_folder = 'public';
	protected $path = '';
	protected $path_img_upload_folder;
	protected $path_img_thumb_upload_folder;
	protected $path_url_img_upload_folder;
	protected $path_url_img_thumb_upload_folder;
	protected $delete_img_url;

	public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		$this->config->load('not_allowed_mimes');
		$this->load->model('gallery_model');
	}

	public function index() {
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

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->oData["albums"] = $this->gallery_model->fetch_countries_albums($aPaginationConfig["per_page"], $page);

		if(!empty($this->oData["albums"])) {
			foreach ($this->oData["albums"] as $iKey => $aUser) {
				$this->oData["albums"][$iKey]->groups = $this->ion_auth->get_users_groups($aUser->id)->result_array();
			}
		}

		$this->oData['profile_id'] = $this->oUser->id;
		$this->oData['pagination'] = $this->pagination;

		$this->oData['view'] = 'admin/gallery/album';
	}

	public function createAlbum() {
		
	}

	public function createImage(){
		
	}
}

/* End of file gallery.php */
/* Location: ./application/controllers/admin/gallery.php */