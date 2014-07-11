<?php
$job_data = $this->SelectQuery("SELECT * FROM tbl_jobs_data WHERE id = '".mysql_real_escape_string($_GET['id'])."'","master");
if(count($job_data)==0)
{
	$errmsg = 'This job does not exist';
}
?>
<div id="center_content">
<div><p style="text-align:left;"><a href="/candidates/find_jobs">Back to Job Search</a></p></div>
<h1>Position Information</h1>
<?php
if($errmsg!=''){?><div id="errmsg"><?php echo $errmsg;?></div><?php } ?>
<?php 
if(count($job_data)>0 && count($my_application)==0)
{
	$client_data = $this->SelectQuery("SELECT company FROM tbl_clients WHERE id = '".$job_data[0]['client_id']."'","master");
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
<br />
<div id="job_description"><span class="label">Description</span><br /><?php echo $job_data[0]['job_description'];?></div>
<?php
}?>

<input type="button" value="To apply for this position please log on your account or click here to create an account" onClick="window.location='/candidates/register'" />
</div>	