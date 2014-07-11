<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/

	class DataBase {
		
		var $conn, $conn_master;
		var $hostName, $dbUserName, $dbPassword, $dbName, $dbPrefix;
		var $hostName_master, $dbUserName_master, $dbPassword_master, $dbName_master;
		
		// Constructor For Db Connection
		function __construct()
		{
			//Assigning DB Details
			$this->hostName   = HOST_NAME; // Host Name
			$this->dbUserName = USER_NAME;// Db User Name
			$this->dbPassword = PASSWORD; // Db Password
			$this->dbName     = DBNAME;// Db Name
			
			$this->hostName_master   = MASTER_HOST_NAME; // Master Host Name
			$this->dbUserName_master = MASTER_USER_NAME;// Master Db User Name
			$this->dbPassword_master = MASTER_PASSWORD;// Master Db Password
			$this->dbName_master     = MASTER_DBNAME;// Master Db Name

				$this->Connect(); // Function Call to Connect Db
		}
		
		function mysql_real_escape_array($t)
		{
   	 		return array_map("mysql_real_escape_string",$t);
		} 
		
		function __destruct() 
        {
           $this->Close($this->conn);
		   $this->Close($this->conn_master);
        }
        
        function __sleep()
        {
          	$this->Close($this->conn);
		   	$this->Close($this->conn_master);
        }
        function __wakeup()
        {
                      $this->Connect();
        }				

		// This is the Function For DB Connection
		function Connect()
		{
			$this->conn=mysql_connect($this->hostName,$this->dbUserName,$this->dbPassword);// Connecting to DB
//			$this->SelectDB($this->dbName, $this->conn);// Function Call to Select DB
			$this->conn_master=mysql_connect($this->hostName_master,$this->dbUserName_master,$this->dbPassword_master);
//			$this->SelectDB($this->dbName_master, $this->conn_master);// Function Call to Select DB
		}
		function getConnectionObject($ctype)
		{
			if($ctype != 'master'){
				//if(!$this->conn)
					$this->Connect();
				$this->SelectDB($this->dbName, $this->conn);
				return $this->conn;
			}else{
				//if(!$this->conn_master)
					$this->Connect();
				$this->SelectDB($this->dbName_master, $this->conn_master);
				return $this->conn_master;
			}
		}
		
		//DeleteCheck function performs the delete i.e. supplied via argument
		// and returns the number of rows afftected by this delete query
		function DeleteCheck($DelQuery)
			{
			$query = $this->SelectQuery($DelQuery, "master");
			return mysql_affected_rows();
			}
		
		
		
		// This is the Function For Selecting DB
		function SelectDB($dbname, $conObj)
		{
				if(!mysql_select_db($dbname, $conObj)) 
				{ return 0; } // return 0, if Unsuccessfull Connection
		}
		
		// This is the Function For Disconnecting DB Connection
		function Close($c)
		{
			return @mysql_close($c);
		}
		
		/* This is the Function For Select Query
		* values to be pass
		* $SelQuery => Select Query */
		function SelectQuery($SelQuery, $ctype)
		{	
			mysql_query("SET NAMES utf8",$this->getConnectionObject($ctype));
			$selectRes = array();			
			if(!($SqlQuery=mysql_query($SelQuery, $this->getConnectionObject($ctype))))
			{
				$myerror = mysql_error();
				echo "sql error [$myerror]\n<br />$SelQuery";
				return 0;
			}
			else
			{
				$cnt = @mysql_num_rows($SqlQuery);
				while($Res_row=@mysql_fetch_assoc($SqlQuery))
				{
					@array_push($selectRes, $Res_row);// Result Array
				}
			}
			
			@mysql_free_result($SqlQuery);				
		   	return($selectRes);// Returnind result array
		}
		
		/* This is the Function For Executing Query
		* Return Query was executed successfully or not 
	/* We have to Pass Query*/
		function ExecQuery($Qry, $ctype)
		{
			mysql_query("SET NAMES utf8",$this->getConnectionObject($ctype));
			if($ExecRes = mysql_query($Qry, $this->getConnectionObject($ctype)))
			{
				$ret = true;
			}
			else
			{
				$ret = false;
			}						
			return $ret;
		}
		
		// This is the Function to Return Resourceid of the Executed Query
		function Fetch_Result($Qry, $ctype)
		{
			$ExecRes = mysql_query($Qry, $this->getConnectionObject($ctype));
			return $ExecRes;
		}
		
		//function to retrieve the no. of rows
		function NumRows($Qry, $ctype)
		{
			if($NumRes = mysql_query($Qry, $this->getConnectionObject($ctype)))
			{$ret = @mysql_num_rows($NumRes);}
			else
			{$ret = @mysql_num_rows($NumRes);}
			return $ret;
		}
		
		//Function for Inserting Records
		function InsertQuery($InsQry, $ctype)
		{		
			mysql_query("SET NAMES utf8",$this->getConnectionObject($ctype));
			if($InsRes = mysql_query($InsQry, $this->getConnectionObject($ctype)))
			{	
				 $ret = mysql_insert_id();// Returning Insert id
			}
			else
			{
				$myerror = mysql_error();				
				echo "sql error [".$InsQry."]\n";
				return false;
			}			
			return $ret;
		}
		
		 function InsertArray($tbl, $insAry, $ctype)
		 {
			 mysql_query("SET NAMES utf8",$this->getConnectionObject($ctype));
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
		

		
	}
?>