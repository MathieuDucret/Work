<?php
/****************************************
* Author - esyed
* Company - Internet Concepts Limited
* Revision - 1.1
* Comments - Paul changed to include in system
*****************************************/?>
<form name="delenquiry" action="/admin/deleteenquiry" method="post">
<input type="hidden" name="id" value="<?php echo $data[0]['id'];?>"  />

<table align="center" width = "50%">
	<tr>
	  <td colspan="2"><?php echo $errmsg;?></td>
    </tr>
    <tr>
    	<td>
        	First Name</td>
        <td>
        	<input readonly type="text" name="first_name" value= "<?php echo $data[0]['first_name'];?>"/>
        </td>
    </tr>
	<tr>
	  <td>
      	Last Name</td>
	  <td>
      	<input readonly type="text" name="last_name" value="<?php echo $data[0]['last_name'] ?>"/>
      </td>
    </tr>
    <tr>
    	<td>
    		Are you sure you wish to delete the above enquiry
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