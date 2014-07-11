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
		var form_Field_name=new Array(3);
		 for (m = 0; m < form_Field_name.length; ++ m){
	form_Field_name [m] = new Array(2);
		}
			form_Field_name[0][0]="username";
			form_Field_name[0][1]="0";
			form_Field_name[1][0]="password";
			form_Field_name[1][1]="0";
			form_Field_name[2][0]="email";
			form_Field_name[2][1]="0";
			var retVal = validate(form_Field_name);
			return retVal;
}
	
</SCRIPT>

<h1>Add Client</h1>         
<form name="addclient" action="/admin/clientGroupManage/addClientUserSave" method="post">
<table align="center">
	<tr>
	  <td colspan="2"><?php echo $errmsg;?></td>
    </tr>
    <tr>
    	<td>Username</td>
        <td>
        <input type="text" name="username"/>
        </td>
    </tr>
    <tr>
    	<td>First Name</td>
        <td>
        <input type="text" name="first_name"/>
        </td>
    </tr>
    <tr>
    	<td>Last name</td>
        <td>
        <input type="text" name="last_name"/>
        </td>
    </tr> 
    <tr>
    	<td>Approved</td>
        <td>
        <select name="approved"/>
        <option value="1">Yes</option>
        <option value="0">No</option>
        </td>
    </tr>           
	<tr>
    	<td>Password</td>
        <td>
        <input type="text" name="password"/>
        </td>
    </tr>
    <tr>
    	<td>Email</td>
        <td>
        <input type="text" name="email"/>
        </td>
    </tr>
    
    <tr><td>Security Group</td>
<td>
   <select name = "clientgroupid">
   <?php for ($i=0; $i<count($data); $i++){ ?>
   <option value =" <?php echo $data[$i]['id']; ?>"><?php echo $data[$i]['group_name'];?></option>
   <?php } ?>
   </select> 
   </td>
   </tr>
    
    
      <td>
      <input type="submit" value="ADD" name = "submit" onclick="return validateOnSubmit()"/>
      </td>
    </tr>
</table>
</form>


