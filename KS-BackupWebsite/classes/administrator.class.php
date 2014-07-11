<?php
/****************************************
* Author - esyed
* Company - Internet Concepts Limited
* Revision - 1.0 
* 16/11/09
*****************************************/

class administrator extends DataBase
{		
	function addAdministratorSave($getPostArgs)
	{ 
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		//include(COMMON_ROOT.'/admin/templates/addadministrator.php');
		if (isset($getPostArgs['submit']))
		{
			if($getPostArgs['admingroup']=='22')  
			{
				$getPostArgs['admingroup']='1';
			}
			//check if teh admin username already exists
			if ($this->SelectQuery("SELECT username from tbl_admins where username ='" . $getPostArgs['username']."'"))
			{
				$errmsg = "Sorry the administrator you are trying to create already exists";
				require_once(COMMON_ROOT."/admin/templates/successError/success.php");			
			}	
			else
			{
				$insert = $this->SelectQuery("INSERT INTO tbl_admins (username,password, email, pas0, admingroup) VALUES ('".$getPostArgs['username']."','".md5($getPostArgs['password'])."','". $getPostArgs['email']. "','". $getPostArgs['password'] ."','". $getPostArgs['admingroup'] ."')","master");	
				if (is_array($insert))
				{
					$errmsg = "The administrator has been sucessfully created";
					require_once(COMMON_ROOT."/admin/templates/successError/success.php");
				}
				else 
				{
					$errmsg = "There has been a problem. The administrator has not been created.";
					require_once(COMMON_ROOT."/admin/templates/successError/error.php");
				}
			}
		}	
	}	
	
	function addAdministrator()
	{
	//Using join in query to make sure only fields with security level assigned appear
	if ($_SESSION['admin']['adminGroup']!="22")
	{
		$data = $this->SelectQuery("select id, group_name from tbl_admin_groups where id !='22'","master");
	}
	else
	{
		$data = $this->SelectQuery("select id, group_name from tbl_admin_groups ","master");	
	}
	require_once(COMMON_ROOT."/admin/templates/administrator/addadministrator.php");
	}

	function viewAdministratorList()   
 	{
		$where = "WHERE admingroup !='22'";
		$table = "tbl_admins";
		$linkObj = new LinkDirectory;
		$layoutObj = new Layout;
		$rsObj = new ResultSetPagination($_GET['limit'], $_GET['cat'], $_GET['paged'], $where, $table, "admin", $_GET['page']);
		$total_pages = $rsObj->total_pages;
		$paged = $rsObj->paged;
		$q = $rsObj->getLimitSet($rsObj->limit_array);
		include(COMMON_ROOT.'/admin/templates/administrator/viewadministratorlist.php');
	}
	
	function deleteAdmin($getPostArgs)
	{
	$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
	if (isset($getPostArgs['submit'])){
		$query = $this->SelectQuery("DELETE from tbl_admins WHERE id ='" .$getPostArgs['id']. "' AND admingroup !='22'", "master");
			//direct to correct output page depending on success of query
			if (is_array($query))
			{
				$errmsg = "Selected admin account has been successfully deleted";
				require_once(COMMON_ROOT."/admin/templates/successError/success.php");
			}
			else 
			{
				$errmsg = "Selected admin account has not been successfully deleted";
				require_once(COMMON_ROOT."/admin/templates/successError/error.php");
			}
		}
		else
		{
		$adminDetails = $this->SelectQuery("SELECT id, username, email, admingroup from tbl_admins where id = '".$getPostArgs['id']."' AND admingroup !='22'", "master");
	
		$groupName = $this->SelectQuery("SELECT group_name from tbl_admin_groups where id ='".$adminDetails[0]['admingroup']."'", "master");	
		require_once(COMMON_ROOT."/admin/actions/modules/administrator/deleteAdmin.php");	
		
		}
	}
	
	//bring admin details from db to show in the edit form
	function editAdmin($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		$adminDetails = $this->SelectQuery("SELECT id, username, email, pas0, admingroup from tbl_admins where id = '".$getPostArgs['id']."' AND admingroup !='22'", "master");
	
		$adminGroupList = $this->SelectQuery("SELECT id, group_name from tbl_admin_groups WHERE id !='22'", "master");	
		require_once(COMMON_ROOT."/admin/actions/modules/administrator/editAdmin.php");	
	}
	
//edit admin details	
	function editAdminUpdate($getPostArgs)
	{ 
	$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		if(isset($getPostArgs['submit']))
		{		
	    	$query = $this->SelectQuery("UPDATE tbl_admins SET username ='". $getPostArgs['username'] . "', password ='". md5($getPostArgs['password']) . "', email ='" .$getPostArgs['email'] ."'".", pas0 = '" . $getPostArgs['password']. "', admingroup='" .$getPostArgs['admingroup']."' WHERE id ='" .$getPostArgs['id']. "' AND admingroup !='22'", "master");


			if (is_array($query))
			{
				$errmsg = "Your administrator has been successfully edited";
				require_once(COMMON_ROOT."/admin/templates/successError/success.php");
				
			}
			else 
			{
				$errmsg = "A problem occurred and your adminadministrator has not been updated";
				require_once(COMMON_ROOT."/admin/templates/successError/error.php");				
			}										
		}
	}
}
?>