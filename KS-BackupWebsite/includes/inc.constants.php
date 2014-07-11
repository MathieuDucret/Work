<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/
//SHOP SETTINGS
define("CURRENCY_ENTITY",'&pound;');
define("SITE_ADMIN_URL", "http://".$_SERVER['HTTP_HOST']."/administrator");
define("SITE_URL","http://".$_SERVER['HTTP_HOST'].'');
define("SITE_DAN_URL",$_SERVER['HTTP_HOST']);
define("SITE_TITLE",":: ".$_SERVER['HTTP_HOST']." ::");
define("SITE_IMAGES",$_SERVER['HTTP_HOST']);

define ("ADMIN_ROOT", getDir(__FILE__));
define ("COMMON_ROOT", getDir(__FILE__));
define ("SEPARATOR" , getSeparator());
define ("UPLOADED_IMAGES", COMMON_ROOT.'site_images'.SEPARATOR);
define("SSL_SITE_ADMIN_URL","http://".$_SERVER['HTTP_HOST']."/administrator");
define("SSL_SITE_URL","http://".$_SERVER['HTTP_HOST']);

$get_domain = getTLDDomain('http://'.$_SERVER['HTTP_HOST']);

define("SITE_DOMAIN",$get_domain);
define("SITE_TLD",getdomain($_SERVER['HTTP_HOST']));
define ("ADMIN_TITLE", $_SERVER['HTTP_HOST']." Admin Panel");
define ("METAEDITOR","metaeditor");
$url = $_SERVER['HTTP_HOST']; 
ini_set("session.cookie_domain", ".".SITE_TLD);

$months = array("jan"=>"January",
				"feb"=>"February",
				"mar"=>"March",
				"apr"=>"April",
				"may"=>"May",
				"jun"=>"June",
				"jul"=>"July",
				"aug"=>"August",
				"sep"=>"Sepetember",
				"oct"=>"October",
				"nov"=>"November",
				"dec"=>"December");

$arrMonth = array("01"=>"January",
				"02"=>"February",
				"03"=>"March",
				"04"=>"April",
				"05"=>"May",
				"06"=>"June",
				"07"=>"July",
				"08"=>"August",
				"09"=>"Sepetember",
				"10"=>"October",
				"11"=>"November",
				"12"=>"December");
?>
