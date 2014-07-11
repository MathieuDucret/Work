<?php
/****************************************
* Author - esyed
* Company - Internet Concepts Limited
* Revision - 1.1
* Comments - Paul changed to include in system
*****************************************/?>
<h1>Delete Client</h1>

<form name="editpage" action="" method="post">
<input type="hidden" name="id" value="<?php echo $clientDetails[0]['id'];?>"  />

<table align="center" width = "50%">
	<tr>
	  <td colspan="2"><?php echo $errmsg;?></td>
    </tr>
    <tr>
    	<td>
        	Username
        </td>
        <td>
        	<input readonly type="text" name="username" value= "<?php echo $clientDetails[0]['username'];?>"/>
        </td>
    </tr>
	<tr>
	  <td>
      	Email
      </td>
	  <td>
      	<input readonly type="text" name="email" value="<?php echo $clientDetails[0]['email'] ?>"/>
      </td>
    </tr>
    
    
    <tr>
    	<td>
    		Are you sure you wish to delete the above client account
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