<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/?>
<h1>Edit Header</h1>
<form name="editheader" action="/admin/settings/editHeader" method="post">
<table align="center">
	<tr>
	  <td colspan="2"><?php //echo $errmsg;?></td>
    </tr>
    <tr>
    	<td>Header Content</td>
        <td><textarea name="header_content"><?php echo stripslashes($data[0]['content']);?></textarea></td>
    </tr>
    <tr>
    	<td align="center" colspan="2"><input name="submit" type="submit" value="Update" /></td>
    </tr>
</table>
</form>
<script type="text/javascript">
	CKEDITOR.replace( 'header_content',
{
 filebrowserBrowseUrl : '/admin/ckfinder/ckfinder.html',
 filebrowserImageBrowseUrl : '/admin/ckfinder/ckfinder.html?Type=Images',
 filebrowserFlashBrowseUrl : '/admin/ckfinder/ckfinder.html?Type=Flash',
 filebrowserUploadUrl : '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
 filebrowserImageUploadUrl : '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
 filebrowserFlashUploadUrl : '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
});
</script>        