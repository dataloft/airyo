<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends Frontend {


	protected $sHomeFolder = 'public/gallery';


	public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('gallery_model');

		$this->oData['home_folder'] = $this->sHomeFolder;

		$this->oData['scripts'] = array(
			'/themes/airyo/js/Gallery/js/ekko-lightbox.js',
			'/themes/airyo/js/gallery.js'
		);
		$this->oData['styles'] = array(
			'/themes/airyo/js/Gallery/css/ekko-lightbox.css',
			'/themes/airyo/css/gallery.css'
		);
	}


	public function index() {
		$this->oData['main_menu'] = 'gallery';

		$this->oData["albums"] = $this->gallery_model->getFetchCountriesAlbums();
		
		$aGalleryConfig = $this->config->item('gallery');
		$this->oData['preview_extension'] = $aGalleryConfig['image_preview_extension'];
		$this->oData['preview_size'] = $aGalleryConfig['image_preview_size'][1];
		
		
		foreach ($this->oData["albums"]  as $a)
		{
			$this->oData["images"][$a->id] = $this->gallery_model->getFetchCountriesImages(array('sAlbumLabel' => $a->label));
		}

		$this->oData['view'] = 'laseris/gallery/gallery';
	}


}