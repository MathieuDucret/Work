<h1>View Portfolio</h1>
<p>Please select an option to perform on the following pages.</p>
<table>
	<tr class="searchtitle">
    	<td>Title</td>
        <td>Image Location</td>
        <td>Link Url</td>
        <td>Description</td>
        <td>Order Number</td>
        <td>Actions</td>
	</tr>
    <?php  
	$rsObj = new ResultSetPagination;
for($i=0;$i<count($data);$i++)
{
	if($i%2) $class = 'searchResult1';
	else $class = 'searchResult2';
	?>
    <tr class="<?php echo $class;?>">
    	<td><?php echo $data[$i]['title'];?></td>
        <td><?php echo $data[$i]['image_location'];?></td>
    	<td><?php echo $data[$i]['link_url'];?></td>
    	<td><?php echo $data[$i]['description'];?></td>
        <td><?php echo $data[$i]['order_no'];?></td>   
		<td><?php echo $rsObj->displayActions($i);?></td>        
	</tr>
    <?php
}
?>
</table>
