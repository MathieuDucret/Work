
<SCRIPT LANGUAGE="JavaScript">
function ClearList()
    {
		for(var j=0; j<document.forms[0].elements.length; j++)
		{			
			if (document.admingroup.elements[j].id==document.activeElement.id)
			{
			}
			else
			{
				//deselect items in all the other list boxes 
        		var list = document.getElementById(document.admingroup.elements[j].id);
				if (list) list.selectedIndex =-1;
			}
		}			
    }
</SCRIPT>



<form name="admingroup" method="post" action="/admin/adminGroup/updateAdminGroup">
<table width="20">

<?php //get all the records  
  //now iterate through to put records according to their groups 
  
  //the first for loop creates th ecorrect select boxes for all the corresponding groups
	$totalGroups = count($groups);
	$unassignedLength = 10*$totalGroups;
	echo "groups count" . $totalGroups;

	
	for($i=0;$i<count($groups); $i++)
	{
	if ($i==0){		
			echo "<tr><td rowspan=".$totalGroups.">";
			echo "<br/><b>Un Assigned</b><br />";
			echo "test";
			echo "<select size=\"".$unassignedLength."\" id=\"unassigned\" name=\"useridngroup\" onfocus=\"ClearList()\">";
		}
			else
		{
			echo "<td>";
			echo "<input type=\"Submit\" name=\"addto\"  value=\"0\" >";
			echo "<input type=\"Submit\" name=\"addto\"  value=\"".$groups[$i]['group_name']."\">";
        	echo "</td>";
			echo "<td>";
			echo "<br/><b>".$groups[$i]['group_name']."</b><br />";
			echo "<select size=8 id=". $groups[$i]['group_name'] ." name=\"useridngroup\"  onfocus=\"ClearList()\">";		
		}
		
		//now put the correct users in the corresponding lists
		for($j=0;$j<count($users); $j++)
		{			
			if($users[$j]['admingroup']==$groups[$i]['id'])
			{			
				echo "<option value= ". "uid_".$users[$j]['id']."@gid_".$groups[$i]['id'].">".$users[$j]['username']."</option>";
			}
		}
		
		echo "</select>";
		if ($groups[$i]['id']==0){
		echo "</td>";
		}
		else
		{
		echo "</td>";
		echo "</tr>";
		}
	}
	
        echo "</table>";
        echo "</form>";
		?>

	

