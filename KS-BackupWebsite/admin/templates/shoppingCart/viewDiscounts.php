<h1>View Discounts</h1>
<p>Please select an option to perform on the following discounts</p>
<table>
	<tr class="searchtitle">
    	<td>Id</td>
        <td>Discount Code</td>
        <td>Discount Type</td>
        <td>Discount Amount</td>
        <td>Expiry Date</td>
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
    	<td><?php echo $data[$i]['discount_code'];?></td>
    	<td><?php echo $data[$i]['discount_type'];?></td>        
    	<td><?php echo $data[$i]['amount'];?></td>        
    	<td><?php echo $data[$i]['expiry_date'];?></td>        
		<td><?php echo ResultSetPagination::displayActions($data[$i]['id']);?></td>        
	</tr>
    <?php
}
?>
</table>
