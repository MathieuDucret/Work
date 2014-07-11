<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0.1 - Links code for any site goes here
* Comments 
* 1.0.1 - Expanded comments for link display code
*****************************************/

class Layout extends DataBase // This class extended with DataBase Class
{ 
	var $tbls = array();
	var $db_page_content;
	var $display_mode = 'normal';
	// Constructor For this Class
	function __construct(){
		parent::__construct();
	}
	
	function showHeader()
	{
		/*$data = $this->SelectQuery("SELECT content FROM tbl_header","master");
		echo stripslashes($data[0]['content']);*/
		include(COMMON_ROOT.'custom/header.php');
	}
	function getSetting($setting)
	{
		$data = $this->SelectQuery("SELECT value FROM tbl_settings WHERE setting='".$setting."'","master");
		return $data[0]['value'];
	}
	
	function showLinks($class,$current_page,$current_module,$type)
	{
		$languageObj = new languageManagement;		
		$current_language = $languageObj->getUserLanguage($_SESSION);
		$groupId = $this->getUserGroup($_SESSION);
		$data = $this->SelectQuery("SELECT a.* FROM tbl_pages a, tbl_client_group_allowed_pages b WHERE (a.menu_type = '".$type."' OR a.menu_type = 'both') AND a.link_type='main' AND a.language_id = '".$current_language."' AND b.pageid = a.id AND b.groupid = '".$groupId."' ORDER BY a.link_order ASC","master");
		//$data = $this->SelectQuery("SELECT * FROM tbl_pages WHERE (menu_type = '".$type."' OR menu_type = 'both') AND link_type='main' ORDER BY link_order ASC","master");
		$master_id = $this->SelectQuery("SELECT assigned_main_id FROM tbl_pages WHERE page_name = '".$current_page."'","master");
		
		$get_master_page = $this->SelectQuery("SELECT page_name FROM tbl_pages WHERE id = '".$master_id[0]['assigned_main_id']."'","master");
		if(isset($get_master_page[0]['page_name']))
		{
			$master_page = $get_master_page[0]['page_name'];
		}
		else
		$master_page = '';
		//Before loop begins
		echo '<ul class="sf-menu">
		'; // Class for ul tag for the current menu

		for($i=0;$i<count($data);$i++)
		{	
		
			$module_name = stripslashes($data[$i]['module_name']);
			$page_name = stripslashes($data[$i]['page_name']);
			$link_name = stripslashes($data[$i]['link_name']); //All links made caps
			if($module_name != 'default') //If not a standard no-module page, we must get the module for the url as well
			{
				$page_name = $module_name.'/'.$page_name;
			}			
			if($current_page==$page_name || $master_page==$page_name || $page_name == $current_module.'/'.$current_page)
			{
				echo '<li class="link_'.($i+1).'" id="current_mainlink">'; // This is the current mainlink
			}
			else // Not the current mainlink
			{
				echo '<li class="link_'.($i+1).'">';
			}
			echo 
			'
			<a href="/'.$page_name.'">'.$link_name.'</a>
			';
			if($data[$i]['has_sublinks']==1) // If this Mainlink has sublinks, we must loop through them
			{
				$sublink_data = $this->SelectQuery("SELECT * FROM tbl_pages WHERE link_type = 'sub' AND assigned_main_id = '".$data[$i]['id']."' ORDER BY sublink_order ASC","master");				
				echo '<ul>'; // HTML to start sublinks section (if id or class required, put here)
				for($j=0;$j<count($sublink_data);$j++) // Looping through sublinks
				{
					if($sublink_data[$j]['module_name'] != 'default') //If not a standard no-module page, we must get the module for the url as well
					{
						$sub_page_name = $sublink_data[$j]['module_name'].'/'.$sublink_data[$j]['page_name'];
					}
					else
					{
						$sub_page_name = $sublink_data[$j]['page_name'];
					}
					
					if($current_page==$sublink_data[$j]['page_name']) // Checks if this is the current sublink
					{
						echo '<li>';  // Current sublink
					}
					else // Not the current sublink
					{
						echo '<li>';
					}
					echo '<a ';
					/*if($j-1== $count_sublink) // Only required if we need markup for the final sublink
					{
						echo 'class="last" ';
					}*/
					echo 'href="/'.$sub_page_name.'">'.$sublink_data[$j]['link_name'].'</a>'; // Link of this sublink
					echo '</li>';
				}
				echo '</ul>'; // Close the sublink section
				//echo '</li>'; // Close the mainlink section
			}
			echo '</li>';
			/*else  // Mainlink that has no sublinks
			{
				echo '<ul>'; //
				if($current_page==$page_name || $master_page==$page_name || $page_name == $current_module.'/'.$current_page)
				{
					echo '<li>'; // This is the current mainlink
				}	
				else
				{
					echo '<li>'; // This is not the current mainlink
				}
				//echo '<a href="/'.$page_name.'"><div class="welcome_to_france">Welcome to France. Welcome to France<span class="tastic">tastic</span> Holidays</div></a></li></ul>'; // If text is required for sublinks (when none exist), this is what will be displayed
			}//Close Link*/
		}
		if($_SESSION['client']['user_id']>0)
		{
			echo '<li><a href="/client/logout">Logout</a></li>';
		}
		echo "</ul>"; // Close whole link section
	}
	
	function getUserGroup($getSession)
	{
		if(isset($getSession['client']['clientgroupid']))
		{
			$groupId = $getSession['client']['clientgroupid'];
		}
		else
		{
			$groupId = 2;
		}
		return $groupId;
	}
	
	function showContent($current_page,$current_module,$location,$postcode,$admin='')
	{
		$callbackObj = callbackHandler::getInstance();

		$languageObj = new languageManagement;		
		$current_language = $languageObj->getUserLanguage($_SESSION);
		$current_module = mysql_real_escape_string($current_module);
		$current_page = mysql_real_escape_string($current_page);
		
		$groupId = $this->getUserGroup($_SESSION);
		$data = $this->SelectQuery("SELECT id, page_content, file_exists FROM tbl_pages WHERE page_name='".$current_page."' AND module_name = '".$current_module."' AND language_id='".$current_language."'","master");
		$checkPermissions = $this->SelectQuery("SELECT COUNT(*) as cnt FROM tbl_client_group_allowed_pages WHERE pageid = '".$data[0]['id']."' AND groupid='".$groupId."'","master");
		
		if($current_page!='logout' && $current_page!='login')
		{
			if($checkPermissions[0]['cnt']==0)
			{
				$data = $this->SelectQuery("SELECT id, page_content, file_exists FROM tbl_pages WHERE page_name='must_be_loggedin' AND module_name = 'default' AND language_id='".$current_language."'","master");
				
				/*echo '<script type="text/javascript">
			<!--
			window.location = "'.SITE_URL.'/must_be_loggedin"
			//-->
			</script>';*/
			}
		}
		
		if($admin!='')
		{
			$data[0]['page_content'] = $_POST['page_content'];
			$data[0]['file_exists'] = $_POST['file_exists'];
		}
		if(count($data>1))
		{
			for($i=0;$i<count($data);$i++)
			{
				if($data[$i]['page_content']=='')
				{
					continue;
				}
				else
				{
					$content = stripslashes($data[$i]['page_content']);
					$exists = $data[$i]['file_exists'];
					break;
				}
			}
		}
		else
		{
			$content = stripslashes($data[0]['page_content']);
			$exists = $data[0]['file_exists'];
		}
	
		$content = str_replace('%LOCATION%',$location,$content);
		$content = str_replace('%POSTCODE%',$postcode,$content);
		$this->db_page_content = $content;		
		$this->dont_display='';
		if($data[0]['file_exists']=='1')
		{			
			require_once(COMMON_ROOT.$current_module.'/'.$current_page.'.php');
		}
		if($this->display_mode=='normal')
		{
			echo $this->db_page_content;
		}		
	}
	
	function showFooter()
	{
		$data = $this->SelectQuery("SELECT content FROM tbl_footer","master");
		$subdomain = $this->getSetting('subdomains');
		echo $data[0]['content'];
		//include(COMMON_ROOT.'custom/custom_footer.php');
		if($subdomain=='1')
		{
			echo $this->getSubdomainFooter();
		}
		
	}
	
	function getSubdomainFooter()
	{		
		$get_areas = $this->SelectQuery("SELECT * FROM tbl_areas ORDER BY Area ASC","master");
		$count_areas = count($get_areas);
		require_once(COMMON_ROOT.'/admin/templates/subdomainfooter.php');
	}
	
	
	
	//Ends
	// Destructor For this Class
	function __destruct(){}
}
// End Class
?>
