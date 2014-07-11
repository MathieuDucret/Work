<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/

class Handler extends DataBase // This class extended with DataBase Class
{ 
	var $tbls = array();	
	var $file_dst_name;
	// Constructor For this Class
	function __construct(){
		parent::__construct();
	}
	
	function currentSubdomain($hostname)
	{
		$domain_array = explode('.',$hostname);
		$subdomain = $domain_array[0];
		return $subdomain;
	}
	
	function cleanSubdomain($subdomain)
	{
		$location = ucfirst($subdomain);
		$location = str_replace('_',' ',$location);
		$location = str_replace('and','&',$location);
		return $location;
	}
	
	function getCurrentpage($current_page)
	{
		if($current_page=='')
		{
			$current_page = 'index';
		}
		return $current_page;
	}
	
	function getCurrentmodule($current_module)
	{
		if($current_module=='')
		{
			$current_module = 'default';
		}
		return $current_module;
	}
	
	function getPostcode($location)
	{
		$location = mysql_real_escape_string($location);
		$get_postcode = $this->SelectQuery("SELECT PostCode from tbl_areas WHERE Area = '$location'","master");
		if(isset($get_postcode[0]['PostCode']))
		{
			$postcode = $get_postcode[0]['PostCode'];
		}
		else $postcode = '';
		return $postcode;
	}
	
	function uploadImage($file,$path,$name)
	{
		$imgObj = new upload($file);
		if ($imgObj->uploaded) 
		{
			$imgObj->file_new_name_body   = $name;
			$imgObj->image_resize         = true;
			$imgObj->image_y = 60;
			$imgObj->image_x = 60;
			$imgObj->image_ratio        = true;	
			$imgObj->process($path.'small'.SEPARATOR);
			//echo $imgObj->log;
			
			$imgObj->file_new_name_body   = $name;
			$imgObj->image_resize         = true;
			$imgObj->image_y = 300;
			$imgObj->image_x = 300;
			$imgObj->image_ratio        = true;
			$imgObj->process($path.'medium'.SEPARATOR);
			//echo $imgObj->log;
						
			$imgObj->file_new_name_body   = $name;
			$imgObj->image_resize         = true;
			$imgObj->image_x = 170;
			$imgObj->image_y = 170;
			$imgObj->image_ratio        = true;	
			$imgObj->process($path.'search_thumb'.SEPARATOR);
			//echo $imgObj->log;			
			
			$imgObj->file_new_name_body   = $name;
			$imgObj->image_resize         = true;
			$imgObj->image_x      = 1280;
			$imgObj->image_y      = 1280;
			$imgObj->image_ratio        = true;
			$imgObj->process($path.'large'.SEPARATOR);	
			//echo $imgObj->log;
			if ($imgObj->processed) 
			{			
				$this->file_dst_name = $imgObj->file_dst_name;
				$imgObj->clean();
			} 
			else 
			{
				echo 'error : ' . $imgObj->error;
			}
		}
		else
		{
			$imgObj->error;
		}
	}
	
	function uploadCV($file,$path,$name)
	{
		$imgObj = new upload($file);
		
		if ($imgObj->uploaded) 
		{
			$imgObj->file_new_name_body   = $name;			
			$imgObj->process($path);							
			if ($imgObj->processed) 
			{			
				$this->file_dst_name = $imgObj->file_dst_name;
				$imgObj->clean();
			} 
			else 
			{
				
				echo 'error : ' . $imgObj->error;
			}
		}
		else
		{
			return $imgObj->error;
		}
		return $imgObj->log;
	}
	
	function uploadGalleryImage($file,$path,$name)
	{
		$imgObj = new upload($file);
		
		if ($imgObj->uploaded) 
		{
			if($imgObj->file_src_y > 1024 || $imgObj->file_src_y > 1024)
			{
				if($imgObj->file_src_y > $imgObj->file_src_x)
				{//If image is higher than wider we should limit its height to max booth height
					$imgObj->image_y = 1024;	
					$imgObj->image_ratio_x        = true;	
					$imgObj->image_resize         = true;
				}
				elseif($imgObj->file_src_x > $imgObj->file_src_y)
				{
					$imgObj->image_x = 1024;	
					$imgObj->image_ratio_y        = true;	
					$imgObj->image_resize         = true;
				}				
			}
			
			$imgObj->image_resize         = true;
			$imgObj->file_new_name_body   = $name;			
			$imgObj->process($path);
			
			$imgObj->image_x = 50;	
			$imgObj->image_ratio_y        = true;	
			$imgObj->image_resize         = true;
			$imgObj->file_new_name_body   = $name;			
			$imgObj->process($path.'thumb'.SEPARATOR);
						
			if ($imgObj->processed) 
			{			
				$this->file_dst_name = $imgObj->file_dst_name;
				$imgObj->clean();
			} 
			else 
			{
				echo 'error : ' . $imgObj->error;
			}
		}
		else
		{
			return $imgObj->error;
		}
		return $imgObj->log;
	}
	
	
	function uploadPropertyImage($file,$path,$name)
	{
		$imgObj = new upload($file);
		if ($imgObj->uploaded) 
		{
			if($imgObj->file_src_y > $imgObj->file_src_x)
			{//If image is higher than wider we should limit its height to max booth height
				$imgObj->image_y = 100;	
				$imgObj->image_ratio_x        = true;	
			}
			elseif($imgObj->file_src_x > $imgObj->file_src_y)
			{
				$imgObj->image_x = 135;	
				$imgObj->image_ratio_y        = true;	
			}
			
			$imgObj->file_new_name_body   = $name;
			$imgObj->image_resize         = true;
			
			$imgObj->process($path.'thumbnail'.SEPARATOR);
						
			if($imgObj->file_src_y > $imgObj->file_src_x)
			{//If image is higher than wider we should limit its height to max booth height
				$imgObj->image_y = 170;	
				$imgObj->image_ratio_x        = true;	
			}
			elseif($imgObj->file_src_x > $imgObj->file_src_y)
			{
				$imgObj->image_x = 230;	
				$imgObj->image_ratio_y        = true;	
			}
			
			$imgObj->file_new_name_body   = $name;
			$imgObj->image_resize         = true;
			
			$imgObj->process($path.'small'.SEPARATOR);
			
			if($imgObj->file_src_y > $imgObj->file_src_x)
			{//If image is higher than wider we should limit its height to max booth height
				$imgObj->image_y = 230;	
				$imgObj->image_ratio_x        = true;	
			}
			
			elseif($imgObj->file_src_x > $imgObj->file_src_y)
			{
				$imgObj->image_x = 310;	
				$imgObj->image_ratio_y        = true;	
			}
			
			$imgObj->file_new_name_body   = $name;
			$imgObj->image_resize         = true;
			
			$imgObj->process($path.'normal'.SEPARATOR);
			
			
			//echo $imgObj->log;
						
			if ($imgObj->processed) 
			{			
				$this->file_dst_name = $imgObj->file_dst_name;
				$imgObj->clean();
			} 
			else 
			{
				echo 'error : ' . $imgObj->error;
			}
		}
		else
		{
			$imgObj->error;
		}
		return $imgObj->log;
	}
	
}