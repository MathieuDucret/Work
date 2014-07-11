
<?php
/****************************************
* Author - esyed
* Company - Internet Concepts Limited
* Revision - 1.0
* being used by /admin/templates/edit_email_message.php
* 24/11/09 
*****************************************/
//class used in admin panel
class home extends DataBase
{	
	
	function showAdminHome()
	{
		include(COMMON_ROOT.'/admin/templates/home/home.php');
	}
	
		
	function logout()
	{
		unset($_SESSION['admin']['user']);
		unset($_SESSION['admin']['pass']);
		unset($_SESSION['admin']['usersecuritylevel']);
		if(isset($_COOKIE[session_name()])) 
		{
			setcookie(session_name(), '', time()-42000, '/');
		}	
		// Finally, destroy the session.
		session_destroy();		
		//echo "username value = " . $_SESSION['admin']['user'];		
		echo '<script type="text/javascript">
				<!--
				window.location = "'.SITE_URL.'/admin/"
				//-->
				</script>';
		return true;
	}
	

}
?>


