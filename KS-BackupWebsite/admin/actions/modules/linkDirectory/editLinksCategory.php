<?php
/****************************************
* Author - esyed
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/?>
<h1>Edit Link category</h1>
<form name="editpage" action="/admin/linkDirectory/editLinksCategory" method="post">
<input type="hidden" name="id" value="<?php echo $data[0]['id'];?>"  />

<table align="center">
	<tr>
	  <td colspan="2"><?php echo $errmsg;?></td>
    </tr>
    <tr>
    	<td>Category Name</td>
        <td>
        <input type="text" name="name" value= "<?php echo $data[0]['name'];?>"/>
        </td>
    </tr>
	<tr>
	  <td>Description</td>
	  <td>
      <textarea name="description"><?php echo $data[0]['description'] ?></textarea>
      </td>
    </tr>
	<tr>
	  <td>Status</td>
	  <td>
		<select name="status">
        
        	<option value="1" <?php if($data[0]['status'] == 1) echo "selected"; ?>>Active</option>
            <option value="0" <?php if($data[0]['status'] == 0) echo "selected"; ?>>In-Active</option>
        </select>
	  </td>
      <td>
      <input type="submit" value="Submit" name = "submit" onClick="return validateOnSubmit()"/>
      </td>
    </tr>
</table>
</form>