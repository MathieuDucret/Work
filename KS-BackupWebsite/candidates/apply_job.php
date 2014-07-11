<?php

$job_data = $this->SelectQuery("SELECT * FROM tbl_jobs_data WHERE id = '".mysql_real_escape_string($_GET['id'])."'","master");
if(count($job_data)==0)
{
	$errmsg = 'This job does not exist';
}
else
{
	$my_application = $this->SelectQuery("SELECT * FROM tbl_jobs_applications WHERE client_id = '".$_SESSION['client']['user_id']."' AND job_id = '".mysql_real_escape_string($_GET['id'])."'","master");
	if(count($my_application)>0)
	{
		$errmsg = 'You have already applied for this position';
	}
	if($_POST['submit']=='Apply')
	{//If job exists and no applications exist
		$candidateObj = new Candidate;
		$errmsg = $candidateObj->jobApply($_GET['id']);
	}
}

?>
<div id="center_content">
<h1>Apply for Job</h1>
<?php
if($errmsg!=''){?><div id="errmsg"><?php echo $errmsg;?></div><?php } ?>
<?php 
?>
<style type="text/css">
.label
{
	font-weight:bold;
}
</style>
<div><span class="label">Job Title</span><br /><span class="value"><?php echo $job_data[0]['job_title'];?></span></div>
<div><span class="label">Salary</span><br /><span class="value"><?php echo $job_data[0]['salary'];?></span></div>
<div><span class="label">Location</span><br /><span class="value"><?php echo $job_data[0]['location'];?></span></div>
<div><span class="label">Industry/Sector</span><br /><span class="value"><?php echo $job_data[0]['industry'];?></span></div>
<div><span class="label">Job Type</span><br /><span class="value"><?php echo $job_data[0]['job_type'];?></span></div>
<div><span class="label">Years Experience</span><br /><span class="value"><?php echo $job_data[0]['years_experience'];?></span></div>
<div><span class="label">Education Level</span><br /><span class="value"><?php echo $job_data[0]['education_level'];?></span></div>
<div id="job_description"><?php echo $job_data[0]['job_description'];?></div>
<div><form name="apply" id="apply" method="post" action=""><input type="submit" name="submit" value="Apply" /></form></div>
<?php
?>
</div>

	