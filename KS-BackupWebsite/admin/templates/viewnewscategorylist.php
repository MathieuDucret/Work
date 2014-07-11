<?php
/****************************************
* Author - Ebad Syed
* Company - Internet Concepts Limited
* Revision - 1.0 
* 18/11/09
*****************************************/?>
<div style = "text-align:center;">
<?php
$rsObj->getPreviousNextMenu();
?>
</div>
<h1>View News Categories</h1>
<p>Please select an option to perform on the following categories.</p>
<table width="100%">
	<tr class="searchtitle">
		<td>ID</td>
        <td>Category Name</td>
        <td>Description</td>
        <td>Actions</td>
   	</tr>        
	<?php for($i=0;$i<count($q);$i++)
	{		
	if($i%2){$style=' class="searchResult1"';} else {$style= ' class="searchResult2"'; }?>	
    <tr <?php echo $style; ?>>
    	<td><?php echo $q[$i]['id'];?></td>
        <td><a href='/admin/viewnewsarticle/<?php echo $q[$i]['id'];?>/10/1/<?php echo $q[$i]['name'] ?>/'><?php echo $q[$i]['name'];?></a></td>
        <td><?php echo $q[$i]['description'];?></td>    
        <td><a href='/admin/actions/modules/news_directory/editnewscat/<?php echo $q[$i]['id'];?>/'>Edit</a> / <a href='/admin/actions/modules/news_directory/deletenewscat/<?php echo $q[$i]['id'];?>/'>Delete</a></td>
	</tr>
    <?php 
	}
	?>
</table>
<div style = "text-align:center;">
<?php
$rsObj->getPreviousNextMenu();
?>
<br /> <br /> <br /> 
<?php
$rsObj->getNumberLinks();
?>