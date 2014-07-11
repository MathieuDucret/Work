<?php
/****************************************
* Author - esyed
* Company - Internet Concepts Limited
* Revision - 1.0
* being used by /admin/templates/edit_email_message.php
* 24/11/09 
*****************************************/
//class used in admin panel
class enquiries extends DataBase
{	
function viewEnquiries()
	{ 	
	//create the where clause and pass this along with table name
		$where = "";
		$table = "tbl_contact";
		$linkObj = new LinkDirectory;
		$layoutObj = new Layout;
		$rsObj = new ResultSetPagination($_GET['limit'], $_GET['cat'], $_GET['paged'], $where, $table, "admin", $_GET['page']);

		$total_pages = $rsObj->total_pages;
		$paged = $rsObj->paged;

		$q = $rsObj->getLimitSet($rsObj->limit_array);

		include(COMMON_ROOT.'/admin/templates/enquiries/viewEnquiries.php');
	}
	
	function viewEnquiry($getPostArgs)
	{ 	
		//create the where clause and pass this along with table name
		$data = $this->SelectQuery("SELECT * FROM tbl_contact WHERE id = '".mysql_real_escape_string($getPostArgs['id'])."'","master");
		include(COMMON_ROOT.'admin/actions/modules/enquiry/viewEnquiry.php');
	}	
	
	function deleteEnquiry($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);		
		$query = $this->SelectQuery("DELETE from tbl_contact WHERE id ='" .$getPostArgs['id']. "'", "master");
			//direct to correct output page depending on success of query
			if (is_array($query))
			{
				$errmsg = "Selected enquiry has been successfully deleted";
				require_once(COMMON_ROOT."/admin/templates/successError/success.php");
			}
			else 
			{
				$errmsg = "Selected enquiry has not been successfully deleted";
				require_once(COMMON_ROOT."/admin/templates/successError/error.php");
			}
	}
	

}
?>


