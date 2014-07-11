<?php
/****************************************
* Author - esyed
* Company - Internet Concepts Limited
* Revision - 1.0 
* 4/12/09
*****************************************/

class clientGroupManage extends DataBase
{		
	function addClientGroupSave($getPostArgs)
	{
		if($getPostArgs['groupname']=='') $errmsg = 'Please enter a group name<br />';
		if($getPostArgs['description']=='') $errmsg .= 'Please enter a group description<br />';
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		$pageIDList = str_replace(' ', '', explode(',', $getPostArgs['totalpagelist']));
		if (isset($getPostArgs['submit']))		
		{
			//check if the admin username already exists
			if ($this->SelectQuery("SELECT group_name from tbl_client_groups where group_name ='" . $getPostArgs['groupname']."'"))
			{
				$errmsg = "Sorry the Group name you are trying to create already exists";
				require_once(COMMON_ROOT."/admin/templates/successError/success.php");			
			}	
			else
			{
				$insert = $this->SelectQuery("INSERT INTO tbl_client_groups (group_name,description) VALUES ('".$getPostArgs['groupname']."','". $getPostArgs['description'] ."')","master");
				//Now get the last group id i.e. ID of the group just created	
				$lastGroupID = $this->SelectQuery("SELECT id FROM tbl_client_groups ORDER BY id DESC LIMIT 1", "master");
				//$lastGroupID[0]['id'];
				
				//check if a new group has been successfully craeted only then perform the allowed page insert
				if (is_array($insert))
				{
				for ($i=0; $i<count($pageIDList); $i++)
					{
					$insertAllowedPages = $this->SelectQuery("INSERT INTO tbl_client_group_allowed_pages (groupid, pageid) VALUES ('".$lastGroupID[0]['id']."','". $pageIDList[$i] ."')","master");
					}
				}
				if (is_array($insert) && is_array($insertAllowedPages))
				{
					$errmsg = "The Client Group has been sucessfully created";
					require_once(COMMON_ROOT."/admin/templates/successError/success.php");
				}
				else 
				{
					$errmsg = "There has been a problem. The Client Group has not been created.";
					require_once(COMMON_ROOT."/admin/templates/successError/error.php");
				}
			}
		}	
	}	
	
	function deleteClientUser($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		if (isset($getPostArgs['submit']))
		{
			$query = $this->ExecQuery("DELETE from tbl_clients WHERE id ='" .$getPostArgs['id']. "'", "master");
				//direct to correct output page depending on success of query
				if ($query)
				{
					$errmsg = "Selected Client account has been successfully deleted";
					require_once(COMMON_ROOT."/admin/templates/successError/success.php");
				}
				else 
				{
					$errmsg = "Selected Client account has not been successfully deleted";
					require_once(COMMON_ROOT."/admin/templates/successError/error.php");
				}
		}
		else
		{
		// $data populated to show admin group details
			$clientDetails = $this->SelectQuery("SELECT id, username, email, pas0 from tbl_clients where id='".$getPostArgs['id']."'", "master");
			require_once(COMMON_ROOT."/admin/actions/modules/clientGroupManage/deleteClientUser.php");
		}
	}
	
	function addClientGroup($getPostArgs)
	{
		if(isset($getPostArgs['submit']))
		{
			if($getPostArgs['groupname']=='') $errmsg = 'Please enter a group name<br />';
			if($getPostArgs['description']=='') $errmsg .= 'Please enter a group description<br />';
			$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
			if($errmsg=='')
			{			
				$pageIDList = str_replace(' ', '', explode(',', $getPostArgs['totalpagelist']));
				//check if the admin username already exists
				if ($this->SelectQuery("SELECT group_name from tbl_client_groups where group_name ='" . $getPostArgs['groupname']."'"))
				{
					$errmsg = "Sorry the Group name you are trying to create already exists";
					require_once(COMMON_ROOT."/admin/templates/successError/success.php");			
				}	
				else
				{
					$insert = $this->InsertQuery("INSERT INTO tbl_client_groups (group_name,description) VALUES ('".$getPostArgs['groupname']."','". $getPostArgs['description'] ."')","master");
					//Now get the last group id i.e. ID of the group just created	
					$lastGroupID = $this->SelectQuery("SELECT id FROM tbl_client_groups ORDER BY id DESC LIMIT 1", "master");
					//$lastGroupID[0]['id'];					
					for ($i=0; $i<count($pageIDList); $i++)
					{
						$insertAllowedPages = $this->InsertQuery("INSERT INTO tbl_client_group_allowed_pages (groupid, pageid) VALUES ('".$lastGroupID[0]['id']."','". $pageIDList[$i] ."')","master");
					}
					if (is_int($insert) && is_int($insertAllowedPages))
					{
						$errmsg = "The client group has been sucessfully created";
						require_once(COMMON_ROOT."/admin/templates/successError/success.php");
						return true;
					}
				}
			}
		}
		$pageList = $this->SelectQuery("SELECT id, link_name, module_name,page_name FROM tbl_pages ORDER BY module_name ASC", "master");
		require_once(COMMON_ROOT."/admin/templates/clientGroupManage/addClientGroup.php");
	}
	
	function addClientUser()
	{
		$data = $this->SelectQuery("select id, group_name from tbl_client_groups", "master");
	require_once(COMMON_ROOT."/admin/templates/clientGroupManage/addClientUser.php");
	}
	
	
	function viewClientGroup()
	{
		$data = $this->SelectQuery("select id, group_name, description from tbl_client_groups", "master");
	require_once(COMMON_ROOT."/admin/templates/clientGroupManage/viewClientGroup.php");
	}
	
	function getAllowedPagesList($id)
	{ 
		$allowedpages = $this->SelectQuery("SELECT a.id as id, a.language_id as language_id, a.link_name as link_name, a.module_name as module_name, a.page_name as page_name FROM tbl_pages a, tbl_client_group_allowed_pages g WHERE g.pageid = a.id AND g.groupid='".$id ."' ORDER BY a.language_id, a.module_name ASC" , "master");
		foreach($allowedpages as $key => $arr)
		{
			$newAllowedPages[$arr['id']] = $allowedpages[$key];
		}
		
		return $newAllowedPages;
	}
	//work out the difference in the mulltidimentional array
	function array_diff_no_cast(&$ar1, &$ar2) 
	{
   		$diff = Array();
   		foreach ($ar1 as $key => $val1) 
		{
      		if (array_search($val1, $ar2) === false) 
			{
         		$diff[$key] = $val1;
      		}
   		}
   		return $diff;
	}
	
	function editClientGroup($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		$data = $this->SelectQuery("SELECT id, group_name, description from tbl_client_groups where id='".$getPostArgs['id']."'", "master");
		$pageList = $this->SelectQuery("SELECT id, language_id, link_name, module_name, page_name FROM tbl_pages ORDER BY language_id, module_name ASC", "master");
		
		foreach($pageList as $key => $arr)
		{
			$newPageList[$arr['id']] = $pageList[$key];
		}
		//print_r($newPageList);
		
		$allowedPageList = $this->getAllowedPagesList($getPostArgs['id']);
		//print_r($allowedPageList);
		
		$unassignedPageList = array_diff_assoc($newPageList,$allowedPageList);
		require_once(COMMON_ROOT."/admin/actions/modules/clientGroupManage/editClientGroup.php");
	}
	
	
	
	function editClientGroupUpdate($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		if (isset($getPostArgs['allowedpagelist']))
		{
			$delete = $this->SelectQuery("DELETE FROM tbl_client_group_allowed_pages WHERE pageid ='".$getPostArgs['allowedpagelist']."' AND groupid = '".$getPostArgs['id']."'","master");	
			$update = $this->SelectQuery("UPDATE tbl_client_groups SET group_name = '".$getPostArgs['group_name']."', description='".$getPostArgs['description']."' WHERE id='".$getPostArgs['id']."'", "master");
			//include("/admin/actions/modules/clientGroupManage/editclientGroup/".$getPostArgs['id']."/");
		$this->editClientGroup($getPostArgs);			
		}
			//to add to the allowed page list
		else if (isset($getPostArgs['unAssignedPageListID']))
		{
				$insert = $this->SelectQuery("INSERT INTO tbl_client_group_allowed_pages (groupid, pageid) VALUES ('".$getPostArgs['id']."','".$getPostArgs['unAssignedPageListID']."')","master");
				$update = $this->SelectQuery("UPDATE tbl_client_groups SET group_name = '".$getPostArgs['group_name']."', 	     
				description='".$getPostArgs['description']."' WHERE id='".$getPostArgs['id']."'", "master");
				
			$this->editClientGroup($getPostArgs);			
		}
		
		//to update the group details
		if (isset($getPostArgs['submit']))
		{	
				$update = $this->SelectQuery("UPDATE tbl_client_groups SET group_name = '".$getPostArgs['group_name']."', 	     
				description='".$getPostArgs['description']."' WHERE id='".$getPostArgs['id']."'", "master");
			if (isset($update))
				{		
					$errmsg = "Your Client Group has been sucessfully Updated";
					require_once(COMMON_ROOT."/admin/templates/successError/success.php");
				}
			else 
			{
				$errmsg = "Your Client Group has not been sucessfully Updated";
				require_once(COMMON_ROOT."/admin/templates/successError/error.php");
			}
		}
		
	}
	function addClientUserSave($getPostArgs)
	{	
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		//include(COMMON_ROOT.'/admin/templates/addadministrator.php');
		if (isset($getPostArgs['submit']))
		{
			if($getPostArgs['first_name']=='') $errmsg = 'Please enter a first name<br />';
			if($getPostArgs['last_name']=='') $errmsg .= 'Please enter a last name<br />';
			if($getPostArgs['username']=='') $errmsg .= 'Please enter a username<br />';
			if($getPostArgs['password']=='') $errmsg .= 'Please enter a password<br />';
			if($getPostArgs['email']=='') $errmsg .= 'Please enter an email<br />';
			if($errmsg!='')
			{
				require_once(COMMON_ROOT."/admin/templates/successError/success.php");
				return true;
			}
			//check if teh admin username already exists
			if ($this->SelectQuery("SELECT username from tbl_clients where username ='" . $getPostArgs['username']."'"))
			{
				$errmsg = "Sorry the Client username you are trying to create already exists";
				require_once(COMMON_ROOT."/admin/templates/successError/success.php");			
			}	
			else
			{
				$insert = $this->SelectQuery("INSERT INTO tbl_clients (username,password,first_name,last_name, email, pas0, clientgroupid,approved) VALUES ('".$getPostArgs['username']."','".md5($getPostArgs['password'])."','". $getPostArgs['first_name']. "','". $getPostArgs['last_name']. "','". $getPostArgs['email']. "','". $getPostArgs['password'] ."','". $getPostArgs['clientgroupid'] ."','". $getPostArgs['approved']. "')","master");	
				if (is_array($insert))
				{
					$errmsg = "The Client User has been sucessfully created";
					require_once(COMMON_ROOT."/admin/templates/successError/success.php");
				}
				else 
				{
					$errmsg = "There has been a problem. The Client User has not been created.";
					require_once(COMMON_ROOT."/admin/templates/successError/error.php");
				}
			}
		}	
	}	
	
	//edit client details	
	function editClientUpdate($getPostArgs)
	{ 
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		if(isset($getPostArgs['submit']))
		{		
	    	$query = $this->SelectQuery("UPDATE tbl_clients SET username ='". $getPostArgs['username'] . "', password ='". md5($getPostArgs['password']) . "', email ='" .$getPostArgs['email'] ."'".", pas0 = '" . $getPostArgs['password']. "', clientgroupid='" .$getPostArgs['admingroup']."' WHERE id ='" .$getPostArgs['id']. "'", "master");


			if (is_array($query))
			{
				$errmsg = "Your Client User has been successfully edited";
				require_once(COMMON_ROOT."/admin/templates/successError/success.php");
				
			}
			else 
			{
				$errmsg = "A problem occurred and your Client User has not been updated";
				require_once(COMMON_ROOT."/admin/templates/successError/error.php");				
			}										
		}
	}
	
	//get details and show these in teh form
	function editClientUser($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		$adminDetails = $this->SelectQuery("SELECT id, username, email, pas0, clientgroupid from tbl_clients where id = '".$getPostArgs['id']."'", "master");
		$clientGroupList = $this->SelectQuery("SELECT id, group_name from tbl_client_groups", "master");
		require_once(COMMON_ROOT."/admin/actions/modules/clientGroupManage/editClientUser.php");	
	}

	function viewClientList()   
 	{
		/*$data = $this->SelectQuery("select * from tbl_clients WHERE approved = '1'", "master");*/
		$clientGroupList = $this->SelectQuery("SELECT id, group_name FROM tbl_client_groups", "master");
		$where = 'WHERE approved="1" AND clientgroupid="1"';

		$table = "tbl_clients";
		$rsObj = new ResultSetPagination($_GET['limit'], $_GET['cat'], $_GET['paged'], $where, $table, "admin", $_GET['page']);
		$total_pages = $rsObj->total_pages;
		$paged = $rsObj->paged;
		$data = $rsObj->getLimitSet($rsObj->limit_array);
		
		require_once(COMMON_ROOT."/admin/templates/clientGroupManage/viewClientList.php");
	}
	
	function viewUnapprovedClientList()   
 	{
	$data = $this->SelectQuery("select * from tbl_clients WHERE approved = '0' AND clientgroupid = '1' ORDER BY id DESC", "master");
	$clientGroupList = $this->SelectQuery("SELECT id, group_name FROM tbl_client_groups", "master");
	require_once(COMMON_ROOT."/admin/templates/clientGroupManage/viewUnapprovedClientList.php");
	}
	
	function approveClientUser($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		if (isset($getPostArgs['submit']))
		{
			$query = $this->SelectQuery("UPDATE tbl_clients SET approved = '1' WHERE id ='" .$getPostArgs['id']. "'", "master");
				//direct to correct output page depending on success of query
				if (is_array($query))
				{
					$mail_data = $this->SelectQuery("SELECT * FROM tbl_clients WHERE id='".$getPostArgs['id']."'","master");
					$message = '';
					$message .= 'New account has been successfully approved:<br /><br />';
					$message .= 'First Name : '.$mail_data[0]['first_name'].'<br />';
					$message .= 'Last Name : '.$mail_data[0]['last_name'].'<br />';
	
					$message .= 'Email : '.$mail_data[0]['email'].'<br />';			
					$message .= 'Company : '.$mail_data[0]['company'].'<br />';
					$message .= 'Job Title : '.$mail_data[0]['job_title'].'<br />';	
					$message .= 'Username : '.$mail_data[0]['username'].'<br />';	
					$subject = 'New Account Approved';
					
					$mailObj = new Mail;
					$mailObj->SendMail(CONTACT_EMAIL,$message,$subject);
					$mailObj->SendMail($mail_data[0]['email'],$message,$subject);
					
					$errmsg = "Selected Client account has been successfully approved";
					require_once(COMMON_ROOT."/admin/templates/successError/success.php");
				}
				else 
				{
					$errmsg = "Selected Client account has not been successfully approved";
					require_once(COMMON_ROOT."/admin/templates/successError/error.php");
				}
		}
		else
		{
		// $data populated to show admin group details
			$data = $this->SelectQuery("SELECT * FROM tbl_clients WHERE id = '".$getPostArgs['id']."'", "master");
			$candidatedata = $this->SelectQuery("SELECT * FROM tbl_candidates_data WHERE client_id = '".$getPostArgs['id']."'", "master");
			$candidatecvdata = $this->SelectQuery("SELECT * FROM tbl_candidates_cv_data WHERE candidate_id = '".$getPostArgs['id']."'", "master");
			require_once(COMMON_ROOT."/admin/actions/modules/clientGroupManage/approveClient.php");
		}
	}
	
	function deleteClientGroup($getPostArgs)
	{	
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		if (isset($getPostArgs['submit']))
		{
			
			$delete = $this->SelectQuery("DELETE FROM tbl_client_groups where id ='".$getPostArgs['id']."'" , "master");
	
			if (isset($delete))
			{
			//Delete links to all the allowed pages for the group in question
				$deleteAllowedPages = $this->SelectQuery("DELETE FROM tbl_client_group_allowed_pages WHERE groupid ='".$getPostArgs['id']."'", "master");
				if (isset($deleteAllowedPages))
				{		
					$errmsg = "Your Client Group has been sucessfully deleted";
					require_once(COMMON_ROOT."/admin/templates/successError/success.php");
				}
				else 
				{
					$errmsg = "Your Client Group has not been sucessfully deleted";
					require_once(COMMON_ROOT."/admin/templates/successError/error.php");
				}
			}
		}
		else
		{
			// $data populated to show admin group details
			$data = $this->SelectQuery("SELECT id, group_name, description from  tbl_client_groups where id='".$getPostArgs['id']."'", "master");
			$allowedPageList = $this->getAllowedPagesList($getPostArgs['id']);
			
			require_once(COMMON_ROOT."/admin/actions/modules/clientGroupManage/deleteClientGroup.php");
		}	
	}
}
?>
