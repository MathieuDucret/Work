
<?php
/****************************************
* Author - esyed
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/
?>
<SCRIPT TYPE="text/javascript">

  function validateOnSubmit() {

		var errcount = 0;
		var message = "";
	//in the following array of arrays, first field corresponds to 
	//the fieldname from the form and the second tells whether to 
	//perform a extended validation on that field
		var form_Field_name=new Array(3);
		 for (m = 0; m < form_Field_name.length; ++ m){
	form_Field_name [m] = new Array(2);
		}
			form_Field_name[0][0]="author";
			form_Field_name[0][1]="0";
			form_Field_name[1][0]="title";
			form_Field_name[1][1]="0";
			form_Field_name[2][0]="newscat";
			form_Field_name[2][1]="0";
			
	
		
			var retVal = validate(form_Field_name);
			return retVal;
}

</SCRIPT>
<h1>Edit News Article</h1>
<form name="editnewsarticle" action="" method="post">
<input type="hidden" name="id" value="<?php echo $data[0]['id'];?>"  />

<table align="center">
	<?php if($errmsg!=''){?>
    <tr>
	  <td colspan="2"><div id="errmsg"><?php echo $errmsg;?></div></td>
    </tr>
    <?php } ?>
    <tr>
    	<td>Author</td>
        <td>
        <input type="text" name="author" value= "<?php echo $data[0]['author'];?>"/>
        </td>
    </tr>
	<tr>
    <td>Title</td>
      <td>
      	<input type="text" name="title" value= "<?php echo $data[0]['title'];?>"/>
      </td>
    </tr>
	<tr>
    <td>Publisher</td>
      <td>
      	<input type="text" name="publisher" value= "<?php echo $data[0]['publisher'];?>"/>
      </td>
    </tr>
    <tr>
    <td>Category Name</td>
      <td>
      <select name = "newscat">
      <?php for ($i=0; $i<count($catList);$i++){?>
      <option value ="<?php echo $catList[$i]['id'] ?>" <?php if ($data[0]['catid']==$catList[$i]['id']) {echo "selected";}?>><?php echo $catList[$i]['name']?></option>
      
      <?php } ?>
      </select>
      </td>
    </tr>  
       <tr>
       <td>
       Content
       </td>
       <td>
       <textarea name ="page_content"><?php echo $data[0]['content'];?></textarea>
       </td>
       </tr> 
    <tr>
	<td>
      <input type="submit" value="Save" name = "submit" onClick="return validateOnSubmit()"/>
      <INPUT TYPE="button"  value="Cancel" name = "cancel" onClick="parent.location='/admin/index'">
      
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