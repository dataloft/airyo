<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends Frontend {

	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('laseris/news_model');
        $this->load->helper('url');
        $this->load->library('Smart_codes');
	}

	
	// Строим список с постраничной разбивкой
	public function index()
	{
		$pg = $this->config->item('pagination');
	    $pg['total_rows'] = $this->news_model->count();
	    $pg['base_url'] = '/news?';
		$pg['per_page'] = 10;
		$pg["num_links"] = 5;
		$pg['use_page_numbers'] = TRUE;
		$pg['page_query_string'] = TRUE;
		
	    $this->pagination->initialize($pg);
	    
	    // Получаем список новостей для текущей страницы
	    $this->data['news']  = $this->news_model->getList($this->pagination->per_page, $this->input->get('per_page'));
	    
	    $this->load->view('laseris/news/list', $this->data);
	}
	
	
	public function item($id = '')
	{
		
		
		
		
		
		$this->load->view('laseris/news/item', $this->data);
	}
	
	
}