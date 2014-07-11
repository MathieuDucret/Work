<div style="text-align:right;">
<div id="resultCount"><?php echo $rsObj->total_items;?> results found for your search</div>
<?php
$rsObj->getPreviousNextMenuAjax();
?>
<br />
<?php
$rsObj->getNumberLinksAjax();
?>
</div>
<?php
if(count($data)==0)
{
	?>
	<div>No jobs found matching this criteria</div>
    <?php
}
else
{
	?>
	<table>
        <tr style="font-weight:bold;">
            <td>ID</td>
            <td>Job Title</td>
            <td>Location</td>
            <td>Industry/Sector</td>
            <td>Job Type</td>
            <td>Date Added</td>
            <td>Action</td>
        </tr>
        <?php
        for($i=0;$i<count($data);$i++)
        { 
            ?>
        <tr>
            <td><?php echo $data[$i]['id'];?></td>
            <td><?php echo $data[$i]['job_title'];?></td>
            <td><?php echo $data[$i]['location'];?></td>
            <td><?php echo $data[$i]['industry'];?></td>
            <td><?php echo $data[$i]['job_type'];?></td>
            <td><?php echo date('d-m-Y h:i:s',strtotime($data[$i]['date_added']));?></td>
            <?php
            if($_SESSION['client'])
			{?>
            <td><a href="/candidates/applyJob/<?php echo $data[$i]['id'];?>">Apply</a></td>
            <?php
			}
			else
			{?>
            <td><a href="/candidates/viewJob/<?php echo $data[$i]['id'];?>">View</a></td>
            <?php
			}?>
        </tr>        
	<?php
		}
		?>
	</table>
    <?php
}?>