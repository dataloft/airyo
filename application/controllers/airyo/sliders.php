<?php

class Sliders extends Airyo 
{

    public function __construct() 
    {
        parent::__construct();

        $this->load->model('airyo/sliders_model');
        $this->data['main_menu'] = 'sliders';
    }

	public function index() 
	{
		$this->data['sliders'] = $this->sliders_model->get_list();
		$this->load->view('airyo/sliders/list', $this->data);
	}

	public function edit($id = false) {
		
        if ($this->input->post())
        {
        	// Обновляем статусы enabled там, где они изменились
            if ($this->sliders_model->update_state(
            	$this->state_changes(
            		$this->input->post('enabled'),
            		$this->input->post('enabled_new')
            	)
            ))
            {
                $this->notice_push('Статусы обновлены', 'success');
            }
            
            
            // Формируем массив входящих данных тут же можно добавить проверки
            $input = array();
            
            foreach ($this->input->post('slides') as $id => $data)
            {
            	$input[] = array(
            		'id' => $id,
            		'title' => $data['title'],
            		'description' => $data['description'],
            		'link' => $data['link']
            	);
            }
            
            if ($this->sliders_model->update($input))
            {
                $this->notice_push('Записи обновлены', 'success');
            } 
            
            
            redirect($this->uri->uri_string());
        }
		
		$this->data['slide'] = $this->sliders_model->get_by_id($id);
		
		$this->data['notice'] = $this->notice_pull();
		$this->load->view('airyo/sliders/edit', $this->data);
	}

	public function delete() {
		
	}

}