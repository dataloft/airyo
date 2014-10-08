<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('content_model');
		$this->load->model('counters_model');
		$this->load->model('menu_model');
        $this->load->helper('url');
        $this->config->load('templates');
	}

	public function index($page = '') {
        $page = $this->uri->uri_string();
		$data['page'] = $this->content_model->getToAlias($page,true);
        $data['template_list'] = $this->config->item('templates');
        $data['menu'] = $this->menu_model->getList(1,true);
        
		if($data['page']) {
			$this->load->view('startbootstrap/common/header', $data);
			$this->load->view('startbootstrap/common/nav', $data);

            if (!empty($data['template_list'][$data['page']['template']]['fields']))
            {
                $content = unserialize($data['page']['content']);
                foreach ($content as $i => $item)
                {
                    $data['page'][$i] = $item;
                }
            }
            $this->load->view('startbootstrap/pages/'.$data['page']['template'], $data);

            if($counters = $this->counters_model->getCounters($this->input->ip_address(), $_SERVER['HTTP_HOST'])) $data['counters'] = $counters; else $data['counters'] = '';

			$this->load->view('startbootstrap/common/footer', $data);
		} else {
			show_404();
		}
	}
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */