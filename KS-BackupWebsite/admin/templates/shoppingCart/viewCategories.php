<h1>View Categories</h1>
<p>Please select an option to perform on the following categories</p>
<table>
	<tr class="searchtitle">
    	<td>Category Name</td>
        <td>Description</td>
        <td>Parent Category</td>
        <td>Visible</td>
        <td>No. Views</td>
        <td>Actions</td>
	</tr>
    <?php  
for($i=0;$i<count($data);$i++)
{
	$parent_data = $this->SelectQuery("SELECT category_name FROM tbl_shop_settings_categories WHERE id = '".$data[$i]['parent_categoryid']."'","master");
	$views_data = $this->SelectQuery("SELECT COUNT(id) as cnt FROM tbl_shop_logging_views WHERE type='category' AND item_id = '".$data[$i]['id']."'","master");
	if(count($parent_data)==0) $parent_data[0]['category_name'] = 'None';
	if($i%2) $class = 'searchResult1';
	else $class = 'searchResult2';
	?>
    <tr class="<?php echo $class;?>">
    	<td><?php echo $data[$i]['category_name'];?></td>
        <td><?php echo trim(strip_tags(substr($data[$i]['description'],0,90))).'...';?></td>
    	<td><?php echo $parent_data[0]['category_name'];?></td>
    	<td><?php echo $data[$i]['visible'];?></td>
        <td><?php echo $views_data[0]['cnt'];?></td>   
		<td><?php echo ResultSetPagination::displayActions($data[$i]['id']);?></td>        
	</tr>
    <?php
}
?>
</table>
