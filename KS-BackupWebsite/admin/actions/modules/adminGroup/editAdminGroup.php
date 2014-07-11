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

//return chosen
//alert (chosen);
//return false
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
 
<h1>Welcome to the Edit Admin-Group page!!</h1>
 
<table>
<form action="/admin/adminGroup/editAdminGroupUpdate" method="post" name="editadmingroup">
<input type="hidden" name="securitylevel" />
<tr><td><input type="hidden" value="<?php echo $data[0]['id']; ?>" name="id"></td></tr>

<tr><td>Group Name</td><td><input type="text"  size="26" name="group_name" value="<?php echo $data[0]['group_name'];?> " ></td></tr>
<tr><td>Group Description</td><td><textarea name="description"><?php echo $data[0]['description'];?></textarea></td></tr>
<tr><td>Page List</td> <td>
<input type="submit" name="submit" value="<< Done >>" align="middle">
</td> <td>Allowed Page(s)</td></tr>
<tr>
<td>

   <select name = "unAssignedPageListID" size="10" onfocus="ClearList()" id="unAssignedPageListID">
   
   <?php 

   for ($i=0; $i<count($unassignedPageList); $i++)
   		{ if ($unassignedPageList[$i]['page_name'] != "") 
   			{ ?>
   <option value =" <?php echo $unassignedPageList[$i]['id']; ?>"><?php echo $unassignedPageList[$i]['class_name'].' - '.$unassignedPageList[$i]['function_name'].' - '.$unassignedPageList[$i]['page_name'];?></option>
   <?php 	}
   		} ?>
   </select> 
   </td>
<td>
<input type="submit" name="addorremove" value="Add/Remove Page(s)"/> 

</td>
<td>
   <select name = "allowedpagelist" id="allowedpagelist" size="10" onfocus="ClearList()" onClick = "GetSelectedItem()">
   <?php    
   
   for ($i=0; $i<count($allowedPageList); $i++){ ?>
   <option value =" <?php echo $allowedPageList[$i]['id']; ?>"><?php echo $allowedPageList[$i]['class_name'].' - '.$allowedPageList[$i]['function_name'].' - '.$allowedPageList[$i]['page_name'];?></option>
   <?php } ?>
   </select>
   </td>
</tr>

   
<tr></tr>




</form>
</table>
