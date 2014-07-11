<?php
$candidateObj = new Candidate;
$data = $candidateObj->SelectQuery("SELECT * FROM tbl_clients WHERE id = '".$_SESSION['client']['user_id']."'", "master");
$candidatedata = $candidateObj->SelectQuery("SELECT * FROM tbl_candidates_data WHERE client_id = '".$_SESSION['client']['user_id']."'", "master");
$cv_data = $candidateObj->SelectQuery("SELECT * FROM tbl_candidates_cv_data WHERE candidate_id = '".$_SESSION['client']['user_id']."'", "master");

if(isset($_POST['submit']))
{			   
	$errmsg = $candidateObj->updateProfile($_POST);
}
?>
<div id="center_content">
<h1>View/Update Profile</h1>
<script type="text/javascript">
      $(function() {        
		$('.flash_media').media();
		$('.date').datepicker({
							  dateFormat : 'yy-mm-dd',
							  changeMonth: true,
								changeYear: true
							  });
      });
      </script>
<?php
$formObj = new formCreator;
$day_array = array();
for($i=1;$i<=31;$i++)
{
	$day_array[] = array('value'=>$i);
}
	
$month_array = array();
for($i=1;$i<=12;$i++)
{
	$month_array[] = array('value'=>$i);
}
	
$year_array = array();
for($i=(date('Y')-15);$i>=1920;$i--)
{
	$year_array[] = array('value'=>$i);
}
$education_array = array(array('display'=>'Bachelor'),array('display'=>'Degree'),array('display'=>'Masters'),array('display'=>'MBA'),array('display'=>'Other'));
$sector_array = array(array('display'=>'Public'),array('display'=>'Private'));
$gender_array = array(array('display'=>'Male'),array('display'=>'Female'));

$ethnicbg_array = array(array('display'=>'White British'),array('display'=>'Afro Carribbean'),array('display'=>'Other'));
$service_array = array(array('display'=>'Job Brokerage'),array('display'=>'Training'),array('display'=>'Business Coaching'),array('display'=>'One to One Information/Advice'),array('display'=>'Self Development Workshops'),array('display'=>'Childcare Services'),array('display'=>'Volunteering Opportunities'),array('display'=>'Welfare to Work Programmes'),array('display'=>'Other'));

if($errmsg!=''){?><div id="errmsg"><?php echo $errmsg;?></div><?php }?>

<?php
$formObj->formNew('candidateRegister','');
$formObj->formtextRow('Username*','username',$data[0]['username']);
$formObj->formtextRow('Name*','name',$candidatedata[0]['name']);
$formObj->formtextAreaRow('Address*','address',$candidatedata[0]['address'],6,60);
$formObj->formtextRow('Telephone*','phone',$candidatedata[0]['phone']);
$formObj->formtextRow('Email*','email',$data[0]['email']);
$formObj->formSelectRow('Education Status*','education_status',$education_array,'display','display',$candidatedata[0]['education_status'],3);
?>
<tr>
	<td>Industry/Sector</td>
    <td>
    	<select id="industry" name="industry">
            <option <?php if($candidatedata[0]['industry']=='') echo 'selected="selected"';?> value="">--Select--</option>
            <option <?php if($candidatedata[0]['industry']=='Accountancy') echo 'selected="selected"';?> value="Accountancy">Accountancy</option>
            <option <?php if($candidatedata[0]['industry']=='Aerospace') echo 'selected="selected"';?> value="Aerospace">Aerospace</option>
            <option <?php if($candidatedata[0]['industry']=='Agriculture, Fishing, Forestry') echo 'selected="selected"';?> value="Agriculture, Fishing, Forestry">Agriculture, Fishing, Forestry</option>
            <option <?php if($candidatedata[0]['industry']=='Banking, Insurance, Finance') echo 'selected="selected"';?> value="Banking, Insurance, Finance">Banking, Insurance, Finance</option>
            <option <?php if($candidatedata[0]['industry']=='Catering and Hospitality') echo 'selected="selected"';?> value="Catering and Hospitality">Catering and Hospitality</option>
            <option <?php if($candidatedata[0]['industry']=='Construction') echo 'selected="selected"';?> value="Construction">Construction</option>
            <option <?php if($candidatedata[0]['industry']=='Customer Services') echo 'selected="selected"';?> value="Customer Services">Customer Services</option>
            <option <?php if($candidatedata[0]['industry']=='Education') echo 'selected="selected"';?> value="Education">Education</option>
            <option <?php if($candidatedata[0]['industry']=='Electronics') echo 'selected="selected"';?> value="Electronics">Electronics</option>
            <option <?php if($candidatedata[0]['industry']=='Engineering, Manufacturing, Utilities') echo 'selected="selected"';?> value="Engineering, Manufacturing, Utilities">Engineering, Manufacturing, Utilities</option>
            <option <?php if($candidatedata[0]['industry']=='Graduate, Trainees') echo 'selected="selected"';?> value="Graduate, Trainees">Graduate, Trainees</option>
            <option <?php if($candidatedata[0]['industry']=='Health, Nursing') echo 'selected="selected"';?> value="Health, Nursing">Health, Nursing</option>
            <option <?php if($candidatedata[0]['industry']=='Human Resources') echo 'selected="selected"';?> value="Human Resources">Human Resources</option>
            <option <?php if($candidatedata[0]['industry']=='IT and Internet') echo 'selected="selected"';?> value="IT and Internet">IT and Internet</option>
            <option <?php if($candidatedata[0]['industry']=='Legal') echo 'selected="selected"';?> value="Legal">Legal</option>
            <option <?php if($candidatedata[0]['industry']=='Management Consultancy') echo 'selected="selected"';?> value="Management Consultancy">Management Consultancy</option>
            <option <?php if($candidatedata[0]['industry']=='Marketing, Advertising, PR') echo 'selected="selected"';?> value="Marketing, Advertising, PR">Marketing, Advertising, PR</option>
            <option <?php if($candidatedata[0]['industry']=='Media, New Media, Creative') echo 'selected="selected"';?> value="Media, New Media, Creative">Media, New Media, Creative</option>
            <option <?php if($candidatedata[0]['industry']=='Not For Profit, Charities') echo 'selected="selected"';?> value="Not For Profit, Charities">Not For Profit, Charities</option>
            <option <?php if($candidatedata[0]['industry']=='Oil, Gas, Alternative Energy') echo 'selected="selected"';?> value="Oil, Gas, Alternative Energy">Oil, Gas, Alternative Energy</option>            
            <option <?php if($candidatedata[0]['industry']=='Property') echo 'selected="selected"';?> value="Property">Property</option>
            <option <?php if($candidatedata[0]['industry']=='Public Sector and Services') echo 'selected="selected"';?> value="Public Sector and Services">Public Sector and Services</option>
            <option <?php if($candidatedata[0]['industry']=='Recruitment Sales') echo 'selected="selected"';?> value="Recruitment Sales">Recruitment Sales</option>
            <option <?php if($candidatedata[0]['industry']=='Retail, Wholesale') echo 'selected="selected"';?> value="Retail, Wholesale">Retail, Wholesale</option>
            <option <?php if($candidatedata[0]['industry']=='Sales') echo 'selected="selected"';?> value="Sales">Sales</option>
            <option <?php if($candidatedata[0]['industry']=='Science') echo 'selected="selected"';?> value="Science">Science</option>
            <option <?php if($candidatedata[0]['industry']=='Secretarial, PAs, Administration') echo 'selected="selected"';?> value="Secretarial, PAs, Administration">Secretarial, PAs, Administration</option>
            <option <?php if($candidatedata[0]['industry']=='Senior Appointments') echo 'selected="selected"';?> value="Senior Appointments">Senior Appointments</option>
            <option <?php if($candidatedata[0]['industry']=='Social Services') echo 'selected="selected"';?> value="Social Services">Social Services</option>
            <option <?php if($candidatedata[0]['industry']=='Telecommunications') echo 'selected="selected"';?> value="Telecommunications">Telecommunications</option>
            <option <?php if($candidatedata[0]['industry']=='Transport, Logistics') echo 'selected="selected"';?> value="Transport, Logistics">Transport, Logistics</option>
            <option <?php if($candidatedata[0]['industry']=='Travel, Leisure, Tourism') echo 'selected="selected"';?> value="Travel, Leisure, Tourism">Travel, Leisure, Tourism</option>
            <option <?php if($candidatedata[0]['industry']=='Other') echo 'selected="selected"';?> value="Other">Other</option>
		</select>
	</td>
</tr>
<?php
?>
<tr>
	<td>Dob*</td>
    <td><input type="text" name="dob" class="date" value="<?php echo $candidatesdata[0]['dob'];?>" /></td>
</tr>
<?php    
$formObj->formSelectRow('Gender*','gender',$gender_array,'display','display',$candidatedata[0]['gender'],3);
$formObj->formSelectRow('Type of Service*','type_service',$service_array,'display','display',$candidatedata[0]['type_service'],3);
?>
<tr>
	<td colspan="2"><h2>CV Information</h2></td>
</tr>
<?php
$formObj->formtextAreaRow('Personal Statement*','personal_statement',$cv_data[0]['personal_statement'],6,60);
$formObj->formtextAreaRow('Education &amp; Training*','education_training',$cv_data[0]['education_training'],6,60);
$formObj->formtextAreaRow('Employment History*','employment_history',$cv_data[0]['employment_history'],6,60);
$formObj->formtextAreaRow('Reference 1*','reference_1',$cv_data[0]['reference_1'],6,60);
$formObj->formtextAreaRow('Reference 2*','reference_2',$cv_data[0]['reference_2'],6,60);
$formObj->formtextAreaRow('Additional Skills','additional_skills',$cv_data[0]['additional_skills'],6,60);
?>
<?php /*<tr>
	<td>Video Upload</td>
    <td id="upload_row"><div id="uploader_contain">
    <?php if($candidatedata[0]['video_upload']!='') {?><div>Video Present.</div>
	<div>
		<a class="flash_media {caption: false, autoplay:false }" href="<?php echo $candidatedata[0]['video_upload'];?>">My Video Interview</a>
	</div>
	<?php } ?></div></td>
</tr>   */?> 
<?php

$formObj->formSubmit('','Submit');
?>
</div>