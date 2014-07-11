<?php
$clientObj = new Client;
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
$employment_array = array(array('display'=>'Employed'),array('display'=>'Unemployed'));
$benefits_array = array(array('display'=>'Yes'),array('display'=>'No'));
$gender_array = array(array('display'=>'Male'),array('display'=>'Female'));

$ethnicbg_array = array(array('display'=>'White British'),array('display'=>'Afro Carribbean'),array('display'=>'Other'));
$service_array = array(array('display'=>'Job Brokerage'),array('display'=>'Training'),array('display'=>'Business Coaching'),array('display'=>'One to One Information/Advice'),array('display'=>'Self Development Workshops'),array('display'=>'Childcare Services'),array('display'=>'Volunteering Opportunities'),array('display'=>'Welfare to Work Programmes'),array('display'=>'Other'));
$formObj->formNew('clientRegister','/admin/clientGroupManage/approveClientUser');
?>
<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"  />
<?php
$formObj->formtextRow('First Name', 'first_name',$data[0]['first_name'],1);
$formObj->formtextRow('Last Name', 'last_name',$data[0]['last_name'],1);
$formObj->formtextRow('Email', 'email',$data[0]['email'],1);
$formObj->formtextRow('Company', 'company',$data[0]['company'],1);
$formObj->formtextRow('Username', 'username',$data[0]['username'],1);

$formObj->formtextRow('Username*','username',$candidatedata[0]['username']);
?>
<tr>
		<td>Password</td>
		<td><input id="password" type="password" name="password" value="<?php echo $candidatedata[0]['password'];?>"  /></td>
	</tr>
	<tr>
		<td>Confirm Password</td>
		<td><input id="confirm_password" type="password" name="confirm_password" value="<?php echo $candidatedata[0]['confirm_password'];?>"  /></td>
	</tr> 
<?php
$formObj->formtextRow('Name*','name',$candidatedata[0]['name']);
$formObj->formtextAreaRow('Address*','address',$candidatedata[0]['address'],6,60);
$formObj->formtextRow('Telephone*','phone',$candidatedata[0]['phone']);
$formObj->formtextRow('Email*','email',$candidatedata[0]['email']);
$formObj->formSelectRow('Employment Status*','employment_status',$employment_array,'display','display',$candidatedata[0]['employment_status'],3);
$formObj->formSelectRow('Claiming Benefits?*','benefits',$benefits_array,'display','display',$candidatedata[0]['benefits'],3);
?>
<tr>
	<td>Dob*</td>
    <td><?php $formObj->formSelectRowN('day','dob_day',$day_array,'value','value',$candidatedata[0]['dob_day']); $formObj->formSelectRowN('month','dob_month',$month_array,'value','value',$candidatedata[0]['dob_month']); $formObj->formSelectRowN('year','dob_year',$year_array,'value','value',$candidatedata[0]['dob_year']);?></td>
</tr>
<?php    
$formObj->formSelectRow('Gender*','gender',$gender_array,'display','display',$candidatedata[0]['gender'],3);
$formObj->formSelectRow('Ethnic Background*','ethnic_bg',$ethnicbg_array,'display','display',$candidatedata[0]['ethnic_bg'],3);
$formObj->formSelectRow('Type of Service*','type_service',$service_array,'display','display',$candidatedata[0]['type_service'],3);
?>
<tr>
	<td colspan="2"><h2>CV Information</h2></td>
</tr>   
<?php
$formObj->formtextAreaRow('Personal Statement*','personal_statement',$candidatecvdata[0]['personal_statement'],6,60);
$formObj->formtextAreaRow('Education &amp; Training*','education_training',$candidatecvdata[0]['education_training'],6,60);
$formObj->formtextAreaRow('Employment History*','employment_history',$candidatecvdata[0]['employment_history'],6,60);
$formObj->formtextAreaRow('Reference 1*','reference_1',$candidatecvdata[0]['reference_1'],6,60);
$formObj->formtextAreaRow('Reference 2*','reference_2',$candidatecvdata[0]['reference_2'],6,60);
$formObj->formtextAreaRow('Additional Skills','additional_skills',$candidatecvdata[0]['additional_skills'],6,60);
$formObj->formSubmit(0,'Approve');
?>