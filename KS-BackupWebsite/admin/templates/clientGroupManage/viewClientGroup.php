<?php
/****************************************
* Author - Ebad Syed
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/?>
<h1>View Client Groups.</h1>
<?php
//create list of headers to display
//Keys in the array are the list of column names in the resultset "$mainMenuItemList"  
$headingArray = array("id"=>"ID", "group_name"=>"Group Name", "description"=>"Description", "actions"=>"Actions" );
$viewresultSetObj = new viewResultSet;
echo $viewresultSetObj->createResultDisplay($headingArray, $data);

?>
