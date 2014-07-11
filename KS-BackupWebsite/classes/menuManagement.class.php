<?php
/****************************************
* Author - esyed
* Company - Internet Concepts Limited
* Revision - 1.0
* Allows to manage the menu, add/delete/update menu items
* 18/12/09 
*****************************************/
//class used in admin panel
class menuManagement extends DataBase
{	
	//to load the addMenuItem page
	function addMenuItem($msg='', $abbrv)
	{		

		$mainMenuList = $this->SelectQuery("SELECT id, module_name, class_name FROM tbl_admin_pages WHERE has_sublinks='1'","master");
		$viewPageList = $this->SelectQuery("SELECT id, page_name FROM tbl_admin_pages WHERE page_name like '%view%'","master");
		if (is_array($msg))
		{
		}
		else
		{
			echo "<b>".$abbrv."</b>";
			$errmsg = $msg;
			require_once(COMMON_ROOT."/admin/templates/successError/success.php");
		}
		include(COMMON_ROOT.'/admin/templates/menuManagement/addMenuItem.php');
	}
	
	function addActionItem($getPostArgs)
	{
	$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
	//check if the edit/delete item for the selected view page already exists or not
	//view_order key '1=edit', '2=delete'
	if ($this->SelectQuery("SELECT * from tbl_admin_pages where assigned_viewpage_id ='" . $getPostArgs['viewPageID']."' AND view_order='".$getPostArgs['view_order']."'"))
		{
			$errmsg = "Sorry the edit/Delete item you are trying to create for the selected view page already exists";
			require_once(COMMON_ROOT."/admin/templates/successError/error.php");			
		}	
		else
		{
		$selectedViewPageClassName = $this->SelectQuery("SELECT module_name, class_name, assigned_main_id FROM tbl_admin_pages WHERE id = '".$getPostArgs['viewPageID']."'", "master");
		
		$insertEditDeletePage = $this->SelectQuery("INSERT INTO tbl_admin_pages (page_name, function_name, module_name, class_name, assigned_main_id, assigned_viewpage_id, view_order, isVisiblePanelItem) VALUES ('".$getPostArgs['pagename']."', '".$getPostArgs['functionname']."', '".$selectedViewPageClassName[0]['module_name']."', '".$selectedViewPageClassName[0]['class_name']."', '".$selectedViewPageClassName[0]['assigned_main_id']."', '".$getPostArgs['viewPageID']."', '".$getPostArgs['view_order']."', '0') ", "master");
		
		if (is_array($insertEditDeletePage))
			{
			$createdAbbrv  = $selectedViewPageClassName[0]['class_name'] . "->". $getPostArgs['pagename'];
			$this->addMenuItem("Successful Update", $createdAbbrv);
			}
		else 
			{$this->addMenuItem("Unseuccessful Update");}
		
		}
	}

	function addMainMenuItem($getPostArgs)
	{
	$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		if ($this->SelectQuery("SELECT * from tbl_admin_pages where module_name ='" . $getPostArgs['modulename']."' AND class_name='".$getPostArgs['classname']."'"))
		{
			$errmsg = "Sorry the Main menu Item (i.e Module Display Name) AND the Class Name you are trying to create already exists";
			require_once(COMMON_ROOT."/admin/templates/successError/error.php");			
		}	
		else
		{
			if (in_array($getPostArgs['classname'],get_declared_classes()))
			{
				$insert = $this->SelectQuery("INSERT INTO tbl_admin_pages (module_name, class_name, has_sublinks) VALUES ('".$getPostArgs['modulename']."','".$getPostArgs['classname']."', '1')", "master");
			if (is_array($insert))
				{
					$createdAbbrv  = $getPostArgs['mainlinktext'];
					$this->addMenuItem("Successful Update", $createdAbbrv);
				}
			else 
				{
					$this->addMenuItem("Unsuccessful Update");
				}
			}
			else
			{
				$errmsg = "Sorry CLASS does not exist.";
				require_once(COMMON_ROOT."/admin/templates/successError/error.php");
			
			}	
		}	
	}
	
	
	function addSubMenuItem($getPostArgs)
	{
	$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
	$selectedMainMenuItem = explode('_', $getPostArgs['modulename']);
	$mainMenuID = $selectedMainMenuItem[0];
	$className = $selectedMainMenuItem[1];

	if ($this->SelectQuery("SELECT * from tbl_admin_pages where function_name ='" . $getPostArgs['functionname'] . "' AND assigned_main_id='".$mainMenuID."'"))
		{
			$errmsg = "Sorry the function on the selected class already exists";
			require_once(COMMON_ROOT."/admin/templates/successError/success.php");			
		}	
		else
		{
		//check if the submenu item is a viewpage item or not i.e. view order is set to > 0
			$arrMethodNames = get_class_methods ($className);
			if (in_array($getPostArgs['functionname'], $arrMethodNames))
			{
				$insert = $this->SelectQuery("INSERT INTO tbl_admin_pages (page_name, class_name, function_name, assigned_main_id,  isVisiblePanelItem) VALUES ('".$getPostArgs['sublinktext']."','".$className."','".$getPostArgs['functionname']."', '".$mainMenuID."','".$getPostArgs['isVisiblePanelItem']."')", "master");	
			if (is_array($insert))
					{
						$createdAbbrv  = $className . "->". $getPostArgs['functionname'];
						$this->addMenuItem("Successful Update", $createdAbbrv);
					}
				else 
					{
						$this->addMenuItem("Unseuccessful Update");
					}
			
			}
			else
			{
				$errmsg = "Sorry the function on the selected class Does not exist";
				require_once(COMMON_ROOT."/admin/templates/successError/success.php");	
			
			}
		}
	}
	
	function viewMenuList()
	{
		$mainMenuItemList = $this->SelectQuery("SELECT * FROM tbl_admin_pages WHERE has_sublinks ='1'", "master");
		//$subMenuItemList = $this->SelectQuery("SELECT * FROM tbl_sub_menu_list", "master");
		include(COMMON_ROOT.'/admin/templates/menuManagement/viewMenuList.php');
		
	}
	
	function editMainMenuItem($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		$mainMenuItem = $this->SelectQuery("SELECT * FROM tbl_admin_pages WHERE id = '".$getPostArgs['id']."'", "master");
		$subMenuItemList = $this->SelectQuery("SELECT * FROM tbl_admin_pages WHERE assigned_main_id = '".$mainMenuItem[0]['id']."'", "master"); 
		include(COMMON_ROOT.'/admin/actions/modules/menuManagement/editMainMenuItem.php');
	}
	
	
	function editMainMenuItemUpdate($getPostArgs)
		{
			$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
			$update = $this->SelectQuery("UPDATE tbl_admin_pages set module_name = '".$getPostArgs['mainlinktext']."', class_name='".$getPostArgs['mainlinkclass']."' WHERE id= '".$getPostArgs['id']."'", "master");
			if (isset($update))
				{
					$errmsg = "Successful UPDATE";
					require_once(COMMON_ROOT."/admin/templates/successError/success.php");
				}
				else
				{
					$errmsg = "Sorry!!! UPDATE FAILED";
					require_once(COMMON_ROOT."/admin/templates/successError/success.php");
				}
	
		}
		
		
	function deleteMainMenuItem($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		if (isset($getPostArgs['submit']))
		{

		$delete = $this->SelectQuery("DELETE FROM tbl_admin_pages WHERE id = '".$getPostArgs['id']."'", "master");
		$deleteSubMenuItems = $this->SelectQuery("DELETE FROM tbl_admin_pages WHERE assigned_main_id='".$getPostArgs['id']."'", "master");   
			if ((isset($delete)) && (isset($deleteSubMenuItems)))
			{
				$errmsg = "Successful Menu DELETE";
				require_once(COMMON_ROOT."/admin/templates/successError/success.php");					
			}
			else
			{
				$errmsg = "Sorry!!! Delete FAILED";
				require_once(COMMON_ROOT."/admin/templates/successError/success.php");
			} 
		}
		else
		{
		$mainMenuItem = $this->SelectQuery("SELECT * FROM tbl_admin_pages WHERE id = '".$getPostArgs['id']."'", "master");
		$subMenuItemList = $this->SelectQuery("SELECT * FROM tbl_admin_pages WHERE assigned_main_id = '".$mainMenuItem[0]['id']."'", "master"); 
		include(COMMON_ROOT.'/admin/actions/modules/menuManagement/deleteMainMenuItem.php');	
		}
	}
	
	function editSubMenuItem($getPostArgs)
	{

		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		$subMenuItem = $this->SelectQuery("SELECT * FROM tbl_admin_pages WHERE id = '".$getPostArgs['id']."'", "master");
		include(COMMON_ROOT.'/admin/actions/modules/menuManagement/editSubMenuItem.php');	
	}
	
	function editSubMenuItemUpdate($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		$update = $this->SelectQuery("UPDATE tbl_admin_pages set page_name = '".$getPostArgs['sublinktext']."', function_name='".$getPostArgs['sublinkfunction']."' WHERE id= '".$getPostArgs['id']."'", "master");
		if (isset($update))
		{
			$errmsg = "Successful UPDATE";
			require_once(COMMON_ROOT."/admin/templates/successError/success.php");
		}
		else
		{
			$errmsg = "Sorry!!! UPDATE FAILED";
			require_once(COMMON_ROOT."/admin/templates/successError/success.php");
		}
	}
		
	
	
	
	function deleteSubMenuItem($getPostArgs)
	{
	$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		if (isset($getPostArgs['submit']))
		{
		$delete = $this->SelectQuery("DELETE FROM tbl_admin_pages WHERE id = '".$getPostArgs['id']."'", "master");
			if (isset($delete))
			{
				$errmsg = "Successful Sub Menu Item DELETE";
				require_once(COMMON_ROOT."/admin/templates/successError/success.php");					
			}
			else
			{
				$errmsg = "Sorry!!! Delete FAILED";
				require_once(COMMON_ROOT."/admin/templates/successError/success.php");
			} 
		}
		else
		{
		$mainMenuItem = $this->SelectQuery("SELECT * FROM tbl_admin_pages WHERE id = '".$getPostArgs['id']."'", "master");
		
		include(COMMON_ROOT.'/admin/actions/modules/menuManagement/deleteSubMenuItem.php');	
		}
	}

}
?>

