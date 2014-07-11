
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
			form_Field_name[0][0]="modulename";
			form_Field_name[0][1]="0";
			form_Field_name[1][0]="classname";
			form_Field_name[1][1]="0";

			var retVal = validate(form_Field_name);
			return retVal;
}

function disAllowSpaces()
{

errorMsg = ''
errorCount = 0
param = document.addSubMenuItem.sublinkhref2.value;	
len =   param.length;

		for (i = 0; i < len; i++) 
		{
			if (param.charAt(i)==" ")
			{
				errorMsg = errorMsg + "In the Sub menu Link Field no spaces are allowed" + "\n";
				errorCount = errorCount+1;
				break;
			}
				
		}
		if (document.addSubMenuItem.sublinktext.value=="")
		{
			errorMsg = errorMsg + " Sublink Text cannot be Empty" + "\n";
			document.addSubMenuItem.sublinktext.focus()	
			errorCount = errorCount+1;		
		}
		if (document.addSubMenuItem.sublinkhref1.value=="")
		{
			errorMsg = errorMsg + " You need to select a Main link from the list" + "\n";	
			document.addSubMenuItem.sublinkhref1.focus()
			errorCount = errorCount+1;		
		}
		
		if (document.addSubMenuItem.sublinkhref2.value=="")
		{
			errorMsg = errorMsg + " Submenu Link ref cannot be left empty" + "\n";	
			document.addSubMenuItem.sublinkhref2.focus()
			errorCount = errorCount+1;		
		}
		
		if (errorCount==0)
		{
			return true;
		}
		else
		{
			alert ("The following error(s) occored whilst processing your form" + "\n" + errorMsg);
			return false;
		}
		
}


function GetSelectedItem(param) {

modulePath=''
moduleName=''
underscoreIsAt = param.value.indexOf('_');
len = param.value.length
//alert ("I am clicked with value= " + param.value + " pos of _ is " + underscoreIsAt + "Length is="+ len);
for (i = 0; i < len; i++) {
		if (i>underscoreIsAt) 
		{
			moduleName = moduleName + param.value.charAt(i)
		}


	} 
	document.addSubMenuItem.classname.value = moduleName;
//}

//return chosen
//alert(chosen);
//return false
}

</SCRIPT>


<h1>Add Menu Item(s)</h1>


<h2>Main Menu</h2>
<form action="/admin/menuManagement/addMainMenuItem" name="addMainmenuItem" method="post">
<table>
<tr>
<td>
Main Menu Item (Display Text)
</td>
<td>
<input type="text" name="modulename" />
</td><td rowspan="2">(Create class with the same name.>> <br>Follow naming convention "FirstSecondThird" <br> in the class name)</td>
</tr>
<tr>
<td>
Class Name
</td>
<td>
<input type="text" name="classname" value="className"/>
</td>
</tr>
<tr>
<td colspan="2"><input type="submit" value="Add Main Menu Item" onClick="return validateOnSubmit()"></td>
</tr>


</table>


</form>
<hr />

<!--***************************************Form2*************************************-->
<br>
<br>
<h2>Sub Menu</h2>
<form action="/admin/menuManagement/addSubMenuItem" name="addSubMenuItem" method="post">

<table>
<tr>
<td>MainLink for this Sublink</td>
<td>

 <select name = "modulename" size="10" onChange = "GetSelectedItem(this)">
<option value="0">Select One</option>
<?php  
for ($i=0; $i<count($mainMenuList); $i++){
echo "<option value=\"".$mainMenuList[$i]['id']."_".str_replace(' ', '',$mainMenuList[$i]['class_name'])."\">".$mainMenuList[$i]['module_name']."</option>";
}
?>
</select>
</td><td>Class/Module Name<br>
Main menu Link -> name of the Class.</td>
</tr>
<tr>
<td>
Class Name 
</td>
<td>
<input readonly type="text" name="classname" size="27"/>
</td>
</tr>
<tr>
<td>
Sub Link Text
</td>
<td>
<input type="text" name="sublinktext"  size="27"/>
</td>
</tr>
<tr><td>
Function To Call
</td>
<td>
<input type="text" name="functionname" size="27" value="functionName()"></td><td>Function name ->
Sub Menu Link.
</td>
</tr>
<tr>
<td>
Should this item Appear in the panel <br />
If you select Yes, the item will appear in the drop down in Admin panel

</td>
<td>
<select name = "isVisiblePanelItem" >
<option value="1">Yes</option>
<option value="0">No</option> 
</select>
</td>
</tr>


<tr>
<td colspan="2"><input type="submit" value="Add Sub Menu Item"  onClick="return disAllowSpaces()"></td>
</tr>
</table>
</form>
<hr />
<!--***************************************Form3*************************************-->
<form  action="/admin/menuManagement/addActionItem" name="addActionItem" method="post">
<table>
<tr>
<td>Select viewPage to add item to:</td>
<td>

 <select name = "viewPageID" size="10">
<option value="0">Select One</option>
<?php  
for ($i=0; $i<count($viewPageList); $i++){
echo "<option value=\"".$viewPageList[$i]['id']."\">".$viewPageList[$i]['page_name']."</option>";
}
?>
</select>

</td>
</tr>
<tr>
<td>
Edit/Delete/View display text <br />
this is the page name
</td>
<td>
<input type="text" name="pagename"  size="27"/>
</td>
</tr>
<tr>
<td>
Edit/Delete/View Function Name
</td>
<td>
<input type="text" name="functionname"  size="27"/>
</td>
</tr>
<tr>
<td>
Select what is it you wish to add (Edit/Delete/View)<br /> 
</td>
<td>
<select name = "view_order" >
<option value="0">Select One</option>
<option value="1">Edit</option>
<option value="2">Delete</option> 
<option value="3">View</option> 
</select>
</td>
</tr>
<tr>
<td colspan="2"><input type="submit" name="submit" value="Add (Edit/Delete) Item"></td>
</tr>
</table>
</form>
