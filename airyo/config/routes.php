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
$route['registration'] = 'auth/create_user';
$route['logout'] = 'auth/logout';

//airyo pages
$route['pages'] = 'pages';
$route['pages/add'] = 'pages/add';
$route['pages/edit'] = 'pages/edit';
$route['pages/edit/(:num)'] = 'pages/edit/$1';
$route['pages/delete'] = 'pages/delete';

//airyo users (profile)
$route['users'] = 'users';
$route['users/(:num)'] = 'users';
$route['users/add'] = 'users/add';
$route['users/edit'] = 'users/edit';
$route['users/edit/(:num)'] = 'users/edit/$1';
$route['users/delete'] = 'users/delete';

//airyo menu
$route['menu'] = 'menu';
$route['menu/ajax_rebuild/(:num)'] = 'menu/ajax_rebuild/$1';
$route['menu/(:num)'] = 'menu/index/$1';
$route['menu/add'] = 'menu/add';
$route['menu/add/(:num)'] = 'menu/add/$1';
$route['menu/edit'] = 'menu/edit';
$route['menu/edit/(:num)'] = 'menu/edit/$1';
$route['menu/delete'] = 'menu/delete';

//airyo file manager
$route['files'] = 'files';
$route['files/dir'] = 'files';
$route['files/delete'] = 'files/delete';
$route['files/createfolder'] = 'files/createfolder';
$route['files/renamefolder'] = 'files/renamefolder';
$route['files/upload'] = 'files/upload';
$route['files/(:any)'] = 'files/index/$1';
$route['download'] = 'files/download';

//airyo gallery manager
$route['gallery'] = 'gallery';
$route['gallery/uploadimages'] = 'gallery/uploadimages';
$route['gallery/(album:any)/ajax-sorting'] = 'gallery/ajax_sorting/$1';
$route['gallery/(album:any)'] = 'gallery/getalbum/$1';
$route['gallery/createalbum'] = 'gallery/createalbum';
$route['gallery/editAlbum'] = 'gallery/editAlbum';
$route['gallery/edit/(album:any)'] = 'gallery/editDescriptionAlbum/$1';
$route['gallery/ajaxRemoveAlbum'] = 'gallery/ajaxRemoveAlbum';

//airyo news
$route['news'] = 'news';
$route['news/(:num)'] = 'news';
$route['news/edit'] = 'news/edit';
$route['news/edit/(:num)'] = 'news/edit/$1';
$route['news/delete'] = 'news/delete';

//airyo chunks
$route['chunks'] = 'chunks';
$route['chunks/(:num)'] = 'chunks';
$route['chunks/edit'] = 'chunks/edit';
$route['chunks/edit/(:num)'] = 'chunks/edit/$1';
$route['chunks/delete'] = 'chunks/delete';

//airyo counters
$route['counters'] = 'counters';





/* End of file routes.php */
/* Location: ./application/config/routes.php */