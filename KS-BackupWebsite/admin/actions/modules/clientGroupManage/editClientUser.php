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
<h1>Edit Client Details</h1>


<form name="editclient" action="" method="post">
<input type="hidden" name="id" value="<?php echo $adminDetails[0]['id'];?>"  />

<table align="center">
	<tr>
	  <td colspan="2"><?php echo $errmsg;?></td>
    </tr>
    <tr>
    	<td>
        	Username
        </td>
        <td>
        	<input type="text" name="username" value= "<?php echo $adminDetails[0]['username'];?>"/>
        </td>
    </tr>
	<tr>
	  	<td>
      		New Password
      	</td>
	  	<td>
      		<input type="text" name="password" value= "<?php echo $adminDetails[0]['pas0'];?>"/>
      	</td>
    </tr>
		<tr>
	  		<td>
            	Email
            </td>
        	<td>
      			<input type="text" name="email" value="<?php echo $adminDetails[0]['email'] ?>"/>
      		</td>
    	</tr>
        
        <tr>
        <td>
        Admin Group
        </td>
       <td>
   <select name = "admingroup" size="10" id="admingroup">

   <?php for ($i=0; $i<count($clientGroupList); $i++)
   		{ 
		if ($clientGroupList[$i]['group_name'] != "") 
   			{?>
   <option value =" <?php echo $clientGroupList[$i]['id']; ?>"<?php if ($adminDetails[0]['clientgroupid']==$clientGroupList[$i]['id']) {echo "selected";} ?>><?php echo $clientGroupList[$i]['group_name'];?></option>
   <?php 	}
   		} ?>
   </select> 
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
      
</div>
      <div id="footer">
        <?php $layoutObj->showFooter(); ?>
      </div>
  </div>
</div>
</body>
</html>