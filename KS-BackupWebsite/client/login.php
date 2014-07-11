<?php
$this->display_mode='exnteded';
?>
<div id="center_content">
<?php
$errmsg = '';
if($_POST['submit']=='Login')
{
	$clientObj = new Client;
	$errmsg = $clientObj->checkLogin($_POST);
}
if($errmsg != '') 
{?>
	<div class="errmsg"><?php echo $errmsg;?></div>
<?php
}?>
   <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #CCC; margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #CCC;">
		<h1>Login</h1>
			<form name="clientLogin" action="/client/login" method="post">
            <input type="hidden" name="hidden" value="1" />
            <table width="100%">
            <tbody>
            <tr>
				<td colspan="2"></td>
            </tr>
			<tr>
                <td>Username</td>
				<td><input style="width: 200px; height: 25px; margin-bottom: 10px;" type="text" value="Username" onfocus="this.value=''" name="username" /></td></tr>
				<tr>
                <td>Password</td>
                <td><input style="width: 200px; height: 25px;" type="password" value="Password"  onfocus="this.value=''" name="password" /></td>
                </tr>
                <tr>
                <td></td>
				<td><input type="submit" name="submit" value="Login" /></td>
                
                </tr>
                </tbody>
                </table>
				</form>
	</div>
<?php 
include(COMMON_ROOT.'client/forgotten_password.php');?>
<br />
<?php echo $content;?>
</div>
