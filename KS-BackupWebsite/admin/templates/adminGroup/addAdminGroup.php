<SCRIPT LANGUAGE="JavaScript">
function GetSelectedItem() {

len = document.addadmingroup.securitylevel.length
i = 0
chosen=0.0

for (i = 0; i < len; i++) {
if (document.addadmingroup.securitylevel[i].selected) {
chosen = chosen +  "," +(document.addadmingroup.securitylevel[i].value)
} 
document.addadmingroup.securityleveltotal.value = chosen;
}

}

</SCRIPT>
<h1>Add Admin Group(s)</h1>

<table>
<form action="/admin/adminGroup/addAdminGroupSave" method="post" name="addadmingroup">
<input type="hidden" name="securityleveltotal" />
<tr><td>Group Name</td><td><input type="text" name="groupname" ></td></tr>
<tr><td>Group Description</td><td><textarea name="description"></textarea></td></tr>
<tr><td>Page List (Hold down 'ctrl' key and click on pages in the list if you wish to select muliple pages)</td>
<td>
   <select name = "securitylevel" size="10" multiple="multiple" onClick = "GetSelectedItem()">
   <?php for ($i=0; $i<count($pageList); $i++){ 
   if($pageList[$i]['function_name']=='') { $pageList[$i]['function_name'] = 'Main Link'; $pageList[$i]['page_name'] = 'Main Link'; }
   ?>
   <option value =" <?php echo $pageList[$i]['id']; ?>"><?php echo $pageList[$i]['class_name'].' - '.$pageList[$i]['function_name'].' - '.$pageList[$i]['page_name'];?></option>
   <?php } ?>
   </select> 
   </td>
   </tr>
<tr><td>
<input type="submit" name="submit" value="Add Group">
</td></tr>




</form>
</table>