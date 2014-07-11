<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/

class formCreator extends DataBase // This class extended with DataBase Class
{ 
	// Constructor For this Class
	function __construct()
	{
		parent::__construct();
	}	
	function formNew($name,$action,$ajax=0)
	{
		$class='';
		$hidden = '';
		if($ajax==1)
		{
			$class ='class="ajax_form"';
		}
		echo '<form name="'.$name.'" id="'.$name.'" '.$class.' method="post" action="'.$action.'"><table>';
	}	
	
	function formNewN($name,$action)
	{
		echo '<form name="'.$name.'" method="post" action="'.$action.'">';
	}
	
	function formtextRow($name, $field,$postfield,$locked=0,$info='',$after='',$date='')
	{
		if($info!='') $title = $info;
		if($date!='') $date = ' class="date" ';
echo '
	<tr id="'.$field.'_row">
		<td>'.$name;  echo '</td>
		<td><input '.$date.' type="text" name="'.$field.'" id="'.$field.'"'; 
		if(isset($postfield)) echo 'value="'.$postfield.'"';
		if($locked==1) echo 'readonly'; echo ' />'; 
		if(isset($title)) 
		{ 
			echo "<img class='help_hover_me' src='/images/moreInformation.gif' />"; 
			echo "<div style='padding:10px;position:absolute;left:550px;display:none;font-size:12px;border:1px solid #000;background-color:#CCC;width:350px;'><strong>".$name."</strong><br /><br />".$info."</div>";
		}
if(isset($after)) {
echo $after;	
}
echo '</td>
	</tr>';
	}
	
	function formpasswordRow($name, $field,$postfield,$locked=0,$info='',$after='')
	{
		if($info!='') $title = $info;
echo '
	<tr id="'.$field.'_row">
		<td>'.$name;  echo '</td>
		<td><input type="password" name="'.$field.'" id="'.$field.'"'; 
					if(isset($postfield)) echo 'value="'.$postfield.'"';if($locked==1) echo 'readonly'; echo ' />'; if(isset($title)) { echo "<img id='".$field."' src='/images/moreInformation.gif' onmouseout=\"HideHelp('".$field."');\" 
onmouseover=\"ShowHelp('".$field."', '".$name."', '".$title."')\" />"; }
if(isset($after)) {
echo $after;	
}
echo '</td>
	</tr>';
	}
	
	function formtextRowN($name, $field,$postfield,$locked=0,$info='')
	{
		if($info!='') $title = $info;
echo '<input type="text" name="'.$field.'"'; 
					if(isset($postfield)) echo 'value="'.$postfield.'"';if($locked==1) echo 'readonly'; echo ' />'; if(isset($title)) { echo "<img id='".$field."' src='/images/moreInformation.gif' onmouseout=\"HideHelp('".$field."');\" 
onmouseover=\"ShowHelp('".$field."', '".$name."', '".$title."')\" />"; }
	}
	
	function formnumberRow($name, $field,$postfield,$locked=0,$info='')
	{
		if($info!='') $title = $info;
echo '
	<tr>
		<td>'.$name;
		echo '</td><td><input onkeyup="this.value=this.value.replace(/\D/g,\'\')" onchange="this.value=this.value.replace(/\D/g,\'\')" type="text" name="'.$field.'"'; 
					if(isset($postfield)) echo 'value="'.$postfield.'"';if($locked==1) echo 'readonly'; echo ' />'; 
					if(isset($title)) 
		{ 
			echo "<img class='help_hover_me' src='/images/moreInformation.gif' />"; 
			echo "<div style='padding:10px;position:absolute;left:550px;display:none;font-size:12px;border:1px solid #000;background-color:#CCC;width:350px;'><strong>".$name."</strong><br /><br />".$info."</div>";
		}
echo '</td>
	</tr>';
	}
	
	function formhiddenRow($field,$value)
	{
echo '<tr><td></td><td>
<input type="hidden" id="'.$field.'" name="'.$field.'" value="'.$value.'" /></td></tr>';
	}
	
	function formtextAreaRow($name, $field,$postfield,$rows,$cols,$locked=0,$info='',$after='')
	{
		if($info!='') $title = $info;
		if($locked==1) $readonly = 'readonly';
echo '
	<tr>
		<td>'.$name; echo '</td>
		<td><textarea '.$readonly.' rows="'.$rows.'" cols="'.$cols.'" name="'.$field.'">'; 
					if(isset($postfield)) echo $postfield; 
					echo '</textarea>';
					if(isset($title)) 
					{ 
						echo "<img class='help_hover_me' src='/images/moreInformation.gif' />"; 
						echo "<span style='display:none;font-size:12px;border:1px solid #000;background-color:#CCC;width:350px;'>".$info."</span>";
					}
if(isset($after)) {
echo $after;	
}
echo '</td>
	</tr>';
	}
	
	function formSubmit($validate=0,$value='Submit',$name='submit')
	{
		echo '
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="'.$name.'" value="'.$value.'"'; if($validate==1) echo ' onclick="return validateOnSubmit();"'; echo ' /></td>
	</tr></table></form>';
	}
	
	function formSubmitN($validate=0,$value='Submit')
	{
		echo '<input type="submit" name="submit" value="'.$value.'"'; if($validate==1) echo ' onclick="return validateOnSubmit();"'; echo ' /></form>';
	}
	
	function formSelectRow($name,$field,$array,$array_display,$array_value,$current_item,$search=0,$locked=0,$info='')
	{
		if($info!='') $title = $info;
		echo '
	<tr id="'.$field.'_row">
		<td>'.$name; echo '</td>
		<td>
		';
		if($locked==1)
		{			
			echo '<select disabled name="'.$field.'">';
		}
		else
		{
			echo '<select name="'.$field.'" id="'.$field.'">';
		}
		if($search==1)
		{
			echo '<option value="" >-- All --</option>';
		}
		else if($search==2)
		{
			echo '<option value="0" >-- None --</option>';
		}
		else if($search==3)
		{
			echo '<option value="" >-- Select --</option>';
		}
		else if($search==4)
		{
			echo '<option value="" >-- Other --</option>';
		}
		else if($search==5)
		{
			echo '<option value="GB" style="border-bottom:1px dashed #000; font-size:14px;margin-bottom:5px;">United Kingdom</option>';
		}
		for($i=0;$i<count($array);$i++)
		{
			echo '
			<option '; if($array[$i][$array_value]==$current_item) echo 'selected '; echo 'value="'.$array[$i][$array_value].'">'.$array[$i][$array_display].'</option>';
		}
		echo '</select>'; 
		if(isset($title)) 
		{ 
			echo "<img class='help_hover_me' src='/images/moreInformation.gif' />"; 
			echo "<div style='padding:10px;position:absolute;left:550px;display:none;font-size:12px;border:1px solid #000;background-color:#CCC;width:350px;'><strong>".$name."</strong><br /><br />".$info."</div>";
		}
		echo '</td></tr>';
	}
	
	function formSelectRowN($name,$field,$array,$array_display,$array_value,$current_item,$search=0,$locked=0,$info='',$extra='')
	{
		if($info!='') $title = $info;
		if($locked==1)
		{			
			echo '<select '.$extra.' disabled name="'.$field.'">';
		}
		else
		{
			echo '<select id="'.$field.'" '.$extra.' name="'.$field.'">';
		}
		if($search==1)
		{
			echo '<option value="" >-- All --</option>';
		}
		else if($search==2)
		{
			echo '<option value="0" >-- None --</option>';
		}
		else if($search==3)
		{
			echo '<option value="" >-- Select --</option>';
		}
		for($i=0;$i<count($array);$i++)
		{
			echo '
			<option '; if($array[$i][$array_value]==$current_item) echo 'selected '; echo 'value="'.$array[$i][$array_value].'">'.$array[$i][$array_display].'</option>';
		}
		echo '</select>'; if(isset($title)) { echo "<img id='".$field."' src='/images/moreInformation.gif' onmouseout=\"HideHelp('".$field."');\" 
onmouseover=\"ShowHelp('".$field."', '".$name."', '".$title."')\" />"; }
	}
	
	function formSelectRowMulti($name,$field,$array,$array_display,$array_value,$current_item,$search=0,$locked=0,$info='')
	{
		if($info!='') $title = $info;
		echo '
	<tr>
		<td>'.$name; echo '</td>
		<td>
		';
		if($locked==1)
		{			
			echo '<select disabled name="'.$field.'">';
		}
		else
		{
			echo '<select name="'.$field.'" multiple>';
		}
		if($search==1)
		{
			echo '<option value="" >-- All --</option>';
		}
		else if($search==2)
		{
			echo '<option value="0" >-- None --</option>';
		}
		for($i=0;$i<count($array);$i++)
		{
			echo '
			<option '; if($array[$i][$array_value]==$current_item) echo 'selected '; echo 'value="'.$array[$i][$array_value].'">'.$array[$i][$array_display].'</option>';
		}
		echo '</select>'; if(isset($title)) { echo "<img id='".$field."' src='/images/moreInformation.gif' onmouseout=\"HideHelp('".$field."');\" 
onmouseover=\"ShowHelp('".$field."', '".$name."', '".$title."')\" />"; } echo '</td></tr>';
	}
	
	function formCalendar($form,$name,$field,$current_item='')
	{
		echo '
		<tr>
			<td>'.$name.'</td>
			<td><input name="'.$field.'" type="text" value="'.$current_item.'" />
			<script language="JavaScript" type="text/javascript">
		var o_cal = new tcal ({
			// form name
			\'formname\': \''.$form.'\',
			// input name
			\'controlname\': \''.$field.'\'
		});	
		</script>
    	</td></tr>';
	}
	
	function formTick($name,$value,$field,$current='',$info='')
	{
		if($info!='') $title = $info;
		 echo '
		 <input type="checkbox"'; if($current==$value) echo 'checked'; echo ' name="'.$field.'" value="'.$value.'"  />'; if(isset($title)) 
		{ 
			echo "<img class='help_hover_me' src='/images/moreInformation.gif' />"; 
			echo "<div style='padding:10px;position:absolute;left:550px;display:none;font-size:12px;border:1px solid #000;background-color:#CCC;width:350px;'><strong>".$name."</strong><br /><br />".$info."</div>";
		}
	}
	

		
	
	function formAddCK($field)
	{
		echo "<script type=\"text/javascript\">
	CKEDITOR.replace( '".$field."',
{
 filebrowserBrowseUrl : '/admin/ckfinder/ckfinder.html',
 filebrowserImageBrowseUrl : '/admin/ckfinder/ckfinder.html?Type=Images',
 filebrowserFlashBrowseUrl : '/admin/ckfinder/ckfinder.html?Type=Flash',
 filebrowserUploadUrl : '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
 filebrowserImageUploadUrl : '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
 filebrowserFlashUploadUrl : '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
});
</script>";
	}
	
	function formSelect($name,$field,$array,$array_display,$array_value,$current_item,$search=0,$locked=0)
	{
		if($locked==1)
		{			
			echo '<select disabled name="'.$field.'">';
		}
		else
		{
			echo '<select name="'.$field.'">';
		}
		if($search==1)
		{
			echo '<option value="" >-- All --</option>';
		}
		for($i=0;$i<count($array);$i++)
		{
			echo '
			<option '; if($array[$i][$array_value]==$current_item) echo 'selected '; echo 'value="'.$array[$i][$array_value].'">'.$array[$i][$array_display].'</option>';
		}
		echo '</select>';
	}
	
	function Helper($name, $field, $title)
	{
		echo " id='".$field."' onmouseout=\"HideHelp('".$field."');\" onmouseover=\"ShowHelp('".$field."', '".$name."', '".$title."')\" "; 
	}
	
}