<?php
/****************************************
* Author - esyed
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/?>
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
			form_Field_name[0][0]="categoryname";
			form_Field_name[0][1]="0";
	
		
			var retVal = validate(form_Field_name);
			return retVal;
}
	
</SCRIPT>
<h1>Add News Category</h1>         
<form name="addnewscategory" action="addnewscategory" method="post">
<table align="center">
	<tr>
	  <td colspan="2"><?php echo $errmsg;?></td>
    </tr>
    <tr>
    	<td>Category Name</td>
        <td>
        <input type="text" name="categoryname"/>
        </td>
    </tr>
	<tr>
    	<td>Description</td>
        <td>
        <input type="text" name="description"/>
        </td>
    </tr>
   
      <td>
      <input type="submit" value="ADD" name = "submit" onclick="return validateOnSubmit()"/>
      </td>
    </tr>
</table>
</form>

