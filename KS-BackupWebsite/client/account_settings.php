<style type="text/css">
#clientRegister {
	font-family:"Courier New", Courier, monospace;
	font-size:14px;
	width: 500px;
}
input#title {
	
	height: 20px;
	width: 220px;
}
input#first_name {
	
	height: 20px;
	width: 220px;
}
input#last_name {
	
	height: 20px;
	width: 220px;
}
input#email {
	
	height: 20px;
	width: 220px;
}
input#company {
	
	height: 20px;
	width: 220px;
}
input#username {
	
	height: 20px;
	width: 220px;
}
input#password {
	
	height: 20px;
	width: 220px;
}
input#confirm_password {
	
	height: 20px;
	width: 220px;
}
#account_details_right {
	width: 400px;
	float: right;
}
#account_details_right p {
	font-family:"Courier New", Courier, monospace;
	font-size:14px;
	color: #CC6666;
}
#account_details_right p a {
	font-family:"Courier New", Courier, monospace;
	font-size:18px;
	color: #CC6666;
}
#account_details_right p a:hover {
	text-decoration: underline;
}
</style>
<h1>Account Details</h1>
<div id="account_details_right">
<p><a href="/shop/order_history">View Order History</a></p>
<p><a href="/shop/address_book">View Address Book</a></p>
</div>
<div style="float: left;">
<?php
$clientObj = new Client;
$clientObj->checkSession();
$formObj = new formCreator;
$userData = $clientObj->SelectQuery("SELECT * FROM tbl_clients WHERE id = '".$_SESSION['client']['user_id']."'","master");
if(isset($_POST['submit']))
{
	$updateUser = $clientObj->updateUser($_POST,$_SESSION['client']['user_id']);
	$errmsg = $updateUser;
}
if($errmsg!='')
{
	echo '<div class="errmsg">'.$errmsg.'</div>';
}
$formObj->formNew('clientRegister','');
$formObj->formtextRow('Title', 'title', $userData[0]['title']);
$formObj->formtextRow('First Name', 'first_name',$userData[0]['first_name']);
$formObj->formtextRow('Last Name', 'last_name',$userData[0]['last_name']);
$formObj->formtextRow('Email', 'email',$userData[0]['email']);
$formObj->formtextRow('Company', 'company',$userData[0]['company']);
$formObj->formtextRow('Username', 'username',$userData[0]['username']);
?>
<tr>
	<td>Password</td>
    <td><input id="password" type="password" name="password" value="<?php echo $_POST['password'];?>"  /></td>
</tr>    
<?php
$formObj->formSubmit();
?>
</div>