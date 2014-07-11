<h1>Add New Record</h1>
<form name="addportfolio" action="/admin/portfolio/addrecord" method="post">
<table align="center">
	<tr>
	  <td colspan="2"><?php echo $errmsg;?></td>
    </tr>
    <tr>
    	<td>Title</td>
        <td><input type="text" name="title" /></td>
    </tr>
	<tr>
	  <td>Image Location</td>
	  <td><input type="text" name="image_location" /></td>
    </tr>
	<tr>
	  <td>Link URL</td>
	  <td><input type="text" name="link_url" />
	  </td>
    </tr>
	<tr>
	  <td>Description</td>
	  <td><input type="text" name="description" /></td>
    </tr>
    <tr>
	  <td>Order Number</td>
	  <td>
      <select name="order_no" id="order_no">
      	<?php for ($i=0; $i<($this->recCount+2); $i++) {?>
        <option value="<?php echo $i ?>" <?php if ($i==($this->recCount+1)){echo "selected";}?>><?php echo $i?></option>
        <?php } ?>
      </select>
      </td>
    </tr>
    <tr>
    	<td align="center" colspan="2"><input name="submit" type="submit" value="Create" /></td>
    </tr>
</table>
</form>
<script type="text/javascript">
	CKEDITOR.replace( 'page_content',
{
 filebrowserBrowseUrl : '/admin/ckfinder/ckfinder.html',
 filebrowserImageBrowseUrl : '/admin/ckfinder/ckfinder.html?Type=Images',
 filebrowserFlashBrowseUrl : '/admin/ckfinder/ckfinder.html?Type=Flash',
 filebrowserUploadUrl : '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
 filebrowserImageUploadUrl : '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
 filebrowserFlashUploadUrl : '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
});
 

	
</script>        