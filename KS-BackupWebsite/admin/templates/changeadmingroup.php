
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



<form name="admingroup" method="post" action="/admin/updateadmingroup">
<table width="20">

<?php //get all the records  
  //now iterate through to put records according to their groups 
  
	for($i=0;$i<count($groups); $i++)
	{
	if ($groups[$i]['id']==0){		
			echo "<tr><td rowspan=5>";
			echo "<br/><b>".$groups[$i]['group_name']."</b><br />";
			echo "<SELECT SIZE=40 id=".$groups[$i]['group_name']. " NAME=\"useridngroup\" onfocus=\"ClearList()\">";
		}
			else
		{
			echo "<td>";
			echo "<input type=\"Submit\" name=\"addto\"  value=\"".$groups[0]['group_name']."\"onClick = GetSelectedItem()>";
			echo "<input type=\"Submit\" name=\"addto\"  value=".$groups[$i]['group_name']. " onClick = GetSelectedItem()>";
        	echo "</td>";
			echo "<td>";
			echo "<br/><b>".$groups[$i]['group_name']."</b><br />";
			echo "<SELECT SIZE=8 id=". $groups[$i]['group_name'] ." NAME=\"useridngroup\"  onfocus=\"ClearList()\">";		
		}

		for($j=0;$j<count($users); $j++)
		{			
			if($users[$j]['admingroup']==$groups[$i]['id'])
			{			
				echo "<OPTION value= ". "uid_".$users[$j]['id']."@gid_".$groups[$i]['id'].">".$users[$j]['username']."</OPTION>";
			}			

		}
		echo "</SELECT>";
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

	

