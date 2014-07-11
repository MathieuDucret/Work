<?php
/****************************************
* Author - Ebad Syed
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/?>
<h1>View Link Categories</h1>
<p>Please select an option to perform on the following categories.</p>

<?php
//create list of headers to display
//Keys in the array are the list of column names in the resultset "$mainMenuItemList"  

$headingArray = array("id"=>"ID", "name"=>"Category Name", "description"=>"Description", "actions"=>"Actions" );
$viewresultSetObj = new viewResultSet;
echo $viewresultSetObj->createResultDisplay($headingArray, $data);

?>

