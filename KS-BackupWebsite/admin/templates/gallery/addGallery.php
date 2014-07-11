<h1>Add Gallery</h1>
<a href="/admin/gallery/viewGallery">Go back to gallery list</a>
<?php if($errmsg != '') echo '<div class="errmsg">'.$errmsg.'</div>';?>
<?php
$formObj= new formCreator;
$formObj->formNew('addCategory" enctype="multipart/form-data"','');
$formObj->formtextRow('Title', 'title',$_POST['title']);
?>
	<tr>
    	<td>Image</td>
        <td><input type="file" name="location"  /></td>
	</tr>
<?php
$formObj->formSelectRow('Active','active',array(array('display'=>'Yes','value'=>'1'),array('display'=>'No','value'=>'0')),'display','value',$_POST['active']);
$formObj->formSubmit();
?>
