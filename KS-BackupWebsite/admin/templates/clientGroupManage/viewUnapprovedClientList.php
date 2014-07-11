<h1>View Unapproved Client User List</h1>
<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/?>
<table width="100%">
	<tr class="searchtitle">
		<td>Username</td>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Company</td>
        <td>Email</td>
        <td>Approve</td>
	</tr>        
	<?php for($i=0;$i<count($data);$i++)
	{		
	if($i%2){$style=' class="searchResult1"';} else {$style= ' class="searchResult2"'; }?>	
    <tr <?php echo $style; ?>>
    	<td><?php echo $data[$i]['username'];?></td>
    	<td><?php echo $data[$i]['first_name'];?></td>
        <td><?php echo $data[$i]['last_name'];?></td>
        <td><?php echo $data[$i]['company'];?></td>
    	<td><?php echo $data[$i]['email'];?></td>
    	<td><a href="/admin/actions/modules/clientGroupManage/approveClientUser/<?php echo $data[$i]['id'];?>/">Approve</a> / <a href="/admin/actions/modules/clientGroupManage/deleteClientUser/<?php echo $data[$i]['id'];?>/">Delete</a></td>    
	</tr>
    <?php } ?>
</table>