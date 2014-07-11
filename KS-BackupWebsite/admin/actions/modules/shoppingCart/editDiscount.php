<script type="text/javascript">
$(function() {
	$("#expiry_date").datepicker( { dateFormat: 'yy-mm-dd' } );
});
</script>
<h1>Shopping Cart</h1>
<h2>Add Discount Code</h2>
<?php if($errmsg != '') echo '<div class="errmsg">'.$errmsg.'</div>';?>
<?php
$formObj= new formCreator;
?>
<form name="addDiscount" action="" method="post">
<table id="appendTo">
<?php
$types_array = array(array('display'=>'Percentage discount'),array('display'=>'Fixed discount'));
$product_array = $this->SelectQuery("SELECT id,product_name FROM tbl_shop_products ORDER BY product_name ASC","master");
$category_array = $this->SelectQuery("SELECT id,category_name FROM tbl_shop_settings_categories ORDER BY category_name ASC","master");

$user_array = $this->SelectQuery("SELECT id,username FROM tbl_clients ORDER BY username ASC","master");
$formObj->formtextRow('Discount Code', 'discount_code',$data[0]['discount_code'],0,'This is the discount code that users will type in when purchasing goods or services.');
$formObj->formSelectRow('Discount Type','discount_type',$types_array,'display','display',$data[0]['discount_type'],3,'This is the type of discount you wish to create.');
$formObj->formtextRow('Amount', 'amount',$data[0]['amount'],0,'This is the amount of the discount. If a percentage based discount is used, this will be a percentage, otherwise if a fixed amount, this will be a straight deduction of the fixed amount specified. <br /><strong>Note</strong> - Fixed price discounts will take an order to 0.00 + shipping if the fixed price discount is equal to or greater than the order value.');
?>
</table>
<h2>Discount Conditions</h2>
<table>
<?php
$formObj->formtextRow('Minimum order value', 'min_order',$data[0]['min_order'],0,'Enter a minimum order value here that the above discount code will take effect from.');
$formObj->formSelectRow('Apply to specific product','product_id',$product_array,'product_name','id',$data[0]['product_id'],1,'Select a product from the list if you wish to apply this discount to a particular product only.');
$formObj->formSelectRow('Apply to specific user','client_id',$user_array,'username','id',$data[0]['client_id'],1,'Select a client from the list if you wish to apply this discount to a particular client\'s orders only.');
$formObj->formSelectRow('Apply to specific category','category_id',$category_array,'category_name','id',$data[0]['category_id'],1,'Select a category from the list if you wish to apply this discount to a particular category only.');
$formObj->formtextRow('Expiry Date', 'expiry_date',$data[0]['expiry_date'],0,'Enter the date on which the code will expire.');
$formObj->formSubmit();
?>
<script>
$('#addProd').click(function() {
$("#appendTo").append("<tr><td>Variation Option Display</td><td><input type='text' name='name[]' /></td></tr>");
});
</script>