<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/

class admin extends DataBase
{	
	function fnAdminLogin($getPostArgs)
	{
		if ($getPostArgs['username']!='' && $getPostArgs['password']!='')
		{
			$username = mysql_real_escape_string($getPostArgs['username']);
			$password = mysql_real_escape_string($getPostArgs['password']);
			$check_pass = $this->SelectQuery("SELECT * FROM tbl_admins WHERE username = '".$username."' AND password = '" . md5($password) . "' OR password = '".$password."'","master");
	 		//echo "Users admin group is=  ****  ".$check_pass[0]['admingroup'];
				if(count($check_pass)>0)
				{
					$_SESSION['admin']['user'] = $check_pass[0]['username'];
					$_SESSION['admin']['user_id'] = $check_pass[0]['id'];
					$_SESSION['admin']['pass'] = $check_pass[0]['password'];
					$_SESSION['admin']['adminGroup'] = $check_pass[0]['admingroup'];
					echo '<script type="text/javascript">
					<!--
					window.location = "/admin/home/index"
					//-->
					</script>';
				}
				else 
				{
					return false;
				}
		}
		else
		{
			return false;
		}
	}
	
	function fnAdminLogout()
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
				window.location = "'.SITE_URL.'/admin/home/index"
				//-->
				</script>';
	}
	
	function fnAdminPage($page)
	{
		require_once('templates/'.$page.'.php');		
	}
	
}
?>