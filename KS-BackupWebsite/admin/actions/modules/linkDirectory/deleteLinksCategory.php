<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/?>
<h1>Delete Links Category</h1>
<form name="deletepage" action="/admin/linkDirectory/deleteLinksCategory" method="post">
<input type="hidden" name="id" value="<?php echo $data[0]['id'];?>"  />

<table align="center">
	<tr>
	  <td colspan="2"><?php echo $errmsg;?></td>
    </tr>
    <tr>
    	<td>Category Name</td>
        <td>
        <input  type="text" name="name" value= "<?php echo $data[0]['name'];?>" readonly/>
        </td>
    </tr>
	<tr>
	  <td>Description</td>
	  <td>
      <textarea name="description" readonly><?php echo $data[0]['description'] ?></textarea>
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
      <input type="submit" value="Delete" name = "submit" />
      </td>
    </tr>
</table>
</form>