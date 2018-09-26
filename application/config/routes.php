<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'site'; // Si aucun param étre n’est donn é, c’est
// la route qui sera utilis ée. Il n’est pas né cessaire d’indiquer la mé thode ’index () ’ c’est celle qui est appelée par dé faut
//$route ["(: any )"] = "site /$1 "; 
//// si un seul param étre est donn é, il sera utilis é comme mé thode du contr ô leur site . Cela permettra de cacher ce dernier dans les adresses
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;







//=================================================================
//route example: http://domain.tld/en/controller => http://domain.tld/controller
//si vous souhaitez ajouter une nouvelle route, il faudra l’ajouter avant ces dernières et tenir compte de la langue. Exemple:
//$route['\w{2}/article/(:num)'] = 'article/afficher/$1';

$route['(\w{2})/(.*)'] = '$2';
$route['(\w{2})'] = $route['default_controller'];