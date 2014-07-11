<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/
$adminObj = new Admin;
$adminObj->fnAdminLogin($_POST);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Admin Logon</title>
<link href="../css/admin_css.php" rel="stylesheet" type="text/css" />
<style type="text/css">
 <!--
#header {
	width: 1000px;
	height: 166px;
	display: block;
}
 -->
 </style>

</head>

<body>
<div id="header"><img src="/images/login_header.png" /></div>
<div style="width:480px;margin: 5px auto;" >
<form action="#" method="post" name="logon" id="logon">
<fieldset>
<legend>Admin Login</legend>
<div class="spacer">
<label for="username">Username:</label>
<input name="username" type="text" id="username" value="" size="35" />
<br />
<label for="password">Password:</label>
<input name="password" type="password" id="password" size="20" />
<br />
<label for="login">&nbsp;</label>
<input type="submit" value="login" id="login" name="login"/>
</div>
</fieldset>
</form>

<?php if (isset($_POST['login']) && $adminObj->fnAdminLogin($_POST) === false){?>
<div id="warning">Invalid login, please try again</div>
<script type="text/javascript">
// <![CDATA[
new Effect.Shake('logon');	// shake logon box
new Effect.Fade('warning',{delay: 3});	// fade out error msg
// ]]>
</script>
<?php } ?>
</div>
</body>
</html>
