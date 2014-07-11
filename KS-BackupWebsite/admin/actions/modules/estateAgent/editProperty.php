<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/?>
<link href="/js/jUpload/fileuploader.css" rel="stylesheet" type="text/css">
<script src="/js/jUpload/fileuploader.js" type="text/javascript"></script>

<script> 
function deleteImage(id)
{
	$(function() {
		$.ajax({
			type: 'POST',
			url: '/admin/ajax/imageDelete.ajax.php',
			data: 'id='+id,
			success: function(data){
				$('#property_image_'+id).hide('slow');
				//$('#property_image_'+id).remove();
				$.jGrowl(data, { header: 'Alert' });
			}
		});
	});
}

function deletePlan(id)
{
	$(function() {
		$.ajax({
			type: 'POST',
			url: '/admin/ajax/planDelete.ajax.php',
			data: 'id='+id,
			success: function(data){
				$('#property_plan_'+id).hide('slow');
				//$('#property_image_'+id).remove();
				$.jGrowl(data, { header: 'Alert' });
			}
		});
	});
}

function primaryImage(id)
{
	$(function() {
		$.ajax({
			type: 'POST',
			url: '/admin/ajax/imagePrimary.ajax.php',
			data: 'id='+id,
			success: function(data){
				$('#propertyPrimaryLink_'+id).hide('slow');
				$('#propertyPrimary').appendTo('#property_image_'+id);				
				$.jGrowl(data, { header: 'Alert' });
			}
		});
	});
}

$(document).ready(function(){ 						   
		function createUploader(){            
            var imguploader = new qq.FileUploader({
				dropContainer : document.getElementById('imageUploaderDrop'),
                element: $('#imageUploader')[0],
				allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],				
                action: '/admin/ajax/imageUpload.ajax.php',
				onSubmit: function(id, fileName){},
				onComplete: function(id, fileName, responseJSON){
					$('#propertyImageBooth').append('<div id="property_image_'+responseJSON.image_id+'" style="height:188px;float:left;text-align:center;border:1px #cc6600 dotted;padding:3px;margin:5px;"><img src="/estate_agent/property_images/thumbnail/'+responseJSON.file_name+'" /><br /><a href="javascript:deleteImage('+responseJSON.image_id+');">Delete</a><br /><span id="propertyPrimaryLink_'+responseJSON.image_id+'"><a href="javascript:primaryImage('+responseJSON.image_id+');">Set as Primary</a></span></div>')
				},
				params: {
							property_id: '<?php echo mysql_real_escape_string($_GET['id']);?>'
				}				
            });           
        }
		
		
		function createFloorplanUploader(){            
            var planuploader = new qq.FileUploader({
                element: $('#planUploader')[0],
				allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],				
                action: '/admin/ajax/planUpload.ajax.php',
				onSubmit: function(id, fileName){},
				onComplete: function(id, fileName, responseJSON){
					$('#propertyPlanBooth').append('<div id="property_plan_'+responseJSON.image_id+'" style="float:left;text-align:center;border:1px #cc6600 dotted;padding:3px;margin:5px;"><img src="/estate_agent/property_plans/thumbnail/'+responseJSON.file_name+'" /><br /><a href="javascript:deletePlan('+responseJSON.image_id+');">Delete</a><br /></div>')
				},
				params: {
							property_id: '<?php echo mysql_real_escape_string($_GET['id']);?>'
				}				
            });           
        }		
		
		createFloorplanUploader();
		createUploader(); //Second so this gets the file dropper
		
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
	$formObj->formtextRow('Address Line 1*','address_1',$data[0]['address_1']);
	$formObj->formtextRow('Address Line 2','address_2',$data[0]['address_2']);
	$formObj->formtextRow('Address Line 3','address_3',$data[0]['address_3']);
	$formObj->formSelectRow('Town*','town',$areas_array,'Area','Area',$data[0]['town'],4);
    $formObj->formtextRow('Town (if Other)','town_other',$data[0]['town']);
	$formObj->formtextRow('Postcode*','postcode',$data[0]['postcode']);
	$formObj->formSelectRow('Buy/Let*','ownership',array(array('name'=>'Buy'),array('name'=>'Let')),'name','name',$data[0]['ownership'],3);
	$formObj->formSelectRow('Furnished?','furnished',array(array('name'=>'Furnished','value'=>'0'),array('name'=>'Part Furnished','value'=>'1'),array('name'=>'Unfurnished','value'=>'2'),array('name'=>'Not Specified','value'=>'3'),array('name'=>'Furnished/Un Furnished','value'=>'4')),'name','value',$data[0]['furnished'],3);
	$formObj->formSelectRow('Tenure','tenure',array(array('name'=>'Freehold'),array('name'=>'Leasehold')),'name','name',$data[0]['tenure'],3);
	$formObj->formSelectRow('Bedrooms','bedrooms',$number_array,'name','name',$data[0]['bedrooms']);
	$formObj->formSelectRow('Bathrooms','bathrooms',$number_array,'name','name',$data[0]['bathrooms']);
	for($i=1;$i<=10;$i++)
	{
		$formObj->formtextRow('Feature '.$i,'feature_'.$i,$data[0]['feature_'.$i]);
	}
	$formObj->formtextAreaRow('Summary','summary',$data[0]['summary'],6,60);
	$formObj->formtextAreaRow('Description','description',$data[0]['description'],10,60);
	$formObj->formSelectRow('Featured?','featured',array(array('display'=>'No','value'=>'0'),array('display'=>'Yes','value'=>'1')),'display','value',$data[0]['featured'],3);
	$formObj->formSelectRow('Property Type','property_type',$property_type_array,'name','id',$data[0]['property_type']);
	$formObj->formtextRow('Price &pound;','price',$data[0]['price']);
	$formObj->formSelectRow('Property Status','property_status',$property_status_array,'name','id',$data[0]['property_status']);
	
	?>
    <tr>
    	<td><h2>Image Data</h2></td>
		<td><div id="propertyImageBooth"><?php echo $image_output;?></div></td>
	</tr> 
    <tr>
    	<td colspan="2"><div style="width:300px;" id="imageUploader">Image Uploader</div></td>
	</tr>
    <tr>
    	<td><h2>Floorplan Data</h2></td>
		<td><div id="propertyPlanBooth"><?php echo $plan_output;?></div></td>
	</tr>   
    <tr>
    	<td colspan="2"><div style="width:300px;" id="planUploader">Floorplan Uploader</div></td>
	</tr>     
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