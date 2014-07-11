<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/

class accessibility extends DataBase // This class extended with DataBase Class
{ 
	var $tbls = array();
	// Constructor For this Class
	function __construct()
	{
		parent::__construct();
	}
	
	function setFontSize($size)
	{
		if($size=='moderate')
		{
			$_SESSION['accessibility']['font_size']='moderate';
		}
		elseif($size=='large')
		{
			$_SESSION['accessibility']['font_size']='large';
		}
		elseif($size=='very large')
		{
			$_SESSION['accessibility']['font_size']='very large';
		}
		elseif($size=='normal')
		{
			unset($_SESSION['accessibility']['font_size']);
		}
	}
	
	function showSizes()
	{
		include(COMMON_ROOT.'accessibility/sizes.php');
	}
		
	
	// Destructor For this Class
	function __destruct(){
		parent::__destruct();
	}
}
// End Class
?>
