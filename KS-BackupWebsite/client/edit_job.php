<div id="center_content">
<h1>Edit Job</h1>
<script type="text/javascript" src="/admin/ckeditor/ckeditor.js"></script>
<?php
$clientObj = new Client;
$formObj = new formCreator;
$data = $clientObj->SelectQuery("SELECT * FROM tbl_jobs_data WHERE client_id = '".$_SESSION['client']['user_id']."' AND id='".mysql_real_escape_string($_GET['id'])."'","master");
if(count($data)==0)
{
	echo '<div id="errmsg">This job does not belong to you</div>';
}
else
{
	if(isset($_POST['submit']))
	{
		$errmsg = $clientObj->updateJob($_GET['id']);
		$data = $clientObj->SelectQuery("SELECT * FROM tbl_jobs_data WHERE client_id = '".$_SESSION['client']['user_id']."' AND id='".mysql_real_escape_string($_GET['id'])."'","master");
	}
	if($errmsg!='')
	{
		echo '<div id="errmsg">'.$errmsg.'</div>';
	}
	$formObj->formNew('addJob','');
	$formObj->formtextRow('Job Title', 'job_title', $data[0]['job_title']);
	$formObj->formtextRow('Location', 'location', $data[0]['location']);
	$formObj->formtextRow('Salary', 'salary', $data[0]['location']);
	$formObj->formSelectRow('Active','visible',array(array('value'=>'1','display'=>'Yes'),array('value'=>'0','display'=>'No')),'display','value',$data[0]['visible'],0);
	?>
	<tr>
		<td>Industry/Sector</td>
		<td>
			<select id="industry" name="industry">
				<option <?php if($data[0]['industry']=='') echo 'selected="selected"';?> value="">--Select--</option>
				<option <?php if($data[0]['industry']=='Accountancy') echo 'selected="selected"';?> value="Accountancy">Accountancy</option>
				<option <?php if($data[0]['industry']=='Aerospace') echo 'selected="selected"';?> value="Aerospace">Aerospace</option>
				<option <?php if($data[0]['industry']=='Agriculture, Fishing, Forestry') echo 'selected="selected"';?> value="Agriculture, Fishing, Forestry">Agriculture, Fishing, Forestry</option>
				<option <?php if($data[0]['industry']=='Banking, Insurance, Finance') echo 'selected="selected"';?> value="Banking, Insurance, Finance">Banking, Insurance, Finance</option>
				<option <?php if($data[0]['industry']=='Catering and Hospitality') echo 'selected="selected"';?> value="Catering and Hospitality">Catering and Hospitality</option>
				<option <?php if($data[0]['industry']=='Construction') echo 'selected="selected"';?> value="Construction">Construction</option>
				<option <?php if($data[0]['industry']=='Customer Services') echo 'selected="selected"';?> value="Customer Services">Customer Services</option>
				<option <?php if($data[0]['industry']=='Education') echo 'selected="selected"';?> value="Education">Education</option>
				<option <?php if($data[0]['industry']=='Electronics') echo 'selected="selected"';?> value="Electronics">Electronics</option>
				<option <?php if($data[0]['industry']=='Engineering, Manufacturing, Utilities') echo 'selected="selected"';?> value="Engineering, Manufacturing, Utilities">Engineering, Manufacturing, Utilities</option>
				<option <?php if($data[0]['industry']=='Graduate, Trainees') echo 'selected="selected"';?> value="Graduate, Trainees">Graduate, Trainees</option>
				<option <?php if($data[0]['industry']=='Health, Nursing') echo 'selected="selected"';?> value="Health, Nursing">Health, Nursing</option>
				<option <?php if($data[0]['industry']=='Human Resources') echo 'selected="selected"';?> value="Human Resources">Human Resources</option>
				<option <?php if($data[0]['industry']=='IT and Internet') echo 'selected="selected"';?> value="IT and Internet">IT and Internet</option>
				<option <?php if($data[0]['industry']=='Legal') echo 'selected="selected"';?> value="Legal">Legal</option>
				<option <?php if($data[0]['industry']=='Management Consultancy') echo 'selected="selected"';?> value="Management Consultancy">Management Consultancy</option>
				<option <?php if($data[0]['industry']=='Marketing, Advertising, PR') echo 'selected="selected"';?> value="Marketing, Advertising, PR">Marketing, Advertising, PR</option>
				<option <?php if($data[0]['industry']=='Media, New Media, Creative') echo 'selected="selected"';?> value="Media, New Media, Creative">Media, New Media, Creative</option>
				<option <?php if($data[0]['industry']=='Not For Profit, Charities') echo 'selected="selected"';?> value="Not For Profit, Charities">Not For Profit, Charities</option>
				<option <?php if($data[0]['industry']=='Oil, Gas, Alternative Energy') echo 'selected="selected"';?> value="Oil, Gas, Alternative Energy">Oil, Gas, Alternative Energy</option>            
				<option <?php if($data[0]['industry']=='Property') echo 'selected="selected"';?> value="Property">Property</option>
				<option <?php if($data[0]['industry']=='Public Sector and Services') echo 'selected="selected"';?> value="Public Sector and Services">Public Sector and Services</option>
				<option <?php if($data[0]['industry']=='Recruitment Sales') echo 'selected="selected"';?> value="Recruitment Sales">Recruitment Sales</option>
				<option <?php if($data[0]['industry']=='Retail, Wholesale') echo 'selected="selected"';?> value="Retail, Wholesale">Retail, Wholesale</option>
				<option <?php if($data[0]['industry']=='Sales') echo 'selected="selected"';?> value="Sales">Sales</option>
				<option <?php if($data[0]['industry']=='Science') echo 'selected="selected"';?> value="Science">Science</option>
				<option <?php if($data[0]['industry']=='Secretarial, PAs, Administration') echo 'selected="selected"';?> value="Secretarial, PAs, Administration">Secretarial, PAs, Administration</option>
				<option <?php if($data[0]['industry']=='Senior Appointments') echo 'selected="selected"';?> value="Senior Appointments">Senior Appointments</option>
				<option <?php if($data[0]['industry']=='Social Services') echo 'selected="selected"';?> value="Social Services">Social Services</option>
				<option <?php if($data[0]['industry']=='Telecommunications') echo 'selected="selected"';?> value="Telecommunications">Telecommunications</option>
				<option <?php if($data[0]['industry']=='Transport, Logistics') echo 'selected="selected"';?> value="Transport, Logistics">Transport, Logistics</option>
				<option <?php if($data[0]['industry']=='Travel, Leisure, Tourism') echo 'selected="selected"';?> value="Travel, Leisure, Tourism">Travel, Leisure, Tourism</option>
				<option <?php if($data[0]['industry']=='Other') echo 'selected="selected"';?> value="Other">Other</option>
			</select>
		</td>
	</tr>
	<?php
	$formObj->formSelectRow('Job Type','job_type',array(array('value'=>'Permanent'),array('value'=>'Contract'),array('value'=>'Temporary'),array('value'=>'Part Time'),array('value'=>'Internship')),'value','value',$data[0]['job_type'],3);
	$formObj->formSelectRow('Years Experience Required','years_experience',array(array('value'=>'None'),array('value'=>'1+'),array('value'=>'2+'),array('value'=>'3+'),array('value'=>'4+'),array('value'=>'5+')),'value','value',$data[0]['years_experience'],3);
	$formObj->formSelectRow('Education Level','education_level',array(array('value'=>'No Requirement'),array('value'=>'Secondary School'),array('value'=>'Vocational'),array('value'=>'Graduate'),array('value'=>'Post Graduate')),'value','value',$data[0]['education_level'],3);
	$formObj->formtextAreaRow('Job Description', 'job_description',$data[0]['job_description'],20,50);
	$formObj->formSubmit('','Submit');
	?>
	<script type="text/javascript">
		CKEDITOR.replace('job_description', { toolbar:'Basic' });
	</script>        
<?php
}?>
</div>