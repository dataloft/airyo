<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends Frontend {

	protected $sHomeFolder = 'public/gallery';


	public function __construct() {
		parent::__construct();
		$this->load->config('gallery');
		$this->load->helper('file');
		$this->load->model('gallery_model');
		
		//var_dump($this->gallery_model->data);

		$this->data['home_folder'] = $this->sHomeFolder;

		//$this->oData['scripts'] = '/themes/laseris/js/jquery.magnific-popup.min.js';
		//$this->oData['styles'] = '/themes/laseris/css/magnific-popup.css';
	}


	public function index() {
		//$this->data['main_menu'] = 'gallery';

		$this->data["albums"] = $this->gallery_model->getFetchCountriesAlbums();
		
		$aGalleryConfig = $this->config->item('gallery');
		$this->data['preview_extension'] = $aGalleryConfig['image_preview_extension'];
		$this->data['preview_size'] = $aGalleryConfig['image_preview_size'][0];
		
		
		if (!empty($this->data["albums"])){
			foreach ($this->data["albums"]  as $a)
			{
				$this->data["images"][$a->id] = $this->gallery_model->getFetchCountriesImages(array('sAlbumLabel' => $a->label));
			}
		}
		
		//$this->data['view'] = 'laseris/gallery/gallery';
		$this->load->view('laseris/gallery/gallery', $this->data);
	}


}