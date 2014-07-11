<h1>Shopping Cart</h1>
<h2>Delete Variation</h2>
<?php if($errmsg != '') echo '<div class="errmsg">'.$errmsg.'</div>'; else {?>
<?php
$formObj= new formCreator;
?>
<form name="deleteVariation" action="" method="post">
<table id="appendTo">
<?php
$formObj->formtextRow('Variation Name', 'variation_name',$data[0]['variation_name'],1,'This is the name of the variation you are editing. E.g. if you are creating a variation for multiple shoe sizes, this would be Shoe Sizes');
for($i=0;$i<count($options_data);$i++)
{
	$formObj->formtextRow('Variation Option Display','name[]',$options_data[$i]['name'],1,'This is the value that appears for a variation option.');
}
?>
<?php    
$formObj->formSubmit();
?>
<script>
$('#addProd').click(function() {
$("#appendTo").append("<tr><td>Variation Option Display</td><td><input type='text' name='name[]' /></td></tr>");
});

</script>
<?php }?>