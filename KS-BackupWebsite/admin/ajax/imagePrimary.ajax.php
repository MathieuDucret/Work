<?php
/*var_dump($_GET);
var_dump($_POST);
var_dump($_FILES);*/
require_once('../../includes/inc.start.php');
if(!isset($_SESSION['admin']['user'])){
	require_once('templates/home/login_page.php');
	exit(0);
}
$dbObj = new DataBase;
if(isset($_POST['id']))
{
	$data = $dbObj->SelectQuery("SELECT property_id FROM tbl_estateagent_property_image_data WHERE id = '".$_POST['id']."' LIMIT 0,1","master");
	$removePrimary = $dbObj->ExecQuery("UPDATE tbl_estateagent_property_image_data SET `primary` = '0' WHERE property_id = '".$data[0]['property_id']."'","master");
	$updatePrimary = $dbObj->ExecQuery("UPDATE tbl_estateagent_property_image_data SET `primary` = '1' WHERE id = '".mysql_real_escape_string($_POST['id'])."'","master");
	if($updatePrimary && $removePrimary)
	{
		echo 'Image has been set as primary';
	}
	else
	{
		echo 'There was a problem changing the primary image. It has not been changed. ';
	}
}

?>