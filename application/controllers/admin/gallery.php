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
			'/themes/airyo/js/Gallery/css/bootstrap-image-gallery.css'
		);

		$this->oData['view'] = 'admin/gallery/album';
	}


    function translitIt($str) {
        $tr = array(
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
        return strtr($str,$tr);
    }
}

/* End of file files.php */
/* Location: ./application/controllers/admin/files.php */