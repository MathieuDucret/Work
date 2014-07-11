<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.1
* Comments - Changed file so no works within system
*****************************************/?>
<h1>Delete Page</h1>
<p>Please review the page you are about to delete. If you are sure you wish to delete this page, please click the Delete button at the bottom of this page.</p>
<form name="editpage" action="/admin/deletepage" method="post">
<input type="hidden" name="page_id" value="<?php echo $data[0]['id'];?>" />
<input type="hidden" name="page_name" value="<?php echo $data[0]['page_name'];?>" />
<input type="hidden" name="module_name" value="<?php echo $data[0]['module_name'];?>" />
<table align="center">
	<tr>
    	<td>Page Name</td>
        <td><?php echo stripslashes($data[0]['page_name']);?></td>
    </tr>
    <tr>
    	<td>Link Name</td>
        <td><?php echo stripslashes($data[0]['link_name']);?></td>
    </tr>
    <tr>
    	<td>Page Content</td>
        <td><?php echo stripslashes($data[0]['page_content']);?></td>
    </tr>
    <tr>
      <td colspan="2"><h2>Meta Data</h2></td>
    </tr>
    <tr>
    	<td>Meta Title</td>
        <td><?php echo stripslashes($meta_data[0]['title']);?></td>
    </tr>
    <tr>
    	<td>Meta Keywords</td>
        <td><?php echo stripslashes($meta_data[0]['keywords']);?></td>
    </tr>
    <tr>
    	<td>Meta Description</td>
        <td><?php echo stripslashes($meta_data[0]['description']);?></td>
    </tr>
    <tr>
    	<td align="center" colspan="2"><input name="submit" type="submit" value="Delete" /></td>
    </tr>
</table>
</form>
<script type="text/javascript">
	CKEDITOR.replace('page_content');
</script>        