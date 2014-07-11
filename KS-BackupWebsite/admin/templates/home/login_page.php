<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/
$adminObj = new Admin;
if(isset($_POST['username']))
{
	$login = $adminObj->fnAdminLogin($_POST);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Admin Logon</title>
<link href="/css/styles.css" rel="stylesheet" type="text/css" />
<link href="/css/admin_css.php" rel="stylesheet" type="text/css" />
<script language="JavaScript1.2" src="/js/prototype.js" type="text/javascript"></script>
<script language="JavaScript1.2" src="/js/effects.js" type="text/javascript"></script>

<style type="text/css">
 <!--
#header {
	width: 1000px;
	height: 166px;
	margin: 0px;
	padding: 0px;
}
#header img {
	margin: 0px;
	padding: 0px;
}
#container {
	background-image: url(/images/login_bg.png);
	background-repeat: repeat-x;
}
#wrapper {
	width: 1000px;
}
 -->
 </style>

</head>

<body>
<div id="container">
<div id="wrapper">
<div id="header"><img src="/images/login_header.png" /></div>
<div style="width:480px;margin: 5px auto;" >
<table>
<form action="" method="post" name="logon" id="logon">
<tr colspan="2">
<td><span style="text-transform: uppercase; letter-spacing: 0.5px; font-weight: bold;">Admin Login</span><br /><br /></td>
</tr>
<tr>
</tr>
<tr>
<td><span style="text-transform: uppercase; letter-spacing: 0.5px;">Username:</span></td>
<td><input name="username" type="text" id="username" value="" style="width:200px;" /></td>
<tr>
<td><span style="text-transform: uppercase; letter-spacing: 0.5px;">Password:</span></td>
<td><input name="password" type="password" id="password" style="width:200px;" /></td>

<tr>
<td>&nbsp;</td>
<td><input style="outline: 0px;" src="/images/login.png" type="image" value="login" id="login" name="login"/></td>
</tr>
</table>


</form>

<?php if (isset($_POST['login']) && $login === false){?>
<div id="warning">Invalid login, please try again</div>
<script type="text/javascript">
// <![CDATA[
new Effect.Shake('logon');	// shake logon box
new Effect.Fade('warning',{delay: 3});	// fade out error msg
// ]]>
</script>
<?php } ?>
</div>
</div>
</div>
</body>
</html>
