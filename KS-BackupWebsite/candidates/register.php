 <?php
 if($_SESSION['client']['user_id'])
 {?>
 	<div id="center_content">
	 	<div><h1>Already logged in</h1><p>You are already logged in to a candidate or client account. If you wish to login as another user, please <a href="/client/logout">logout</a> and login again.</p></div>
	</div>        
	<?php
 }
 else
 {?>      <link href="/uploader/uploadify.css" type="text/css" rel="stylesheet" />   
      <script type="text/javascript">
      $(function() {
        
		$('#file_upload').uploadify({
          'uploader'  : '/uploader/ajax/uploadify.swf',
          'script'    : '/uploader/ajax/uploadify.php',
          'cancelImg' : '/uploader/cancel.png',
          'folder'    : '/uploader/uploads',
          'auto'      : true,
		  'multi'     : false,
		  'onComplete'  : function(event, ID, fileObj, response, data) {				
			if(response=='Invalid file type')
			{
				$('#upload_row').append('<div>'+response+'</div>');												  
			}
			else
			{
				$.post('/uploader/ajax/complete.php', { fileLocation: response });
				$('#upload_row').empty().append('<div>File uploaded successfully</div>');	
			}
		  }
        });	
		$('.flash_media').media();
		$('.date').datepicker({
							  dateFormat : 'yy-mm-dd',
							  changeMonth: true,
								changeYear: true,
								yearRange: '<?php echo date('Y')-50;?>:<?php echo date('Y')-15;?>'
							  });
			
		
		
      });
      </script>
		<style type="text/css">
		#display_complete
		{
			display:none;	
		}
		</style>
<div id="center_content">
<div id="display_complete"><strong>Upload Completed</strong></div>
<h1>Candidate Registration</h1>
<?php
if(isset($_POST['submit']))
{
	$candidateObj = new Candidate;
	$errmsg = $candidateObj->candidateRegister();	
}
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
$formObj->formtextRow('Username*','username',$_POST['username']);
?>
<tr>
		<td>Password</td>
		<td><input id="password" type="password" name="password" value="<?php echo $_POST['password'];?>"  /></td>
	</tr>
	<tr>
		<td>Confirm Password</td>
		<td><input id="confirm_password" type="password" name="confirm_password" value="<?php echo $_POST['confirm_password'];?>"  /></td>
	</tr> 
<?php
$formObj->formtextRow('Name*','name',$_POST['name']);
$formObj->formtextAreaRow('Address*','address',$_POST['address'],6,60);
$formObj->formtextRow('Telephone*','phone',$_POST['phone']);
$formObj->formtextRow('Email*','email',$_POST['email']);
$formObj->formSelectRow('Education Status*','education_status',$education_array,'display','display',$_POST['education_status'],3);
?>
<tr>
	<td>Industry/Sector</td>
    <td>
    	<select id="industry" name="industry">
            <option <?php if($_POST['industry']=='') echo 'selected="selected"';?> value="">--Select--</option>
            <option <?php if($_POST['industry']=='Accountancy') echo 'selected="selected"';?> value="Accountancy">Accountancy</option>
            <option <?php if($_POST['industry']=='Aerospace') echo 'selected="selected"';?> value="Aerospace">Aerospace</option>
            <option <?php if($_POST['industry']=='Agriculture, Fishing, Forestry') echo 'selected="selected"';?> value="Agriculture, Fishing, Forestry">Agriculture, Fishing, Forestry</option>
            <option <?php if($_POST['industry']=='Banking, Insurance, Finance') echo 'selected="selected"';?> value="Banking, Insurance, Finance">Banking, Insurance, Finance</option>
            <option <?php if($_POST['industry']=='Catering and Hospitality') echo 'selected="selected"';?> value="Catering and Hospitality">Catering and Hospitality</option>
            <option <?php if($_POST['industry']=='Construction') echo 'selected="selected"';?> value="Construction">Construction</option>
            <option <?php if($_POST['industry']=='Customer Services') echo 'selected="selected"';?> value="Customer Services">Customer Services</option>
            <option <?php if($_POST['industry']=='Education') echo 'selected="selected"';?> value="Education">Education</option>
            <option <?php if($_POST['industry']=='Electronics') echo 'selected="selected"';?> value="Electronics">Electronics</option>
            <option <?php if($_POST['industry']=='Engineering, Manufacturing, Utilities') echo 'selected="selected"';?> value="Engineering, Manufacturing, Utilities">Engineering, Manufacturing, Utilities</option>
            <option <?php if($_POST['industry']=='Graduate, Trainees') echo 'selected="selected"';?> value="Graduate, Trainees">Graduate, Trainees</option>
            <option <?php if($_POST['industry']=='Health, Nursing') echo 'selected="selected"';?> value="Health, Nursing">Health, Nursing</option>
            <option <?php if($_POST['industry']=='Human Resources') echo 'selected="selected"';?> value="Human Resources">Human Resources</option>
            <option <?php if($_POST['industry']=='IT and Internet') echo 'selected="selected"';?> value="IT and Internet">IT and Internet</option>
            <option <?php if($_POST['industry']=='Legal') echo 'selected="selected"';?> value="Legal">Legal</option>
            <option <?php if($_POST['industry']=='Management Consultancy') echo 'selected="selected"';?> value="Management Consultancy">Management Consultancy</option>
            <option <?php if($_POST['industry']=='Marketing, Advertising, PR') echo 'selected="selected"';?> value="Marketing, Advertising, PR">Marketing, Advertising, PR</option>
            <option <?php if($_POST['industry']=='Media, New Media, Creative') echo 'selected="selected"';?> value="Media, New Media, Creative">Media, New Media, Creative</option>
            <option <?php if($_POST['industry']=='Not For Profit, Charities') echo 'selected="selected"';?> value="Not For Profit, Charities">Not For Profit, Charities</option>
            <option <?php if($_POST['industry']=='Oil, Gas, Alternative Energy') echo 'selected="selected"';?> value="Oil, Gas, Alternative Energy">Oil, Gas, Alternative Energy</option>            
            <option <?php if($_POST['industry']=='Property') echo 'selected="selected"';?> value="Property">Property</option>
            <option <?php if($_POST['industry']=='Public Sector and Services') echo 'selected="selected"';?> value="Public Sector and Services">Public Sector and Services</option>
            <option <?php if($_POST['industry']=='Recruitment Sales') echo 'selected="selected"';?> value="Recruitment Sales">Recruitment Sales</option>
            <option <?php if($_POST['industry']=='Retail, Wholesale') echo 'selected="selected"';?> value="Retail, Wholesale">Retail, Wholesale</option>
            <option <?php if($_POST['industry']=='Sales') echo 'selected="selected"';?> value="Sales">Sales</option>
            <option <?php if($_POST['industry']=='Science') echo 'selected="selected"';?> value="Science">Science</option>
            <option <?php if($_POST['industry']=='Secretarial, PAs, Administration') echo 'selected="selected"';?> value="Secretarial, PAs, Administration">Secretarial, PAs, Administration</option>
            <option <?php if($_POST['industry']=='Senior Appointments') echo 'selected="selected"';?> value="Senior Appointments">Senior Appointments</option>
            <option <?php if($_POST['industry']=='Social Services') echo 'selected="selected"';?> value="Social Services">Social Services</option>
            <option <?php if($_POST['industry']=='Telecommunications') echo 'selected="selected"';?> value="Telecommunications">Telecommunications</option>
            <option <?php if($_POST['industry']=='Transport, Logistics') echo 'selected="selected"';?> value="Transport, Logistics">Transport, Logistics</option>
            <option <?php if($_POST['industry']=='Travel, Leisure, Tourism') echo 'selected="selected"';?> value="Travel, Leisure, Tourism">Travel, Leisure, Tourism</option>
            <option <?php if($_POST['industry']=='Other') echo 'selected="selected"';?> value="Other">Other</option>
		</select>
	</td>
</tr>
<tr>
	<td>Dob*</td>
    <td><input type="text" name="dob" class="date" /></td>
</tr>
<?php    
$formObj->formSelectRow('Gender*','gender',$gender_array,'display','display',$_POST['gender'],3);
?>
<tr>
	<td colspan="2"><h2>CV Information</h2></td>
</tr>
<?php
$formObj->formtextAreaRow('Personal Statement*','personal_statement',$_POST['personal_statement'],6,60);
$formObj->formtextAreaRow('Education &amp; Training*','education_training',$_POST['education_training'],6,60);
$formObj->formtextAreaRow('Employment History*','employment_history',$_POST['employment_history'],6,60);
$formObj->formtextAreaRow('Reference 1*','reference_1',$_POST['reference_1'],6,60);
$formObj->formtextAreaRow('Reference 2*','reference_2',$_POST['reference_2'],6,60);
$formObj->formtextAreaRow('Additional Skills','additional_skills',$_POST['additional_skills'],6,60);
?>
<tr>
	<td>Video Upload</td>
    <td id="upload_row"><div id="uploader_contain">
    <?php if($_SESSION['image_done']!='') {?><div>Video already uploaded. If you upload another, the old one will be replaced.</div>
	<div>
		<a class="flash_media {caption: false, autoplay:false }" href="<?php echo $_SESSION['image_done'];?>">My Video Interview</a>
	</div>
	<?php } ?>
    <input id="file_upload" name="file_upload" type="file" /></div></td>
</tr>    
<?php

$formObj->formSubmit('','Submit');
?>
<?php
include(COMMON_ROOT.'client/login.php');
?>
</div>
<?php
 }?>