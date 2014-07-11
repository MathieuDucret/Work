<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/?>
<h1>Delete Link</h1>
<form name="deletepage" action="/admin/deletelinklinkdirectory" method="post">
<input type="hidden" name="id" value="<?php echo $data[0]['id'];?>"  />

<table width="100%" border="0" cellspacing="1" cellpadding="2">
<input type="hidden" name="id" value =" <?php echo $data[0]['id'];?>">
	<tr><td colspan="2"></td></tr>
	  <tr>
		<td width="30%" align="right" valign="middle">First name :</td>
		<td width="70%" align="left" valign="middle">
			<input readonly name="first_name" id="first_name" type="text" value= "<?php echo $data[0]['first_name'];?>"  style="width:50%">
        </td>
	  </tr>
	  <tr>
		<td align="right" valign="middle">Sur Name :</td>

		<td align="left" valign="middle">
		<input id="sur_name" name="sur_name" type="text"  value= "<?php echo $data[0]['sur_name'];?>" style="width:50%"></td>
	  </tr>
	  <tr>
	  <td align="right" valign="middle">Email :</td>
	  <td align="left" valign="middle">
	  <input type="text" name="email" id="email" value= "<?php echo $data[0]['email'];?>" style="width:50%" /></td>
	  </tr>

	  <tr>
	  <td align="right" valign="middle">Phone :</td>
	  <td align="left" valign="middle">
	  <input type="text" name="phone" id="phone" value= "<?php echo $data[0]['phone'];?>" style="width:50%" /></td>
	  </tr>
	  <tr>
	  <td align="right" valign="middle">Website Name :</td>
	  <td align="left" valign="middle">

	  <input type="text" name="website_name" id="website_name" value= "<?php echo $data[0]['website_name'];?>" style="width:50%" /></td>
	  </tr>
	  <tr>
	  <td align="right" valign="middle">Link to be added :</td>
	  <td align="left" valign="middle"><input type="text" name="link_to_be_added" id="link_to_be_added" class="normaltextfield1" value= "<?php echo $data[0]['link_to_be_added'];?>" style="width:50%" /></td>
	  </tr>
	  <tr>
	  <td align="right" valign="middle">Text for link :</td>

	  <td align="left" valign="middle"><input type="text" name="text_for_link" id="text_for_link"  value= "<?php echo $data[0]['text_for_link'];?>" style="width:50%" /></td>
	  </tr>
	  <tr>
	  <td align="right" valign="top">Site Description :</td>
	  <td align="left" valign="middle">
	  <textarea name="site_description" cols="65" rows="10" id="site_description"><?php echo $data[0]['site_description'];?>"</textarea></td>
	  </tr>
	  <tr>

	  <td align="right" valign="middle">Category of link :</td>
	  <td align="left" valign="middle">
      
      
      
	  <select name="category_for_link" id="category_for_link" class="normaltextfield1" style="width:50%">
      
      
	  <option value="0">--Select--</option>
      <?php for ($i=0; $i<count($catList); $i++) {   ?>
      
	  	  	<option value="<?php echo $catList[$i]['id'];?>" <?php if ($catList[$i]['id']==$data[0]['category_for_link']){echo "selected";}?>><?php echo $catList[$i]['name']?></option>
	  <?php } ?>  	
	  	  </select></td>
	  </tr>
	  <tr>
		<td align="right" valign="middle">Url of Reciprocal link :</td>
		<td align="left" valign="middle">

		<input type="text" name="url_for_reciprocal_link" id="url_for_reciprocal_link" value= "<?php echo $data[0]['url_for_reciprocal_link'];?>" style="width:50%" /></td>
		</td>
	  </tr>
	  <tr>
		<td align="right" valign="middle">&nbsp;</td>
<tr><td>
		<input type="submit" name="submit" value="EDIT" /></td>
</td>	  </tr>

	</table>
</form>