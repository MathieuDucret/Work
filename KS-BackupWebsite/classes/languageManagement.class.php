<?php

class languageManagement extends DataBase 
{	
	function __contruct()
	{
		parent::__construct();
	}
	
	function getUserLanguage($session)
	{
		if($session['language']>0)
		{
			$checkExists = $this->SelectQuery("SELECT id FROM tbl_languages WHERE id = '".$session['language']."' AND active='1'","master");
			if(count($checkExists)>0)
			{
				$language = $session['language'];
			}
			else
			{
				$data = $this->SelectQuery("SELECT id FROM tbl_languages WHERE default_language='1'","master");
				$language = $data[0]['id'];
				$this->setLanguage($language);
			}
		}
		else
		{
			$data = $this->SelectQuery("SELECT id FROM tbl_languages WHERE default_language='1'","master");
			$language = $data[0]['id'];
		}
		return $language;
	}
	
	function setLanguage($language_id)
	{
		$_SESSION['language']=$language_id;
	}
	
	function showLanguages()
	{
		$active_languages = $this->SelectQuery("SELECT * FROM tbl_languages WHERE active='1'","master");
		if(count($active_languages)>1)
		{
			for($i=0;$i<count($active_languages);$i++)
			{
				$output .= '<a href="/language_setter/'.$active_languages[$i]['id'].'/'.bin2hex($_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]).'/">'.$active_languages[$i]['language'].'</a><br />';
			}
			echo $output;
		}
	}
	
	function viewLanguages($getPostArgs)
	{
		$data = $this->SelectQuery("SELECT * FROM tbl_languages ORDER BY default_language DESC","master");
		require_once(COMMON_ROOT.'/admin/templates/languageManagement/viewLanguages.php');
	}
	
	function addLanguage($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($_POST);		
		$checkExists = $this->SelectQuery("SELECT * FROM tbl_languages WHERE language = '".$getPostArgs['language']."'","master");
		if(count($checkExists)>0)
		{
			$errmsg = 'A language already exists with this name<br />';
		}
		else
		{
			$errmsg = '';
			if($getPostArgs['default_language']==1 && $getPostArgs['active']==0)
			{
				$errmsg .= 'You cannot set the default language as inactive.<br />';
			}
			if ($errmsg == '') 
			{
				if(isset($getPostArgs['submit']))
				{
					if($getPostArgs['default_language']==1) 
					{
						$reset_default = $this->ExecQuery("UPDATE tbl_languages SET default_language = '0'","master");
					}						
					$insert = $this->InsertQuery("INSERT INTO tbl_languages ".createInsert($getPostArgs),"master");		
					$defaultLanguage = $this->SelectQuery("SELECT id FROM tbl_languages WHERE default_language='1' LIMIT 0,1","master");
					$insert_pages = $this->SelectQuery("SELECT * FROM tbl_pages WHERE language_id ='".$defaultLanguage[0]['id']."'","master");
					$insert_meta = $this->SelectQuery("SELECT * FROM tbl_meta WHERE language_id ='".$defaultLanguage[0]['id']."'","master");
					for($i=0;$i<count($insert_pages);$i++)
					{//Loop through all pages and insert pages and meta with new language id and default language data	
						$insert_pages[$i] = $this->mysql_real_escape_array($insert_pages[$i]);
					$getPostArgs['stripped_page_content'] = strip_tags($insert_pages[$i]['page_content']);
					$getPostArgs['stripped_page_content'] = str_replace(array("\r", "\r\n", "\n"), '',$getPostArgs['stripped_page_content']);
					$getPostArgs['stripped_page_content'] = str_replace('	', ' ',$getPostArgs['stripped_page_content']);
					$getPostArgs['stripped_page_content'] = str_replace('  ', ' ',$getPostArgs['stripped_page_content']);
						$language_id=$insert;								
						$page_id = $this->InsertQuery("
											 INSERT INTO tbl_pages (page_name, module_name, link_name, page_content, file_exists, link_order, menu_type,has_sublinks, link_type, assigned_main_id,language_id,stripped_content) VALUES 
											 (
											  '".$insert_pages[$i]['page_name']."',
											  '".$insert_pages[$i]['module_name']."',
											  '".$insert_pages[$i]['link_name']."',
											  '".$insert_pages[$i]['page_content']."',
											  '".$insert_pages[$i]['file_exists']."',
											  '".$insert_pages[$i]['link_order']."',
											  '".$insert_pages[$i]['menu_type']."',
											  '".$insert_pages[$i]['has_sublinks']."',
											  '".$insert_pages[$i]['link_type']."',
											  '".$insert_pages[$i]['assigned_main_id']."',											  
											  '".$language_id."',
											  '".$getPostArgs['stripped_page_content']."')","master");	
						$this->InsertQuery("INSERT INTO tbl_meta (page, module_name, title, keywords, description, language_id) VALUES ('".$insert_meta[$i]['page_name']."','".$insert_meta[$i]['module_name']."','".$insert_meta[$i]['meta_title']."','".$insert_meta[$i]['meta_keywords']."','".$insert_meta[$i]['meta_description']."',	'".$language_id."')","master"); 
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
					
					$errmsg = 'Language successfully added';
				}			
			}
		}
		require_once(COMMON_ROOT.'/admin/templates/languageManagement/addLanguage.php');
	}
	
	function editLanguage($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($_POST);
		if(isset($getPostArgs['submit']))
		{			
			$checkUpdate = $this->SelectQuery("SELECT * FROM tbl_languages WHERE language = '".$getPostArgs['language']."' AND id != '".$_GET['id']."'","master");
			$checkOtherDefault = $this->SelectQuery("SELECT id FROM tbl_languages WHERE default_language='1' AND id !='".$_GET['id']."'","master");
			
			if(count($checkUpdate)!=0)
			{			
				$errmsg="A language already exists with this new name<br />";
			}
			if($getPostArgs['default_language']==1 && $getPostArgs['active']==0)
			{
				$errmsg .= 'You cannot set the default language as inactive.<br />';
			}
			if($getPostArgs['default_language']==0 && count($checkOtherDefault)==0)
			{
				$errmsg .='You must have one language as your default. Please choose another language to set as default if you no longer wish this language to be default.';
			}
			
			if($errmsg=='')
			{
				if($getPostArgs['default_language']==1) 
				{					
					$reset_default = $this->ExecQuery("UPDATE tbl_languages SET default_language = '0'","master");
				}
				
				$this->SelectQuery("UPDATE tbl_languages SET ".createUpdate($getPostArgs,'default_language')." WHERE id='".$_GET['id']."'","master");				
				$errmsg="Language updated successfully";
			}
		}	
		$data = $this->SelectQuery("SELECT * FROM tbl_languages WHERE id = '".$_GET['id']."'","master");		
		require_once(COMMON_ROOT.'/admin/actions/modules/languageManagement/editLanguage.php');	
	}
	
	function deleteLanguage($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($_REQUEST);
		if(isset($getPostArgs['submit']))
		{
			$this->ExecQuery("DELETE FROM tbl_pages WHERE language_id = '".$getPostArgs['id']."'","master");
			$this->ExecQuery("DELETE FROM tbl_client_group_allowed_pages WHERE languageid = '".$getPostArgs['id']."'","master");
			$this->ExecQuery("DELETE FROM tbl_meta WHERE language_id = '".$getPostArgs['id']."'","master");
			$this->SelectQuery("DELETE FROM tbl_languages WHERE id='".$getPostArgs['id']."'","master");				
			$errmsg="Language deleted successfully";
		}	
		else
		{
			$data = $this->SelectQuery("SELECT * FROM tbl_languages WHERE id='".$getPostArgs['id']."'","master");			
		}	
		require_once(COMMON_ROOT.'/admin/actions/modules/languageManagement/deleteLanguage.php');			
	}
		
}
?>