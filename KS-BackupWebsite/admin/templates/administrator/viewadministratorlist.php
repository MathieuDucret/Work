<?php
/****************************************
* Author - esyed
* Company - Internet Concepts Limited
* 16/11/2009 - pagination added
*  
*****************************************/
?>
<h1>View Administrator List</h1>
<?php
//create list of headers to display
//Keys in the array are the list of column names in the resultset "$mainMenuItemList"  
$headingArray = array("id"=>"ID", "username"=>"Group Name", "email"=>"Email", "actions"=>"Actions" );
$viewresultSetObj = new viewResultSet;
echo $viewresultSetObj->createResultDisplay($headingArray, $q);


?>


