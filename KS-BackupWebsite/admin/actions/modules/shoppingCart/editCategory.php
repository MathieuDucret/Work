<script type="text/javascript">
function sendByPost(photo_id)
{
	var photoField = document.getElementById('photo_id');
	photoField.value = photo_id;
	var answer = confirm ("Are you sure you wish to delete this image?")
	if(answer)
	document.delphoto.submit();
}
</script>
<form id='delphoto' name='delphoto' method="post">
<input type='hidden' id='photo_id' name='photo_id' value='' />
</form>
<h1>Shopping Cart</h1>
<h2>Edit Category</h2>
<?php if($errmsg != '') echo '<div class="errmsg">'.$errmsg.'</div>';?>
<?php
$formObj= new formCreator;
$formObj->formNew('editCategory" enctype="multipart/form-data"','');
$formObj->formtextRow('Category Name', 'category_name',$data[0]['category_name']);
?>
	<tr>
    	<td>Category Image</td>
        <td><input type="file" name="photo"  /></td>
	</tr>
<?php 
if(count($image_data)>0) { echo '<tr><td>Current Image</td><td>&nbsp;</td></tr>'; } 
for($i=0;$i<count($image_data);$i++)
{
		$increaseOrder = '';
		$decreaseOrder = '';
			if($image_data[$i]['image_order']!=1) $increaseOrder = '<a href="javascript:increaseOrder('.$image_data[$i]['id'].');"/><img src="/images/sortUp.gif" /></a>';
			if($image_data[$i]['image_order']!=count($image_data)) $decreaseOrder = '<a href="javascript:decreaseOrder('.$image_data[$i]['id'].');"/><img src="/images/sortDown.gif" /></a>';
		echo '
		<tr>
			<td style="text-align:right;">&nbsp;</td>
			<td><img height="100px" src="/shop_images/category_images/medium/'.$image_data[$i]['file_location'].'" /><a href ="javascript:sendByPost('.$image_data[$i]['id'].');"/><img src="/images/cross.gif" /></a></td>
		</tr>';
}
$formObj->formtextAreaRow('Description', 'description',$data[0]['description'],5,40);
$formObj->formSelectRow('Parent Category','parent_categoryid',$formObj->SelectQuery("SELECT category_name,id FROM tbl_shop_settings_categories WHERE parent_categoryid ='0' AND id != '".$_GET['id']."' ORDER BY category_name ASC","master"),'category_name','id',$data[0]['parent_categoryid'],2);
$formObj->formSelectRow('Visible','visible',array(0=>array('value'=>'1','display'=>'Yes'),array('value'=>'0','display'=>'No')),'display','value',$data[0]['value']);
?>
<tr>
	<td>Is this a brand?</td>
    <td><?php $formObj->formTick('Is this a brand?','1','brand',$data[0]['brand']);?></td>
</tr>
<?php    
$formObj->formSubmit();

$formObj->formAddCK('description')
?>
