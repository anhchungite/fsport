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
$route['default_controller'] = 'Public_fsport/index';
$route['admin'] = 'admin/Admin_index/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Rewrite URL controller Register_fsport
$route['register'] = 'Register_fsport';
$route['register/register'] = 'Register_fsport/register';
$route['register/success'] = 'Register_fsport/success';
$route['register/verify-email'] = 'Register_fsport/verify_email';
$route['register/verify-email/(:any)'] = 'Register_fsport/verify_email/$1';

// Rewrite URL controller Login_fsport
$route['login'] = 'Login_fsport/index';
$route['login/login'] = 'Login_fsport/login';
$route['login/facebook'] = 'Login_fsport/facebook';
$route['login/google'] = 'Login_fsport/google';
$route['login/forgot-password'] = 'Login_fsport/forgot_password';
$route['login/reset-password'] = 'Login_fsport/reset_password';
$route['login/reset-password/(:any)'] = 'Login_fsport/reset_password/$1';
$route['login/success'] = 'Login_fsport/success';
$route['login/error'] = 'Login_fsport/error';
$route['login/logout'] = 'Login_fsport/logout';

// Rewrite URL controller Cart_fsport
$route['cart'] = 'Cart_fsport/index';
$route['cart/checkout'] = 'Cart_fsport/checkout';
$route['cart/order-info'] = 'Cart_fsport/order_info';
$route['cart/thankyou'] = 'Cart_fsport/thankyou';

// Rewrite URL controller Member_fsport
$route['member'] = 'Member_fsport/index';
$route['member/update-profile'] = 'Member_fsport/update_profile';
$route['member/change-password'] = 'Member_fsport/change_password';
$route['member/order-history'] = 'Member_fsport/order_history';
$route['member/order-detail/(:num)'] = 'Member_fsport/order_detail/$1';

// Search
$route['search'] = 'Public_fsport/search';

// Product
$route['(:any)-p(:num)'] = 'Public_fsport/detail/$2';