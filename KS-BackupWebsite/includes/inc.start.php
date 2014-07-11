<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0.2
* Comments - 
* 1.0.1 Added AdminLayout class  and moved code to this class from Layout
* 1.0.2 Altered includes to not include optional modules
*****************************************/
ini_set('display_errors',0);

session_start();
$starttime = microtime();
$startarray = explode(" ", $starttime);
$starttime = $startarray[1] + $startarray[0];

require_once("inc.functions.php");
require_once("inc.constants.php");
require_once("inc.db.php");
require_once(COMMON_ROOT."/classes/DataBase.class.php");
ob_start();
includeClasses();



$extendObj = new Extender;
$extendObj->process('constants');
foreach($extendObj->resultArray as $key=>$val)
{	
	define($key,$val);
}
ob_end_clean();

$callbackObj = callbackHandler::getInstance();

ob_start(array($callbackObj, 'ajaxCallback'));

set_time_limit(0);

ini_set("session.cache_limiter","");
ini_set("allow_url_include", "0");
ini_set("memory_limit", "256M");
$now = gmdate('D, d M Y H:i:s') . ' GMT';
header( 'Content-Type: text/html; charset=utf-8' );
header('Expires: 0'); // rfc2616 - Section 14.21
header('Last-Modified: ' . $now);
header('Cache-Control: no-store, no-cache, must-revalidate'); // HTTP/1.1 
header('Cache-Control: pre-check=0, post-check=0, max-age=0'); // HTTP/1.1 header('Pragma: no-cache'); // HTTP/1.0

//include all the classes

?>