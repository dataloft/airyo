<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| MIME TYPES
| -------------------------------------------------------------------
| This file contains an array of mime types.  It is used by the
| Upload class to help identify allowed file types.
|
*/

$config['not_allowed_mimes'] = array(
                //'hqx'	=>	'application/mac-binhex40',
//				'cpt'	=>	'application/mac-compactpro',
//				'csv'	=>	'text/x-comma-separated-values',
//                'csv2'  =>  'text/comma-separated-values',
//                'csv3'  =>  'application/octet-stream',
//                'csv4'  =>  'application/vnd.ms-excel',
//                'csv5'  =>  'application/x-csv',
//                'csv6'  =>  'text/x-csv',
//                'csv7'  =>  'text/csv',
//                'csv8'  =>  'application/csv',
//                'csv9'  =>  'application/excel',
//                'csv10' =>  'application/vnd.msexcel',
//				'bin'	=>	'application/macbinary',
//				'dms'	=>	'application/octet-stream',
//				'lha'	=>	'application/octet-stream',
//				'lzh'	=>	'application/octet-stream',
//				'exe'	=>	'application/octet-stream',
//                'exe1'  =>  'application/x-msdownload',
//				'class'	=>	'application/octet-stream',
//				'psd'	=>	'application/x-photoshop',
//				'so'	=>	'application/octet-stream',
//				'sea'	=>	'application/octet-stream',
//				'dll'	=>	'application/octet-stream',
//				'oda'	=>	'application/oda',
//				'pdf'	=>	'application/pdf',
//                'pdf'   =>  'application/x-download',
//				'ai'	=>	'application/postscript',
//				'eps'	=>	'application/postscript',
//				'ps'	=>	'application/postscript',
//				'smi'	=>	'application/smil',
//				'smil'	=>	'application/smil',
//				'mif'	=>	'application/vnd.mif',
//				'xls'	=>	'application/excel',
//				'xls2'	=>	'application/vnd.ms-excel',
//				'xls3'	=>	'application/msexcel',
//				'ppt'	=>	'application/powerpoint',
//                'ppt2'   =>  'application/vnd.ms-powerpoint',
//				'wbxml'	=>	'application/wbxml',
//				'wmlc'	=>	'application/wmlc',
//				'dcr'	=>	'application/x-director',
//				'dir'	=>	'application/x-director',
//				'dxr'	=>	'application/x-director',
//				'dvi'	=>	'application/x-dvi',
//				'gtar'	=>	'application/x-gtar',
//				'gz'	=>	'application/x-gzip',
//				'php'	=>	'application/x-httpd-php',
//				'php4'	=>	'application/x-httpd-php',
//				'php3'	=>	'application/x-httpd-php',
//				'phtml'	=>	'application/x-httpd-php',
//				'phps'	=>	'application/x-httpd-php-source',
//				'js'	=>	'application/x-javascript',
//				'swf'	=>	'application/x-shockwave-flash',
//				'sit'	=>	'application/x-stuffit',
//				'tar'	=>	'application/x-tar',
//				'tgz'	=>	'application/x-tar',
//				'tgz2'	=>	'application/x-gzip-compressed',
//				'xhtml'	=>	'application/xhtml+xml',
//				'xht'	=>	'application/xhtml+xml',
//				'zip'	=>  'application/x-zip',
//				'zip2'	=> 'application/zip',
//				'zip3'	=>  'application/x-zip-compressed',
//				'mid'	=>	'audio/midi',
//				'midi'	=>	'audio/midi',
//				'mpga'	=>	'audio/mpeg',
//				'mp2'	=>	'audio/mpeg',
//				'mp31'	=>	'audio/mpeg',
//				'mp32'	=>	'audio/mpg',
//				'mp33'	=>	'audio/mpeg3',
//				'mp34'	=>	'audio/mp3',
//				'aif'	=>	'audio/x-aiff',
//				'aiff'	=>	'audio/x-aiff',
//				'aifc'	=>	'audio/x-aiff',
//				'ram'	=>	'audio/x-pn-realaudio',
//				'rm'	=>	'audio/x-pn-realaudio',
//				'rpm'	=>	'audio/x-pn-realaudio-plugin',
//				'ra'	=>	'audio/x-realaudio',
//				'rv'	=>	'video/vnd.rn-realvideo',
//				'wav'	=>	'audio/x-wav',
//				'wav2'	=>	'audio/wave',
//				'wav3'	=>	'audio/wav',
//				'bmp'	=>	'image/bmp',
//				'bmp1'	=>	'image/x-windows-bmp',
//				'gif'	=>	'image/gif',
//				'jpeg'	=>	'image/jpeg',
//				'jpg'	=>	'image/pjpeg',
//				'png'	=>	'image/png',
//				'png2'	=>	'image/x-png',
//				'tiff'	=>	'image/tiff',
//				'tif'	=>	'image/tiff',
//				'css'	=>	'text/css',
//				'html'	=>	'text/html',
//				'htm'	=>	'text/html',
//				'shtml'	=>	'text/html',
//				'txt'	=>	'text/plain',
//				'text'	=>	'text/plain',
//				'log'	=>	'text/plain',
//				'log2'	=>	'text/x-log',
//				'rtx'	=>	'text/richtext',
//				'rtf'	=>	'text/rtf',
//				'xml'	=>	'text/xml',
//				'xsl'	=>	'text/xml',
//				'mpeg'	=>	'video/mpeg',
//				'mpg'	=>	'video/mpeg',
//				'mpe'	=>	'video/mpeg',
//				'qt'	=>	'video/quicktime',
//				'mov'	=>	'video/quicktime',
//				'avi'	=>	'video/x-msvideo',
//				'movie'	=>	'video/x-sgi-movie',
//				'doc'	=>	'application/msword',
//				'docx'	=>	'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
//				'docx2'	=>	'application/zip',
//				'xlsx'	=>	'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
//				'word'	=>	'application/msword',
//				'word2'	=>	'application/octet-stream',
//				'xl'	=>	'application/excel',
//				'eml'	=>	'message/rfc822',
//				'json' => 'application/json',
//				'json2' => 'text/json'
			);


/* End of file mimes.php */
/* Location: ./application/config/mimes.php */
