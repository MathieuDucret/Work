<h1>Shopping Cart</h1>
<h2>Edit Shipping Option</h2>
<?php if($errmsg != '') echo '<div class="errmsg">'.$errmsg.'</div>';?>
<?php
$formObj= new formCreator;
$formObj->formNew('addCategory','');
$formObj->formtextRow('Display Name', 'name',$data[0]['name']);
?>
<tr>
	<td>Cost</td>
    <td><input type="text" name="cost" onkeydown="return chkNumber(event)" value="<?php echo $data[0]['cost'];?>"  /></td>
</tr>
<?php    
//$formObj->formtextRow('Cost', 'cost',$_POST['cost']);
$formObj->formtextRow('Delivery Time', 'delivery_time',$data[0]['delivery_time']);
$formObj->formSubmit();
?>
