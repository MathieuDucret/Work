<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/

	class MetaData extends DataBase {
		
		function __construct(){
		parent::__construct();
		}
		
		var $location;
		var $postcode;
		
		
		function getKeywords($page,$module,$getPostArgs='')
		{
			$page = mysql_real_escape_string($page);
			$module = mysql_real_escape_string($module);
			$getPostArgs['id'] = mysql_real_escape_string($getPostArgs['id']);
			
			$languageObj = new languageManagement;		
			$current_language = $languageObj->getUserLanguage($_SESSION);			
			$retrieve_meta = $this->SelectQuery("SELECT keywords FROM tbl_meta WHERE page = '$page' AND module_name = '$module' AND language_id='$current_language'","master");			
			$keywords = $retrieve_meta[0]['keywords'];
			$keywords = str_replace('%POSTCODE%',$this->postcode,$keywords);
			$keywords = str_replace('%LOCATION%',$this->location,$keywords);
			switch ($getPostArgs['module']) {  
				case 'news_directory':						
					//print_r($getPostArgs);
					$id_array = explode('_',strrev($getPostArgs['id']));
					$id = strrev($id_array[0]);
					if($page=='article')
					{			
						$data = $this->SelectQuery("SELECT a.title as title,a.content as content,a.date_added as date_added,b.name as name  FROM tbl_module_news_article_data a, tbl_module_newsdirectory_categories_data b WHERE a.id = '".mysql_real_escape_string($id)."' AND a.categoryid = b.id","master");
						$keywords = str_replace('%TITLE%',$data[0]['title'],$keywords);						
						$keywords = str_replace('%CATEGORY%',$data[0]['name'],$keywords);
						$keywords = str_replace('%DESCRIPTION%',trim(strip_tags($data[0]['content'])),$keywords);
						$keywords = str_replace('%POSTED%',date('d-m-Y',strtotime($data[0]['date_added'])),$keywords);
	
					}
					elseif($page=='article_list')
					{
						$data = $this->SelectQuery("SELECT name FROM tbl_module_newsdirectory_categories_data WHERE id = '".mysql_real_escape_string($id)."'","master");
						$title = str_replace('%CATEGORY%',$data[0]['name'],$title);
					}
					$keywords = str_replace('%DESCRIPTION%',$getPostArgs['current_page'],$keywords);
					$keywords = str_replace('%POSTED%',date('d-m-Y',strtotime($data[0]['date_added'])),$keywords);
				break;
				case 'link_directory':
					if($page=='viewlinkclientpaginated')
					{
						$data = $this->SelectQuery("SELECT name FROM tbl_module_linkdirectory_categories_data WHERE id = '".$getPostArgs['id']."'","master");
						$keywords = str_replace('%CATEGORY%',$data[0]['name'],$keywords);
					}
				break;
				case 'shop':
					if($page=='category')
					{
						$data = $this->SelectQuery("SELECT category_name, description FROM tbl_shop_settings_categories WHERE category_name = '".mysql_real_escape_string(urldecode($_GET['item']))."'","master");
						$keywords = str_replace('%CATEGORY%',$data[0]['category_name'],$keywords);
						$keywords = str_replace('%DESCRIPTION%',trim(strip_tags($data[0]['description'])),$keywords);
					}
					elseif($page=='product')
					{
						$data = $this->SelectQuery("SELECT id,product_name, product_code, description FROM tbl_shop_products WHERE product_name = '".mysql_real_escape_string(str_replace('|','/',urldecode($_GET['item'])))."'","master");
						$search_tags = $this->SelectQuery("SELECT tag FROM tbl_shop_products_searchtags WHERE product_id = '".$data[0]['id']."'","master");
						for($i=0;$i<count($search_tags);$i++)
						{
							$tag_data .= $search_tags[$i]['tag'];
							if($i!=count($search_tags)-1) $tag_data .= ', ';
						}					
	
						$keywords = str_replace('%PRODUCTNAME%',$data[0]['product_name'],$keywords);
						$keywords = str_replace('%PRODUCTCODE%',$data[0]['product_code'],$keywords);
						$keywords = str_replace('%PRODUCTSEARCH_TAGS%',$tag_data,$keywords);
						$keywords = str_replace('%PRODUCTDESCRIPTION%',php_strip_whitespace(strip_tags($data[0]['description'])),$keywords);
					}
				break;
					
			}
			$keywords = str_replace('_',' ',$keywords);
			echo $keywords;
		}		
		function getTitle($page,$module,$getPostArgs='')
		{
			$languageObj = new languageManagement;		
			$current_language = $languageObj->getUserLanguage($_SESSION);	
			$page = mysql_real_escape_string($page);
			$module = mysql_real_escape_string($module);
			$getPostArgs['id'] = mysql_real_escape_string($getPostArgs['id']);
			

			$retrieve_meta = $this->SelectQuery("SELECT title FROM tbl_meta WHERE page = '$page' AND module_name = '$module' AND language_id='$current_language'","master");	
			$title = $retrieve_meta[0]['title'];
			$title = str_replace('%POSTCODE%',$this->postcode,$title);
			$title = str_replace('%LOCATION%',$this->location,$title);						
			switch ($getPostArgs['module']) {  
				case 'news_directory':	
				$id_array = explode('_',strrev($getPostArgs['id']));
				$id = strrev($id_array[0]);
				//print_r($getPostArgs);
				if($page=='article')
				{	
				
					$data = $this->SelectQuery("SELECT a.title as title,a.content as content,a.date_added as date_added,b.name as name  FROM tbl_module_news_article_data a, tbl_module_newsdirectory_categories_data b WHERE a.id = '".mysql_real_escape_string($id)."' AND a.categoryid = b.id","master");
					$title = str_replace('%TITLE%',$data[0]['title'],$title);
					$title = str_replace('%CATEGORY%',$data[0]['name'],$title);
					$title = str_replace('%DESCRIPTION%',trim(strip_tags($data[0]['content'])),$title);
					$title = str_replace('%POSTED%',date('d-m-Y',strtotime($data[0]['date_added'])),$title);
				}
				elseif($page=='article_list')
				{
					$data = $this->SelectQuery("SELECT name FROM tbl_module_newsdirectory_categories_data WHERE id = '".mysql_real_escape_string($id)."'","master");
					$title = str_replace('%CATEGORY%',$data[0]['name'],$title);
				}					
				$title = str_replace('%DESCRIPTION%',$getPostArgs['current_page'],$title);
				$title = str_replace('%POSTED%',$getPostArgs['current_page'],$title);
				break;
				case 'link_directory':
				if($page=='viewlinkclientpaginated')
				{
					$data = $this->SelectQuery("SELECT name FROM tbl_module_linkdirectory_categories_data WHERE id = '".$getPostArgs['id']."'","master");
					$title = str_replace('%CATEGORY%',$data[0]['name'],$title);
				}
				break;
				case 'shop':
				if($page=='category')
				{
					$data = $this->SelectQuery("SELECT category_name, description FROM tbl_shop_settings_categories WHERE category_name = '".mysql_real_escape_string(urldecode($_GET['item']))."'","master");
					$title = str_replace('%CATEGORY%',$data[0]['category_name'],$title);
					$title = str_replace('%DESCRIPTION%',trim(strip_tags($data[0]['description'])),$title);
				}
				elseif($page=='product')
				{
					$data = $this->SelectQuery("SELECT id, product_name, product_code, description FROM tbl_shop_products WHERE product_name = '".mysql_real_escape_string(str_replace('|','/',urldecode($_GET['item'])))."'","master");
					$search_tags = $this->SelectQuery("SELECT tag FROM tbl_shop_products_searchtags WHERE product_id = '".$data[0]['id']."'","master");
					for($i=0;$i<count($search_tags);$i++)
					{
						if($i!=count($search_tags)-1) $tag_data .= ', ';
					}

					$title = str_replace('%PRODUCTNAME%',$data[0]['product_name'],$title);
					$title = str_replace('%PRODUCTCODE%',$data[0]['product_code'],$title);
					$title = str_replace('%PRODUCTSEARCH_TAGS%',$tag_data,$title);
					$title = str_replace('%PRODUCTDESCRIPTION%',trim(strip_tags($data[0]['description'])),$title);
				}
				break;
			}
			
			$title = str_replace('_',' ',$title);
			echo $title;
		}		
		function getDescription($page,$module,$getPostArgs='')
		{
			$languageObj = new languageManagement;		
			$current_language = $languageObj->getUserLanguage($_SESSION);
			$page = mysql_real_escape_string($page);
			$module = mysql_real_escape_string($module);
			$getPostArgs['id'] = mysql_real_escape_string($getPostArgs['id']);
						
			$retrieve_meta = $this->SelectQuery("SELECT description FROM tbl_meta WHERE page = '$page' AND module_name = '$module' AND language_id='$current_language'","master");	
			$description = $retrieve_meta[0]['description'];
			$description = str_replace('%POSTCODE%',$this->postcode,$description);
			$description = str_replace('%LOCATION%',$this->location,$description);
			switch ($getPostArgs['module']) {  
				case 'news_directory':
				$id_array = explode('_',strrev($getPostArgs['id']));
				$id = strrev($id_array[0]);
				if($page=='article')
				{	
					$data = $this->SelectQuery("SELECT a.title as title,a.content as content,a.date_added as date_added,b.name as name  FROM tbl_module_news_article_data a, tbl_module_newsdirectory_categories_data b WHERE a.id = '".mysql_real_escape_string($id)."' AND a.categoryid = b.id","master");
					$description = str_replace('%TITLE%',$data[0]['title'],$description);
					$description = str_replace('%CATEGORY%',$data[0]['name'],$description);
					$description = str_replace('%POSTED%',date('d-m-Y',strtotime($data[0]['date_added'])),$description);
					$description = str_replace('%DESCRIPTION%',substr(strip_tags($data[0]['content']),0,100),$description);
				}
				elseif($page=='article_list')
				{
					$data = $this->SelectQuery("SELECT name FROM tbl_module_newsdirectory_categories_data WHERE id = '".mysql_real_escape_string($id)."'","master");
					$title = str_replace('%CATEGORY%',$data[0]['name'],$title);
				}
				break;
				case 'link_directory':
				if($page=='viewlinkclientpaginated')
				{
					$data = $this->SelectQuery("SELECT name FROM tbl_module_linkdirectory_categories_data WHERE id = '".$getPostArgs['id']."'","master");
					$description = str_replace('%CATEGORY%',$data[0]['name'],$description);
				}
				break;
				case 'shop':
				if($page=='category')
				{
					$data = $this->SelectQuery("SELECT category_name, description FROM tbl_shop_settings_categories WHERE category_name = '".mysql_real_escape_string(urldecode($_GET['item']))."'","master");
					$description = str_replace('%CATEGORY%',$data[0]['category_name'],$description);
					$description = str_replace('%DESCRIPTION%',trim(strip_tags($data[0]['description'])),$description);
				}
				elseif($page=='product')
				{
					$data = $this->SelectQuery("SELECT id, product_name, product_code, description FROM tbl_shop_products WHERE product_name = '".mysql_real_escape_string(str_replace('|','/',urldecode($_GET['item'])))."'","master");
					$search_tags = $this->SelectQuery("SELECT tag FROM tbl_shop_products_searchtags WHERE product_id = '".$data[0]['id']."'","master");
					for($i=0;$i<count($search_tags);$i++)
					{
						if($i!=count($search_tags)-1) $tag_data .= ', ';
					}

					$description = str_replace('%PRODUCTNAME%',$data[0]['product_name'],$description);
					$description = str_replace('%PRODUCTCODE%',$data[0]['product_code'],$description);
					$description = str_replace('%PRODUCTSEARCH_TAGS%',$tag_data,$description);
					$description = str_replace('%PRODUCTDESCRIPTION%',trim(strip_tags($data[0]['description'])),$description);
				}
				break;				
			}
			$description = str_replace('_',' ',$description);
			echo $description;
		}
}
?>