<h1>Edit Gallery</h1>
<a href="/admin/templates/gallery/viewGallery">Go back to gallery list</a>
<?php if($errmsg != '') echo '<div class="errmsg">'.$errmsg.'</div>';?>
<?php
$formObj= new formCreator;
$formObj->formNew('addCategory','');
$formObj->formtextRow('Title', 'title',$data[0]['title']);
?>
	<tr>
    	<td>Image</td>
        <td><img src="<?php echo $data[0]['image_location'];?>" /></td>
	</tr>
<?php
$formObj->formSelectRow('Active','active',array(array('display'=>'Yes','value'=>'1'),array('display'=>'No','value'=>'0')),'display','value',$data[0]['active']);
$formObj->formSubmit();
?>
