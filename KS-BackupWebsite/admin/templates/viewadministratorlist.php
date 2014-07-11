<?php
/****************************************
* Author - esyed
* Company - Internet Concepts Limited
* 16/11/2009 - pagination added
*  
*****************************************/
?>
<div style = "text-align:center;">
<?php
$rsObj->getPreviousNextMenu();
?>
</div>
<h1>View Administrator List</h1>
<p>Please select an option to perform on the following pages.</p>
<table width="100%">
	<tr class="searchtitle">
		<td>ID</td>
        <td>User Name</td>
        <td>Email</td>
        <td>Action</td>
	</tr>        
<?php 

	for($i=0;$i<count($q);$i++){	

	if($i%2){$style=' class="searchResult1"';} else {$style= ' class="searchResult2"'; }?>	
    <tr <?php echo $style; ?>>
    
    	<td><?php echo $q[$i]['id'];?></td>
        <td><?php echo $q[$i]['username'];?></td>
        <td><?php echo $q[$i]['email'];?></td>
               
        <td><a href='/admin/actions/modules/admin_edit_delete/edit_admin/<?php echo $q[$i]['id'];?>/'>Edit</a> / <a href='/admin/actions/modules/admin_edit_delete/delete_admin/<?php echo $q[$i]['id'];?>/'>Delete</a></td>
	</tr>
    
    <?php
	}
	?>
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
