<SCRIPT LANGUAGE="JavaScript">
function GetSelectedItem() {

len = document.addclientgroup.pagelist.length
i = 0
chosen=0.0

for (i = 0; i < len; i++) {
if (document.addclientgroup.pagelist[i].selected) {
chosen = chosen +  "," +(document.addclientgroup.pagelist[i].value)
} 
document.addclientgroup.totalpagelist.value = chosen;
}

//return chosen
//alert(chosen);
//return false
}
</SCRIPT>
<h1>Add Client Group</h1>
<?php if($errmsg!=''){?><div class="errmsg"><?php echo $errmsg;?></div><?php } ?>
<table>
<form action="" method="post" name="addclientgroup">
<input type="hidden" name="totalpagelist" />
<tr><td>Group Name</td><td><input type="text" name="groupname" ></td></tr>
<tr><td>Group Description</td><td><textarea name="description" rows="5" cols="50"></textarea></td></tr>
<tr><td>Page List (Hold down 'ctrl' key <br> and click on pages in the <br> list if you wish to select muliple pages)</td>
<td>
   <select name = "pagelist" size="10" multiple="multiple" onClick = "GetSelectedItem()">
   <?php for ($i=0; $i<count($pageList); $i++){ ?>
   <option value =" <?php echo $pageList[$i]['id']; ?>"><?php echo $pageList[$i]['module_name'].' - '.$pageList[$i]['page_name'].' - '.$pageList[$i]['link_name'];?></option>
   <?php } ?>
   </select> 
   </td>
   </tr>
<tr><td>
<input type="submit" name="submit" value="Add Group">
</td></tr>




</form>
</table>