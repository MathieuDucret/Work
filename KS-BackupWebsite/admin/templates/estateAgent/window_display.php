<div>
        <?php
		$property_type_array = $this->SelectQuery("SELECT * FROM tbl_estateagent_property_types WHERE visible = '1'","master");
		$property_status_array = $this->SelectQuery("SELECT * FROM tbl_estateagent_property_statuses WHERE visible = '1'","master");
		$formObj = new formCreator;
		$formObj->formNew('propertySearch');
		?>
        <input type="hidden" name="pdf_type" value="<?php echo $_POST['pdf_type'];?>" />
        <?php
		$formObj->formtextRow('Address 1','address_1',$_POST['address_1']);
		$formObj->formtextRow('Town','town',$_POST['town']);
		$formObj->formtextRow('Postcode','postcode',$_POST['postcode']);
		$formObj->formtextRow('Let/Buy','ownership',$_POST['ownership']);
		$formObj->formtextRow('Bedrooms','bedrooms',$_POST['bedrooms']);
		$formObj->formtextRow('Bathrooms','bathrooms',$_POST['bathrooms']);
		$formObj->formSelectRow('Property Status','property_status',$property_status_array,'name','id',$data[0]['property_status']);       
		$formObj->formSubmit('Search');
		?>
<div style="text-align:right;">
<div id="resultCount"><?php echo $rsObj->total_items;?> results found for your search</div>
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
    	<td>Address 1</td>
        <td>Town</td>
        <td>Postcode</td>        
        <td>Let/Buy</td>
        <td>Beds</td>
        <td>Baths</td>
        <td>Property Status</td>
        <td>Actions</td>
	</tr>        
        
   <?php  
for($i=1;$i<count($data);$i++)
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
        <td><?php echo $data[$i]['property_status'];?></td>
		<td><a href="/admin/actions/modules/estateAgent/outputWindowPropertyPdf/<?php echo $data[$i]['id'];?>/">Single PDF</a></td>        
	</tr>
    <?php
}
?>
</table>