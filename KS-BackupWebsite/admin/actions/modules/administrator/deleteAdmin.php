<?php
/****************************************
* Author - esyed
* Company - Internet Concepts Limited
* Revision - 1.1
* Comments - Paul changed to include in system
*****************************************/?>
<h1>Delete Administrator</h1>

<form name="editpage" action="/admin/administrator/deleteadmin" method="post">
<input type="hidden" name="id" value="<?php echo $adminDetails[0]['id'];?>"  />

<table align="center" width = "50%">
	<tr>
	  <td colspan="2"><?php echo $errmsg;?></td>
    </tr>
    <tr>
    	<td>
        	Username
        </td>
        <td>
        	<input readonly type="text" name="username" value= "<?php echo $adminDetails[0]['username'];?>"/>
        </td>
    </tr>
	<tr>
	  <td>
      	Email
      </td>
	  <td>
      	<input readonly type="text" name="email" value="<?php echo $adminDetails[0]['email'] ?>"/>
      </td>
    </tr>
    <tr>
	  <td>
      	Admin Group
      </td>
	  <td>
      	<input readonly type="text" name="email" value="<?php echo $groupName[0]['group_name'] ?>"/>
      </td>
    </tr>
    
    
    <tr>
    	<td>
    		Are you sure you wish to delete the above admin account
    	</td>
    </tr>
    <tr>
		<td>
      		<input type="submit" value="Yes" name = "submit" />
      		<INPUT TYPE="button"  value="Cancel" name = "cancel" onClick="parent.location='/admin/index'">
        </td>
    </tr>
</table>
</form>