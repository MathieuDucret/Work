<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/
require_once('../../includes/inc.start.php');
if(!isset($_SESSION['admin'])){
	require_once('../templates/home/login_page.php');
	exit(0);
}
$dbObj = new DataBase;
$data = $dbObj->SelectQuery("SELECT * FROM tbl_pages_archive WHERE id = '".mysql_real_escape_string($_GET['id'])."'","master");
?>
<div id="archive_pane">
	<textarea class="editor" name="archive_content"><?php echo $data[0]['page_content'];?></textarea>
</div>