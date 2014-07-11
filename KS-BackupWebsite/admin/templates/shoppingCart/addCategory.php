<h1>Shopping Cart</h1>
<h2>Add Category</h2>
<?php if($errmsg != '') echo '<div class="errmsg">'.$errmsg.'</div>';?>
<?php
$formObj= new formCreator;
$formObj->formNew('addCategory" enctype="multipart/form-data"','');
$formObj->formtextRow('Category Name', 'category_name',$_POST['category_name']);
?>
	<tr>
    	<td>Category Image</td>
        <td><input type="file" name="photo"  /></td>
	</tr>
<?php
$formObj->formtextAreaRow('Description', 'description',$_POST['description'],5,40);
$formObj->formSelectRow('Parent Category','parent_categoryid',$formObj->SelectQuery("SELECT category_name,id FROM tbl_shop_settings_categories WHERE parent_categoryid ='0' ORDER BY category_name ASC","master"),'category_name','id',$data[0]['phone_id'],2);
$formObj->formSelectRow('Visible','visible',array(0=>array('value'=>'1','display'=>'Yes'),array('value'=>'0','display'=>'No')),'display','value',$_POST['value']);
?>
<tr>
	<td>Is this a brand?</td>
    <td><?php $formObj->formTick('Is this a brand?','1','brand',$data[0]['brand']);?></td>
</tr>
<?php
$formObj->formSubmit();

$formObj->formAddCK('description');
?>
