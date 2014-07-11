<h1>Shopping Cart</h1>
<h2>Delete Category</h2>
<?php if($errmsg != '') echo '<div class="errmsg">'.$errmsg.'</div>';
else {?>
<?php
$formObj= new formCreator;
$formObj->formNew('addCategory','');
$formObj->formtextRow('Category Name', 'category_name',$data[0]['category_name'],1);
?>
<tr>
	<td>Description</td>
    <td><?php echo $data[0]['description'];?></td>
</tr>
<?php    
$formObj->formSelectRow('Parent Category','parent_categoryid',$formObj->SelectQuery("SELECT category_name,id FROM tbl_shop_settings_categories WHERE parent_categoryid ='0' ORDER BY category_name ASC","master"),'category_name','id',$data[0]['phone_id'],2,1);
$formObj->formSelectRow('Visible','visible',array(0=>array('value'=>'1','display'=>'Yes'),array('value'=>'0','display'=>'No')),'display','value',$data[0]['value'],0,1);
$formObj->formSubmit();
}?>
