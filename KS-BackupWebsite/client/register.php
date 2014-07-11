<?php
 if($_SESSION['client']['user_id'])
 {?>
 	<div id="center_content">
	 	<div><h1>Already logged in</h1><p>You are already logged in to a candidate or client account. If you wish to login as another user, please <a href="/client/logout">logout</a> and login again.</p></div>
	</div>        
	<?php
 }
 else
 {?>
 <div id="center_content">
<div id="register">
<h1>Company Register</h1>
<?php 
if(isset($_SESSION['client']['user_id']))
{
?>
<?php /*?><div id="logout">
	<p>You are currently logged in, <a href="/shop/logout">Click here to logout</a></p></div><?php */?>
<?php
}
else
{
	$clientObj = new Client;
	$formObj = new formCreator;
	$errmsg = '';
	if($_POST['submit']=='Register')
	{
		$registerUser = $clientObj->registerUser($_POST);
		$errmsg = $registerUser;
	}
	if($errmsg!='')
	{
		echo '<div id="errmsg">'.$errmsg.'</div>';
	}
	$formObj->formNew('clientRegister','/client/register');
	$formObj->formtextRow('Username', 'username', $_POST['username']);
	$formObj->formtextRow('Company name', 'company', $_POST['company']);
	//Address
	$formObj->formtextRow('Phone', 'phone', $_POST['phone']);
	$formObj->formtextRow('Email', 'email', $_POST['email']);
	$formObj->formtextRow('Sector', 'sector', $_POST['sector']);
	
	$formObj->formtextRow('Nature of Business', 'nature_business', $_POST['nature_business']);
	$formObj->formtextRow('No. Employees', 'employees', $_POST['employees']);
	$formObj->formtextRow('No. Sites', 'sites', $_POST['sites']);	
	?>                               
<?php
$formObj->formtextAreaRow('Additional Comments','additional_comments',$_POST['additional_comments'],6,40);
?>
	<tr>
		<td>Password</td>
		<td><input id="password" type="password" name="password" value="<?php echo $_POST['password'];?>"  /></td>
	</tr>
	<tr>
		<td>Confirm Password</td>
		<td><input id="confirm_password" type="password" name="confirm_password" value="<?php echo $_POST['confirm_password'];?>"  /></td>
	</tr>     
	<?php
	$formObj->formSubmit('','Register');
}
	?>
	</div>
<?php
include(COMMON_ROOT.'client/login.php');
?>
<div id="register_bottom">&nbsp;</div>
</div>    
<?php
 }?>