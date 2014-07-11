
<?php
/****************************************
* Author - esyed
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/

?>

<SCRIPT TYPE="text/javascript">

  function validateOnSubmit() {
		var errcount = 0;
		var message = "";
	//in the following array of arrays, first field corresponds to 
	//the fieldname from the form and the second tells whether to 
	//perform a extended validation on that field
		var form_Field_name=new Array(2);
		 for (m = 0; m < form_Field_name.length; ++ m){
	form_Field_name [m] = new Array(2);
		}
			form_Field_name[0][0]="mainlinktext";
			form_Field_name[0][1]="0";
			form_Field_name[1][0]="mainlinkhref";
			form_Field_name[1][1]="0";

			var retVal = validate(form_Field_name);
			return retVal;
}
</SCRIPT>
<h1>Edit Menu Item & Submenu Item(s)</h1>


<form name="editMainMenuItem" action="/admin/menuManagement/editMainMenuItemUpdate" method="post">
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
        	<input type="text" name="mainlinktext" value= "<?php echo $mainMenuItem[0]['module_name'];?>"/>
        </td>
    </tr>
    <tr>
    	<td>
        	Main Link Class
        </td>
        <td>
        	<input type="text" name="mainlinkclass" value= "<?php echo $mainMenuItem[0]['class_name'];?>"/>
        </td>
    </tr>
     
       </tr>
     
    	<tr>
			<td>
      			<input  type="submit" value="Save" name = "submit" onClick="return validateOnSubmit()"/>
      			<INPUT TYPE="button"  value="Cancel" name = "cancel" onClick="parent.location='/admin/index'">
      		</td>
    	</tr>
</table>
</form>
<?php
//create list of headers to display
//Keys in the array are the list of column names in the resultset "$mainMenuItemList"  
$headingArray = array("id"=>"ID", "page_name"=>"Submenu Display Text", "function_name"=>"Function Name", "actions"=>"Actions" );
$viewresultSetObj = new viewResultSet;
echo $viewresultSetObj->createResultDisplay($headingArray, $subMenuItemList);

?>  