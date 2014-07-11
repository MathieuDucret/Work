<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.1
* Comments - Changed so now works in the systems
*****************************************/?>
<SCRIPT TYPE="text/javascript">

function validateOnSubmit() {
  var message = "";
  var errcount = 0;

    if (document.editpage.module_name.value=="")
  		{
  			//alert("the page_name field is left blank");
			message = "Module name" + '\n';
			errcount = errcount + 1;
  		}
	
	
	if (document.editpage.page_name.value=="")
  		{
  			//alert("the page_name field is left blank");
			message = message + "Page name" + '\n';
			errcount = errcount + 1;
  		}
	if (document.editpage.link_name.value=="")
  		{
  			//alert("the page_name field is left blank");
			message = message + "link name" + '\n';
			errcount = errcount + 1;
  		}
	if (document.editpage.meta_title.value=="")
  		{
  			//alert("the page_name field is left blank");
			message = message + "Meta title" + '\n';
			errcount = errcount + 1;
  		}
	if (document.editpage.meta_keywords.value=="")
  		{
  			//alert("the page_name field is left blank");
			message = message + "Meta keyword" + '\n';
			errcount = errcount + 1;
  		}

	if (document.editpage.meta_description.value=="")
  		{
  			//alert("the page_name field is left blank");
			message = message + "Meta description" + '\n';
			errcount = errcount + 1;
  		}
		
	if (errcount > 0)
		{	
			alert ("Following fields are mandatory and have been left empty" + '\n' + message);
			return false;
		}
		else
		{
			return true;
		}
	}
	
</SCRIPT>
<h1>Edit Page</h1>
<form name="editpage" action="/admin/addpage" method="post">
<input type="hidden" name="page_id" value="<?php echo $data[0]['id'];?>" />
<input type="hidden" name="page_name_old" value="<?php echo $data[0]['page_name'];?>" />
<input type="hidden" name="module_name_old" value="<?php echo $data[0]['module_name'];?>" />
<input type="hidden" name="editpage" value="true" />
<table align="center">
    <tr>
    	<td>Main Link Order</td>
        <td><select name="link_order">
        <?php for($i=0;$i<$count_pages[0]['cnt'];$i++)
		{?>
        <option value="<?php echo $i;?>" <?php if($i==$data[0]['link_order']) echo "selected";?>><?php echo $i;?></option>
        <?php } ?></select>
        </td>
    </tr>
    <?php if($data[0]['link_type']=='sub'){?>
    <tr>
    	<td>Sub Link Order</td>
        <td><select name="sublink_order">
        <?php 
		for($i=0;$i<=$getsublinkorder[0]['cnt'];$i++)
		{?>
        <option value="<?php echo $i;?>" <?php if($i==$data[0]['sublink_order']) echo "selected";?>><?php echo $i;?></option>
        <?php } ?></select>
        </td>
    </tr>
    <?php } ?>
    <tr>
    <td>Menu Type</td>
    <td>
    <select name="menu_type">
	    <option <?php if($data[0]['menu_type']=='horizontal') echo "selected";?> value="horizontal">Horizontal</option>
	    <option <?php if($data[0]['menu_type']=='vertical') echo "selected";?> value="vertical">Vertical</option>
        <option <?php if($data[0]['menu_type']=='both') echo "selected";?> value="both">Both</option>
      </select>
    </td>
    </tr>
    <tr>
	  <td>Link Type</td>
	  <td>
		<select name="link_type">
        	<option <?php if($data[0]['link_type']=='main') echo "selected";?> value="main">Main</option>
            <option <?php if($data[0]['link_type']=='sub') echo "selected";?> value="sub">Sublink</option>
        </select>
	  </td>
    </tr>
	<tr>
	  <td>Does this link have sublinks?</td>
	  <td><select name="has_sublinks">
	    <option <?php if($data[0]['has_sublinks']==0) echo "selected";?> value="0">No</option>
	    <option <?php if($data[0]['has_sublinks']==1) echo "selected";?> value="1">Yes</option>
      </select></td>
    </tr>
	<tr>
	  <td>Assigned Main ID</td>
	  <td><select name="assigned_main_id">
      <option <?php if($data[0]['assigned_main_id']==0) echo "selected";?> value="0">None</option>
	  <?php for($i=0;$i<count($getmainsublinks);$i++){?>
      <option <?php if($data[0]['assigned_main_id']==$getmainsublinks[$i]['id']) echo "selected";?> value="<?php echo $getmainsublinks[$i]['id'];?>"><?php echo $getmainsublinks[$i]['page_name'];?></option>
      <?php } ?>
      </select>
    </tr>
	<tr>
	  <td>Module Name</td>
	  <td><input type="text" name="module_name" value="<?php echo stripslashes($data[0]['module_name']);?>" /></td>    
	  </tr>
    <tr>
    	<td>Page Name</td>
        <td><input type="text" name="page_name" value="<?php echo stripslashes($data[0]['page_name']);?>" /></td>
    </tr>
    <tr>
    	<td>Link Name</td>
        <td><input type="text" name="link_name" value="<?php echo stripslashes($data[0]['link_name']);?>"	></td>
    </tr>
    <tr>
    	<td>Page Content</td>
        <td><textarea name="page_content"><?php echo stripslashes($data[0]['page_content']);?></textarea></td>
    </tr>
    <tr>
      <td colspan="2"><h2>Meta Data</h2></td>
    </tr>
    <tr>
    	<td>Meta Title</td>
        <td><input type="text" name="meta_title" value="<?php echo stripslashes($meta_data[0]['title']);?>"></td>
    </tr>
    <tr>
    	<td>Meta Keywords</td>
        <td><input type="text" name="meta_keywords" value="<?php echo stripslashes($meta_data[0]['keywords']);?>"></td>
    </tr>
    <tr>
    	<td>Meta Description</td>
        <td><textarea cols="50" rows="5" name="meta_description"><?php echo stripslashes($meta_data[0]['description']);?></textarea></td>
    </tr>
    <tr>
      <td>Hard File <em><strong>(do not change this)</strong></em><strong></strong></td>
      <td><select name="hard_file"><option <?php if ($data[0]['file_exists'] == '1') echo "selected";?> value="1">Yes</option><option <?php if ($data[0]['file_exists'] == '0') echo "selected";?> value="0">No</option></select></td>
    </tr>
    <tr>
    	<td align="center" colspan="2">
        <input name="submit" type="submit" value="Update" onclick="return validateOnSubmit()" />
        </td>
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