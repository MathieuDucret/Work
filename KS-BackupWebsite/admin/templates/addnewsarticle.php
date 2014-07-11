<?php
/****************************************
* Author - esyed
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/
?>
<script type="text/javascript" src="datepickercontrol.js"></script>
<link type="text/css" rel="stylesheet" href="datepickercontrol.css"> 


<SCRIPT TYPE="text/javascript">

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
<form name="addnewsarticle" action="addnewsarticle" method="post">
<input type="hidden" id="DPC_TODAY_TEXT" value="today">
<input type="hidden" id="DPC_BUTTON_TITLE" value="Open calendar...">
<input type="hidden" id="DPC_MONTH_NAMES" value="['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']">
<input type="hidden" id="DPC_DAY_NAMES" value="['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']">
<table align="center">
	<tr>
	  <td colspan="2"><?php echo $errmsg;?></td>
    </tr>
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
   <tr>
   <td>News Category</td>
   <td>
   <select name = "newscategory">
   <?php for ($i=0; $i<count($data); $i++){ ?>
   <option value =" <?php echo $data[$i]['id']; ?>"><?php echo $data[$i]['name'];?></option>
   <?php } ?>
   </select> 
   </td>
   </tr>
   <tr>
   <td>
	  Article Published On</td>
   <td>
        <input type="text" name="publishedon"/>
		<script language="JavaScript" type="text/javascript">
			var o_cal = new tcal ({
			// form name
			'formname': 'addnewsarticle',
			// input name
			'controlname': 'publishedon'
				});	
		</script>

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


