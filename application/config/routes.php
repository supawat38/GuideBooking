<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] 					= 'main';
$route['404_override'] 							= '';
$route['translate_uri_dashes'] 					= FALSE;

$route['main'] 									= 'main';
$route['register'] 								= 'register/register/index';
$route['login'] 								= 'login/checklogin';
$route['logout'] 								= 'login/logout';

//อัพโหลดรูปภาพ
$route['ImageUpload'] 							= 'main/Uploadimage';
$route['InsertAndEditRegister'] 				= 'register/register/RegisterSystems';

//จัดการข้อมูล
$route['UpdateInformation'] 					= 'Information/Information/index';

//ผู้ดูแลระบบ
$route['ManageAdmin'] 							= 'ManageAdmin/ManageAdmin/index';
$route['Loadtable_Admin'] 						= 'ManageAdmin/ManageAdmin/Loadtable';
$route['PageInsOrEdit_Admin'] 					= 'ManageAdmin/ManageAdmin/PageInsoredit';
$route['EventInsOrEdit_Admin'] 					= 'ManageAdmin/ManageAdmin/EventInsoredit';


