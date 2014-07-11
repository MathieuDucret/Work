<?php
/****************************************
* Author - esyed
* Company - Internet Concepts Limited
* Revision - 1.1
* Comments - Now included in the system
*****************************************/
?>
<SCRIPT TYPE="text/javascript">

  function validateOnSubmit() {
	
		var errcount = 0;
		var message = "";
	//in the following array of arrays, first field corresponds to 
	//the fieldname from the form and the second tells whether to 
	//perform a extended validation on that field
		var form_Field_name=new Array(1);
		 for (m = 0; m < form_Field_name.length; ++ m){
	form_Field_name [m] = new Array(2);
		}
			form_Field_name[0][0]="name";
			form_Field_name[0][1]="0";
	
		
			var retVal = validate(form_Field_name);
			return retVal;
}

</SCRIPT>
<h1>Edit News category</h1>
<form name="editnewscategory" action="/admin/newsDirectory/editNewsCategory" method="post">
<input type="hidden" name="id" value="<?php echo $data[0]['id'];?>"  />

<table align="center">
	<?php if($errmsg!=''){?>
    <tr>
	  <td colspan="2"><div id="errmsg"><?php echo $errmsg;?></div></td>
    </tr>
    <?php } ?>
    <tr>
    	<td>Category Name</td>
        <td>
        <input type="text" name="name" value= "<?php echo $data[0]['name'];?>"/>
        </td>
    </tr>
	<tr>
    <td>Description</td>
      <td>
      	<textarea name="description" cols="25" rows="5"><?php echo $data[0]['description'];?></textarea>
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