<div id="center_content">
<?
$clientObj = new Client;
$data = $clientObj->clientJobs();
?>
<h1>View My Jobs</h1>
<table>
	<tr style="font-weight:bold;">
    	<td>ID</td>
        <td>Job Title</td>
        <td>Location</td>
        <td>Industry/Sector</td>
        <td>Job Type</td>
        <td>Date Added</td>
        <td>Applicants</td>
        <td>Status</td>
        <td>Action</td>
	</tr>
	<?php 
	if(count($data)==0)
	{?>
    <tr>
    	<td colspan="8"><div style="text-align:center;">You do not currently have any jobs</div></td>
	</tr>
    <?php
	}
    for($i=0;$i<count($data);$i++)
    {
		$count_applicants = $clientObj->countApplicants($data[$i]['id']);        
		?>
    <tr>
    	<td><?php echo $data[$i]['id'];?></td>
        <td><?php echo $data[$i]['job_title'];?></td>
        <td><?php echo $data[$i]['location'];?></td>
        <td><?php echo $data[$i]['industry'];?></td>
        <td><?php echo $data[$i]['job_type'];?></td>
        <td><?php echo date('d-m-Y h:i:s',strtotime($data[$i]['date_added']));?></td>
        <td><?php echo $count_applicants;?></td>
        <td><?php if($data[$i]['active']==1) echo 'Active'; else echo 'Inactive';?></td>
        <td><a href="/client/editJob/<?php echo $data[$i]['id'];?>">Edit Job</a> / <a href="/client/viewApplicants/<?php echo $data[$i]['id'];?>">View Applicants</a></td>
	</tr>        
	<?php
	}?>
</table>
</div>