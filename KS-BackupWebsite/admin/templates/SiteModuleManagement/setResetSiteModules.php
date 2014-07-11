<form name="resetsitemodules" action="/admin/SiteModuleManagement/setResetSiteModulesSave" method="post"> 
<table>
<?php for($i=0; $i<count($moduleList); $i++){?> 

<tr>
<td><INPUT TYPE="CHECKBOX" NAME="<?php echo $moduleList[$i]['id'];?>"<?php if ($moduleList[$i]['isAllowedModuleItem']=='1'){echo "checked";}?>><?php echo $moduleList[$i]['module_name'];?></td>
</tr>
<?php } ?>

<tr><td colspan="2"><input type="submit" name="submit" value="Set/Reset Modules"></td></tr>
</table>
</form>