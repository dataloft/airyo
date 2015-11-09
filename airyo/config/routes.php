<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/




$route['404_override'] = '';
$route['default_controller'] = 'pages';


//Admin Routes:

//airyo
$route[$this->config->item('auth')] = 'auth/login';
//$route[''] = 'auth/login';
$route['airyo/registration'] = 'auth/create_user';
$route['airyo/logout'] = 'auth/logout';

//airyo pages
$route['airyo/pages'] = 'pages';
$route['airyo/pages/edit'] = 'pages/edit';
$route['airyo/pages/edit/(:num)'] = 'pages/edit/$1';
$route['airyo/pages/delete'] = 'pages/delete';

//airyo users (profile)
$route['airyo/users'] = 'users';
$route['airyo/users/(:num)'] = 'users';
$route['airyo/users/add'] = 'users/add';
$route['airyo/users/edit'] = 'users/edit';
$route['airyo/users/edit/(:num)'] = 'users/edit/$1';
$route['airyo/users/delete'] = 'users/delete';

//airyo menu
$route['airyo/menu'] = 'menu';
$route['airyo/menu/ajax_rebuild/(:num)'] = 'menu/ajax_rebuild/$1';
$route['airyo/menu/(:num)'] = 'menu/index/$1';
$route['airyo/menu/add'] = 'menu/add';
$route['airyo/menu/add/(:num)'] = 'menu/add/$1';
$route['airyo/menu/edit'] = 'menu/edit';
$route['airyo/menu/edit/(:num)'] = 'menu/edit/$1';
$route['airyo/menu/delete'] = 'menu/delete';

//airyo file manager
$route['airyo/files'] = 'files';
$route['airyo/files/dir'] = 'files';
$route['airyo/files/delete'] = 'files/delete';
$route['airyo/files/createfolder'] = 'files/createfolder';
$route['airyo/files/renamefolder'] = 'files/renamefolder';
$route['airyo/files/upload'] = 'files/upload';
$route['airyo/files/(:any)'] = 'files/index/$1';
$route['airyo/download'] = 'files/download';

//airyo gallery manager
$route['airyo/gallery'] = 'gallery';
$route['airyo/gallery/uploadimages'] = 'gallery/uploadimages';
$route['airyo/gallery/(album:any)/ajax-sorting'] = 'gallery/ajax_sorting/$1';
$route['airyo/gallery/(album:any)'] = 'gallery/getalbum/$1';
$route['airyo/gallery/createalbum'] = 'gallery/createalbum';
$route['airyo/gallery/editAlbum'] = 'gallery/editAlbum';
$route['airyo/gallery/edit/(album:any)'] = 'gallery/editDescriptionAlbum/$1';
$route['airyo/gallery/ajaxRemoveAlbum'] = 'gallery/ajaxRemoveAlbum';

//airyo sliders manager
$route['airyo/sliders'] = 'sliders/sliders';
$route['airyo/sliders/edit/(:num)'] = 'sliders/edit/$1';
$route['airyo/sliders/sort'] = 'sliders/sort';
$route['airyo/sliders/uploadimages'] = 'sliders/upload_images';

//airyo news
$route['airyo/news'] = 'news';
$route['airyo/news/(:num)'] = 'news';
$route['airyo/news/edit'] = 'news/edit';
$route['airyo/news/edit/(:num)'] = 'news/edit/$1';
$route['airyo/news/delete'] = 'news/delete';

//airyo chunks
$route['airyo/chunks'] = 'chunks';
$route['airyo/chunks/(:num)'] = 'chunks';
$route['airyo/chunks/edit'] = 'chunks/edit';
$route['airyo/chunks/edit/(:num)'] = 'chunks/edit/$1';
$route['airyo/chunks/delete'] = 'chunks/delete';

//airyo counters
$route['airyo/counters'] = 'counters';





/* End of file routes.php */
/* Location: ./application/config/routes.php */