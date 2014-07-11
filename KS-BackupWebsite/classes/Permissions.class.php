<?php
class permissions extends DataBase
{
 	 function __construct($usersCombinedSecurity){
	 	parent::__construct();
		$this->permissions = $this->SelectQuery("SELECT levelname, active from tbl_admin_group_levels_data", "master");
		echo " <b> permissions called permission code passed= ". $usersCombinedSecurity. "</b>";

		for ($i=0; $i<count($this->permissions); $i++)
		{
			if ($i<(count($this->permissions)-1))
			{
			$this->permissionItemList[$i] = $this->permissions[$i]['levelname'];
			$this->permissions[$i] = $this->permissions[$i]['levelname']."\"=>" ."false";
			}
		else
			{
			$this->permissionItemList[$i] = $this->permissions[$i]['levelname'];			
			$this->permissions[$i] = $this->permissions[$i]['levelname']."\""."=>"."false";				
			}
		}
	
		$this->permarr=$this->getPermissions($usersCombinedSecurity);
			echo "<pre>";
				var_dump($this->permissionItemList);
			echo "</pre>";

			echo "<pre>";
				var_dump($this->permarr);
			echo "</pre>";

			
			
			for ($i=0; $i<count($this->permarr); $i++){
				if($this->permarr[$i])
				{
					echo $this->permissionItemList[$i] . " Permissions GRANTED <br>";
				}
				else
				{
					echo $this->permissionItemList[$i] . " permissions NOT GRANTED <br>";
				}
			}
			$this->checkAccessToPage();

   }
   //$permissionItemList contains only the names of the permission levels i.e edit, delete etc
   var $permissionItemList = array();
   //holds the levels as keys with teh bolean "false" value
   var $permissions = array();
   //will be set to have results of permission check
   var $permarr;
   var $pagetoview;

    function getPermissions($bitMask=0)
	{
       
      $i=0;
        foreach($this->permissions as $key=>$value){
			$this->permissions[$key]= (($bitMask & pow(2,$i)) !=0) ? true: false;
      		$i++;                 
        }
        return $this->permissions;
    }
	
	
	
	function checkAccessToPage()
	{
	//permissiontest
	//echo $_GET['page'];
	$pageSecurityLevel = $this->SelectQuery("SELECT security_level FROM tbl_page_permission_level WHERE page_name = '" . $_GET['page'] . "'", "master");
	echo $pageSecurityLevel[0]['security_level'];
	echo "Users security level = " .$_SESSION['admin']['usersecuritylevel'];
	exit(0);
	
	}
	
	
	
 }



?>