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
$route['default_controller'] = 'home';


$route['forgot-password'] = "signin/forgot_password";
$route['verify-account/(:any)'] = "signup/verify_account/$1";
$route['verify-register-account/(:any)'] = "profile/verify_register_account/$1";
$route['reset-password/(:any)'] = "signin/reset_password/$1";
$route['inbound/thank-you'] = "inbound/thank_you";
$route['outbound/thank-you'] = "outbound/thank_you";
$route['my-booking'] = "My_booking/index";
$route['my-booking/details/(:any)'] = "My_booking/details/$1";
$route['my-booking/cancel/(:any)'] = "My_booking/cancel/$1";
$route['all-trips'] = "My_booking/all";
$route['all-trips'] = "My_booking/all";
$route['upcoming-trips'] = "My_booking/upcoming";
$route['cancel-trips'] = "My_booking/cancel";
$route['past-trips'] = "My_booking/past";
$route['change-password'] = "Profile/change_password";
$route['return'] = "Round/index";
$route['return/step2'] = "Round/step2";
$route['return/step3'] = "Round/step3";
$route['return/step4'] = "Round/step4";
$route['return/step5'] = "Round/step5";
$route['return/step6'] = "Round/step6";
$route['return/step7'] = "Round/step7";
$route['return/step8'] = "Round/step8";
$route['return/step9'] = "Round/step9";
$route['return/step10'] = "Round/step10";
$route['return/step11'] = "Round/step11";
$route['return/step12'] = "Round/step12";
$route['return/step13'] = "Round/step13";
$route['return/thank-you'] = "Round/thank_you";
$route['privacy-policy'] = "Privacy_policy/index";
$route['terms-condition'] = "Terms_condition/index";


$route['admin']        = "admin/login";
//$route['admin']        = "login";
$route['admin/users-flight-list/(:any)']        = "admin/users/view_flight_list/$1";
$route['admin/admin-maintenance']        = "admin/admin_maintenance";
$route['admin/admin-maintenance/add']        = "admin/admin_maintenance/add";
$route['admin/admin-maintenance/edit/(:any)']        = "admin/admin_maintenance/edit/$1";
$route['admin/admin-maintenance/change-password/(:any)']        = "admin/admin_maintenance/change_password/$1";
$route['admin/vehicle-type']        = "admin/vehicle_type";
$route['admin/vehicle-type/add']        = "admin/vehicle_type/add";
$route['admin/vehicle-type/edit/(:any)']        = "admin/vehicle_type/edit/$1";
$route['admin/price-management']        = "admin/price_management";
$route['admin/price-management/add']        = "admin/price_management/add";
$route['admin/price-management/edit/(:any)']        = "admin/price_management/edit/$1";
$route['admin/zone-management']        = "admin/zone_management";
$route['admin/(:any)'] = "admin/$1";
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
