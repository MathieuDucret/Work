<?php
/****************************************
* Author - Ebad Syed
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/


?>
<h1>View Admin Groups.</h1>


<table width="100%">
	<tr class="searchtitle">
		<td>ID</td>
        <td>Group Name</td>
        <td>Description</td>
        <td>Allowed Pages</td>
        <td>Edit/Delete</td>

   	</tr>  
   
          
	<?php for($i=0;$i<count($data);$i++)
	{		
	if($i%2){$style=' class="searchResult1"';} else {$style= ' class="searchResult2"'; }?>	
    <tr <?php echo $style; ?>>
    	<td><?php echo $data[$i]['id'];?></td>
        <td><?php echo $data[$i]['group_name'];?></td>
        <td><?php echo $data[$i]['description'];?></td>
        <td><?php 
		$pageList=$this->getAllowedPagesList($data[$i]['id']);
			for ($j=0; $j<count($pageList); $j++)
			{
				if ($j<(count($pageList)-1))
				{
					echo $pageList[$j]['link_name'].", " ;
				}
				else
				{
					echo $pageList[$j]['link_name'];
				}
			}
		?></td>
        <td><a href ="/admin/actions/modules/admin_group/admin_group_edit/<?php echo $data[$i]['id'];?>/">Edit</a> / <a href='/admin/actions/modules/admin_group/deleteadmingroup/<?php echo $data[$i]['id'];?>/'>Delete</a></td>
	</tr>
    <?php 
	}
	?>
</table>

