<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/?>



<SCRIPT TYPE="text/javascript">

  function validateOnSubmit() {
 		
	
	//return false();
		var errcount = 0;
		var message = "";

	//in the following array of arrays, first field corresponds to 
	//the fieldname from the form and the second tells whether to 
	//perform a extended validation on that field
		var form_Field_name=new Array(5);
		 for (m = 0; m < form_Field_name.length; ++ m){
	form_Field_name [m] = new Array(2);
		}
			
			form_Field_name[0][0]="page_name";
			form_Field_name[0][1]="0";
			form_Field_name[1][0]="link_name";
			form_Field_name[1][1]="0";
			form_Field_name[2][0]="meta_title";
			form_Field_name[2][1]="0";
			form_Field_name[3][0]="meta_description";
			form_Field_name[3][1]="0";
			form_Field_name[4][0]="meta_keywords";
			form_Field_name[4][1]="0";
			
			var retVal = validate(form_Field_name);
			
			return retVal;
}
	
</SCRIPT>

<h1>Add New Page</h1>
<form name="addpage" action="addpage" method="post">
<table align="center">
	<tr>
	  <td colspan="2"><?php echo $errmsg;?></td>
    </tr>
    <tr>
    	<td>Link Order</td>
        <td><select name="link_order">
        <?php 
		for($i=0;$i<=$get_pages[0]['cnt'];$i++)
		{?>
        <option <?php if($i==$get_pages[0]['cnt']) echo "selected";?> value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php } ?></select>
        </td>
    </tr>
	<tr>
	  <td>Menu Type</td>
	  <td><select name="menu_type">
	    <option value="horizontal">Horizontal</option>
	    <option value="vertical">Vertical</option>
        <option value="both">Both</option>
      </select></td>
    </tr>
	<tr>
	  <td>Link Type</td>
	  <td>
		<select name="link_type">
        	<option value="main">Main</option>
            <option value="sub">Sublink</option>
        </select>
	  </td>
    </tr>
	<tr>
	  <td>Does this link have sublinks?</td>
	  <td><select name="has_sublinks">
	    <option value="0">No</option>
	    <option value="1">Yes</option>
      </select></td>
    </tr>
	<tr>
	  <td>Assigned Main ID</td>
	  <td><select name="assigned_main_id">
	  <option value="0">None</option>
	  <?php for($i=0;$i<count($getmainsublinks);$i++){?>
      <option value="<?php echo $getmainsublinks[$i]['id'];?>"><?php echo $getmainsublinks[$i]['page_name'];?></option>
      <?php } ?>
      </select>
    </tr>
	<tr>
	  <td>Module Name</td>
	  <td><input type="text" name="module_name" value="default"/>    
    </tr>
	<tr>
    	<td>Page Name</td>
        <td><input type="text" name="page_name"></td>
    </tr>
    <tr>
    	<td>Link Name</td>
        <td><input type="text" name="link_name"></td>
    </tr>
    <tr>
    	<td>Page Content</td>
        <td><textarea name="page_content"></textarea></td>
    </tr>
    <tr>
      <td colspan="2"><h2>Meta Data</h2></td>
    </tr>
    <tr>
    	<td>Meta Title</td>
        <td><input type="text" name="meta_title"></td>
    </tr>
    <tr>
    	<td>Meta Keywords</td>
        <td><input type="text" name="meta_keywords"></td>
    </tr>
    <tr>
    	<td>Meta Description</td>
        <td><textarea cols="50" rows="5" name="meta_description"></textarea></td>
    </tr>
    <tr>
      <td>Hard File <em><strong>(do not change this)</strong></em><strong></strong></td>
      <td><select name="hard_file"><option value="1">Yes</option><option selected value="0">No</option></select></td>
    </tr>
    <tr>
    	<td align="center" colspan="2"><input name="submit" type="submit" value="Create" onclick="return validateOnSubmit()" /></td>
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