<?php

class Sliders extends Airyo 
{
    protected $sHomeFolder = 'public/sliders';

    public function __construct() 
    {
        parent::__construct();

        $this->load->model('sliders_model');
        $this->load->helper('file');
        $this->config->load('not_allowed_mimes');
        $this->data['main_menu'] = 'sliders';
        $this->data['home_folder'] = $this->sHomeFolder;
    }

	public function index() 
	{  
		$this->data['sliders'] = $this->sliders_model->get_list();
		$this->load->view('sliders/list', $this->data);
	}

	public function edit($id = false) {

        if ($this->input->post() AND !$this->input->post('delete'))
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

      // Удаление записей
        elseif ($this->input->post('delete')) {
        	$row_id = array();
        	foreach ($this->input->post('delete') as $key => $value) {
        		$row_id[] = $key;
        	}

        	if ($this->sliders_model->delete($row_id)) {
        		$this->notice_push('Записи удалены', 'success');
        	}
        	redirect($this->uri->uri_string());
        }
		
		$this->data['slide'] = $this->sliders_model->get_by_id($id);
        $this->data['slider'] = $this->sliders_model->get_slider_by_id($id);
		$this->data['notice'] = $this->notice_pull();
		$this->load->view('sliders/edit', $this->data);
	}

	public function sort() {
		foreach ($this->input->post('item') as $order => $value) {
			$this->sliders_model->sort_order($value, $order);
		}
	}

	public function upload_images() {
		$upload = isset($_FILES['files']) ? $_FILES['files'] : null;

		if ($upload) {
			$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.$this->sHomeFolder.DIRECTORY_SEPARATOR;
			$config['allowed_types'] = '*';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
		}

		if (in_array($upload['type'][0], $this->config->item('not_allowed_mimes'))) {
				$aMessage =   array(
						'type' => 'danger',
						'text' => $upload['type'][0].' not allowed mime'
				);
				echo json_encode(array('path'=>'/airyo/sliders/', 'err' =>$upload['type'][0].' not allowed mime'));
			}

		$slider_id = $this->input->post('slider_id');

		$upload['name'] = $this->translitString($upload['name'][0]);
		$_FILES['file'] = array (
    			'name'=> $upload['name'],
				'type'=> $upload['type'][0],
				'tmp_name'=> $upload['tmp_name'][0],
				'error'=> $upload['error'][0],
				'size'=> $upload['size'][0]
			);

		if ($this->upload->do_upload('file')) {
			$tmp_data = $this->upload->data();
			$img_data = array(
				'sliders_id'    => $slider_id,
				'create_date'   => date('Y-m-d H:i:s'),
				'enabled'       => 0,
				'order'  		=> 0,
				'img_title'     => $tmp_data['file_name']
			);
		}

		if ($this->sliders_model->add_img($img_data)) {
			$this->notice_push('Файлы загружены', 'success');
		}

		else {
			$this->notice_push('Ошибка при загрузке файла', 'error');
		}
	}

    function translitString($sString) {
		$aTranslit = array(
			"А" => "A", "Б" => "B", "В" => "V", "Г" => "G",
			"Д" => "D", "Е" => "E", "Ж" => "J", "З" => "Z", "И" => "I",
			"Й" => "Y", "К" => "K", "Л" => "L", "М" => "M", "Н" => "N",
			"О" => "O", "П" => "P", "Р" => "R", "С" => "S", "Т" => "T",
			"У" => "U", "Ф" => "F", "Х" => "H", "Ц" => "TS", "Ч" => "CH",
			"Ш" => "SH", "Щ" => "SCH", "Ъ" => "", "Ы" => "YI", "Ь" => "",
			"Э" => "E", "Ю" => "YU", "Я" => "YA", "а" => "a", "б" => "b",
			"в" => "v", "г" => "g", "д" => "d", "е" => "e", "ж" => "j",
			"з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l",
			"м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
			"с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h",
			"ц" => "ts", "ч" => "ch", "ш" => "sh","щ" => "sch","ъ" => "y",
			"ы" => "yi", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya",
			" " => "_"
		);
		return strtr($sString, $aTranslit);
	}

	public function delete() {
		
	}

}