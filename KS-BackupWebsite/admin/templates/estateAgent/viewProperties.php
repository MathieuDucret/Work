<style>
tr#bold td {
	font-weight:bold;
}
</style>
<h1>View Properties</h1>
<p>Please select an option to perform on the following properties</p>
<div>
        <?php
		$property_type_array = $this->SelectQuery("SELECT * FROM tbl_estateagent_property_types WHERE visible = '1'","master");
		$property_status_array = $this->SelectQuery("SELECT * FROM tbl_estateagent_property_statuses WHERE visible = '1'","master");
		$formObj = new formCreator;
		$formObj->formNew('propertySearch');
		$formObj->formtextRow('Address 1','address_1',$_POST['address_1']);
		$formObj->formtextRow('Town','town',$_POST['town']);
		$formObj->formtextRow('Postcode','postcode',$_POST['postcode']);
		$formObj->formSelectRow('Buy/Let','ownership',array(array('value'=>'Buy'),array('value'=>'Let')),'value','value',$_POST['ownership'],1);
		$formObj->formtextRow('Bedrooms','bedrooms',$_POST['bedrooms']);
		$formObj->formtextRow('Bathrooms','bathrooms',$_POST['bathrooms']);
		$formObj->formSelectRow('Property Status','property_status',$property_status_array,'name','id',$_POST['property_status'],1);       
		$formObj->formSelectRow('Featured?','featured',array(array('display'=>'No','value'=>'0'),array('display'=>'Yes','value'=>'1')),'display','value',$_POST['featured'],1);
		$formObj->formSubmit('Search');
		?>
<table>
	<tr>
    	<td>Address 1</td>
        <td>Town</td>
        <td>Postcode</td>        
        <td>Let/Buy</td>
        <td>Beds</td>
        <td>Baths</td>
        <td>Property Status</td>
        <td>Featured?</td>
        <td>Actions</td>
	</tr>        
        
   <?php  
for($i=0;$i<count($data);$i++)
{
	if($i%2) $class = 'searchResult1';
	else $class = 'searchResult2';
	?>
    <tr class="<?php echo $class;?>">
    	<td><?php echo $data[$i]['address_1'];?></td>
    	<td><?php echo $data[$i]['town'];?></td>
    	<td><?php echo $data[$i]['postcode'];?></td>
        <td><?php echo $data[$i]['ownership'];?></td>
        <td><?php echo $data[$i]['bedrooms'];?></td>
        <td><?php echo $data[$i]['bathrooms'];?></td>
        <td><?php echo $this->id2text('statuses',$data[$i]['property_status']);?></td>
        <td><?php if($data[$i]['featured']=='1') echo 'Featured'; else echo 'Not Featured';?></td>
		<td><?php echo ResultSetPagination::displayActions($data[$i]['id']);?></td>        
	</tr>
    <?php
}
?>
</table>
