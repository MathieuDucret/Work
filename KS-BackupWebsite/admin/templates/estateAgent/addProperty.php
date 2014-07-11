<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/?>
<script type="text/javascript">
$(document).ready(function(){ 					
		function checkOwnership()
		{
			if($('#ownership').val() == 'Buy')
			{
				$('#furnished_row').hide();
				$('#furnished').val('');
				$('#tenure_row').show();
			}
			else if($('#ownership').val() == 'Let')
			{
				$('#tenure_row').hide();
				$('#tenure').val('');
				$('#furnished_row').show();				
			}
			else
			{
				$('#tenure_row').hide();
				$('#furnished_row').hide();
				$('#tenure').val('');
				$('#furnished').val('');
			}
				
		}
		
		function checkTown()
		{
			if($('#town_other').val() != '')
			{
				$('#town').val('');
			}				
		}
		
		function checkOtherTown()
		{
			if($('#town').val() != '')
			{
				$('#town_other').val('');
			}
		}
		
		$('#ownership').change(function(){
			checkOwnership();
		});
		
		$('#town_other').change(function(){
			checkTown();
		});
		
		$('#town').change(function(){
			checkOtherTown();
		});
		
		checkOwnership();
		checkTown();
});
</script>		
<h1>Add Property</h1>
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
	$formObj->formtextRow('Address Line 1*','address_1',$_POST['address_1']);
	$formObj->formtextRow('Address Line 2','address_2',$_POST['address_2']);
	$formObj->formtextRow('Address Line 3','address_3',$_POST['address_3']);
	$formObj->formSelectRow('Town*','town',$areas_array,'Area','Area',$_POST['town'],4);
    $formObj->formtextRow('Town (if Other)','town_other',$_POST['town_other']);
	$formObj->formtextRow('Postcode*','postcode',$_POST['postcode']);
	$formObj->formSelectRow('Buy/Let*','ownership',array(array('name'=>'Buy'),array('name'=>'Let')),'name','name',$_POST['ownership'],3);
	$formObj->formSelectRow('Furnished?','furnished',array(array('name'=>'Furnished','value'=>'0'),array('name'=>'Part Furnished','value'=>'1'),array('name'=>'Unfurnished','value'=>'2'),array('name'=>'Not Specified','value'=>'3'),array('name'=>'Furnished/Un Furnished','value'=>'4')),'name','value',$_POST['furnished'],3);
	$formObj->formSelectRow('Tenure','tenure',array(array('name'=>'Freehold'),array('name'=>'Leasehold')),'name','name',$_POST['tenure'],3);
	$formObj->formSelectRow('Bedrooms','bedrooms',$number_array,'name','name',$_POST['bedrooms']);
	$formObj->formSelectRow('Bathrooms','bathrooms',$number_array,'name','name',$_POST['bathrooms']);
	for($i=1;$i<=10;$i++)
	{
		$formObj->formtextRow('Feature '.$i,'feature_'.$i,$_POST['feature_'.$i]);
	}
	$formObj->formtextAreaRow('Summary','summary',$_POST['summary'],6,60);
	$formObj->formtextAreaRow('Description','description',$_POST['description'],10,60);
	$formObj->formSelectRow('Featured?','featured',array(array('display'=>'No','value'=>'0'),array('display'=>'Yes','value'=>'1')),'display','value',$_POST['featured'],3);
	$formObj->formSelectRow('Property Type','property_type',$property_type_array,'name','id',$_POST['property_type']);
	$formObj->formnumberRow('Price &pound;','price',$_POST['price']);
	$formObj->formSelectRow('Property Status','property_status',$property_status_array,'name','id',$_POST['property_status']);
	
	?>   
    <?php                 
	$formObj->formSubmit();
	?>    
<script type="text/javascript">
CKEDITOR.replace( 'description',
{
	 filebrowserBrowseUrl : '/admin/ckfinder/ckfinder.html',
	 filebrowserImageBrowseUrl : '/admin/ckfinder/ckfinder.html?Type=Images',
	 filebrowserFlashBrowseUrl : '/admin/ckfinder/ckfinder.html?Type=Flash',
	 filebrowserUploadUrl : '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
	 filebrowserImageUploadUrl : '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
	 filebrowserFlashUploadUrl : '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
});	
</script>   