
 
<h1>Delete Admin Group</h1>
 
<table>
<form action="/admin/adminGroup/deleteAdminGroup" method="post" name="editadmingroup">
<input type="hidden" name="securitylevel" />
<tr><td><input type="hidden" value="<?php echo $data[0]['id']; ?>" name="id"></td></tr>

<tr><td>Group Name</td><td><input type="text"  size="26" name="group_name" value="<?php echo $data[0]['group_name'];?> " ></td></tr>
<tr><td>Group Description</td><td><textarea name="description"><?php echo $data[0]['description'];?></textarea></td></tr>
<tr><td>Allowed Page(s)</td></tr>

<tr><td>
   <select name = "allowedpagelist" id="allowedpagelist" size="10" onfocus="ClearList()" onClick = "GetSelectedItem()">
   <?php 
   
   for ($i=0; $i<count($allowedPageList); $i++){ ?>
   <option value =" <?php echo $allowedPageList[$i]['id']; ?>"><?php echo $allowedPageList[$i]['page_name'];?></option>
   <?php } ?>
   </select>
   </td>
</tr>
<tr><td>Are you sure, you wish to delete this admin group. </td></tr>
   
<tr><td>
<input type="submit" name="submit" value="Yes"/> 
<INPUT TYPE="button"  value="NO" name = "cancel" onClick="parent.location='/admin/index'">

</td></tr>




</form>
</table>

