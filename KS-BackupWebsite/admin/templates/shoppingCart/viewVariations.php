<h1>View Variations</h1>
<p>Please select an option to perform on the following variations</p>
<table>
	<tr class="searchtitle">
    	<td>Id</td>
        <td>Variation Name</td>
        <td>Actions</td>
	</tr>
    <?php  
for($i=0;$i<count($data);$i++)
{
	if($i%2) $class = 'searchResult1';
	else $class = 'searchResult2';
	?>
    <tr class="<?php echo $class;?>">
  		<td><?php echo $data[$i]['id'];?></td>
    	<td><?php echo $data[$i]['variation_name'];?></td>
		<td><?php echo ResultSetPagination::displayActions($data[$i]['id']);?></td>        
	</tr>
    <?php
}
?>
</table>
