
<h1>Shopping Cart</h1>
<h2>Add Variation</h2>
<?php if($errmsg != '') echo '<div class="errmsg">'.$errmsg.'</div>';?>
<?php
$formObj= new formCreator;
?>
<form name="addVariation" action="" method="post">
<table id="appendTo">
<?php
$formObj->formtextRow('Variation Name', 'variation_name',$_POST['variation_name'],0,'This is the name of the variation you are creating. E.g. if you are creating a variation for multiple shoe sizes, this would be Shoe Sizes');
$formObj->formtextRow('Variation Option Display','name[]','',0,'This is the value that appears for a variation option.');
?>
</table>
<table>
<tr>
	<td colspan="2"><div id="addProd" class="ui-state-default ui-corner-all" style="cursor:pointer;width:150px;float:left;padding:5px;"><span class="ui-icon ui-icon-circle-plus" style="float:left;"></span><span style="float:left;padding-left:10px;">Add another field</span></div><div id="clear"></div></td>    
</tr>
<?php    
$formObj->formSubmit();
?>
<script>
$('#addProd').click(function() {
$("#appendTo").append("<tr><td>Variation Option Display</td><td><input type='text' name='name[]' /></td></tr>");
});

</script>