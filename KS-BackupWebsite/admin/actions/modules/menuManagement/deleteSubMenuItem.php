<h1>Please check if you wish to delete the following Sub-menu item</h1>
<form name="deleteSubMenuItem" action="/admin/menuManagement/deleteSubMenuItem" method="post">
<input type="hidden" name="id" value="<?php echo $mainMenuItem[0]['id'];?>"  />

<table align="center">
	<tr>
	  <td colspan="2"><?php echo $errmsg;?></td>
    </tr>
    <tr>
    	<td>
        	Sub Link Display 
        </td>
        <td>
        	<input readonly="readonly" type="text" name="sublinktext" value= "<?php echo $mainMenuItem[0]['page_name'];?>"/>
        </td>
    </tr>
    
     <tr>
    	<td>
        	Sublink Function
        </td>
        <td>
        	<input readonly="readonly" type="text" name="sublinkfunction" value= "<?php echo $mainMenuItem[0]['function_name'];?>"/>
        </td>
    </tr>

<tr><td colspan="2">Are you sure you wish to delete this Menu Item</td></tr>
    	<tr>
			<td>
      			<input type="submit" value="YES" name="submit"/>
      			<INPUT TYPE="button"  value="NO" name = "cancel" onClick="parent.location='/admin/index'">
      		</td>
    	</tr>
</table>
</form>
      
</div>
      <div id="footer">
        <?php $layoutObj->showFooter(); ?>
      </div>
  </div>
</div>

