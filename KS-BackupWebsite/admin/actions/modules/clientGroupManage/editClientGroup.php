<SCRIPT LANGUAGE="JavaScript">
function GetSelectedItem() {

len = document.editadmingroup.security.length
i = 0
chosen=0.0
pageName = ""

for (i = 0; i < len; i++) {
if (document.editadmingroup.security[i].selected) {
chosen = chosen+", "+(document.editadmingroup.security[i].value)

} 
document.editadmingroup.securitylevel.value = chosen;
}


}

function ClearList()
    {
		for(var j=0; j<document.forms[0].elements.length; j++)
		{			
			if (document.editadmingroup.elements[j].id==document.activeElement.id)
			{
			}
			else
			{
				//deselect items in all the other list boxes 
        		var list = document.getElementById(document.editadmingroup.elements[j].id);
				if (list) list.selectedIndex =-1;
			}
		}			
    }

</SCRIPT>
 
<h1>Welcome to the Edit Client-Group page</h1>
 
<table>
<form action="/admin/clientGroupManage/editClientGroupUpdate" method="post" name="editclientgroup">
<input type="hidden" name="securitylevel" />
<tr><td><input type="hidden" value="<?php echo $data[0]['id']; ?>" name="id"></td></tr>

<tr><td>Group Name</td><td><input type="text"  size="26" name="group_name" value="<?php echo $data[0]['group_name'];?> " ></td></tr>
<tr><td>Group Description</td><td><textarea name="description"><?php echo $data[0]['description'];?></textarea></td></tr>
<tr><td>Page List</td> <td>
<input type="submit" name="submit" value="<< Done >>" align="middle">
</td> <td>Allowed Pages</td></tr>
<tr>
<td>
   <select name = "unAssignedPageListID" size="10" onFocus="ClearList()" id="unAssignedPageListID">
   <?php foreach($unassignedPageList as $key=>$val)
   		{ 
			$language = $this->SelectQuery("SELECT language FROM tbl_languages WHERE id = '".$val['language_id']."'","master");
		if ($val['link_name'] != "") 
   			{?>
   <option value =" <?php echo $val['id']; ?>"><?php echo $language[0]['language'].': '.$val['module_name'].' - '.$val['page_name'].' - '.$val['link_name'];?></option>
   <?php 	}
   		} ?>
   </select> 
   </td>
<td>
<input type="submit" name="addorremove" value="Add/Remove Page(s)"/> 

</td>
<td>
   <select name = "allowedpagelist" id="allowedpagelist" size="10" onFocus="ClearList()" onClick = "GetSelectedItem()">
   <?php    
   
   foreach($allowedPageList as $key=>$val){ 
   	$language = $this->SelectQuery("SELECT language FROM tbl_languages WHERE id = '".$val['language_id']."'","master");
   ?>
   <option value =" <?php echo $val['id']; ?>"><?php echo $language[0]['language'].': '.$val['module_name'].' - '.$val['page_name'].' - '.$val['link_name'];?></option>
   <?php } ?>
   </select>
   </td>
</tr>

   
<tr></tr>




</form>
</table>

