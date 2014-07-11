<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/

class Css extends DataBase // This class extended with DataBase Class
{ 
	var $tbls = array();
	// Constructor For this Class
	function __construct()
	{
		parent::__construct();
	}
	
	function getCSS($property)
	{
		$get_css = $this->SelectQuery("SELECT value FROM tbl_css WHERE property = '".$property."'","master");
		if(isset($_SESSION['accessibility']))
		{
			if($_SESSION['accessibility']['font_size']=='moderate')
			{
				$increase = 4;
			}
			elseif($_SESSION['accessibility']['font_size']=='large')
			{
				$increase = 6;
			}
			elseif($_SESSION['accessibility']['font_size']=='very large')
			{
				$increase = 8;
			}
		}
		else
		{
			$increase = 0;
		}
		if(stristr($get_css[0]['value'],'px'))
		{
			$css_array = explode('px',$get_css[0]['value']);
			$get_css[0]['value'] = ($css_array[0]+$increase).'px';			
		}
		return $get_css[0]['value'];
	}
	
	function getLinkcode($alignment)
	{
		$get_code = $this->SelectQuery("SELECT link_code FROM tbl_links WHERE link_alignment = '".$alignment."'","master");
		return $get_code[0]['link_code'];
	}
		
	
	//Ends
	// Destructor For this Class
	function __destruct(){}
}
// End Class
?>
