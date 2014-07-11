<?php
require_once('../../../includes/inc.start.php');
if(!isset($_SESSION['admin']['user'])){
	require_once('templates/home/login_page.php');
	exit(0);
}
$newsObj = new Newsletter;
$type = mysql_real_escape_string($_POST['type']);
$recipient_list = $newsObj->SelectQuery("SELECT * FROM tbl_module_newsletter_queue WHERE mail_status = '0'","master");
?>
<?php echo count($recipient_list).' users in mail queue';?>
<div id="showListQueue" class="clickMe">Click here to show all users in queue</div>
<div style="font-size:14px;border:1px solid #000;" id="userListQueue">
	<?php for($i=0;$i<count($recipient_list);$i++) { ?><div style="float:left;width:300px;"><?php echo $recipient_list[$i]['email'];?></div><?php  }?>
	<div style="clear:both;">
</div>