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
	$imageData = $dbObj->SelectQuery("SELECT id,location FROM tbl_estateagent_property_floorplan_data WHERE id = '".mysql_real_escape_string($_POST['id'])."'","master");
	
	$deleteImage = $dbObj->ExecQuery("DELETE FROM tbl_estateagent_property_floorplan_data WHERE id = '".$imageData[0]['id']."'","master");
	$deleteFile = unlink(COMMON_ROOT.'estate_agent'.SEPARATOR.'floorplan_images'.SEPARATOR.'thumbnail'.SEPARATOR.$imageData[0]['location']);
	$deleteFile = unlink(COMMON_ROOT.'estate_agent'.SEPARATOR.'floorplan_images'.SEPARATOR.'normal'.SEPARATOR.$imageData[0]['location']);
	$deleteFile = unlink(COMMON_ROOT.'estate_agent'.SEPARATOR.'floorplan_images'.SEPARATOR.'small'.SEPARATOR.$imageData[0]['location']);
	$deleteFile = unlink(COMMON_ROOT.'estate_agent'.SEPARATOR.'floorplan_images'.SEPARATOR.'hot'.SEPARATOR.$imageData[0]['location']);
	$deleteFile = unlink(COMMON_ROOT.'estate_agent'.SEPARATOR.'floorplan_images'.SEPARATOR.'original'.SEPARATOR.$imageData[0]['location']);
	$deleteFile = unlink(COMMON_ROOT.'estate_agent'.SEPARATOR.'floorplan_images'.SEPARATOR.'medium'.SEPARATOR.$imageData[0]['location']);
	$deleteFile = unlink(COMMON_ROOT.'estate_agent'.SEPARATOR.'floorplan_images'.SEPARATOR.'large'.SEPARATOR.$imageData[0]['location']);
	if($deleteImage)
	{
		echo 'Floorplan deleted';
	}
	else
	{
		echo 'There was a problem deleting your floorplan. Your floorplan has not been deleted. ';
	}
}

?>