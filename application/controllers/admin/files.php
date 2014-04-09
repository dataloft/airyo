<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Files extends CI_Controller {

    protected $start_folder = 'public';

	public function __construct() {
		parent::__construct();
		$this->load->library('ion_auth');
        $this->load->helper('file');
        $this->load->helper('url');
	}

	public function index() {

		if(!$this->ion_auth->logged_in()) {
			redirect('admin', 'refresh');
		}

		$data['menu'] = array();
		$data['main_menu'] = 'files';
		$data['usermenu'] = array();

        $dir = $this->getCurrentDir();
        $data['dir'] = $dir;

        if (!is_dir($dir)) echo 'Нет папки';
        try {
            $array = $this->readdir($dir);
        } catch (Exception $e) {
            $array = array();
            echo 'Невозможно прочитать папку "' . $dir . '".';
        }
        if (!empty($array))
        foreach ($array as $item) {
            $label = basename($item);
            $path =  ltrim(ltrim($item,'/'), $this->start_folder.'/');
            $isLink = is_link($path);
            if (is_dir($item)) {
                $data['data'][] = array(
                    'type' => 'dir',
                    'isLink' => $isLink,
                    'path' => $path,
                    'label' => $label,
                    'extension' => '-',
                    'url' => '/admin/files/?dir='.$path
                );
            } else {
                $size = @filesize($item);
                if ($size === false) {
                    $intsize = 0;
                    $size = 'N/A';
                } else if ($size < 0) {
                    $intsize = 0;
                    $size = '> 1Гb';
                } else {
                    $intsize = $size;
                    $size = number_format($size, 0, ' ', ' ');
                }
                $extension = pathinfo($path, PATHINFO_EXTENSION);
                if (empty($extension)) $extension = '-';
                $data['data'][] = array(
                    'type' => 'file',
                    'isLink' => $isLink,
                    'path' => $path,
                    'label' => $label,
                    'size' => $size,
                    'intsize' => $intsize,
                    'extension' => $extension,
                );
            }
        }
        else
            $data['data']=array();

        $upDir = ltrim(ltrim(dirname($dir),'public'),"/");
        if ($upDir == '' or $upDir == '.')
            array_unshift($data['data'], array('type' => 'up', 'path' => '', 'label' => 'Вверх', 'url' => '/admin/files'));
        else
            array_unshift($data['data'], array('type' => 'up', 'path' => $upDir, 'label' => 'Вверх', 'url' => '/admin/files/?dir='.$upDir));

        // Создаем путь (хлебные крошки)
        $currDir = preg_replace("/public/",'',rtrim($this->getCurrentDir(), '\\/'),1);
        $currExplodedDir = preg_split('#\\\\|/#', $currDir);
        if (isset($currExplodedDir[0]) && $currExplodedDir[0] == '') $currExplodedDir[0] = DIRECTORY_SEPARATOR; //FIX для UNIX
        $data['path'] = array();
        $url = '';
        foreach ($currExplodedDir as $value) {
            if ($value != DIRECTORY_SEPARATOR) {
                $url .= ($value . DIRECTORY_SEPARATOR);
            } else {
                $url = DIRECTORY_SEPARATOR;
                $value = 'Home';
            }
            $data['path'][] = array('text' => $value, 'url' => ltrim($url,'/'));
        }

		$this->load->view('admin/header', $data);
		$this->load->view('admin/files/list', $data);
		$this->load->view('admin/footer', $data);
	}
	
	public function edit($id = '') {
		
		
	}

    protected function getCurrentDir()
    {
       return ($this->input->get('dir')) ? $this->start_folder.DIRECTORY_SEPARATOR.$this->input->get('dir') : $this->start_folder;
    }

    public static function readdir($dir, $onlyDirs = false)
    {
        if (!is_dir($dir)) throw new Exception('Директория не найдена'); //TODO: Сообщение об ошибке.

        if (!preg_match('#[\\\\/]$#u', $dir)) {
            $dir .= DIRECTORY_SEPARATOR;
        }
        if ($handle = opendir($dir)) {
            $dirs = $files = array();
            while (false !== ($file = readdir($handle))) {
                if ($file != '.' && $file != '..') {
                    $file = $dir . $file;
                    if (is_dir($file)) {
                        $dirs[] = $file . DIRECTORY_SEPARATOR;
                    } else {
                        $files[] = $file;
                    }
                }
            }
            closedir($handle);
            sort($dirs);
            sort($files);
            if ($onlyDirs) {
                return $dirs;
            } else {
                return array_merge($dirs, $files);
            }
        } else {
            throw new  Exception('Не удалось открыть деректорию'); //TODO: Сообщение об ошибке.
        }
    }
	
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */