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
$route['default_controller'] = 'pages/view';
$route['orders'] = 'orders/index';
$route['items'] = 'items/index';

$route['order/(:num)'] = 'orders/get_order_details/$1';
$route['order/(:num)/print'] = 'orders/get_order_details/$1/$2';
$route['orders/print_invoice/(:num)'] = 'orders/print_invoice/$1';
$route['order/(:num)/printinv'] = 'orders/print_invoice/$1/$2';

$route['invoice/(:num)'] = 'orders/view_invoice/$1';


$route['returns'] = 'returns/index';
$route['view/invoice/(:num)'] = 'orders/view_invoice/$1';
$route['view/order/(:num)'] = 'orders/view_order/$1';
$route['view/return/(:num)'] = 'returns/view_credit_note/$1';


// $route['neworder'] = 'orders/create_new_order';
$route['neworder'] = 'orders/crud_sales_order/New';
$route['neworder/(:num)/Edit'] = 'orders/crud_sales_order/Edit/$1';
$route['new_credit_note'] = 'returns/new_credit_note';
$route['itemsearch'] = 'items/item_search';
$route['customersearch'] = 'customers/client_search';
$route['print/(:num)'] = 'orders/print_order/$1';
$route['register'] = 'users_control/register';
$route['login'] = 'users_control/login';
$route['logout'] = 'users_control/logout';
$route['(:any)'] = 'pages/view/$1';
