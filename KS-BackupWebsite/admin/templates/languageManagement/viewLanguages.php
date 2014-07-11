<style>
tr#bold td {
	font-weight:bold;
}
</style>
<h1>View Languages</h1>
<p>Please select an option to perform on the following languages</p>
<table>
	<tr class="searchtitle">
    	<td>Id</td>
    	<td>Language</td>
        <td>Status</td>
        <td>Default Language</td>
        <td>Actions</td>
	</tr>
    <tr id="bold">
    	<td><?php echo $data[0]['id'];?></td>
    	<td><?php echo $data[0]['language'];?></td>
    	<td><?php if($data[0]['active']==1) echo 'Active'; else echo 'Disabled';?></td>
        <td>Yes</td>
		<td><?php echo ResultSetPagination::displayActions($data[0]['id']);?></td>        
	</tr>
    <?php  
for($i=1;$i<count($data);$i++)
{
	if($i%2) $class = 'searchResult1';
	else $class = 'searchResult2';
	?>
    <tr class="<?php echo $class;?>">
    	<td><?php echo $data[$i]['id'];?></td>
    	<td><?php echo $data[$i]['language'];?></td>
    	<td><?php if($data[$i]['active']==1) echo 'Active'; else echo 'Disabled';?></td>
        <td>No</td>
		<td><?php echo ResultSetPagination::displayActions($data[$i]['id']);?></td>        
	</tr>
    <?php
}
?>
</table>
