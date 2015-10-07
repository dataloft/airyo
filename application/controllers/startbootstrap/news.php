<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends Frontend {

	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('startbootstrap/news_model');
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
		$pg['page_query_string'] = TRUE;
		$pg['full_tag_open'] = '<div class="row text-center"><div class="col-lg-12"><ul class="pagination">';
		$pg['full_tag_close'] = '</ul></div></div>';
		$pg['prev_tag_open'] = '<li>';
		$pg['prev_tag_close'] = '</li>';
		$pg['next_tag_open'] = '<li>';
		$pg['next_tag_close'] = '</li>';
		$pg['cur_tag_open'] = '<li class="active"><a href="">';
		$pg['cur_tag_close'] = '</a></li>';
		$pg['num_tag_open'] = '<li>';
		$pg['num_tag_close'] = '</li>';


		$this->pagination->initialize($pg);
	    
	    // Получаем список новостей для текущей страницы
	    $this->data['news']  = $this->news_model->getList($this->pagination->per_page, $this->input->get('per_page'));
	    
	    $this->load->view('startbootstrap/news/list', $this->data);
	}
	
	
	public function item($alias = '')
	{
		$this->data['page'] = $this->news_model->get_by_alias($alias);
		
		if ($this->data['page'])
		{
			$this->data['page']['content'] = $this->smart_codes->Parse($this->data['page']['content']);
            
            $this->load->view('startbootstrap/news/item', $this->data);
		}
		else {
			show_404();
		}
	}
	
	
}