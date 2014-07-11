<style>
tr#bold td {
	font-weight:bold;
}
</style>
<script type="text/javascript">
$(function(){	
	$('#date_added_from').datepicker({
		dateFormat: 'dd-mm-yy'
	});
	$('#date_added_to').datepicker({
		dateFormat: 'dd-mm-yy'
	});
	$('#order').change(function(){
		$('#venueSearch').submit();
	});
	$(".resizeme").aeImageResize({height: 100, width: 100});
});
</script>				
				
<h1>View Gallery</h1>
<p>Please select an option to perform on the following gallery items</p>
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
<table>
	<tr>
    	<td>Id</td>
        <td>Title</td>
        <td>Image Location</td>        
        <td>Active</td>
        <td>Date added</td>
        <td>Preview</td>        
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
    	<td><?php echo $data[$i]['title'];?></td>
    	<td><?php echo $data[$i]['image_location'];?></td>
        <td><?php if($data[$i]['active']==1) echo 'Yes'; else echo 'No';?></td>
        <td><?php echo $data[$i]['date_added'];?></td>
        <td><img class="resizeme" src="<?php echo $data[$i]['image_location'];?>" /></td>
		<td><?php echo ResultSetPagination::displayActions($data[$i]['id']);?></td>        
	</tr>
    <?php
}
?>
</table>
