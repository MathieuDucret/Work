<h2>Edit Product Variation</h2>
<?php 
if($errmsg != '') echo '<div class="errmsg">'.$errmsg.'</div>';
$formObj = new formCreator;
$formObj->formNew('editProductVariation','');  
$formObj->formnumberRow('Stock Level', 'stock_level',$data[0]['stock_level'],0,'If you wish to manage stock levels for this variation, please set a positive number for your initial stock level. If you do not wish to manage stock levels, please leave this field blank.');
$formObj->formnumberRow('Low stock Level', 'low_stock_level',$data[0]['low_stock_level'],0,'When inventory levels fall below this number, this item will be flagged as low stock.');
?>
<?php   
$formObj->formSubmit();
?>
