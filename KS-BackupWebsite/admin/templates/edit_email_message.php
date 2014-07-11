<?php
/****************************************
* Author - esyed
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/?>
<?php
$rafObj = new RecommendFriend;
$data = $rafObj->getData();
?>



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
			form_Field_name[0][0]="subject";
			form_Field_name[0][1]="0";
			form_Field_name[1][0]="message";
			form_Field_name[1][1]="0";
			var retVal = validate(form_Field_name);
			return retVal;
}
	
</SCRIPT>




<h1>Edit RAF Message</h1>         
<form name="editmailmessage" action="editemailmessage" method="post">
<table align="center">
    <tr>
    	<td>Subject</td>
        <td>
        <input type="text" name="subject" value = "<?php echo $data[0]['subject'];?>"/>
        </td>
    </tr>
	<tr>
	  <td>Message</td>
	  <td>      
      <textarea name="message"><?php echo $data[0]['message'];?></textarea>
      </td>
    </tr>
	<tr>
      <td>
      <input type="submit" value="Submit" name = "submit" onclick="return validateOnSubmit()"/>
      </td>
    </tr>
</table>
</form>

<script type="text/javascript">
	CKEDITOR.replace( 'message',
{
 filebrowserBrowseUrl : '/admin/ckfinder/ckfinder.html',
 filebrowserImageBrowseUrl : '/admin/ckfinder/ckfinder.html?Type=Images',
 filebrowserFlashBrowseUrl : '/admin/ckfinder/ckfinder.html?Type=Flash',
 filebrowserUploadUrl : '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
 filebrowserImageUploadUrl : '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
 filebrowserFlashUploadUrl : '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
});
 

	
</script>

