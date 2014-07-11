<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/
?>

<h1>View Enquiries</h1>

<?php
//create list of headers to display
//Keys in the array are the list of column names in the resultset "$mainMenuItemList"  
$headingArray = array("date_time"=>"Date Time", "first_name"=>"First Name", "last_name"=>"Last Name", "telephone"=>"Tel No", "mobile"=>"Mobile No", "email"=>"Email", "nature"=>"Nature Enquiry","actions"=>"Actions" );
$viewresultSetObj = new viewResultSet;
echo $viewresultSetObj->createResultDisplay($headingArray, $q);

?>
