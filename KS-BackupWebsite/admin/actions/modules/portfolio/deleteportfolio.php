<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/
?>
<h1>Delete Item</h1>
<p>Please review the portfolio item you are about to delete. If you are sure you wish to delete this portfolio item, please click the Delete button at the bottom of this page.</p>
<form name="editpage" action="/admin/portfolio/deletePortfolio" method="post">
<input type="hidden" name="id" value="<?php echo $data[0]['id'];?>" />
<table align="center">
	<tr>
    	<td></td>
        <td><?php echo stripslashes($data[0]['page_name']);?></td>
    </tr>
	<tr>
	  <td>Title</td>
	  <td><input readonly type="text" name="title" value="<?php echo $data[0]['title'];?>" /></td>
	  </tr>
	<tr>
	  <td>Image Location</td>
	  <td><input readonly type="text" name="image_location" value="<?php echo $data[0]['image_location'];?>" /></td>
	  </tr>
	<tr>
	  <td>Link URL</td>
	  <td><input readonly type="text" name="link_url" value="<?php echo $data[0]['link_url'];?>" /></td>
	  </tr>
	<tr>
	  <td>Description</td>
	  <td><input readonly type="text" name="description" value="<?php echo $data[0]['description'];?>" /></td>
	  </tr>
    <tr>
      <td align="center" colspan="2"><input name="submit" type="submit" value="Delete" /></td>
    </tr>
</table>
</form>
<script type="text/javascript">
	CKEDITOR.replace('page_content');
</script>        