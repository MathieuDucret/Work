<?php
/****************************************
* Author - Ebad Syed
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/


?>
<h1>View link requests. Approve or Reject them</h1>
<h2>If you wish to edit the links, please click on the ID of appropriate link.</h2>



<table width="100%">
	<tr class="searchtitle">
		<td>ID</td>
        <td>First Name</td>
        <td>Surname</td>
        <td>Email</td>
        <td>Phone</td>
        <td>Website</td>
        <td>Link to be added</td>
        <td>Category for link</td>
        <td>Date Link requested</td>
        <td>Approve/Reject</td>

   	</tr>  
   
          
	<?php for($i=0;$i<count($data);$i++)
	{		
	if($i%2){$style=' class="searchResult1"';} else {$style= ' class="searchResult2"'; }?>	
    <tr <?php echo $style; ?>>
    	<td><a href ="/admin/actions/modules/link_directory/edit_link/<?php echo $data[$i]['id'];?>/"><?php echo $data[$i]['id'];?></a></td>
        <td><?php echo $data[$i]['first_name'];?></td>
        <td><?php echo $data[$i]['sur_name'];?></td>
        <td><?php echo $data[$i]['email'];?></td>
        <td><?php echo $data[$i]['phone'];?></td>
        <td><?php echo $data[$i]['website_name'];?></td>
        <td><?php echo $data[$i]['link_to_be_added'];?></td>
        <td><?php echo $data[$i]['category_for_link'];?></td>
        <td><?php echo $data[$i]['linkrequest_date'];?></td>
        <td><a href='/admin/actions/modules/link_directory/approve_link/<?php echo $data[$i]['id'];?>/'>Approve</a> / <a href='/admin/actions/modules/link_directory/reject_link/<?php echo $data[$i]['id'];?>/'>Reject</a></td>
	</tr>
    <?php 
	}
	?>
</table>
</body>
</html>
