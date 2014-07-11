<h1>Shopping Cart</h1>
<h2>Delete Shipping Option</h2>
<?php if($errmsg != '') echo '<div class="errmsg">'.$errmsg.'</div>'; else {?>
<?php
$formObj= new formCreator;
$formObj->formNew('addCategory','');
$formObj->formtextRow('Display Name', 'name',$data[0]['name'],1);
$formObj->formtextRow('Cost', 'cost',$data[0]['cost'],1);
$formObj->formtextRow('Delivery Time', 'delivery_time',$data[0]['delivery_time'],1);
$formObj->formSubmit();
}
?>
