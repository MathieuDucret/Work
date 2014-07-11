<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/

class General extends DataBase // This class extended with DataBase Class
{ 
	var $tbls = array();
	// Constructor For this Class
	function __construct(){
		parent::__construct();
	}
	
	/* This is the Function to Get All Details From DB		 
	* variables to be Passed
	* $tbl => Table Name */
	function check_email_address($email) 
	{
  // First, we check that there's one @ symbol, 
  // and that the lengths are right.
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
    // Email invalid because wrong number of characters 
    // in one section or wrong number of @ symbols.
    return false;
  }
  // Split it into sections to make life easier
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
    if
(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&
?'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",
$local_array[$i])) {
      return false;
    }
  }
  // Check if domain is IP. If not, 
  // it should be valid domain name
  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
        return false; // Not enough parts to domain
    }
    for ($i = 0; $i < sizeof($domain_array); $i++) {
      if
(!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|
?([A-Za-z0-9]+))$",
$domain_array[$i])) {
        return false;
      }
    }
  }
  return true;
}

	
	
	function GetAll($tbl, $ctype)
	{
		$qry = "SELECT * FROM ".$tbl;
	    //echo $qry;
		$Result = $this->SelectQuery($qry, $ctype);
		return $Result;
	}
	
	/* This is the method for getting the information based on the order by. 
	*/
	function getmicrotime()
	{
		list($usec, $sec) = explode(" ",microtime());
		return ((float)$usec + (float)$sec);
	}
	
	function getAllOrderBy($table, $sort_by, $sort_dir, $ctype)
	{
		if(empty($sort_dir)) $sort_dir = "DESC";
		return $this->SelectQuery("SELECT * FROM ".$table." ORDER BY " .$sort_by." $sort_dir", $ctype);
	}
	
	/* This is the function to Get All Details For a selected table with Multiple Where Conditions
	* The Seperator For the Where condition was AND 
	* variables to be Passed
	* $tbl => Table Name
	* $where => Array for Where Condition */
	function GetAllWhereAnd($tbl, $where, $ctype)
	{	
		foreach($where as $fieldName => $value)
		{
			if($condition == '')
				$condition = $fieldName."="."'".$value."'";
			else
				$condition .= " AND ".$fieldName."="."'".$value."'";
		}
	 	$qry = "SELECT * FROM ".$tbl." WHERE ".$condition;
		$Result = $this->SelectQuery($qry, $ctype);
		return $Result;
	}
	/* This is the method for getting the information based on the number of records. So, this function is used for 
	*  paging functionality.
	*/
	function getAllWherePager($table, $idx, $limit, $sort_by, $sort_dir, $where, $ctype)
	{
		if(empty($sort_dir)) $sort_dir = "DESC";
		if(empty($limit)) $limit = 20;
		return $this->SelectQuery("SELECT * FROM ".$table." WHERE ".$where." ORDER BY " .$sort_by." $sort_dir LIMIT ".$idx.",".$limit, $ctype);
	}
	
	/* This is the method for getting the information based on the order by. 
	*/
	function getAllWhereOrderBy($table, $sort_by, $sort_dir, $where, $ctype)
	{
		if(empty($sort_dir)) $sort_dir = "DESC";
			return $this->SelectQuery("SELECT * FROM ".$table." WHERE ".$where." ORDER BY " .$sort_by." $sort_dir", $ctype);				
	}
	
	/* This is the function to Get All Details For a selected table with Multiple Where Conditions
	* The Seperator For the Where condition was OR		* variables to be Passed
* $tbl => Table Name
	* $where => Array for Where Condition */
	function GetAllWhereOr($tbl, $where)
	{	
		foreach($where as $fieldName => $value)
		{
			if($condition == '')
			$condition = $fieldName."="."'".$value."'";
			else
			$condition .= " or ".$fieldName."="."'".$value."'";
		}
		
		$qry = "SELECT * FROM ".$tbl." WHERE ".$condition;
		// echo $qry;
		$Result = $this->SelectQuery($qry, $ctype);
		return $Result;
	}
	/* This is the function to Get All Details For a selected table with Where Conditions
	* User Defined Where Condition		* variables to be Passed
	* $tbl => Table Name
	* $where => Where Condition */
	function GetAllWhere($tbl, $where, $ctype)
	{
   		//"SELECT * FROM ".$tbl." where ".$where;
		//echo "<br>";	
		$qry = "SELECT * FROM ".$tbl." where ".$where;	
		$Result = $this->SelectQuery($qry, $ctype);		
		return $Result;
	}
	
	function GetAllOnJoin($tbl1,$tbl2,$join,$on, $where, $ctype)
	{
		$qry = "SELECT * FROM ".$tbl1." t1 ".$join." ".$tbl2." t2 ON ".$on." WHERE ".$where;
		$Result = $this->SelectQuery($qry, $ctype);
		return $Result;
	}
	
	function GetAllWhereJoin($tbl1,$tbl2,$on, $where, $ctype)
	{
		$qry = "SELECT t1.* FROM ".$tbl1." t1 INNER JOIN ".$tbl2." t2 ".$on.$where;
		$Result = $this->SelectQuery($qry, $ctype);
		return $Result;
	}
	/* This is the Function to Get Selected Fields  From The Selected Query		* variables to be Passed
    * $tbl_name => Table Name
	* $selFields => Array of the Selected Fields
	* $where => Where Condition */
	function GetSelWhere($tbl_name,$selFields,$where, $ctype)
	{
		$fields = @implode(',',$selFields);
		$qry = "SELECT ".$fields." FROM ".$tbl_name." WHERE ".$where;
		$res_arr = $this->SelectQuery($qry, $ctype);
		return $res_arr;	//returns the result array
	}
	/* This is the Function to Insert data into table
	* SAMPLE  EXAMPLE FOR INSERTION
	* $tbl is nothing but table name
	* $insAry = array("agent_fname"	=>	$_POST['firstname'],
					  "agent_lname"	=>	$_POST['lastName'],
					  "agent_email"	=>	$_POST['email'],
					  "agent_pword" =>	$_POST['password'],
					  "agency_name" =>  $_POST['agncyname']); */
					  
 function InsertQry($tbl, $insAry, $ctype)
 {
	foreach($insAry as $key => $value)
	{
		$insertFields[] = $key;
		
		if(($value == 'now()') || ($value == 'NOW()'))
			$insertValues[] = $value;
		else
			$insertValues[] = "'".$value."'";
	}
	$Qry = "INSERT INTO ".$tbl." (".implode(", ", $insertFields).") VALUES (".implode(", ",$insertValues).")";
	$Result = $this->InsertQuery($Qry, $ctype);
	return $Result;
 }
/* This is the Function to Delete Records From the Table variables to be Passed
* $tbl => Table Name
	* $id => Id of the Delete Record */
	function DeleteQry($tbl, $where, $ctype)
	{
		$Qry = "DELETE FROM ".$tbl." WHERE ".$where;
		$Result = $this->ExecQuery($Qry, $ctype);
		return $Result;
	}
	/* This is the Function for UPDATE query		* variables to be Passed
* $tbl_name => Table Name
	* $fields => Array with the Field Names and Values 
	* $where_condition => Where Condition */
	function UpdateQry($tbl_name,$fields,$where_condition, $ctype)
	{
		//get the column names and their values 
		$no_of_fields = count($fields);	//no. of fields
		foreach($fields as $key=>$col_val)
		{
			$cols[]  = $key;	//get the column names	
			if(($col_val == 'now()') || ($col_val == 'NOW()'))
				$values[] = $col_val;//get the values  
			else if($col_val == 'NULL')
				$values[] = $col_val;//get the values
			else
				$values[] = "'".$col_val."'";//get the values  
		}
		//get the fields n their values in 1 string
		$str = "";
		for($i=0; $i<$no_of_fields; $i++)
		{
			//for the 1st field,append without ','
			if($str == '')
				$str = $cols[$i]." = ".$values[$i];
			else 
				$str .= ",". $cols[$i]." = ".$values[$i];
		}
		
		//Update query
		$Qry = "UPDATE ".$tbl_name." SET ".$str." WHERE ".$where_condition;		
        $Result = $this->ExecQuery($Qry, $ctype);
		return $Result;
	} 
	//function to get information based on given a field value
	function GetInfoBy($tbl_name,$field,$value, $ctype)
	{
		//echo "SELECT * FROM ".$tbl_name." WHERE ".$field."='".$value."'";
		$inf = $this->SelectQuery("SELECT * FROM ".$tbl_name." WHERE ".$field."='".$value."'", $ctype);
		return $inf[0];
	}
	//function to get a single field value based on condition
	function GetFieldBy($tbl_name,$field,$where, $ctype)
	{
		//echo 'get field by';
		//echo "SELECT ".$field." FROM ".$tbl_name." WHERE ".$where;
		$arrRes = $this->SelectQuery("SELECT ".$field." FROM ".$tbl_name." WHERE ".$where, $ctype);
		return $arrRes[0][$field];
	}
	// function to get all categories from categories table
	function getCategories()
	{
		return $this->SelectQuery("SELECT * FROM ".$this->tbls['category']['name']." WHERE catStatus=1 ORDER BY catName", $this->tbls['category']['type']);
	}
	//function to get the Number of Rows
	function getCount($qry)
	{
		
	}
	
	// Function to get no of records on condition in particular table
	function GetAllWhereCount($tbl_name,$where,$ctype)
	{
		//echo "<br>SELECT count(*) as total FROM ".$tbl_name." WHERE ".$where;
		$res = $this->SelectQuery("SELECT count(*) as total FROM ".$tbl_name." WHERE ".$where,$ctype);
		if($res[0]['total']>0)
		return $res[0]['total'];
		else
		return 0;
	}	
	
	//Method to Display the Scroller
	function DisplayScroller($dispContent,$direction,$scrolldelay)
	{
		echo "<marquee id=\"marid\" direction=\"".$direction."\"  scrolldelay=\"".$scrolldelay."\" behavior=\"scroll\"  onMouseOut=\"javascript: this.start();\"  onMouseOver=\"javascript: this.stop();\" onMouseMove=\"javascript: this.stop();\" onMouseUp=\"javascript: this.stop();\" style=\"175px;\">";
		echo $dispContent;
		echo "</marquee>";
	}
	
	//function to get support mail types
	function getMailSupportTypes($site_id,$site_type)
	{
		$where = "site_id = '".$site_id."' AND site_type = '".$site_type."'";
		return $this->GetAllWhere($this->tbls['support_mail']['name'],$where,$this->tbls['support_mail']['type']);
	}
	
	// to set styles for booth settings
	function setBoothStyles()
	{
		$booth = $this->SelectQuery("SELECT * FROM ".$this->tbls['booth_settings']['name'], $this->tbls['booth_settings']['type']);
		$booth = $booth[0];
		$style = '<style type="text/css">';
		$style .= '.ph_btborder{ background-color: #4294c0;}';
		
		//start for head
		$style .= '.ph_btwitebg{ background-color: #ffffff; height:50px; font-family:'.$booth['head_text_font'].';font-size:'.$booth['head_text_font_size'].';color:'.$booth['head_text_font_color'].'; text-align:'.$booth['head_text_align'].';';
		if($booth['head_text_style'] != 'bold')
			$style .= 'font-style:'.$booth['head_text_style'].';';
		else
			$style .= 'font-weight:'.$booth['head_text_style'].';';
		$style .= '}';
		//end for head
		//start for description
		$style .= '.ph_bttextbg{ background-color: #e8f3fa; font-family:'.$booth['desc_text_font'].';font-size:'.$booth['desc_text_font_size'].';color:'.$booth['desc_text_font_color'].'; text-align:'.$booth['desc_text_align'].';';
		if($booth['desc_text_style'] != 'bold')
			$style .= 'font-style:'.$booth['desc_text_style'].';';
		else
			$style .= 'font-weight:'.$booth['desc_text_style'].';';
		$style .= '}';
		//end for description
		
		//start for link
		$style .= '.ph_btlinkbg{ background-color: #e8f3fa; font-family:'.$booth['link_text_font'].';font-size:'.$booth['link_text_font_size'].';color:'.$booth['link_text_font_color'].'; text-align:'.$booth['link_text_align'].';';
		if($booth['link_text_style'] != 'bold')
			$style .= 'font-style:'.$booth['link_text_style'].';';
		else
			$style .= 'font-weight:'.$booth['link_text_style'].';';
		$style .= '}';
		//end for link
		$style .= '</style>';
		echo $style;
		return $booth['head_type'];
	}
	
	//function to get the random password
	function RandomPwd($length)
	{
		$salt = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$makepass = '';
		mt_srand(10000000*(double)microtime());
		for ($i = 0; $i < $length; $i++)
			$makepass .= $salt[mt_rand(0,61)];
		return $makepass;
	}
	
	function UserList($user='')
	{
		if($user!='')
			$user_where = " AND U.user_id!=".$user;
		return $users = $this->SelectQuery("SELECT sex,user_id,username,(SELECT new_name FROM ".$this->tbls['user_photos']['name']." P WHERE P.user_id=U.user_id AND approve_by_admin=1 ORDER BY photo_order asc limit 1) as new_name FROM ".$this->tbls['users']['name']." U WHERE U.status=1".$user_where,$this->tbls['users']['type']);
	}

	//check ip restriction
	function CheckIp($ipadr)
	{
		$site_type = $_SESSION['site']['type'];
	if($site_type == "sub_site")
	{
		$sub_domain_id = $_SESSION['site']['id'];
		$sub_site_id = $_SESSION['site']['sub_site_id'];
	}
	else
		$sub_site_id = $_SESSION['site']['id'];
		
		$res = $this->GetAllWhere($this->tbls['users']['name']," user_ip = '".$ipadr."' AND siteid = '".$sub_site_id."'",$this->tbls['users']['type']);
		if($res)
			return true;
		else
			return false;
	}
	//Ends
	// Destructor For this Class
	function __destruct(){}
}
// End Class
?>
