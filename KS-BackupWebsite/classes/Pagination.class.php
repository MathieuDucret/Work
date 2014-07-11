<?php
/****************************************
* Author - esyed
* Revision - 2.0 
* 17/11/09
*****************************************/

class ResultSetPagination extends DataBase
{
//$cat and $pagename are optional as they get chcked and used in getPreviousNextmenu()
//page view news article uses $cat to pass news cat ID 
	function __construct($limit, $cat, $paged, $where, $table, $module, $pagename, $order='',$what='*'){
	
		parent::__construct();
		$this->limit = mysql_real_escape_string($limit); 
		$this->cat = mysql_real_escape_string($cat);
		$this->paged = mysql_real_escape_string($paged);
		$this->select_what = mysql_real_escape_string($what);
		if ($module == "admin"){
		$this->module = "admin/". mysql_real_escape_string($_GET['module']);
		}
		else
		{
		$this->module = mysql_real_escape_string($module);
		}
		$this->pagename = mysql_real_escape_string($pagename);
		$this->where_clause = $where;
		$this->orderby_clause = mysql_real_escape_string($order);
				
		//now get the count of records for teh particular category
		$this->total_items = $this->getResultSetCount($table, $where);
		
		//check and set the limit as selected by the user
		$this->limit = $this->checkLimit($this->limit);
		
		//check and set the value for the page as entered or selected by the user
		$this->paged = $this->checkPaged($this->paged, $this->total_items);
		
		//compute and set the rquired variables
		$this->limit_array = $this->setVariables($this->total_items, $this->limit, $this->paged, $table);
		
		if (isset($this->pagename)){$this->pagenamelink = $this->pagename."/";}
		if (isset($this->cat) && ($this->cat != '') ){$this->catlink = $this->cat."/";}	  
		
		}
var $pagename;
var $module;		
var $errmsg;
var $limit;
var $cat;
var $paged;
var $total_items; 
var $set_limit;  
//var $total_pages;
var $where_clause; 
var $where;
var $table;
var $limit_array = array();
var $q;
var $menu;
var $pagenamelink;
var $catlink;
var $countCurrentPage;




//sequence to call functions
//1. checkAndSetVars
//2. getResultSetCount
//3. setVariables
//4. getLimitSet
 
function getResultSetCount($table_name, $where)
	{
		//Get all records
		//first call the createwhere() with teh correct params and then use that to return the number of rows from getResultSetCount()
		
	
		$getdata =  $this->SelectQuery("SELECT ".$this->select_what." from " . $table_name ." ". $where, "master");
		//count total no of records to be displayed
		$total_items = count($getdata);
		return $total_items; 
	}

function checkLimit($limit)
	{ 
//check the input and set variables
	if(($limit=='')  || (is_numeric($limit) == false) || ($limit < 10) || ($limit > 100)) 
		{
     		$limit = 30; // set default			
		}	
		
		return $limit; 
	}

function checkPaged($paged, $total_items)
	{
//check the input and set variables
		if(($paged == '') || (is_numeric($paged) == false) || ($paged < 0) || ($paged > $total_items)) 
			{
				$paged = 1; //set default
				
			}	
			
			return $paged; 
	}


function createWhere($getPostArgs,$exclude='')
{
	$where = '1=1';
	$i=1; 
	foreach($getPostArgs as $key=>$val)
	{
		if($key=='submit') continue;
		if($key=='max_occupancy') continue;
		//if(array_key_exists($key,$exclude)) continue;
		if($val!='')
		{
		$where .= ' AND '.$key.' = "'.$val.'"';	
		}
		$i++;
	}
	return $where;
}


function setVariables($total_items, $limit, $paged, $table)
	{
	
		//total pages that contain the query results
		$this->total_pages 	= ceil($total_items / $limit); 
		//work out the set of results to be displayed on the page
		$set_limit 	= $paged * $limit - ($limit);
		//build array to pass variables to the function
		$limitArr = array(0=>$set_limit, 1=>$limit, 2=>$table);
		return $limitArr;

	}	
	
	
function  getLimitSet($getPostArgs)
	{	
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);				
		$q = $this->SelectQuery("SELECT ".$this->select_what." FROM " . $getPostArgs[2]." ".$this->where_clause . " ".$this->orderby_clause." LIMIT ". $getPostArgs[0] . "," .$getPostArgs[1], "master");	
		//echo "SELECT ".$this->select_what." FROM " . $getPostArgs[2]." ".$this->where_clause . " ".$this->orderby_clause." LIMIT ". $getPostArgs[0] . "," .$getPostArgs[1];
		//echo "SELECT ".$this->select_what." FROM " . $getPostArgs[2]." ".$this->where_clause . " ".$this->orderby_clause." LIMIT ". $getPostArgs[0] . "," .$getPostArgs[1];
		$this->countCurrentPage = count($q);
   		return $q;	
	}
	
function getPreviousNextMenu()
{ 
	if($this->total_pages==1)
	{
		return true;
	}
	/*if (isset($this->pagename)){$this->pagenamelink = $this->pagename."/";}
	if (isset($this->cat) && ($this->cat != '') ){$this->catlink = $this->cat."/";}	  */
	   
	//if value of current page is > 1 than we have a previous page- 
	//display this link with correct params to pass
	$prev_page = $this->paged-1;
		if($prev_page >= 1) { 
			$this->menu .= "<a href='/". $this->module."/".$this->pagenamelink .$this->catlink . $this->limit."/".$prev_page."/'><b><< Prev</b></a> - ";
			} 
//print out the correct number of pages that the whole result set is spread on
//make these as links to the pages with correct params

	for($a = 1; $a <= $this->total_pages; $a++)
		{ 
   		if($a == $this->paged) 
		{      		
			$this->menu .= "<b>" .$a."</b> - ";
	 	}
		
	 	else if ($a < ($this->paged+3) && $a > ($this->paged-3)) 
	 		{ 
	 			if (isset($this->cat)){$catlink = $this->cat."/";}
  				$this->menu .= "<a href='/" .$this->module . "/".$this->pagenamelink .$this->catlink . $this->limit."/".$a."/'>".$a."</a> - ";
				
     		} 
		} 
//see if the current page is the last page is the last page
//if not than display a next page link
	$next_page = $this->paged+1;
		if($next_page <= $this->total_pages) 
			{
			$this->menu .= "<a href='/" . $this->module . "/". $this->pagenamelink .$this->catlink . $this->limit."/".$next_page."/'><b>Next >></b></a>";
			
			} 

echo $this->menu;
$this->menu = "";

}	

function getPreviousNextMenuAjax()
{ 
	if($this->total_pages==1)
	{
		return true;
	}
	/*if (isset($this->pagename)){$this->pagenamelink = $this->pagename."/";}
	if (isset($this->cat) && ($this->cat != '') ){$this->catlink = $this->cat."/";}	  */
	   
	//if value of current page is > 1 than we have a previous page- 
	//display this link with correct params to pass
	$prev_page = $this->paged-1;
	if($prev_page >= 1) 
	{ 
		$this->menu .= "<a href='javascript:setPagination(".$this->limit.",".$prev_page.");'><b><< Prev</b></a> - ";
	} 
//print out the correct number of pages that the whole result set is spread on
//make these as links to the pages with correct params

	for($a = 1; $a <= $this->total_pages; $a++)
	{ 
   		if($a == $this->paged) 
		{      		
			$this->menu .= "<b>" .$a."</b> - ";
	 	}
		
	 	else if ($a < ($this->paged+3) && $a > ($this->paged-3)) 
		{ 
			if(isset($this->cat))
			{
				$catlink = $this->cat."/";
			}
  			$this->menu .= "<a href='javascript:setPagination(".$this->limit.",".$a.");'>".$a."</a> - ";			
    	} 
	} 
//see if the current page is the last page is the last page
//if not than display a next page link
	$next_page = $this->paged+1;
	if($next_page <= $this->total_pages) 
	{
		$this->menu .= "<a href='javascript:setPagination(".$this->limit.",".$next_page.");'><b>Next >></b></a>";
	} 
	echo $this->menu;
	$this->menu = "";
}

function getNumberLinks()
{
	$link = '<a href="/'.$this->module.'/'.$this->pagenamelink.$this->catlink;
	if ($this->total_items > 10 && $this->total_items < 25) 
	{
		echo "Results per page<br />";
		echo $link.'10/1/">10</a> | ';
		echo $link.'25/1/">25</a>';
	}
	else if ($this->total_items > 25)
	{
		echo "Results per page<br />";
		echo $link.'10/1/">10</a> | ';
		echo $link.'25/1/">25</a> | ';
		echo $link.'50/1/">50</a>';
	}
	echo '<br /><br />';
}

function getNumberLinksAjax()
{
	if($this->total_items > 10 && $this->total_items < 25) 
	{
		echo "Results per page<br />";
		echo "<a href='javascript:setLimit(10)'>10</a> | ";
		echo "<a href='javascript:setLimit(25)'>25</a>";
	}
	else if ($this->total_items > 25)
	{
		echo "Results per page<br />";
		echo "<a href='javascript:setLimit(10)'>10</a> | ";
		echo "<a href='javascript:setLimit(25)'>25</a> | ";
		echo "<a href='javascript:setLimit(50)'>50</a>";
	}
	echo '<br /><br />';
}

function displayActions($i)
	{		
		$viewPageID = $this->SelectQuery("SELECT id from tbl_admin_pages where function_name = '".$_GET['page']."'", "master");
		if ($_SESSION['admin']['adminGroup']!="22")
		{
			$editDelete = $this->SelectQuery("SELECT a.function_name, a.page_name from tbl_admin_pages a, tbl_admin_group_allowed_pages p  where a.assigned_viewpage_id = '".$viewPageID[0]['id']."' AND p.pageid = a.id AND p.groupid = '" .$_SESSION['admin']['adminGroup']. "' ORDER BY view_order ASC", "master");
		}
		else
		{
			$editDelete = $this->SelectQuery("SELECT function_name, page_name from tbl_admin_pages where assigned_viewpage_id = '".$viewPageID[0]['id']."' ORDER BY view_order ASC", "master");
		}
		for ($k=0; $k<count($editDelete); $k++)
		{ 
			 $actions .=	"<a href ='/admin/actions/modules/".$_GET['module']."/".$editDelete[$k]['function_name']."/".$i."/'>".$editDelete[$k]['page_name']."</a> ";
		}
		return $actions;
	}
}
