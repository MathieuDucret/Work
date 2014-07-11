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

class UploadFileXhr {
	function save($path){
		$input = fopen("php://input", "r");
		$fp = fopen($path, "w");
		while ($data = fread($input, 1024)){
			fwrite($fp,$data);
		}
		fclose($fp);
		fclose($input);			
		if(file_exists($path))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function getName(){
		return $_GET['qqfile'];
	}
}


if (isset($_GET['qqfile']))
{
	$file = new UploadFileXhr();
	$pathinfo = pathinfo($file->getName());
	$filename = $pathinfo['filename'];			
	$ext = $pathinfo['extension'];
	$path = COMMON_ROOT.'estate_agent'.SEPARATOR.'property_plans'.SEPARATOR.'preprocessed_images'.SEPARATOR.$filename . '.' . $ext;
	if($file->save($path))
	{
		$name = $_GET['property_id'].'_'.$_GET['qqfile'].rand(100000,999999);
		$handlerObj = new Handler;
		$handlerObj->uploadPropertyImage($path,COMMON_ROOT.'estate_agent'.SEPARATOR.'property_plans'.SEPARATOR,$name);	
		$new_name = $handlerObj->file_dst_name;
		$insert = $dbObj->InsertQuery("INSERT INTO tbl_estateagent_property_floorplan_data (property_id, location) VALUES ('".mysql_real_escape_string($_GET['property_id'])."', '".$new_name."')","master");
		$result = array('success'=>true,'file_name'=>$new_name,'image_id'=>$insert);
	}
	else
	{
		$result = array('success'=>false,'error'=>'File has not been uploaded');
	}
}
elseif(is_array($_FILES['qqfile']))
{
	$name = $_GET['property_id'].'_'.$_GET['qqfile'].rand(100000,999999);
	$handlerObj = new Handler;							
	$handlerObj->uploadPropertyImage($_FILES['qqfile'],COMMON_ROOT.'estate_agent'.SEPARATOR.'property_plans'.SEPARATOR,$name);										
	$new_name = $handlerObj->file_dst_name;	
	$insert = $dbObj->InsertQuery("INSERT INTO tbl_estateagent_property_floorplan_data (property_id, location) VALUES ('".mysql_real_escape_string($_GET['property_id'])."', '".$new_name."')","master");
	if(isset($new_name))
	{
		$result = array('success'=>true,'file_name'=>$new_name);
	}
	else
	{
		$result = array('success'=>false, 'error'=>"File is empty.");
	}
} 
else 
{
	$result =  array('success'=>false);
}

// to pass data through iframe you will need to encode all html tags
echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
?>
