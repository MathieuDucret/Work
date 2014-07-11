<?php 
class viewResultSet extends DataBase
{
	function __construct(){
		parent::__construct();
		}
		var $resultDisplay;
		var $resultSet;
		var $errmsg;
		// generic function used by most o fthe view pages to display data with the control of edit/delete functionality
	function createResultDisplay($headingArray, $rs)
	{	
		//get the ID of the page (View Page) requested 
	$viewPageID = $this->SelectQuery("SELECT id from tbl_admin_pages where function_name = '".$_GET['page']."'", "master");
	if ($_SESSION['admin']['adminGroup']!="22"){
	$editDelete = $this->SelectQuery("SELECT a.function_name, a.page_name from tbl_admin_pages a, tbl_admin_group_allowed_pages p  where a.assigned_viewpage_id = '".$viewPageID[0]['id']."' AND p.pageid = a.id AND p.groupid = '" .$_SESSION['admin']['adminGroup']. "' ORDER BY view_order ASC", "master");
	}
	else
	{
	$editDelete = $this->SelectQuery("SELECT function_name, page_name from tbl_admin_pages where assigned_viewpage_id = '".$viewPageID[0]['id']."' ORDER BY view_order ASC", "master");
	}

	$this->resultDisplay .= "<table width=\"100%\"><tr class=\"searchtitle\">";
	
	foreach ($headingArray as $key=>$value) 
		{
			if ($value!="Actions")
			{
			
				if(substr($key,0,5)=='limit')
				{
					$this->resultDisplay .= "<td>".substr($value,0,80)."</td>";
				}
				else
				{
					$this->resultDisplay .= "<td>".$value."</td>";
				}
			}
			else
			{
				$this->resultDisplay .= "<td colspan='".count($editDelete)."'>".$value."</td>";
			}
		}
		$this->resultDisplay .= "</tr>";
	$this->resultSet = $rs;


	//check if the users Group is allowed to have edit or delete facilities on the current page
	//activate all Edit/delete/view functionalities for the super admin group user
	for($j=0;$j<count($this->resultSet);$j++)
	{	
		if($i%2){$style=' class="searchResult1"';} else {$style= ' class="searchResult2"'; }	
    		$this->resultDisplay .= "<tr ". $style .">";
			foreach ($headingArray as $key => $value) 
			{	
				if ($this->resultSet[$j][$key]!="")
				{
					//check if the column in the dataset is date time, if yes display this as date time
					if (!preg_match('/date/i', $key))
					{
    					$this->resultDisplay .=	"<td>". $this->resultSet[$j][$key]."</td>";
					}
					else 
					{
					//date('d-m-Y H:i:s',strtotime($this->resultSet[$j]['date_time']))
						$this->resultDisplay .=	"<td>". date('d-m-Y H:i:s',strtotime($this->resultSet[$j][$key])) ."</td>";

					}
				}
				else
				{
					$this->resultDisplay .= '<td>&nbsp;</td>';
				}
    	}
		for ($k=0; $k<count($editDelete); $k++)
		{ 
			$this->resultDisplay .=	"<td><a href =/admin/actions/modules/".$_GET['module']."/".$editDelete[$k]['function_name']."/". $this->resultSet[$j]['id']."/>".$editDelete[$k]['page_name']."</a></td>";
		}
		$this->resultDisplay .= "</tr>";
     } 
	$this->resultDisplay .= "</table>";
	return $this->resultDisplay;
	}	
}
?>
