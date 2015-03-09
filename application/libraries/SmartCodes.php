<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SmartCodes
{
	public $data = array();


    public function __construct()
    {
        $this->load->helper('url');
        $this->config->load('templates');
    }

    
    public function __get($var)
    {
        return get_instance()->$var;
    }


    public function Parse($str)
    {
        $this->data = array();
        
        preg_match_all('/\[\[[^\[\]]*\]\]/i', $str, $matches);
        
        if (!empty($matches[0]))
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
                        
                        $str = str_replace($match, $new_str, $str);	
                        
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
            
        //return $str;
        $this->data['output'] = $str;
    }
    
    
    public function Gallery($sAlbumLabel)
    {
        $this->load->config('gallery');
        $this->load->model('gallery_model');
        
        $aGalleryConfig = $this->config->item('gallery');
        
        $data['home_folder'] = 'public/gallery';
        $data['preview_extension'] = $aGalleryConfig['image_preview_extension'];
        $data['preview_size'] = $aGalleryConfig['image_preview_size'][0];
        $data['album']['label'] = $sAlbumLabel;
        $data["images"] = $this->gallery_model->getFetchCountriesImages(array('sAlbumLabel' => $sAlbumLabel));
        
        
        //var_dump($this->gallery_model->data);
        
        
        //$result = array();
        
        //$result['output'] 	= $this->load->view('laseris/gallery/gallery_album', $data, TRUE);
        //$result['styles'] 	= $this->gallery_model->styles;
        //$result['scripts'] 	= $this->gallery_model->scripts;
        
        //return $result;
        
        //echo $this->gallery_model->styles;
        //var_dump($data);
        
        $this->data['images'] = array(); //пустой массив, указывающий вьюшке на наличие галереи на странице 
        
        return $this->load->view('laseris/gallery/gallery_album', $data, TRUE);
    }


}
