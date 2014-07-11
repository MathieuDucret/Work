<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/?>
<h1>Delete Property</h1>
<p>Please review the information on this screen, then press submit at the bottom of the page to delete this property and all associated information</p>
<?php
$formObj = new formCreator;
$areas_array = $formObj->SelectQuery("SELECT * FROM tbl_areas ORDER BY Area ASC","master");
$property_type_array = $formObj->SelectQuery("SELECT * FROM tbl_estateagent_property_types WHERE visible = '1'","master");
$property_status_array = $formObj->SelectQuery("SELECT * FROM tbl_estateagent_property_statuses WHERE visible = '1'","master");
$number_array = array();
for($i=1;$i<=10;$i++){ $number_array[]['name'] = $i; }
?>
<?php if($errmsg != '') echo '<div class="errmsg">'.$errmsg.'</div>';?>
<form name="addProperty" action="" method="post">
<table align="center">
	<?php
	$formObj->formtextRow('Address Line 1*','address_1',$data[0]['address_1'],1);
	$formObj->formtextRow('Address Line 2','address_2',$data[0]['address_2'],1);
	$formObj->formtextRow('Address Line 3','address_3',$data[0]['address_3'],1);
	$formObj->formSelectRow('Town*','town',$areas_array,'Area','Area',$data[0]['town'],4);
    $formObj->formtextRow('Town (if Other)','town_other',$data[0]['town'],1);
	$formObj->formtextRow('Postcode*','postcode',$data[0]['postcode'],1);
	$formObj->formSelectRow('Buy/Let*','ownership',array(array('name'=>'Buy'),array('name'=>'Let')),'name','name',$data[0]['ownership'],3);
	$formObj->formSelectRow('Furnished?','furnished',array(array('name'=>'Yes','value'=>'1'),array('name'=>'No','value'=>'0')),'name','value',$data[0]['ownership'],3);
	$formObj->formSelectRow('Tenure','tenure',array(array('name'=>'Freehold'),array('name'=>'Leasehold')),'name','name',$data[0]['tenure'],3);
	$formObj->formSelectRow('Bedrooms','bedrooms',$number_array,'name','name',$data[0]['bedrooms']);
	$formObj->formSelectRow('Bathrooms','bathrooms',$number_array,'name','name',$data[0]['bathrooms']);
	for($i=1;$i<=10;$i++)
	{
		$formObj->formtextRow('Feature '.$i,'feature_'.$i,$data[0]['feature_'.$i]);
	}
	$formObj->formtextAreaRow('Summary','summary',$data[0]['summary'],6,60);
	$formObj->formtextAreaRow('Description','description',$data[0]['description'],10,60);
	$formObj->formSelectRow('Property Type','property_type',$property_type_array,'name','id',$data[0]['property_type']);
	$formObj->formtextRow('Price &pound;','price',$data[0]['price'],1);
	$formObj->formSelectRow('Property Status','property_status',$property_status_array,'name','id',$data[0]['property_status']);
	
	?>
    <tr>
    	<td><h2>Image Data</h2></td>
		<td><div id="propertyImageBooth"><?php echo $image_output;?></div></td>
	</tr>     
    <tr>
    	<td><h2>Floorplan Data</h2></td>
		<td><div id="propertyPlanBooth"><?php echo $plan_output;?></div></td>
	</tr>          
    <?php                 
	$formObj->formSubmit();
	?>    
