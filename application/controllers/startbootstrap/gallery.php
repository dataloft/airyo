<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends Frontend {

	protected $sHomeFolder = 'public/gallery';


	public function __construct() {
		parent::__construct();
		$this->load->config('gallery');
		$this->load->helper('file');
		$this->load->model('startbootstrap/gallery_model');

		$this->data['home_folder'] = $this->sHomeFolder;
	}


	public function index() {

		$this->data["albums"] = $this->gallery_model->getFetchCountriesAlbums();
		
		$aGalleryConfig = $this->config->item('gallery');
		$this->data['preview_extension'] = $aGalleryConfig['image_preview_extension'];
		$this->data['preview_size_small'] = $aGalleryConfig['image_preview_size'][1];
		$this->data['preview_size_big'] = $aGalleryConfig['image_preview_size'][0];
		
		
		if (!empty($this->data["albums"])){
			foreach ($this->data["albums"]  as $a)
			{
				$this->data["images"][$a->id] = $this->gallery_model->getFetchCountriesImages(array('sAlbumLabel' => $a->label));
			}
		}
		
		$this->load->view('startbootstrap/gallery/gallery', $this->data);
	}


}