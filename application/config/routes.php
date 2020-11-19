<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] 					= 'main';
$route['404_override'] 							= '';
$route['translate_uri_dashes'] 					= FALSE;

//อัพโหลดรูปภาพ
$route['ImageUpload'] 							= 'main/Uploadimage';

//สมัครสมาชิก
$route['InsertAndEditRegister'] 				= 'register/register/RegisterSystems';


//หน้าจอ - ข้อมูลหลัก
$route['main'] 									= 'main';
$route['Loadtable_package_mainpage']			= 'main/LoadtablePackage';

//หน้าจอ - ค้นหามัคคุเทศก์
$route['ResearchGuide'] 						= 'ResearchGuide/ResearchGuide/index';
$route['LoadtableGuide'] 						= 'ResearchGuide/ResearchGuide/LoadtableGuide';

//หน้าจอ - สมัครสมาชิก
$route['register'] 								= 'register/register/index';

//หน้าจอ - เข้าสู่ระบบ
$route['login'] 								= 'login/checklogin';

//หน้าจอ - ออกจากระบบ
$route['logout'] 								= 'login/logout';

//หน้าจอ - จัดการข้อมูล
$route['Backend'] 								= 'Backend/Backend/index';

//หน้าจอ - ข้อมูลส่วนตัว
$route['UpdateInformation'] 					= 'Information/Information/index';
$route['UpdateInformationAdmin'] 				= 'Information/Information/UpdateInformationAdmin';
$route['UpdateInformationCustomer'] 			= 'Information/Information/UpdateInformationCustomer';
$route['UpdateInformationGuide'] 				= 'Information/Information/UpdateInformationGuide';

//หน้าจอ - ข้อมูลผู้ดูแลระบบ
$route['Loadtable_Admin'] 						= 'ManageAdmin/ManageAdmin/Loadtable';
$route['PageInsOrEdit_Admin'] 					= 'ManageAdmin/ManageAdmin/PageInsoredit';
$route['EventInsOrEdit_Admin'] 					= 'ManageAdmin/ManageAdmin/EventInsoredit';
$route['EventDelete_Admin'] 					= 'ManageAdmin/ManageAdmin/EventDeleteAdmin';

//หน้าจอ - แพ็กเกจ
$route['Loadtable_package'] 					= 'Package/Package/Loadtable';
$route['PageInsOrEdit_package'] 				= 'Package/Package/PageInsoredit';
$route['EventInsOrEdit_package'] 				= 'Package/Package/EventInsoredit';
$route['EventDelete_package'] 					= 'Package/Package/EventDeletePackage';
$route['FileUpload']							= 'Package/Package/UploadFilePackage';

//หน้าจอ - กำหนดราคา
$route['Loadtable_rate'] 						= 'Guiderate/Guiderate/Loadtable';
$route['PageInsOrEdit_rate'] 					= 'Guiderate/Guiderate/PageInsoredit';
$route['EventInsOrEdit_rate'] 					= 'Guiderate/Guiderate/EventInsoredit';
$route['EventDelete_rate'] 						= 'Guiderate/Guiderate/EventDeleterate';

//หน้าจอ - ข้อมูลลูกค้า
$route['Loadtable_ManageCustomer'] 				= 'GuideManageCustomer/GuideManageCustomer/Loadtable';
$route['PageInsOrEdit_ManageCustomer'] 			= 'GuideManageCustomer/GuideManageCustomer/PageInsoredit';
$route['EventInsOrEdit_ManageCustomer'] 		= 'GuideManageCustomer/GuideManageCustomer/EventInsoredit';
$route['EventDelete_ManageCustomer'] 			= 'GuideManageCustomer/GuideManageCustomer/EventDeleteManageCustomer';

//หน้าจอ - ตารางงาน
$route['LoadCalendar'] 							= 'Calendar/Calendar/index';





