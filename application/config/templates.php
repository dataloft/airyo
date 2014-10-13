<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| MIME TYPES
| -------------------------------------------------------------------
| This file contains an array of mime types.  It is used by the
| Upload class to help identify allowed file types.
|
*/
$config['default_template'] = 'pages_1block';
$config['templates'] = array(
                'pages_default' => array(
                    'name' => 'Шаблон по умолчанию'
                ),
                'pages_1block' => array(
                    'name' => 'Текст и текст',
                    'fields' => array(
                        'content1' => array(
                            'type' => 'textarea',
                            'label' => 'h1',
                            'required' => '1',
                            'attributes' => array(
                                'rows' => '20',
                                'cols' => '10',
                            )
                        ),
                        'content2' => array(
                            'type' => 'text',
                            'label' => 'Какой-то текст',
                            'required' => '1',
                            'attributes' => array(
                                'placeholder' => 'Какой-то текст'
                            )
                        ),
                    )
                ),
                'gallery' => array(
                    'name' => 'Кртинка и текст',
                    'fields' => array(
                        'content1' => array(
                            'type' => 'textarea',
                            'label' => 'Текст',
                            'required' => '1',
                            'attributes' => array(
                                'rows' => '20',
                                'cols' => '10',
                            )
                        ),
                        'img' => array(
                            'type' => 'file',
                            'label' => 'Картинка',
                            'required' => '1',

                        ),
                    )
                ),
                'pages_menu' => array(
                    'name' => 'Меню',
                    'modules' => array(
                        'menu' => array(
                            'model' => 'menu_model',
                            'method' => array(
                                'name' => 'getList',
                                'params' => '1, true'
                            )
                        )
                    )
                ),
			);


/* End of file mimes.php */
/* Location: ./application/config/mimes.php */
