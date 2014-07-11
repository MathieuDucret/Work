<?php
/****************************************
* Author - esyed
* Revision - 1.5 
* 4/12/09
*****************************************/

class adminGroup extends DataBase
{		
	function addAdminGroupSave($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		$pageIDList = str_replace(' ', '', explode(',', $getPostArgs['securityleveltotal']));
			if (isset($getPostArgs['submit']))		
			{
				//check if the admin username already exists
				if ($this->SelectQuery("SELECT group_name from tbl_admin_groups where group_name ='" . $getPostArgs['groupname']."'"))
				{
					$errmsg = "Sorry the group name you are trying to create already exists";
					require_once(COMMON_ROOT."/admin/templates/successError/success.php");			
				}	
				else
				{
					$insert = $this->SelectQuery("INSERT INTO tbl_admin_groups (group_name,description) VALUES ('".$getPostArgs['groupname']."','". $getPostArgs['description'] ."')","master");
					//Now get the last group id i.e. ID of the group just created	
					$lastGroupID = $this->SelectQuery("SELECT id FROM tbl_admin_groups ORDER BY id DESC LIMIT 1", "master");
				//$lastGroupID[0]['id'];
				
				//check if a new group has been successfully craeted only then perform the allowed page insert
				if (is_array($insert))
				{
					for ($i=0; $i<count($pageIDList); $i++)
					{
						if($pageIDList[$i]==0) continue;
						$insertAllowedPages = $this->SelectQuery("INSERT INTO tbl_admin_group_allowed_pages (groupid, pageid) VALUES ('".$lastGroupID[0]['id']."','". $pageIDList[$i] ."')","master");			
						//echo "INSERT INTO tbl_admin_group_allowed_pages (groupid, pageid) VALUES ('".$lastGroupID[0]['id']."','". $pageIDList[$i] ."')";
					}
				}
				if (is_array($insert) && is_array($insertAllowedPages))
				{
					$errmsg = "The administrator Group has been sucessfully created";
					require_once(COMMON_ROOT."/admin/templates/successError/success.php");
				}
				else 
				{
					$errmsg = "There has been a problem. The administrator Group has not been created.";
					require_once(COMMON_ROOT."/admin/templates/successError/error.php");
				}
			}
		}	
	}	
	
	function deleteAdministratorDetails($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		$query = $this->SelectQuery("DELETE from tbl_admins WHERE id ='" .$getPostArgs['id']. "' AND admingroup!='22'", "master");
			//direct to correct output page depending on success of query
			if (is_array($query))
			{
				$errmsg = "Selected admin account has been successfully deleted";
				require_once(COMMON_ROOT."/admin/templates/successError/success.php");
			}
			else 
			{
				$errmsg = "Selected admin account has not been successfully deleted";
				require_once(COMMON_ROOT."/admin/templates/succesError/error.php");
			}
	}
	
	function addAdminGroup()
	{
		$pageList = $this->SelectQuery("SELECT id, page_name, function_name, class_name FROM tbl_admin_pages WHERE page_name!='' ORDER BY class_name", "master");
		require_once(COMMON_ROOT."/admin/templates/adminGroup/addAdminGroup.php");
	}
	
	function viewAdminGroup()
	{
		$data = $this->SelectQuery("select id, group_name, description from tbl_admin_groups where id !='22' ", "master");
		require_once(COMMON_ROOT."/admin/templates/adminGroup/viewAdminGroup.php");
	}
	
	function getAllowedPagesList($id)
	{ //param = groupID
		$allowedpages = $this->SelectQuery("SELECT a.id as id, a.page_name as page_name, a.function_name as function_name, a.class_name as class_name FROM tbl_admin_pages a, tbl_admin_group_allowed_pages g WHERE page_name!='' AND g.pageid = a.id AND g.groupid='".$id ."' ORDER BY a.class_name ASC" , "master");
		return $allowedpages;
	}
	//work out the difference in the mulltidimentional array
	function array_diff_no_cast(&$ar1, &$ar2) {
   		$diff = Array();
   			foreach ($ar1 as $key => $val1) 
			{
      			if (array_search($val1, $ar2) === false) {
         		$i=0;
				$diff[$key] = $val1;

				$i++;
      		}
   }
   return $diff;
}
	
	function editAdminGroup($getPostArgs)
	{
	$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		$data = $this->SelectQuery("SELECT id, group_name, description from tbl_admin_groups where id='".$getPostArgs['id']."' AND id !='22'", "master");
		$pageList = $this->SelectQuery("SELECT id, page_name, function_name, class_name FROM tbl_admin_pages WHERE page_name !=''  ORDER BY class_name ASC", "master");		
		$allowedPageList = $this->getAllowedPagesList($getPostArgs['id']);		
		$unassignedPageList = $this->array_diff_no_cast($pageList, $allowedPageList);
		//now rekey the unassigned pagelist
		$unassignedPageList = array_values($unassignedPageList);
		require_once(COMMON_ROOT."/admin/actions/modules/adminGroup/editAdminGroup.php");
	}
	
	
	
	function editAdminGroupUpdate($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		//to remove from the allowed page list
		if (isset($getPostArgs['allowedpagelist']))
		{
			$delete = $this->SelectQuery("DELETE FROM tbl_admin_group_allowed_pages WHERE pageid ='".$getPostArgs['allowedpagelist']."' AND groupid = '".$getPostArgs['id']."' AND groupid !='22'","master");	
			$update = $this->SelectQuery("UPDATE tbl_admin_groups SET group_name = '".$getPostArgs['group_name']."', 	     
				description='".$getPostArgs['description']."' WHERE id='".$getPostArgs['id']."' AND id !='22'", "master");
			$this->editAdminGroup($getPostArgs);			
		}
			//to add to the allowed page list
		else if (isset($getPostArgs['unAssignedPageListID']))
		{
			$insert = $this->SelectQuery("INSERT INTO tbl_admin_group_allowed_pages (groupid, pageid) VALUES ('".$getPostArgs['id']."','".$getPostArgs['unAssignedPageListID']."')","master");
			$update = $this->SelectQuery("UPDATE tbl_admin_groups SET group_name = '".$getPostArgs['group_name']."', 	     
				description='".$getPostArgs['description']."' WHERE id='".$getPostArgs['id']."' AND id !='22'", "master");
			$this->editAdminGroup($getPostArgs);	
		}
		
		//to update the group details
		if (isset($getPostArgs['submit']))
		{	
				$update = $this->SelectQuery("UPDATE tbl_admin_groups SET group_name = '".$getPostArgs['group_name']."', 	     
				description='".$getPostArgs['description']."' WHERE id='".$getPostArgs['id']."' AND id !='22'", "master");
			if (isset($update))
				{		
					$errmsg = "Your Admin Group has been sucessfully Updated";
					require_once(COMMON_ROOT."/admin/templates/successError/success.php");
				}
			else 
			{
				$errmsg = "Your Admin Group has not been sucessfully Updated";
				require_once(COMMON_ROOT."/admin/templates/successError/error.php");
			}
		}
		
	}
		

	
	
	function deleteAdminGroup($getPostArgs)
	{	
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		if (isset($getPostArgs['submit']))
		{
			$delete = $this->SelectQuery("DELETE FROM tbl_admin_groups where id =".$getPostArgs['id']." AND id !='22'", "master");
			//reset all the administrators to have admin group=0 i.e. unassigned group
			$updateAdmin = $this->SelectQuery("UPDATE tbl_admins SET admingroup=0 where admingroup='".$getPostArgs['id']."' AND admingroup !='22'", "master");
			if (isset($delete))
			{ 
				//Delete links to all the allowed pages for the group in question
				$deleteAllowedPages = $this->SelectQuery("DELETE FROM tbl_admin_group_allowed_pages WHERE groupid ='".$getPostArgs['id']."' AND groupid !='22'", "master");
					if (isset($deleteAllowedPages))
					{	
						$errmsg = "Your Admin Group has been sucessfully deleted";
						require_once(COMMON_ROOT."/admin/templates/successError/success.php");
					}
					else 
					{
						$errmsg = "Your Admin Group has not been sucessfully deleted";
						require_once(COMMON_ROOT."/admin/templates/successError/error.php");
					}
			}
		}
		else
		{
			// $data populated to show admin group details
			$data = $this->SelectQuery("SELECT id, group_name, description from tbl_admin_groups where id='".$getPostArgs['id']."' AND id !='22'", "master");

			$allowedPageList = $this->getAllowedPagesList($getPostArgs['id']);
			require_once(COMMON_ROOT."/admin/actions/modules/adminGroup/deleteAdminGroup.php");
		}
	}
	
	function changeAdminGroup()
	{
	
		$groupcount = $this->SelectQuery("SELECT COUNT(*) as cnt FROM tbl_admin_groups", "master");
		//echo $groupcount;
		
		$adminGroupIDList = $this->SelectQuery("SELECT id, group_name from tbl_admin_groups", "master");
		

		$data = $this->SelectQuery("
								   SELECT a.admingroup, a.username, a.email, g.group_name, g.id as groupid	
								   FROM tbl_admins a, tbl_admin_groups g 
								   WHERE g.id = a.admingroup 
								   ORDER BY a.admingroup ASC", "master");
		
		$users = $this->SelectQuery("SELECT username, id, email, admingroup FROM tbl_admins","master");
		
		if ($_SESSION['admin']['adminGroup']!="22")
		{
			$groups = $this->SelectQuery("SELECT group_name, id FROM tbl_admin_groups where id != '22' ","master");
		}
		else
		{
			$groups = $this->SelectQuery("SELECT group_name, id FROM tbl_admin_groups","master");
		}
		
		//print_r($data);
		require_once(COMMON_ROOT."/admin/templates/adminGroup/changeAdminGroup.php");
	}
	
	function getAdminUserList()
	{
	$users = $this->SelectQuery("SELECT a.id, a.username, g.group_name FROM tbl_admins a, tbl_admin_groups g where a.admingroup=g.id AND g.id!='22'","master");
	return $users;
	
	
	}
	
	function getAdminGroupList1()	
	{
		$groups = $this->SelectQuery("SELECT group_name, id FROM tbl_admin_groups","master");
		return $groups;	
	}

	function updateAdminGroup($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		$addto = $getPostArgs['addto'];
		$idandgroup = explode("@",$getPostArgs['useridngroup']);

		$adminID = explode("_",$idandgroup[0]);
		$groupID = explode("_",$idandgroup[1]);

		$adminID = $adminID[1];
		$groupID = $groupID[1];

	//get the group ID of the group we wish to add our admin to
	$newGroupID = $this->SelectQuery("select id from tbl_admin_groups where group_name ='".$addto."' AND id!='22'", "master");
	$update = $this->SelectQuery("Update tbl_admins set admingroup= ". $newGroupID[0]['id'] ." WHERE id='".$adminID."' AND id !='22'","master");
	$this->changeAdminGroup();
	}
	
	function switchAdminGroupUsers()
	{
	//echo "Load Drag Drop functyionCalled";
		
		if ($_SESSION['admin']['adminGroup']=='22')
		{
		$groupList = $this->SelectQuery("SELECT id, group_name FROM tbl_admin_groups", "master");
		}
		else
		{$groupList = $this->SelectQuery("SELECT id, group_name FROM tbl_admin_groups where id != '22'", "master");}
		$adminList = $this->SelectQuery("SELECT id, username, admingroup FROM tbl_admins WHERE admingroup !='22'", "master");
		$unassignedAdminList = $this->SelectQuery("SELECT id, username, admingroup FROM tbl_admins where admingroup = '0'", "master");
		include(COMMON_ROOT."/admin/templates/adminGroup/switchAdminGroupUsers.php");
	
	
	
	}

}
?>
