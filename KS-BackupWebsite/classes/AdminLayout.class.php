<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0.1
* Comments -
* 1.0.1 - Footer and header now insert if none exist   
*****************************************/

class adminLayout extends DataBase // This class extends with DataBase Class
{ 
	// Constructor For this Class
	function __construct(){  
		parent::__construct();   
	}  
	
	function showAdminContent($current_page, $module, $getPostArgs)     
	{
		//check if the user belongs to super admin group. If yes, Bypass all the security
		if(stristr(PHP_SAPI,'cli'));
		{
			$classObj  =  new $module;
			return $classObj->$current_page($getPostArgs); 
		}
		if ($_SESSION['admin']['adminGroup']!="22")  
		{	
			//$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
//			echo "showAdminContent page name =  " . $current_page. "module name= " . $module;
			$currentPageId = $this->SelectQuery("SELECT id FROM tbl_admin_pages WHERE function_name = '".$current_page."' AND class_name = '".$module."'", "master"); 
			$checkPermissions = $this->SelectQuery("SELECT COUNT(*) as cnt FROM tbl_admin_group_allowed_pages WHERE pageid = '".$currentPageId[0]['id']."' AND groupid = '".$_SESSION['admin']['adminGroup']."'","master");

			//allow access to logout and home page to all users
			if (($current_page=="logout") || ($current_page=="index"))
			{
				$classObj  =  new $module;
				return $classObj->$current_page($getPostArgs); 	
			}
			//show allowed page to user
			//if theres a save or update in page name, its an action from a permitted page and thus the user should be allowed to carry out respective action
			elseif($checkPermissions[0]['cnt']>0)
			{
				$classObj  =  new $module;
				return $classObj->$current_page($getPostArgs);  
			}
			else
			{ 
				$errmsg = '<b>Access to the page denied!!! Please contact your system administrator. </b>'; 
				require_once(COMMON_ROOT."/admin/templates/successError/error.php");
				exit(0);
			}
		}
		else 
		{
			$classObj  =  new $module;
			return $classObj->$current_page($getPostArgs); 
		}
	}
}