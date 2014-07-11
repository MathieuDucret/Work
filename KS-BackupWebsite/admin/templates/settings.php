<?php
/****************************************
* Author - esyed
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/?>
<script type="text/javascript">
function validateOnSubmit() {
  var message = "";
  var errcount = 0;
  
  	
	//read the values from the form
	var link_alignment= document.settings.link_alignment.value;
	var subdomains= document.settings.subdomains.value;
	var background_color= document.settings.background_color.value;
	var font_family= document.settings.font_family.value;
    var curved_corners= document.settings.curved_corners.value;
	var header_background_color= document.settings.header_background_color.value;
	var wrapper_background_color= document.settings.wrapper_background_color.value;
	var h1_color= document.settings.h1_color.value;
	var h2_color= document.settings.h2_color.value;
    var h3_color= document.settings.h3_color.value;
	var h4_color= document.settings.h4_color.value;
	var label_color= document.settings.label_color.value;
	var p_size= document.settings.p_size.value;



	var width= document.settings.width.value;
	var width_last_two_char=width.charAt(width.length-2) + width.charAt(width.length-1);
	var width_last_char = width.charAt(width.length-1);
	
	var margin_left= document.settings.margin_left.value;
	var margin_left_last_two_char=margin_left.charAt(margin_left.length-2) + margin_left.charAt(margin_left.length-1);
	var margin_left_last_char = margin_left.charAt(margin_left.length-1);
	
	var margin_right= document.settings.margin_right.value;
	var margin_right_last_two_char=margin_right.charAt(margin_right.length-2) + margin_right.charAt(margin_right.length-1);
	var margin_right_last_char = margin_right.charAt(margin_right.length-1);
	
	
	var image_margin_left= document.settings.margin_left.value;
	var image_margin_left_last_two_char=image_margin_left.charAt(image_margin_left.length-2) + image_margin_left.charAt(image_margin_left.length-1);
	var image_margin_left_last_char = image_margin_left.charAt(image_margin_left.length-1);
	
	var image_margin_right= document.settings.image_margin_right.value;
	var image_margin_right_last_two_char=image_margin_right.charAt(image_margin_right.length-2) + image_margin_right.charAt(image_margin_right.length-1);
	var image_margin_right_last_char = image_margin_right.charAt(image_margin_right.length-1);
	
	//alert("width = "+ width_last_two_char + " margin right = " + margin_right_last_two_char+ " margin left = " + margin_left_last_two_char +" image margin left = "+ image_margin_left_last_two_char+" image margin right=" + image_margin_right_last_two_char + ".");
	
	var fieldNameList = new Array("Width", "Margin Left", "Margin Right", "Image Margin Left", "Image margin Right");
	//define array for the last char
	var last_char_list = new Array(width_last_char, margin_left_last_char, margin_right_last_char, image_margin_left_last_char, image_margin_right_last_char);
	
	//define array fro teh last 2 chars
	var last2_char_list = new Array(width_last_two_char, margin_left_last_two_char, margin_right_last_two_char, image_margin_left_last_two_char, image_margin_right_last_two_char );

    var size_extensions=new Array("px","pt","em");
	
	
	for (j=0;j<last2_char_list.length;j++){
		//check if the 
		count =1;
		for (i=0;i<size_extensions.length;i++)
			{ 
				if (last_char_list[j] == "%")
				{	
				//alert ("you have got the correct extension in field" + fieldNameList[j]);
				//if a correct ext found for a field, check for the next field in the list
				break
				} 
				else if (size_extensions[i] == last2_char_list[j])
				{
				//alert ("you have got the correct extension in field" + fieldNameList[j]);
				//if a correct ext found for a field, check for the next field in the list
				break				
				}
				else 
				{
				count++;
					if (count >= size_extensions.length)
					{
					message = message + "check the size definition in " + fieldNameList[j] + "\n";
					break
					//alert ("" + message);
					//return false;
					}		
				//return false;
				}
			}
		}
  var allFormFieldValArr = new Array(link_alignment,subdomains,background_color,font_family,width,margin_left,margin_right,curved_corners,header_background_color,wrapper_background_color,image_margin_left,image_margin_right,h1_color,h2_color,h3_color,h4_color,label_color,p_size);
  
  var allFormFieldNameArr = new Array("Link Alignment", "Subdomains", "Background color", "Font Family", "Width", "Margin Left", "Margin Right", "curved corners", "Header background color", "Wrapper Background color", "image Margin Left", "image Margin Right", "Header One color", "Header two color", "Header three color", "Header four color", "Label Color", "Font Size");
  
  
  		for (k=0; k< allFormFieldValArr.length; k++)
  		{
  			if (allFormFieldValArr[k] == "")
  			{
				message = message + "Mandatory: " + allFormFieldNameArr[k] + "\n"; 
	
			}
  		}
  //check if the value for message has been set in the previous checks
  			if (message == "")
  			{
				//alert ("your form is good to go");
				return true;
  			}
  			else
  			{
				alert ("please check the following and resubmit \n" +  message);
  				return false;
  			}

  }

</script>






<h1>Edit Settings</h1>
<form name="settings" action="settings" method="post">
<table align="center">
	<tr>
	  <td colspan="2"><?php echo $errmsg;?></td>
    </tr>
    <table>
    <tr>
    <td>
    <h2>General Settings</h2>
    </td>
    </tr>
    <?php for($i=0;$i<count($settings);$i++){?>
    <tr>
    	<td><?php echo $settings[$i]['display_name'];?></td>
        <td><input type="text" name="<?php echo $settings[$i]['setting'];?>" value="<?php echo $settings[$i]['value'];?>"></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    </tr>
    <?php } ?>  
    </table>
    <table>
    <tr>
    <td>
    <h2>CSS Settings (test)</h2>
    </td>
    </tr>
    <?php 
	$page_alignment    = array(0 => "Auto", 1 => "Left", 2 => "Right");
	$background_repeat = array(0 => "No-Repeat", 1 => "Repeat-Y", 2 => "Repeat-X");
	$body_background_repeat = array(0 => "No-Repeat", 1 => "Repeat-Y", 2 => "Repeat-X");
	$font_alignment = array(0 => "left", 1 => "right", 2 => "justify", 3 => "center", 4 => "inherit");
	
	for($j=0;$j<count($css);$j++)
		{
	?>
    <tr>
    <?php 
	if($css[$j]['is_dropdown']==0) 
	{ 	
	?>
    <!--only display the text fields and leave the drop downs -->
    	<td><?php  {echo $css[$j]['display_name'];}?></td>
        <td><input <?php if($css[$j]['color_picker']==1) {echo 'class="color {hash:true}"';}?> type="text" name="<?php echo $css[$j]['property'];?>" value="<?php echo $css[$j]['value'];?>"></td>
    </tr>
    <?php 
	}    
	elseif ($css[$j]['is_dropdown']==1)
	{ 		
		?>
        <td><?php echo $css[$j]['display_name'];?></td>
		<td><select name='<?php echo $css[$j]['property']?>'>
			<?php 
			$arrayName = ${$css[$j]['property']};
			for ($k=0;$k<count($arrayName);$k++)
			{?>
			<option value='<?php echo $arrayName[$k];?>' <?php echo $css[$j]['value'] == $arrayName[$k] ? " selected style='font-weight:bold;'": ''; ?>><?php echo $arrayName[$k]?></option>
  			<?php 
			}?>				
			</select>
		</td>
		<?php 
		}
	} 
	?> 
    	<td><input type="submit" name="submit" value="submit" onclick="return validateOnSubmit()"/></td>
    </tr>
    </table> 
</table>
</form>