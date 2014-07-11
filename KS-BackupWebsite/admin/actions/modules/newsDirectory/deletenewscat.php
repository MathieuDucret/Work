
<?php
/****************************************
* Author - esyed
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/
?>
<h1>Confirm News Category Delete </h1>
<form name="editpage" action="" method="post">
<input type="hidden" name="id" value="<?php echo $data[0]['id'];?>"  />

<table align="center" width = "50%">
	<tr>
	  <td colspan="2"><?php echo $errmsg;?></td>
    </tr>
    <tr>
    	<td>Username</td>
        <td>
        <input readonly type="text" name="name" value= "<?php echo $data[0]['name'];?>"/>
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
    Are you sure you wish to delete the above news category?</td>
    </tr>
    <tr>
	<td>
      <input type="submit" value="Yes" name = "submit" />
      <INPUT TYPE="button"  value="Cancel" name = "cancel" onClick="parent.location='/admin/index'">
      
      </td>
    </tr>
</table>
</form>