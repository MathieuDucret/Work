<?php
function array_not_unique( $a = array() )
{
  return array_diff_key( $a , array_unique( $a ) );
}
require_once('../../../includes/inc.start.php');
if(!isset($_SESSION['admin']['user'])){
	require_once('templates/home/login_page.php');
	exit(0);
}
$newsObj = new Newsletter;
$type = mysql_real_escape_string($_POST['type']);
if($type=='newsletter')
{
	$recepient_list = $newsObj->SelectQuery("SELECT first_name,last_name,email FROM tbl_module_newsletter_users WHERE subscribe_status = '1'","master");
}
elseif($type=='client')
{
	$recepient_list = $newsObj->SelectQuery("SELECT first_name,last_name,email FROM tbl_clients WHERE subscribe_status = '1'","master");	
}
elseif($type=='both')
{
	$recepient_list = $newsObj->SelectQuery("(SELECT email FROM tbl_clients WHERE subscribe_status = '1') UNION (SELECT email FROM tbl_module_newsletter_users WHERE subscribe_status = '1')","master");
}
echo count($recepient_list).' Users';
?>
<div id="showUsers" class="clickMe">Click here to toggle user list</div>
<div style="display:none;font-size:14px;" id="userList">
<?php 
for($i=0;$i<count($recepient_list);$i++) 
{ ?>
	<div style="float:left;width:300px;"> <?php echo $recepient_list[$i]['email'];?></div> 
<?php  
}?>
	<div style="clear:both;">
</div>