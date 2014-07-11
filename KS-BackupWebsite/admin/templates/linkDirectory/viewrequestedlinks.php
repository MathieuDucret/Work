<?php
/****************************************
* Author - Ebad Syed
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/


?>
<h1>View link requests</h1>

<?php
//create list of headers to display
//Keys in the array are the list of column names in the resultset "$mainMenuItemList"  
$headingArray = array("id"=>"ID", "first_name"=>"First Name", "sur_name"=>"Sur Name", "email"=>"Email" , "phone"=>"Phone No", "website_name"=>"Website", "link_to_be_added"=> "link to Be Added", "name"=>"Category For Link" , "name"=>"Date Link requested" , "name"=>"Status", "actions"=>"Actions" );
$viewresultSetObj = new viewResultSet;
echo $viewresultSetObj->createResultDisplay($headingArray, $data);

?>
