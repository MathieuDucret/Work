<script type="text/javascript">
$(function() {
	$('#pdf_type').change(function(){
		document.propertyPdf.submit();
	});
});
</script>
						  
<h1>PDF Generation</h1>
<p>Please select an output type from the options below</p>
<?php 
$pdf_output_array = array(array('display'=>'Single Property Details','value'=>'single'),
							/*array('display'=>'Multiple Property Details','value'=>'multiple'),
							array('display'=>'Summary listing','value'=>'summary'),*/
							array('display'=>'Window Display','value'=>'window'));
$formObj = new formCreator;
$formObj->formNew('propertyPdf');
$formObj->formSelectRow('PDF Output type','pdf_type',$pdf_output_array,'display','value',$_POST['pdf_type'],3);    
?>
</table>
</form>






<?php
if($getPostArgs['pdf_type']=='single')
{
	include(COMMON_ROOT.'admin/templates/estateAgent/single_display.php');
}
elseif($getPostArgs['pdf_type']=='multiple')
{
	include(COMMON_ROOT.'admin/templates/estateAgent/multiple_display.php');
}
elseif($getPostArgs['pdf_type']=='summary')
{
	include(COMMON_ROOT.'admin/templates/estateAgent/summary_display.php');
}
elseif($getPostArgs['pdf_type']=='window')
{
	include(COMMON_ROOT.'admin/templates/estateAgent/window_display.php');
}
?>