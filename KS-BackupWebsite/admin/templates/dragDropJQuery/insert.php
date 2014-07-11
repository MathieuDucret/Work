
<?php
echo "insert Called";
var_dump($_POST);

$groupid = explode('_', $_POST['groupid']);
$userid = explode('_', $_POST['userid']);

echo "UPDATE tbl_admins set admingroup='".$groupid[1]."' where id='".$userid[1]."'";
//exit(0);
$dbObj = new DataBase;
$update = $dbObj->SelectQuery("UPDATE tbl_admins set admingroup='".$groupid[1]."' where id='".$userid[1]."'", "master");

		if (isset($update))
		{
			echo "Successful update";
		}
		else
		{
		echo "Update failed";
		}

$returnedMsg = "balle";
return $returnedMsg;

?>