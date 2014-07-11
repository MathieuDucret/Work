<?php
/****************************************
* Author - Ebad Syed
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/?>
<h1>View Link Categories</h1>
<p>Please select an option to perform on the following categories.</p>
<table width="100%">
	<tr class="searchtitle">
		<td>ID</td>
        <td>Category Name</td>
        <td>Description</td>
        <td>Status</td>
        <td>Actions</td>
   	</tr>        
	<?php for($i=0;$i<count($data);$i++)
	{		
	if($i%2){$style=' class="searchResult1"';} else {$style= ' class="searchResult2"'; }?>	
    <tr <?php echo $style; ?>>
    	<td><?php echo $data[$i]['id'];?></td>
        <td><a href="/admin/viewrequestedlinks/<?php echo $data[$i]['id'];?>/"><?php echo $data[$i]['name'];?></a></td>       
     
        <td><?php echo $data[$i]['description'];?></td>
        <td><?php echo $data[$i]['status'];?></td>     
        <td><a href='/admin/actions/modules/link_directory/edit_links_category/<?php echo $data[$i]['id'];?>/'>Edit</a> / <a href='/admin/actions/modules/link_directory/delete_links_category/<?php echo $data[$i]['id'];?>/'>Delete</a></td>
	</tr>
    <?php 
	}
	?>
</table>