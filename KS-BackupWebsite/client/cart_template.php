<script type="text/javascript">
function delProduct(id,type)
{
	var typechar;
	if(type == 1) typechar = 'regular';
	else if(type == 2) typechar = 'variations';
	document.delProduct.delproductid.value = id;
	document.delProduct.deltype.value = typechar;
	document.delProduct.submit();
}
</script>
<?php
if(isset($_POST['delproductid']))
{
	shoppingCart::deleteProductCart($_POST['delproductid'],$_POST['deltype']);
}	
if(isset($_POST['kill']))
{
	shoppingCart::emptyCart();
}
?>
<form name="delProduct" id="delProduct" method="post" action="">
<input type="hidden" name="delproductid" value="" />
<input type="hidden" name="deltype" value="" />
</form>
<div id="cart" style="float:right;width:200px;vertical-align:top;border:1px solid #000;min-height:800px;padding-left:10px;padding-right:10px;">
<h1>Your Basket</h1>
<?php if($errmsg!=''){?><div class="errmsg"><?php echo $errmsg;?></div><?php }?>
<?php shoppingCart::viewCartProducts();?>
<br />
<a href="/shop/view_basket">View Basket</a>
<br /><br /><br />
<?php /*<form name="cartForm" method="post" action="" />
<input type="submit" value="Empty Cart" name="kill" />
</form>*/?>
</div>