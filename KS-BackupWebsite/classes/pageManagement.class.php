<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 2.0
* 
* 10/07/2010
*****************************************/
//class used in admin panel
class pageManagement extends DataBase
{	

	
	//function showAdminAddPage($getPostArgs)
	function addPage($getPostArgs)
	{		
		$getPostArgs['stripped_page_content'] = strip_tags($getPostArgs['page_content']);
		$getPostArgs['stripped_page_content'] = str_replace(array("\r", "\r\n", "\n"), '',$getPostArgs['stripped_page_content']);
		$getPostArgs['stripped_page_content'] = str_replace('	', ' ',$getPostArgs['stripped_page_content']);
		$getPostArgs['stripped_page_content'] = str_replace('  ', ' ',$getPostArgs['stripped_page_content']);
		
		$getPostArgs['page_content'] = str_replace('&quot;',"'",$getPostArgs['page_content']);
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		if(count($_POST)>0)
		{
			if($getPostArgs['selected_language']!='')
			{
				$check_exists = $this->SelectQuery("SELECT * FROM tbl_pages WHERE page_name='".$getPostArgs['page_name']."' AND module_name='".$getPostArgs['module_name']."' AND language_id = '".$getPostArgs['selected_language']."'","master");
				if(count($check_exists)>0)
				{ 
					$errmsg = 'Page already exists in this module for this language';
				}
			}
			//Validate user entry
			if(preg_match('/^[a-z0-9_]+$/', $getPostArgs['page_name'])==false) $errmsg .= 'Page name cannot have invalid characters in it. Please ensure page name only has numbers, letters or underscores in it<br />';
			if(preg_match('/^[a-z0-9_]+$/', $getPostArgs['module_name'])==false) $errmsg .= 'Module name cannot have invalid characters in it. Please ensure module name only has numbers, letters or underscores in it<br />';
			if($getPostArgs['link_type']=='sub' && $getPostArgs['assigned_main_id']==0)
			{
				$errmsg .= 'You must select a main link to assign this link to if you set its link type to Sublink';
			}
			
			if($getPostArgs['link_type']=='main' && $getPostArgs['assigned_main_id']>0)
			{
				$errmsg .= 'You cannot assign this link to another if it is a Main link type<Br />';
			}
			
			if($getPostArgs['link_type']=='sub' && $getPostArgs['assigned_main_id']>0 && $getPostArgs['selected_language']=='')
			{ //If this is a sublink being assigned to a main link and its supposed to assign to all langauges we have  aproblem!
				$errmsg .= 'You must select a language when adding sublinks so you can correctly assign the sublink to the correct language main link<br />';
			}
			
			if($errmsg=='')
			{			
					
				if($getPostArgs['assigned_main_id'] == '') $getPostArgs['assigned_main_id'] = 0;
				if($getPostArgs['selected_language']!='')
				{ //We want to update one language
					$language_data = $this->SelectQuery("SELECT * FROM tbl_languages WHERE id = '".$getPostArgs['selected_language']."'","master");
				}
				else
				{
					$language_data = $this->SelectQuery("SELECT * FROM tbl_languages","master");
				}
				
				for($i=0;$i<count($language_data);$i++)
				{
					if($getPostArgs['selected_language']=='')
					{ //Check if this page is to be inserted for all languages
						$check_exists = $this->SelectQuery("SELECT * FROM tbl_pages WHERE page_name='".$getPostArgs['page_name']."' AND module_name='".$getPostArgs['module_name']."' AND language_id = '".$language_data[$i]['id']."'","master");
						if(count($check_exists)>0)
						{ //This page already exists for this language so continue to add page for next language
							continue;
						}
					}						
						
					$page_id = $this->InsertQuery("
											 INSERT INTO tbl_pages (page_name, module_name, link_name, page_content, file_exists, link_order, menu_type,has_sublinks, link_type, assigned_main_id,language_id,stripped_content) VALUES 
											 (
											  '".$getPostArgs['page_name']."',
											  '".$getPostArgs['module_name']."',
											  '".$getPostArgs['link_name']."',
											  '".$getPostArgs['page_content']."',
											  '".$getPostArgs['hard_file']."',
											  '".$getPostArgs['link_order']."',
											  '".$getPostArgs['menu_type']."',
											  '".$getPostArgs['has_sublinks']."',
											  '".$getPostArgs['link_type']."',
											  '".$getPostArgs['assigned_main_id']."',
											  '".$language_data[$i]['id']."',
											  '".$getPostArgs['stripped_page_content']."')","master");				
					if($getPostArgs['page_name']!='')
					{
						$this->SelectQuery("INSERT INTO tbl_meta (page, module_name, title, keywords, description, language_id) VALUES ('".$getPostArgs['page_name']."','".$getPostArgs['module_name']."','".$getPostArgs['meta_title']."','".$getPostArgs['meta_keywords']."','".$getPostArgs['meta_description']."','".$language_data[$i]['id']."')","master"); 
					}
					$layoutObj = new Layout;
					if($layoutObj->getSetting('auto_add_permissions')==1)
					{//This checks if auto add is on, if it is, this adds permissions into the system for all groups (Previous loop ensures this applies to all pages)
							$groupData = $this->SelectQuery("SELECT * FROM tbl_client_groups","master");
							for($k=0;$k<count($groupData);$k++)
							{
								$insert_permissions = $this->InsertQuery("INSERT INTO tbl_client_group_allowed_pages (groupid, pageid) VALUES ('".$groupData[$k]['id']."', '".$page_id."')","master");
							}
					}
				}
				$errmsg = 'Page successfully added';
				echo '<script type="text/javascript">window.location = "'.SITE_URL.'/admin/pageManagement/viewPages"</script>';
				exit(0);
			}
		}
		$get_pages = $this->SelectQuery("SELECT COUNT(*) AS cnt FROM tbl_pages","master");
		//$getmainsublinks = $this->SelectQuery("SELECT * FROM tbl_pages WHERE link_type = 'main' AND has_sublinks = '1' ORDER BY link_order ASC","master");
		
		$language_array = $this->SelectQuery("SELECT * FROM tbl_languages ORDER BY default_language DESC","master");
		
		include(COMMON_ROOT.'/admin/templates/pageManagement/addPage.php');		
	}
	
	function viewPages($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		
		$language_array = $this->SelectQuery("SELECT * FROM tbl_languages ORDER BY default_language DESC","master");
		if($_POST['selected_language']!='') $current_language = $_POST['selected_language']; else $current_language = $language_array[0]['id'];		
		
	//create the where clause and pass this along with table name
		$where = "WHERE language_id='".$current_language."' AND link_type='main' OR (link_type='sub' AND assigned_main_id='0') ORDER BY link_order ASC";
		$table = "tbl_pages";
		$layoutObj = new Layout;
		$rsObj = new ResultSetPagination($_GET['limit'], $_GET['cat'], $_GET['paged'], $where, $table, "admin", $_GET['page']);


		$total_pages = $rsObj->total_pages;
		$paged = $rsObj->paged;

		$q = $rsObj->getLimitSet($rsObj->limit_array);
		$data = $this->SelectQuery("SELECT module_name FROM tbl_pages WHERE language_id='".$current_language."' GROUP BY module_name ASC","master");
		include(COMMON_ROOT.'/admin/templates/pageManagement/viewPages.php');
	}
	
	
	function editPage($getPostArgs)
	{
		$getPostArgs['stripped_page_content'] = strip_tags($getPostArgs['page_content']);
		$getPostArgs['stripped_page_content'] = str_replace(array("\r", "\r\n", "\n"), '',$getPostArgs['stripped_page_content']);
		$getPostArgs['stripped_page_content'] = str_replace('	', ' ',$getPostArgs['stripped_page_content']);
		$getPostArgs['stripped_page_content'] = str_replace('  ', ' ',$getPostArgs['stripped_page_content']);
		$getPostArgs['page_content'] = str_replace('&quot;',"'",$getPostArgs['page_content']);
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		$data = $this->SelectQuery("SELECT * FROM tbl_pages WHERE id = '".mysql_real_escape_string($_GET['id'])."'","master");
		$meta_data = $this->SelectQuery("SELECT * FROM tbl_meta WHERE page = '".$data[0]['page_name']."' AND module_name = '".$data[0]['module_name']."'","master");
		$count_pages = $this->SelectQuery("SELECT COUNT(*) as cnt FROM tbl_pages","master");
		$getmainsublinks = $this->SelectQuery("SELECT * FROM tbl_pages WHERE link_type = 'main' AND has_sublinks = '1' AND language_id = '".$data[0]['language_id']."' ORDER BY link_order ASC","master");
		if($data[0]['link_type']=='sub')
		{
			$getsublinkorder = $this->SelectQuery("SELECT COUNT(*) as cnt FROM tbl_pages WHERE assigned_main_id = '".$data[0]['assigned_main_id']."'","master");
		}	
		if(count($_POST)>0)
		{		
			//Validate user entry
			if(preg_match('/^[a-z0-9_]+$/', $getPostArgs['page_name'])==false) $errmsg = 'Page name cannot have invalid characters in it. Please ensure page name only has numbers, letters or underscores in it<br />';
			if(preg_match('/^[a-z0-9_]+$/', $getPostArgs['module_name'])==false) $errmsg .= 'Module name cannot have invalid characters in it. Please ensure module name only has numbers, letters or underscores in it<br />';	
			if($getPostArgs['link_type']=='sub' && $getPostArgs['assigned_main_id']==0)
			{
				$errmsg .= 'You must select a main link to assign this link to if you set its link type to Sublink';
			}
			
			if($getPostArgs['link_type']=='main' && $getPostArgs['assigned_main_id']>0)
			{
				$errmsg .= 'You cannot assign this link to another if it is a Main link type<Br />';
			}			
			
			if($errmsg =='')
			{				
			
				if($getPostArgs['sublink_order']=='') $getPostArgs['sublink_order'] = 0;				  
				$this->SelectQuery("
										 UPDATE tbl_pages SET 
										 page_name = '".$getPostArgs['page_name']."',
										 module_name = '".$getPostArgs['module_name']."',
										 link_name = '".$getPostArgs['link_name']."', 
										 page_content='".$getPostArgs['page_content']."', 
										 file_exists ='".$getPostArgs['hard_file']."', 
										 link_order = '".$getPostArgs['link_order']."',
										 menu_type = '".$getPostArgs['menu_type']."',
										 has_sublinks = '".$getPostArgs['has_sublinks']."',
										 link_type = '".$getPostArgs['link_type']."',
										 assigned_main_id = '".$getPostArgs['assigned_main_id']."',
										 sublink_order = '".$getPostArgs['sublink_order']."',
										 stripped_content = '".$getPostArgs['stripped_page_content']."'
										 WHERE id='".mysql_real_escape_string($_GET['id'])."'","master");
				
				//echo (strlen($data[0]['page_content']) - similar_text($_POST['page_content'],$data[0]['page_content']));				
				if(mysql_real_escape_string($data[0]['page_content'])!=$getPostArgs['page_content'])
				{
					$page_id = $this->InsertQuery("
											 INSERT INTO tbl_pages_archive (page_id, admin_user, page_content, language_id, stripped_content) VALUES 
											 (
											  '".mysql_real_escape_string($_GET['id'])."',
											  '".$_SESSION['admin']['user_id']."',
											  '".$getPostArgs['page_content']."',
											  '".$data[0]['language_id']."',
											  '".$getPostArgs['stripped_page_content']."')","master");	
				}
						
							  
				$this->SelectQuery("UPDATE tbl_meta SET title = '".$getPostArgs['meta_title']."', keywords = '".$getPostArgs['meta_keywords']."', description = '".$getPostArgs['meta_description']."', module_name = '".$getPostArgs['module_name']."', `page`='".$getPostArgs['page_name']."' WHERE `page` = '".$data[0]['page_name']."' AND module_name = '".$data[0]['module_name']."' AND language_id = '".$data[0]['language_id']."'","master");												
				
				$errmsg = 'Page successfully updated';
			}
		}
		$data = $this->SelectQuery("SELECT * FROM tbl_pages WHERE id = '".mysql_real_escape_string($_GET['id'])."'","master");
		$archive_data = $this->SelectQuery("SELECT * FROM tbl_pages_archive WHERE page_id = '".mysql_real_escape_string($_GET['id'])."' ORDER BY date_created DESC","master");
		for($i=0;$i<count($archive_data);$i++)
		{
			$admin_user = $this->SelectQuery("SELECT username, admingroup FROM tbl_admins WHERE id = '".$archive_data[$i]['admin_user']."' LIMIT 0,1","master");
			if($admin_user[0]['admingroup']==22)
			{
				$admin_user[0]['username']='Superuser';
			}
			$archive_data[$i]['date_created'] = $i.'. '.date('dS F Y H:i:s',strtotime($archive_data[$i]['date_created'])).' - Edited by '.$admin_user[0]['username'];
		}
		$meta_data = $this->SelectQuery("SELECT * FROM tbl_meta WHERE page = '".$data[0]['page_name']."' AND module_name = '".$data[0]['module_name']."'","master");
		include(COMMON_ROOT.'/admin/actions/modules/pageManagement/editpage.php');
	}
	
	function deletePage($getPostArgs)
	{	
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);	
		$data = $this->SelectQuery("SELECT * FROM tbl_pages WHERE id = '".mysql_real_escape_string($_GET['id'])."'","master");
		
		if(isset($getPostArgs['submit']))
		{			
			$this->SelectQuery("DELETE FROM tbl_pages WHERE id='".mysql_real_escape_string($_GET['id'])."'","master");
			$this->SelectQuery("DELETE FROM tbl_pages_archive WHERE page_id='".mysql_real_escape_string($_GET['id'])."'","master");
			$this->SelectQuery("DELETE FROM tbl_meta WHERE page='".$data[0]['page_name']."' AND module_name='".$data[0]['module_name']."' AND language_id = '".$data[0]['language_id']."'","master");
			$this->ExecQuery("DELETE FROM tbl_client_group_allowed_pages WHERE pageid = '".mysql_real_escape_string($_GET['id'])."'","master");
			$errmsg="Page deleted successfully";
			echo '<script type="text/javascript">window.location = "'.SITE_URL.'/admin/pageManagement/viewPages"</script>';
			exit(0);
		}		
		$data = $this->SelectQuery("SELECT * FROM tbl_pages WHERE id = '".mysql_real_escape_string($_GET['id'])."'","master");
		$meta_data = $this->SelectQuery("SELECT * FROM tbl_meta WHERE page = '".$data[0]['page_name']."' AND module_name = '".$data[0]['module_name']."' AND language_id = '".$data[0]['language_id']."'","master");
		
		include(COMMON_ROOT.'/admin/actions/modules/pageManagement/deletepage.php');
	}
		
	
}
?>



