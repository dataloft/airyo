<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Smart_codes
{
	public $data = array();


    public function __construct()
    {
        $this->load->helper('url');
    }

    
    public function __get($var)
    {
        return get_instance()->$var;
    }
    
    
    function str_replace_once($search, $replace, $text) 
	{ 
		$pos = strpos($text, $search); 
		return $pos!==false ? substr_replace($text, $replace, $pos, strlen($search)) : $text; 
	} 


    public function Parse($str)
    {
        //$this->data = array();
        // Добавить чистку пробелов в строке
        
        preg_match_all('/\[\[[^\[\]]*\]\]/i', $str, $matches);
        
        if (!empty($matches[0]))
        {
            foreach($matches[0] as $match)
            {
                $string = preg_replace(array('/\[/i','/\]/i'), '', $match);
                $data_arr = explode(':', $string);
                
                if (!empty($data_arr))
                {
                    if (method_exists($this, $data_arr[0]))
                    {
                        //var_dump($data_arr);
                        
                        //echo $data_arr[1];
                        
                        $params = explode(';',$data_arr[1]);
                        //var_dump($params);
                        //echo $data_arr[0];
                        
                        //$new_str = call_user_func_array(array($this, $data_arr[0]), $params);
                        $new_str = call_user_func_array(array($this, $data_arr[0]), $params);
                        
                        $str = $this->str_replace_once($match, $new_str, $str);	
                        
                        /*if (count($data_arr) > 1)
                        {
                            $params = explode(';',$data_arr[1]);
                            $new_str =  call_user_func_array(array($this, $data_arr[0]), $params);
                        }
                        else
                            $new_str =  $this->{$data_arr[0]}();
                            $str = str_replace($match, $new_str, $str);*/

                    }
                }
            }
        }
            
        return $str;
    }
    
    
    public function Gallery($sAlbumLabel)
    {
        $this->load->config('gallery');
        $this->load->model('laseris/gallery_model');
        
        $aGalleryConfig = $this->config->item('gallery');
        
        $data['home_folder'] = 'public/gallery';
        $data['preview_extension'] = $aGalleryConfig['image_preview_extension'];
        $data['preview_size'] = $aGalleryConfig['image_preview_size'][0];
        
        $rand_num = mt_rand(0, 0xffffff);
        $rand_str = sprintf("%06x", $rand_num);
        
        $data['album']['name'] = $sAlbumLabel.$rand_str;
        $data['album']['label'] = $sAlbumLabel;
        
        $data["images"] = $this->gallery_model->getFetchCountriesImages(array('sAlbumLabel' => $sAlbumLabel));
        
        return $this->load->view('laseris/gallery/gallery_album', $data, TRUE);
    }
    
    
    public function gallery_last($limit = 1)
    {
        $this->load->config('gallery');
        $this->load->model('laseris/gallery_model');
        
        $data = array();
        
        $albums = $this->gallery_model->getFetchCountriesAlbums();
		
		$aGalleryConfig = $this->config->item('gallery');
		$data['preview_extension'] = $aGalleryConfig['image_preview_extension'];
		$data['preview_size'] = $aGalleryConfig['image_preview_size'][0];
		
		if (!empty($albums)){
			foreach ($albums as $a)
			{
				$images = $this->gallery_model->getFetchCountriesImages(array('sAlbumLabel' => $a->label));
				
				if (isset($images[0])) $data["images"][$a->id][] = $images[0];
				if (isset($images[1])) $data["images"][$a->id][] = $images[1];
				if (isset($images[2])) $data["images"][$a->id][] = $images[2];
				if (isset($images[3])) $data["images"][$a->id][] = $images[3];
			}
		}
		
		$i = 0;
		foreach ($albums as $a)
		{
			if (!empty($data["images"][$a->id])) 
			{
				$data['albums'][$a->id] = $a;
				$i++;
			}
			
			if ($i >= $limit) break;
		}
		
        return $this->load->view('laseris/gallery/gallery_last', $data, TRUE);
    }
    
    
    public function news_last($limit = 1)
    {
        $this->load->model('laseris/news_model');
        
        $data['news']  = $this->news_model->getList(2, 0);
		
        return $this->load->view('laseris/news/last', $data, TRUE);
    }


}
