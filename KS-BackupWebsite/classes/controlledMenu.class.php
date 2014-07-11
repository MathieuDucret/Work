<?php
/****************************************
* Author - esyed
* Company - Internet Concepts Limited
* Revision - 1.0
* 21/12/09 
*****************************************/
//class used in admin panel
class controlledMenu extends DataBase
{	
	function createMenu()
	{
	//check if the user is a super admin i.e. AdminGroupId=22
		if ($_SESSION['admin']['adminGroup']!="22")
		{ 
			//work out how many items in the menu do we need to create
			$allowedPagesList = $this->SelectQuery("SELECT distinct a.assigned_main_id from tbl_admin_pages a, tbl_admin_group_allowed_pages p where p.pageid = a.id AND p.groupid ='".$_SESSION['admin']['adminGroup']."' AND a.assigned_main_id!=0 ", "master");		
//GROUP BY a.assigned_main_id
		//$menu='';
			$menu .= "<li><a href=\"#\">Home</a><ul><li><a href=\"/admin/home/index\">Home</a></li><li><a href=\"/admin/home/logout\">Logout</a></li></ul></li>";
			for ($p=0; $p<count($allowedPagesList); $p++)
			{
				//get the module details of every allowed page one by one  
				$moduleName = $this->SelectQuery("SELECT id, module_name, class_name, has_sublinks from tbl_admin_pages where id='".$allowedPagesList[$p]['assigned_main_id']."' ORDER BY class_name", "master");	
				//now get the allowed pages (sublinks) within the current module
				$listitems = $this->SelectQuery("SELECT a.* from tbl_admin_pages a, tbl_admin_group_allowed_pages p where p.pageid = a.id AND  a.assigned_main_id='".$allowedPagesList[$p]['assigned_main_id']."' AND p.groupid ='".$_SESSION['admin']['adminGroup']."' AND a.isVisiblePanelItem = 1", "master");
				
				$menu .= "<li><a href=\"#\">".$moduleName[0]['module_name']."</a>";
				if ($moduleName[0]['has_sublinks']==1){$menu .= "<ul>";}
					for ($i=0; $i<count($listitems); $i++)
					{
						if ($moduleName[0]['id']==$listitems[$i]['assigned_main_id'])
						{
							$menu .= "<li><a href=\"/admin/".$listitems[$i]['class_name']."/".$listitems[$i]['function_name']."\">".$listitems[$i]['page_name']."</a></li>";
						}
					}
				if ($moduleName[0]['has_sublinks']==1)
				{
					$menu .= "</ul></li>";
				}
			}	
			return $menu;	
//		$menu .= "</li>";
		}
		else
		{
		//work out how many items in the menu do we need to create
		
			$allowedPagesList = $this->SelectQuery("SELECT distinct assigned_main_id from tbl_admin_pages", "master");
		//$menu='';
		// GROUP BY assigned_main_id
			$menu .= "<li><a href=\"#\">Home</a><ul><li><a href=\"/admin/home/index\">Home</a></li><li><a href=\"/admin/home/logout\">Logout</a></li></ul></li>";
		
			for ($p=0; $p<count($allowedPagesList); $p++)
			{
				//get the module details of every allowed page one by one  
				$moduleName = $this->SelectQuery("SELECT id, module_name, has_sublinks from tbl_admin_pages where id='".$allowedPagesList[$p]['assigned_main_id']."'", "master");	
				//now get the allowed pages (sublinks) within the current module
				$listitems = $this->SelectQuery("SELECT * from tbl_admin_pages WHERE isVisiblePanelItem = 1", "master");

				if ($moduleName[0]['module_name']!=""){
				$menu .= "<li><a href=\"#\">".$moduleName[0]['module_name']."</a>";
				}
				//$menu .= $moduleName[0]['module_name'];
				if ($moduleName[0]['has_sublinks']==1){$menu .= "<ul>";}
				//$menu.= "<li>";
				for ($i=0; $i<count($listitems); $i++)
				{
					if(isset($moduleName[0]))
					{						
						if($moduleName[0]['id']==$listitems[$i]['assigned_main_id'])
						{
							$menu .= "<li><a href=\"/admin/".$listitems[$i]['class_name']."/".$listitems[$i]['function_name']."\">".$listitems[$i]['page_name']."</a></li>";
						}
					}
				}
				if ($moduleName[0]['has_sublinks']==1)
				{
					$menu .= "</ul></li>";
				}
			}	
			return $menu;
		}		
	}		
} 
?>     



