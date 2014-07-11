<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/?>
<h1>Edit Footer</h1>
<form name="editfooter" action="/admin/settings/editFooter" method="post">
<table align="center">
	<tr>
	  <td colspan="2"><?php echo $errmsg;?></td>
    </tr>
    <tr>
    	<td>Footer Content</td>
        <td><textarea name="footer_content"><?php echo stripslashes($data[0]['content']);?></textarea></td>
    </tr>
    <tr>
    	<td align="center" colspan="2"><input name="submit" type="submit" value="Update" /></td>
    </tr>
</table>
</form>
<script type="text/javascript">
	CKEDITOR.replace( 'footer_content',
{
 filebrowserBrowseUrl : '/admin/ckfinder/ckfinder.html',
 filebrowserImageBrowseUrl : '/admin/ckfinder/ckfinder.html?Type=Images',
 filebrowserFlashBrowseUrl : '/admin/ckfinder/ckfinder.html?Type=Flash',
 filebrowserUploadUrl : '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
 filebrowserImageUploadUrl : '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
 filebrowserFlashUploadUrl : '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
});
</script>        