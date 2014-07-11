<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/
?>

<h1>View Property Enquiries</h1>

<?php
//create list of headers to display
//Keys in the array are the list of column names in the resultset "$mainMenuItemList"  
$headingArray = array("date_time"=>"Date Time", "contact_name"=>"Contact Name", "phone"=>"Tel No", "email"=>"Email", "address_1"=>"Property Address","actions"=>"Actions" );
$viewresultSetObj = new viewResultSet;
echo $viewresultSetObj->createResultDisplay($headingArray, $q);

?>
