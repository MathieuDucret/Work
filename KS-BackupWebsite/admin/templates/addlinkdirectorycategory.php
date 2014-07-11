<?php
/****************************************
* Author - Dev Team
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
			form_Field_name[0][0]="name";
			form_Field_name[0][1]="0";
			var retVal = validate(form_Field_name);
			return retVal;
}
	
</SCRIPT>





<h1>Add Category</h1>         
<form name="addcategory" action="addcategorylinkdirectory" method="post">
<table align="center">
	<tr>
	  <td colspan="2"><?php echo $errmsg;?></td>
    </tr>
    <tr>
    	<td>Category Name</td>
        <td>
        <input type="text" name="name"/>
        </td>
    </tr>
	<tr>
	  <td>Description</td>
	  <td>
      <textarea name="description"></textarea>
      </td>
    </tr>
	<tr>
	  <td>Status</td>
	  <td>
		<select name="status">
        	<option value="1">Active</option>
            <option value="0">In-Active</option>
        </select>
	  </td>
      <td>
      <input type="submit" value="Submit" name = "submit" onclick="return validateOnSubmit()" />
      </td>
    </tr>
</table>
</form>

