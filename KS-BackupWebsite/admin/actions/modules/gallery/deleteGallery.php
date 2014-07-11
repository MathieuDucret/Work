<h1>Delete Gallery Item</h1>
<p>Please review the following gallery item and if you still wish to delete it, press "Delete" at the bottom of the form</p>
<a href="/admin/gallery/viewGallery">Go back to gallery list</a>
<?php 
if($errmsg != '') 
{
	echo '<div class="errmsg">'.$errmsg.'</div>'; 
}
else
{?>
	<?php
    $formObj= new formCreator;
    $formObj->formNew('addCategory','');
    ?>
    <tr>
        <td>Title</td>
        <td><?php echo $data[0]['title'];?>
    </td>    
    <tr>
        <td>Image</td>
        <td><img src="<?php echo $data[0]['image_location'];?>" /></td>
    </tr>
    <?php
    $formObj->formSubmit('','Delete');
}
?>
