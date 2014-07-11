<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/
?>

<div style = "text-align:center;">
<?php
$rsObj->getPreviousNextMenu();
?>
</div>


<h1>View Enquiries</h1>
<table width="100%">
	<tr class="searchtitle">
		<td>Enquiry No.</td>
        <td>Date Time</td>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Tel. No.</td>
        <td>Mobile No.</td>
        <td>Email</td>
        <td>Nature Enquiry</td>
        <td>Questions</td>
        <td>Action</td>
	</tr>        
	<?php for($i=0;$i<count($q);$i++){		
	if($i%2){$style=' class="searchResult1"';} else {$style= ' class="searchResult2"'; }?>	
    <tr <?php echo $style; ?>>
    	<td><?php echo $i;?></td>
        <td><?php echo date('d-m-Y H:i:s',strtotime($q[$i]['date_time']));?></td>
    	<td><?php echo $q[$i]['first_name'];?></td>
        <td><?php echo $q[$i]['last_name'];?></td>
    	<td><?php echo $q[$i]['telephone'];?></td>
        <td><?php echo $q[$i]['mobile'];?></td>
    	<td><?php echo $q[$i]['email'];?></td>
        <td><?php echo $q[$i]['nature'];?></td>
<<<<<<< .mine
    	<td><?php echo $q[$i]['questions'];?></td>   
        <td><a href="/admin/deleteenquiry/<?php echo $q[$i]['id'];?>">Delete</a></td> 
=======
    	<td><?php echo $q[$i]['questions'];?></td>   
        <td><a href='/admin/actions/modules/enquiry/deleteenquiry/<?php echo $q[$i]['id'];?>/'>Delete</a></td> 
>>>>>>> .r235
	</tr>
    <?php } ?>
</table>

<br /> <br /> 
<div style = "text-align:center;">
<?php
$rsObj->getPreviousNextMenu();
?>
<br /> <br /> <br /> 
<?php
$rsObj->getNumberLinks();
?>