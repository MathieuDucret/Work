<h1>Please check if you wish to delete the following menu item</h1>
<form name="editMainMenuItem" action="/admin/menuManagement/deleteMainMenuItem" method="post">
<input type="hidden" name="id" value="<?php echo $mainMenuItem[0]['id'];?>"  />

<table align="center">
	<tr>
	  <td colspan="2"><?php echo $errmsg;?></td>
    </tr>
    <tr>
    	<td>
        	Main Link Text
        </td>
        <td>
        	<input readonly="readonly" type="text" name="mainlinktext" value= "<?php echo $mainMenuItem[0]['module_name'];?>"/>
        </td>
    </tr>
     <tr>
    	<td>
        	Main Link Class
        </td>
        <td>
        	<input readonly="readonly" type="text" name="mainlinktext" value= "<?php echo $mainMenuItem[0]['module_name'];?>"/>
        </td>
    </tr>
    
    <?php
?>  
<table>
	<tr class="searchtitle">
    	<td>ID</td>
        <td>Submenu Display Text</td>
        <td>Function Name</td>
	</tr>
<?php for($i=0;$i<count($subMenuItemList);$i++){
	if($i%2) $class = 'searchResult1';
	else $class = 'searchResult2';
	?>
	<tr class="<?php echo $class;?>">
    	<td><?php echo $subMenuItemList[$i]['id'];?></td>
        <td><?php echo $subMenuItemList[$i]['page_name'];?></td>
        <td><?php echo $subMenuItemList[$i]['function_name'];?></td>  
	</tr>
<?php } ?>
</table>                  
           
<br>
<tr><td colspan="2">Are you sure you wish to delete this Menu Item</td></tr>
    	<tr>
			<td>
      			<input type="submit" value="YES" name="submit"/>
      			<INPUT TYPE="button"  value="NO" name = "cancel" onClick="parent.location='/admin/index'">
      		</td>
    	</tr>
</table>
</form>