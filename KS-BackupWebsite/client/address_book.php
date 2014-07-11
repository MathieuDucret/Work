<style type="text/css">
#addAddress {
	font-family:"Courier New", Courier, monospace;
	font-size:14px;
	width: 580px;
}
input#company {
	border: 1px dotted #4D4D4D;
	height: 20px;
	width: 220px;
}
input#first_name {
	border: 1px dotted #4D4D4D;
	height: 20px;
	width: 220px;
}
input#last_name {
	border: 1px dotted #4D4D4D;
	height: 20px;
	width: 220px;
}
input#address1 {
	border: 1px dotted #4D4D4D;
	height: 20px;
	width: 220px;
}
input#address2 {
	border: 1px dotted #4D4D4D;
	height: 20px;
	width: 220px;
}
input#town {
	border: 1px dotted #4D4D4D;
	height: 20px;
	width: 220px;
}
input#county {
	border: 1px dotted #4D4D4D;
	height: 20px;
	width: 220px;
}
input#postcode {
	border: 1px dotted #4D4D4D;
	height: 20px;
	width: 220px;
}
input#phone {
	border: 1px dotted #4D4D4D;
	height: 20px;
	width: 220px;
}
</style>

<script type="text/javascript">
function delAddress(address_id)
{
	var addressField = document.getElementById('address_id');
	addressField.value = address_id;
	var answer = confirm ("Are you sure you wish to delete this address?")
	if(answer)
	document.deladdress.submit();
}
function makeCurrent(address_id)
{
	var addressField = document.getElementById('primary_id');
	addressField.value = address_id;
	var answer = confirm ("Are you sure you wish to change your default address?")
	if(answer)
	document.makeprimary.submit();
}
</script>
<?php 
$shopObj = new shoppingCart;
if(isset($_POST['address_id']))
{
	$errmsg = $shopObj->deleteAddress($_POST['address_id']);
}
if(isset($_POST['primary_id']))
{
	$errmsg = $shopObj->changePrimary($_POST['primary_id']);
}?>
<form id='deladdress' name='deladdress' method="post">
<input type='hidden' id='address_id' name='address_id' value='' />
</form>
<form id='makeprimary' name='makeprimary' method="post">
<input type='hidden' id='primary_id' name='primary_id' value='' />
</form>
<?php
$clientObj = new Client;
$clientObj->checkSession();
$formObj = new formCreator;
$userData = $clientObj->SelectQuery("SELECT * FROM tbl_clients WHERE id = '".$_SESSION['client']['user_id']."'","master");
if(isset($_POST['submit']))
{
	$updateUser = $shopObj->addAddress($_POST);
	$errmsg = $updateUser;
}
if($errmsg!='')
{
	echo '<div class="errmsg">'.$errmsg.'</div>';
}
?>
<h1>Add new address</h1>
<?php
$formObj->formNew('addAddress','');
$formObj->formtextRow('Company', 'company', $_POST['company']);
$formObj->formtextRow('First name', 'first_name', $_POST['first_name']);
$formObj->formtextRow('Last name', 'last_name', $_POST['last_name']);
$formObj->formtextRow('Address Line 1', 'address1',$_POST['address1']);
$formObj->formtextRow('Address Line 2', 'address2',$_POST['address2']);
$formObj->formtextRow('Town', 'town',$_POST['town']);
$formObj->formtextRow('County', 'county',$_POST['county']);
$formObj->formtextRow('Postcode', 'postcode',$_POST['postcode']);
$formObj->formtextRow('Phone number', 'phone',$_POST['phone']);
$formObj->formSubmit();

$address_data = $shopObj->SelectQuery("SELECT * FROM tbl_shop_customers_addresses WHERE client_id = '".$_SESSION['client']['user_id']."' ORDER BY current DESC","master");
if(count($address_data)==0)
{?><br />
    <div style="text-align:center;"><p>No stored addresses found</p></div>
    <?php
}
else
{?>
<br /><br />
<table>
	<?php
	for($i=0;$i<count($address_data);$i++)
	{
?>
	<tr>
    	<td><?php /*?><?php echo $i;?><?php */?></td>
        <td><?php echo $address_data[$i]['first_name'].' '.$address_data[$i]['last_name'];?></td>
	</tr>
<?php if($address_data[$i]['company']!=''){?>   
    <tr>
    	<td>&nbsp;</td>
        <td><?php echo $address_data[$i]['company'];?></td>
	</tr>  
<?php }?>          
    <tr>
    	<td>&nbsp;</td>
        <td><?php echo $address_data[$i]['address1'];?></td>
	</tr>
<?php if($address_data[$i]['address2']!=''){?>     
    <tr>
    	<td>&nbsp;</td>
        <td><?php echo $address_data[$i]['address2'];?></td>
	</tr>
<?php } ?>    
    <tr>
    	<td>&nbsp;</td>
        <td><?php echo $address_data[$i]['town'];?>, <?php echo $address_data[$i]['county'];?>, <?php echo $address_data[$i]['postcode'];?></td>
	</tr>
    <tr>
        <td>&nbsp;</td>    	
        <td><a style="color: #CC6666; font-family:'Courier New', Courier, monospace; font-size: 14px;" href="javascript:delAddress('<?php echo $address_data[$i]['id'];?>');">Delete Address</a><?php if($i!=0){?>&nbsp;/&nbsp;<a style="color:#390; font-family:'Courier New', Courier, monospace; font-size: 14px;" href="javascript:makeCurrent('<?php echo $address_data[$i]['id'];?>');">Set as Primary Address</a><?php } ?></td>
    <tr>
    	<td colspan="2"><img style="margin: 0px; padding: 0px;" src="/images/divide_1000_alt.png" /></td> 
	</tr>   
    <?php
	}?>
</table>    
<?php
}
?>
