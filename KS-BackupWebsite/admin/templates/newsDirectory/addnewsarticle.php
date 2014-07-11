<?php
?>
<script type="text/javascript">
function submitMe(val)
{
	document.pages.submit()
}	

</script>
<SCRIPT TYPE="text/javascript">

$(function() {
		$("#publishedon").datepicker( { dateFormat: 'yy-mm-dd' } );
	});

  function validateOnSubmit() {
		var errcount = 0;
		var message = "";
	//in the following array of arrays, first field corresponds to 
	//the fieldname from the form and the second tells whether to 
	//perform a extended validation on that field
		var form_Field_name=new Array(2);
		 for (m = 0; m < form_Field_name.length; ++ m){
	form_Field_name [m] = new Array(2);
		}
			form_Field_name[0][0]="author";
			form_Field_name[0][1]="0";
			form_Field_name[1][0]="title";
			form_Field_name[1][1]="0";
			form_Field_name[1][0]="publishedon";
			form_Field_name[1][1]="0";
		
			var retVal = validate(form_Field_name);
			return retVal;
}	
</SCRIPT>
<h1>Add News Articles</h1> 
<form id="pages" name="pages" action="" method="post">
<?php
$formObj = new formCreator;
$language_array[0]['language'] .= ' (Default)';
$formObj->formSelectRowN('Language','selected_language" onchange="submitMe(this.options[this.selectedIndex].value);',$language_array,'language','id',$current_language);
?>
</form>        
<form name="addnewsarticle" action="" method="post">
<input type="hidden" name="selected_language" value="<?php echo $current_language;?>" />
<table align="center">
	<?php if($errmsg!=''){?>
    <tr>
	  <td colspan="2"><div id="errmsg"><?php echo $errmsg;?></div></td>
    </tr>
    <?php } ?>
    <tr>
    	<td>Author</td>
        <td>
        <input type="text" name="author"/>
        </td>
    </tr>
	<tr>
    	<td>Title</td>
        <td>
        <input type="text" name="title"/>
        </td>
    </tr>
    
    <tr>
    	<td>Publisher</td>
        <td>
        <input type="text" name="publisher"/>
        </td>
    </tr>
   <?php $formObj->formSelectRow('News Category','newscategory',$category_data,'name','id',$_POST['newscategory']);?>
   <tr>
   <td>
	  Article Published On</td>
   <td>
        <input type="text" name="publishedon" id="publishedon"/>

   </td>
   </tr>
   <tr>
   <td>
   Content
   </td>
   <td>
   <textarea name = "page_content"></textarea>
   </td>
   </tr>
   
      <td>
      <input type="submit" value="ADD" name = "submit" onclick="return validateOnSubmit()"/>
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


