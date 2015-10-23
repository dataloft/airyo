<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Frontend {

	public function __construct() {
		parent::__construct();

		$this->load->model('startbootstrap/pages_model');
		$this->load->model('startbootstrap/sliders_model');
		$this->load->helper('url');
		$this->load->library('Smart_codes');
	}

	public function index() {

		$this->data['page'] = $this->pages_model->getByAlias($this->uri->uri_string(), true);

		if ($this->data['page'])
		{
			$this->data['page']['content'] = $this->smart_codes->Parse($this->data['page']['content']);
			$this->data['page']['title'] = $this->data['page']['h1'];

			$sliders_list = $this->sliders_model->get_list();
			if (!empty($sliders_list)){
				foreach ($sliders_list  as $row) {
					$this->data["sliders"][] = array (
						'id' => $row["id"],
						'title' => $row["title"],
						'slide' => $this->sliders_model->get_by_id($row['id'])
					);
				}
			}

			$this->load->view('startbootstrap/pages/'.$this->data['page']['template'], $this->data);
		}
		else {
			show_404();
		}
	}
}