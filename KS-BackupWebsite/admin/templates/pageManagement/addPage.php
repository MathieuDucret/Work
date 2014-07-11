<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/?>
<style type="text/css">
.advanced
{
	/*display:none;*/
}
#mode_toggle
{
	cursor:pointer;
	border:1px solid #000;
	background:#ccc;
	width:150px;
	text-align:Center;
}
</style>
<script type="text/javascript">
$(function(){
	$('#preview_content').click(function(){
		$('#add_page').attr('action', '/admin/ajax/previewPage.php');
		$('#add_page').attr('target', '_blank');
		$('#add_page').submit();
	});
	
	$('#submit_form').click(function(){
		$('#add_page').attr('action', '');
		$('#add_page').attr('target', '');
		$('#add_page').submit();
	});
	
	$('#link_type').change(function(){
		checkValues();									
	});
	
	$('#selected_language').change(function(){
		checkLanguage();									
	});
	
	function checkValues()
	{
		if($('#link_type').val()=='sub')
		{			
			$('#assigned_main_id_row').show();
			$('#has_sublinks_row').hide();
			$('#has_sublinks').val(0);
		}
		else
		{
			$('#assigned_main_id_row').hide();
			$('#assigned_main_id').val(0);
			$('#has_sublinks_row').show();
		} 
	}
	
	function checkLanguage()
	{
		var language_id = $('#selected_language').val();
		
		$.ajax({
		   type: "GET",
		   url: "/admin/ajax/mainlinkLanguage.php?language_id="+language_id,		  
		   success: function(msg){
			 $('#assigned_main_id_row').replaceWith(msg);
			 checkValues();
		   }
		});
	}
	
	checkValues();
										 			   
});

</script>
<h1>Add New Page</h1>
<br />
<?php
$formObj = new formCreator;
$language_array[0]['language'] .= ' (Default)';		

if($errmsg != '') echo '<div class="errmsg">'.$errmsg.'</div>';?>
<form name="add_page" id="add_page" action="" method="post">
<table id="pageManagement" align="center">
	<?php
	$formObj->formSelectRow('Language','selected_language',$language_array,'language','id',$_POST['selected_language'],1);
	?>
    <tr class="advanced">
    	<td>Link Order</td>
        <td><select name="link_order">
        <?php 
		for($i=0;$i<=$get_pages[0]['cnt'];$i++)
		{?>
        <option <?php if($i==$get_pages[0]['cnt']) echo "selected";?> value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php } ?></select>
        </td>
    </tr>
	<tr class="advanced">
		<td>Menu Type</td>
		<td>
        <select id="menu_type" name="menu_type">
            <option <?php if($getPostArgs['menu_type']=='horizontal') echo 'selected';?> value="horizontal">Horizontal</option>
            <option <?php if($getPostArgs['menu_type']=='vertical') echo 'selected';?> value="vertical">Vertical</option>
            <option <?php if($getPostArgs['menu_type']=='both') echo 'selected';?> value="both">Both</option>        
            <option <?php if($getPostArgs['menu_type']=='hide') echo 'selected';?> value="hide">Do Not Display</option>            
      	</select>
        </td>
    </tr>
	<tr class="advanced">
	  <td>Link Type</td>
	  <td>
		<select id="link_type" name="link_type">
        	<option <?php if($getPostArgs['link_type']=='main') echo 'selected';?> value="main">Main</option>
            <option <?php if($getPostArgs['link_type']=='sub') echo 'selected';?> value="sub">Sublink</option>
        </select>
	  </td>
    </tr>
	<tr id="has_sublinks_row" class="advanced">
	  <td>Does this link have sublinks?</td>
	  <td><select id="has_sublinks" name="has_sublinks">
	    <option <?php if($getPostArgs['has_sublinks']=='0') echo 'selected';?> value="0">No</option>
	    <option <?php if($getPostArgs['has_sublinks']=='1') echo 'selected';?> value="1">Yes</option>
      </select></td>
    </tr>
	<tr id="assigned_main_id_row" class="advanced">
	  <td>Assigned Main ID</td>
	  <td><select id="assigned_main_id" name="assigned_main_id">
	  <option <?php if($getPostArgs['assigned_main_id']=='0') echo 'selected';?> value="0">None</option>
	  <?php for($i=0;$i<count($getmainsublinks);$i++){?>
      <option <?php if($getPostArgs['assigned_main_id']==$getmainsublinks[$i]['id']) echo 'selected';?> value="<?php echo $getmainsublinks[$i]['id'];?>"><?php echo $getmainsublinks[$i]['page_name'];?></option>
      <?php } ?>
      </select><span style="font-size:11px;margin-left:10px;color:#c00;">Note - If no links appear here and you have added main links that can have sublinks, select a language from the top of the page</span>
    </tr>
	<tr class="advanced">
	  <td>Module Name</td>
	  <td><input type="text" name="module_name" value="<?php if($getPostArgs['module_name']=='') echo 'default'; else echo $getPostArgs['module_name'];?>"/>    
    </tr>
	<tr>
    	<td>Page Name</td>
        <td><input type="text" name="page_name" value="<?php echo $getPostArgs['page_name'];?>" /></td>
    </tr>
    <tr>
    	<td>Link Name</td>
        <td><input type="text" name="link_name" value="<?php echo $getPostArgs['link_name'];?>"></td>
    </tr>
    <tr>
    	<td>Page Content</td>
        <td><textarea id="page_content" name="page_content"><?php echo $_POST['page_content'];?></textarea></td>
    </tr>
    <tr>
      <td colspan="2"><h2>Meta Data</h2></td>
    </tr>
    <tr>
    	<td>Meta Title</td>
        <td><input type="text" name="meta_title" value="<?php echo $getPostArgs['meta_title'];?>"></td>
    </tr>
    <tr>
    	<td>Meta Keywords</td>
        <td><input type="text" name="meta_keywords" value="<?php echo $getPostArgs['meta_keywords'];?>"></td>
    </tr>
    <tr>
    	<td>Meta Description</td>
        <td><textarea cols="50" rows="5" name="meta_description"><?php echo $getPostArgs['meta_description'];?></textarea></td>
    </tr>
    <tr class="advanced">
      <td>Hard File <em><strong>(do not change this)</strong></em><strong></strong></td>
      <td><select id="hard_file" name="hard_file">
      <option <?php if($getPostArgs['hard_file']=='1') echo 'selected';?> value="1">Yes</option>
      <option <?php if($getPostArgs['hard_file']=='0' || $getPostArgs['hard_file']=='') echo 'selected';?> value="0">No</option>
      </select></td>
    </tr>
    <tr>
    	<td align="center" colspan="2"><input name="send" id="submit_form" type="submit" value="Create"/><input type="button" id="preview_content" value="Preview Content" /></td>
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