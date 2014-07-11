<script type="text/javascript">
$(function(){
	$('.flash_media').media();
});
</script>
<div id="center_content">
<style type="text/css">
.label
{
	font-weight:bold;
}
</style>
<h1>View Candidates</h1>
<?php 
$data = $this->SelectQuery("SELECT * FROM tbl_jobs_applications WHERE job_id = '".$_GET['id']."' AND job_id IN (SELECT id as job_id FROM tbl_jobs_data WHERE client_id = '".$_SESSION['client']['user_id']."')","master");
if(count($data)==0)
{
	?>
    <div>No candidates exist for this job, or this job does not exist</div>
    <?php
}
else
{
	for($i=0;$i<count($data);$i++)
	{
		$candidate_data = $this->SelectQuery("SELECT * FROM tbl_candidates_data WHERE client_id = '".$data[$i]['client_id']."'","master");
		$candidate_cvdata = $this->SelectQuery("SELECT * FROM tbl_candidates_cv_data WHERE candidate_id = '".$data[$i]['client_id']."'","master");
	?>
    <div><?php echo $i+1;?> of <?php echo count($data);?></div>
	<div class="candidate_profile" style="padding:15px;border:1px solid #000;">	
		<div>
			<div class="label">Unique ID</div>
			<div class="value"><?php echo $candidate_data[$i]['client_id'];?></div>
		</div>
		<div>
			<div class="label">Education Status</div>        
			<div class="value"><?php echo $candidate_data[$i]['education_status'];?></div>
		</div>
		<div>
			<div class="label">Industry/Sector</div>        
			<div class="value"><?php echo $candidate_data[$i]['industry'];?></div>
		</div>
		<div>        
			<div class="label">Dob (Year)</div>
			<div class="value"><?php echo $candidate_data[$i]['dob_year'];?></div>
		</div>
		<div>        
			<div class="label">Gender</div>
			<div class="value"><?php echo $candidate_data[$i]['gender'];?></div>
		</div>
		<div>
			<div class="label">Ethnic BG</div>
			<div class="value"><?php echo $candidate_data[$i]['ethnic_bg'];?></div>
		</div>
		<div>
			<div class="label">Type of Service</div>              
			<div class="value"><?php echo $candidate_data[$i]['type_service'];?></div>	
		</div>
		<div>
			<div class="label">Personal Statement</div>
			<div class="value"><?php echo $candidate_cvdata[$i]['personal_statement'];?></div>
		</div>
		<div>
			<div class="label">Education Traning</div>        
			<div class="value"><?php echo $candidate_cvdata[$i]['education_training'];?></div>
		</div>
		<div>
			<div class="label">Employment History</div>        
			<div class="value"><?php echo $candidate_cvdata[$i]['employment_history'];?></div>
		</div>
		<div>
			<div class="label">Reference 1</div>               
			<div class="value"><?php echo $candidate_cvdata[$i]['reference_1'];?></div>
		</div>
		<div>
			<div class="label">Reference 2</div>                       
			<div class="value"><?php echo $candidate_cvdata[$i]['reference_2'];?></div>
		</div>
		<div>
			<div class="label">Additional Skills</div>                
			<div class="value"><?php echo $candidate_cvdata[$i]['additional_skills'];?></div>
		</div>
        <?php if($candidate_data[$i]['video_upload']!='') {?>
        <div>
        	<div class="label">Additional Skills</div>  
            <div class="value"><a class="flash_media {caption: false, autoplay:false }" href="<?php echo $candidate_data[$i]['video_upload'];?>">My Video Interview</a></div>
        </div>
		<?php } ?>
	</div>    
		<?php
	}
}
	?>
	

</div>