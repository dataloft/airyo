<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SmartCodes
{

    public function __construct()
    {
        $this->load->helper('url');
        $this->config->load('templates');


    }

    public function __call($method, $arguments)
    {
        if (!method_exists( $this->ion_auth_model, $method) )
        {
            throw new Exception('Undefined method Ion_auth::' . $method . '() called');
        }

        return call_user_func_array( array($this->ion_auth_model, $method), $arguments);
    }

    /**
     * __get
     *
     * Enables the use of CI super-global without having to define an extra variable.
     *
     * I can't remember where I first saw this, so thank you if you are the original author. -Militis
     *
     * @access	public
     * @param	$var
     * @return	mixed
     */
    public function __get($var)
    {
        return get_instance()->$var;
    }

    public function parseString ($str)
    {
        preg_match_all('/\[\[[^\[\]]*\]\]/i',$str,$matches);
        if (!empty($matches[0]))
            foreach($matches[0] as $match)
            {
                $string = preg_replace(array('/\[/i','/\]/i'),'',$match);
                $data_arr = explode(':',$string);
                if (!empty($data_arr))
                {
                    if (method_exists($this, $data_arr[0]))
                    {
                        if (count($data_arr) > 1)
                        {
                            $params = explode(';',$data_arr[1]);
                            $new_str =  call_user_func_array(array($this, $data_arr[0]), $params);
                        }
                        else
                            $new_str =  $this->{$data_arr[0]}();
                        $str = str_replace($match, $new_str, $str);

                    }
                }
            }
        return $str;
    }
    public function counters($p1='', $p2='')    //changed $email to $identity
    {
        $this->load->model('counters_model');
        $data['counters'] = $this->counters_model->getCounters($p1, $p2);
        return $this->load->view('startbootstrap/counters/counters', $data, TRUE);
    }


}
