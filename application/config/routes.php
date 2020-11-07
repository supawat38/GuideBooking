<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] 					= 'main';
$route['404_override'] 							= '';
$route['translate_uri_dashes'] 					= FALSE;


//อัพโหลดรูปภาพ
$route['ImageUpload'] 							= 'main/Uploadimage';
$route['InsertAndEditRegister'] 				= 'register/register/RegisterSystems';

//หน้าจอ - ข้อมูลหลัก
$route['main'] 									= 'main';

//หน้าจอ - สมัครสมาชิก
$route['register'] 								= 'register/register/index';

//หน้าจอ - เข้าสู่ระบบ
$route['login'] 								= 'login/checklogin';

//หน้าจอ - ออกจากระบบ
$route['logout'] 								= 'login/logout';

//หน้าจอ - ข้อมูลส่วนตัว
$route['UpdateInformation'] 					= 'Information/Information/index';
$route['UpdateInformationAdmin'] 				= 'Information/Information/UpdateInformationAdmin';
$route['UpdateInformationCustomer'] 			= 'Information/Information/UpdateInformationCustomer';
$route['UpdateInformationGuide'] 				= 'Information/Information/UpdateInformationGuide';

//หน้าจอ - ข้อมูลผู้ดูแลระบบ
$route['ManageAdmin'] 							= 'ManageAdmin/ManageAdmin/index';
$route['Loadtable_Admin'] 						= 'ManageAdmin/ManageAdmin/Loadtable';
$route['PageInsOrEdit_Admin'] 					= 'ManageAdmin/ManageAdmin/PageInsoredit';
$route['EventInsOrEdit_Admin'] 					= 'ManageAdmin/ManageAdmin/EventInsoredit';


