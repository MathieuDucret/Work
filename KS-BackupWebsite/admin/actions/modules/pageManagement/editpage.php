<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.1
* Comments - Changed so now works in the systems
*****************************************/?>
<script type="text/javascript">
$(function(){  
			   
	$('#preview_content').click(function(){
		$('#editpage').attr('action', '/admin/ajax/previewPage.php');
		$('#editpage').attr('target', '_blank');
		$('#editpage').submit();
	});
	
	$('#submit_form').click(function(){
		$('#editpage').attr('action', '');
		$('#editpage').attr('target', '');
		$('#editpage').submit();
	});
	
	$('#preview_archive').click(function(){
		var archive_id = $('#archive_id').val();										 
		$.ajax({
			type: "GET",
			url: "/admin/ajax/getArchive.php",
			data: "id="+archive_id,
			success: function(data){				
				$('textarea.editor').ckeditor(function(){
					this.destroy();
				});
				$('#archive_pane').replaceWith(data).slideDown();
				$( 'textarea.editor' ).ckeditor();
				
			}
		});
		
		
	});
	$('#page_content').ckeditor(function(){
		CKFinder.setupCKEditor(this,'/admin/ckfinder/' );
	});
});
</script>	
<h1>Edit Page</h1>
<?php
if(count($archive_data)>0)
{?>
<h2>Archive page content</h2>
<?php
	$formObj = new formCreator;
	$formObj->formSelectRowN('Archives','archive_id', $archive_data, 'date_created', 'id', $_POST['archive_id']);
?>
<div id="preview_archive" style="cursor:pointer;width:150px;border:#000 1px solid; background-color:#ccc;">Preview archive</div>
<div style="display:none;" id="archive_pane"></div>
<?php	
}?>
<?php if($errmsg != '') echo '<div class="errmsg">'.$errmsg.'</div>';?>
<?php 
$language_data = $this->SelectQuery("SELECT language FROM tbl_languages WHERE id = '".$data[0]['language_id']."'","master");
?>
<h2><?php echo $language_data[0]['language'];?> version of page - <a href="/admin/pageManagement/viewPages">Click here</a> to go back to all pages</h2>
<form name="editpage" id="editpage" action="" method="post">
<input type="hidden" name="editpage" value="true" />
<table align="center">
    <tr>
    	<td>Main Link Order</td>
        <td><select name="link_order">
        <?php for($i=0;$i<$count_pages[0]['cnt'];$i++)
		{?>
        <option value="<?php echo $i;?>" <?php if($i==$data[0]['link_order']) echo "selected='selected'";?>><?php echo $i;?></option>
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
        <option value="<?php echo $i;?>" <?php if($i==$data[0]['sublink_order']) echo "selected='selected'";?>><?php echo $i;?></option>
        <?php } ?></select>
        </td>
    </tr>
    <?php } ?>
    <tr>
    <td>Menu Type</td>
    <td>
    <select name="menu_type">
	    <option <?php if($data[0]['menu_type']=='horizontal') echo "selected='selected'";?> value="horizontal">Horizontal</option>
	    <option <?php if($data[0]['menu_type']=='vertical') echo "selected='selected'";?> value="vertical">Vertical</option>
        <option <?php if($data[0]['menu_type']=='both') echo "selected='selected'";?> value="both">Both</option>
      </select>
    </td>
    </tr>
    <tr>
	  <td>Link Type</td>
	  <td>
		<select name="link_type">
        	<option <?php if($data[0]['link_type']=='main') echo "selected='selected'";?> value="main">Main</option>
            <option <?php if($data[0]['link_type']=='sub') echo "selected='selected'";?> value="sub">Sublink</option>
        </select>
	  </td>
    </tr>
	<tr>
	  <td>Does this link have sublinks?</td>
	  <td><select name="has_sublinks">
	    <option <?php if($data[0]['has_sublinks']==0) echo "selected='selected'";?> value="0">No</option>
	    <option <?php if($data[0]['has_sublinks']==1) echo "selected='selected'";?> value="1">Yes</option>
      </select></td>
    </tr>
	<tr>
	  <td>Assigned Main ID</td>
	  <td><select name="assigned_main_id">
      <option <?php if($data[0]['assigned_main_id']==0) echo "selected='selected'";?> value="0">None</option>
	  <?php for($i=0;$i<count($getmainsublinks);$i++){?>
      <option <?php if($data[0]['assigned_main_id']==$getmainsublinks[$i]['id']) echo "selected='selected'";?> value="<?php echo $getmainsublinks[$i]['id'];?>"><?php echo $getmainsublinks[$i]['page_name'];?></option>
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
        <td><textarea id="page_content" name="page_content"><?php echo stripslashes($data[0]['page_content']);?></textarea></td>
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
       <input name="send" type="submit" id="submit_form" value="Update"/><input type="button" style="margin-left:80px;" id="preview_content" value="Preview Content" />
        </td>
    </tr>
</table>
</form>