<h1>View Shipping Options</h1>
<p>Please select an option to perform on the following shipping options</p>
<table>
	<tr class="searchtitle">
    	<td>Display Name</td>
        <td>Cost</td>
        <td>Delivery Time</td>
        <td>Actions</td>
	</tr>
    <?php  
for($i=0;$i<count($data);$i++)
{
	if(count($parent_data)==0) $parent_data[0]['category_name'] = 'None';
	if($i%2) $class = 'searchResult1';
	else $class = 'searchResult2';
	?>
    <tr class="<?php echo $class;?>">
    	<td><?php echo $data[$i]['name'];?></td>
    	<td><?php echo $data[$i]['cost'];?></td>
        <td><?php echo $data[$i]['delivery_time'];?></td>   
		<td><?php echo ResultSetPagination::displayActions($data[$i]['id']);?></td>        
	</tr>
    <?php
}
?>
</table>
