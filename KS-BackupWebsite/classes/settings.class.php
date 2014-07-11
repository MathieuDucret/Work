<?php
/****************************************
* Author - esyed
* Company - Internet Concepts Limited
* Revision - 1.0
* being used by /admin/templates/edit_email_message.php
* 24/11/09 
*****************************************/
//class used in admin panel
class settings extends DataBase
{	
	function editHeader($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		if(isset($getPostArgs['submit']))
		{
			$check_exists = $this->SelectQuery("SELECT * FROM tbl_header","master");
			if(count($check_exists)>0)
			{
				$this->SelectQuery("UPDATE tbl_header SET content = '".$getPostArgs['header_content']."'","master");
				$errmsg="Header updated successfully";	
			}
			else
			{
				$this->SelectQuery("INSERT INTO tbl_header (content) VALUES ('".$getPostArgs['header_content']."')","master");
				$errmsg="Header inserted successfully";		
			}				
		}	
		$data = $this->SelectQuery("SELECT content FROM tbl_header","master");
		include(COMMON_ROOT.'/admin/templates/settings/editheader.php');
	}
	
		
	function editFooter($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		if(isset($getPostArgs['submit']))
		{
			$check_exists = $this->SelectQuery("SELECT * FROM tbl_footer","master");
			if(count($check_exists)>0)
			{
				$this->SelectQuery("UPDATE tbl_footer SET content = '".$getPostArgs['footer_content']."'","master");
				$errmsg="Footer updated successfully";	
			}
			else
			{
				$this->SelectQuery("INSERT INTO tbl_footer (content) VALUES ('".$getPostArgs['footer_content']."')","master");
				$errmsg="Footer inserted successfully";		
			}			
		}
		$data = $this->SelectQuery("SELECT content FROM tbl_footer","master");
		include(COMMON_ROOT.'/admin/templates/settings/editfooter.php');
	}
	
	function showSettings($getPostArgs)
	{ 
		if(isset($getPostArgs['submit']))
		{			
			foreach($getPostArgs as $key=>$val){
				$this->SelectQuery("UPDATE tbl_settings SET value = '".mysql_real_escape_string($val)."' WHERE setting = '".mysql_real_escape_string($key)."'","master");
				$this->SelectQuery("UPDATE tbl_css SET value = '".mysql_real_escape_string($val)."' WHERE property = '".mysql_real_escape_string($key)."'","master");			
			}
		}			
		$settings = $this->SelectQuery("SELECT * FROM tbl_settings","master");
		$css = $this->SelectQuery("SELECT * FROM tbl_css ORDER BY display_name ASC","master");		
		include(COMMON_ROOT.'/admin/templates/settings/settings.php');
	}
}
?>


