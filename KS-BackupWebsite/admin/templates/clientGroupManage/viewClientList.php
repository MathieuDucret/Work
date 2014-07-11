<?php
/****************************************
* Author - esyed
* Company - Internet Concepts Limited
* 16/11/2009 - pagination added
*  
*****************************************/
?>

<h1>View Client User List</h1>
<div style="text-align:right;">
<div id="resultCount"><?php echo $rsObj->total_items;?> results found</div>
<?php
$rsObj->getPreviousNextMenu();
?>
<br />
<?php
$rsObj->getNumberLinks();
?>
</div>
<table width="100%">
	<tr class="searchtitle">
		<td>Username</td>
        <td>Type</td>
        <td>Company Name</td>
        <td>Email</td>
        <td>Approve</td>
	</tr>        
	<?php for($i=0;$i<count($data);$i++){
		if($data[0]['clientgroupid']=='3')
		{
			$candidate_data = $this->SelectQuery("SELECT * FROM tbl_candidates_data WHERE client_id = '".$data[$i]['id']."'","master");
			$name = $candidate_data[0]['name'];
			$type = 'Candidate';
		}
		else
		{
			$name = $data[$i]['company'];
			$type = 'Company';
		}
	if($i%2){$style=' class="searchResult1"';} else {$style= ' class="searchResult2"'; }?>	
    <tr <?php echo $style; ?>>
    	<td><?php echo $data[$i]['username'];?></td>
        <td><?php echo $type;?></td>
    	<td><?php echo $name;?></td>
    	<td><?php echo $data[$i]['email'];?></td>
        <td><a href="/admin/actions/modules/clientGroupManage/editClientUser/<?php echo $data[$i]['id'];?>/">Edit User</a></td>
        <td><a href="/admin/actions/modules/clientGroupManage/deleteClientUser/<?php echo $data[$i]['id'];?>/">Delete User</a></td> 
	</tr>       
    <?php }?>
</table>	