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

$route['default_controller'] = "home";

//Peticiones GET: utilizadas para la consulta de recursos, que pueden ser HTML, JSON, XML u otros formatos.
if ( $_SERVER['REQUEST_METHOD'] == 'GET' )
{
	//Admin
	$route['admin'] = 'crud/users';

	// Log
	$route['logout'] = 'site/logout';

	// Rutas Comunes:
	$route['ultimos'] = 'home/ultimos';
	$route['mejores'] = 'home/mejores';
	$route['aleatorios'] = 'home/aleatorios';
	$route['temas/(:any)'] = 'home/temas/$1';
	$route['ver_post/(:any)'] = "home/post/$1";
	
	// Rutas CRUD:
	// users
	$route['users'] = 'crud/users';
	$route['users/(:any)'] = "crud/users/$1";
	$route['user'] = 'crud/user';
	$route['user/(:any)'] = "crud/user/$1";
	$route['eliminaru/(:any)'] = "crud/eliminaru/$1";

	// Posts
	$route['posts'] = 'crud/posts';
	$route['posts/(:any)'] = "crud/posts/$1";
	$route['post'] = "crud/post";
	$route['post/(:any)'] = "crud/post/$1";
	$route['eliminarp/(:any)'] = "crud/eliminarp/$1";
	$route['guardarv/(:any)'] = "crud/guardarv/$1/$2";
	
	// Comentarios
	$route['comments'] = "crud/comments";
	$route['comments/(:any)'] = "crud/comments/$1";
	$route['comment'] = "crud/comment";
	$route['comment/(:any)'] = "crud/comment/$1";
	$route['comment_post'] = "home/post";
	$route['comment_post/(:any)'] = "home/post/S1";
	$route['eliminarc/(:any)'] = "crud/eliminarc/$1";

	// Tester
	$route['test'] = 'test/tester_home';
}
//Peticiones POST:  utilizadas para la creación de nuevos elementos (registro de un nuevo user, nuevo post, nuevo comentario, etc...)
else if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
	// Log
	$route['login'] = 'site/login';

	// Rutas CRUD:
	// Posts
	$route['post'] = 'crud/crear_post';
	$route['post/(:any)'] = "crud/editarp/$1";
	$route['ver_post/(:any)'] = "home/post_comment/$1";

	// users
	$route['user'] = 'crud/crear_user';
	$route['user/(:any)'] = "crud/editaru/$1";

	// Comments
	$route['comment/(:any)'] = "crud/editarc/$1";
	$route['comment'] = 'crud/crear_comment';	
}

$route['(:any)'] = "$1";


$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */