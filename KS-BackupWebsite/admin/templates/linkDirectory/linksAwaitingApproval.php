<?php
/****************************************
* Author - Ebad Syed
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/


?>
<h1>View link requests. Approve or Reject them</h1>
<h2>If you wish to edit the links, please click on the ID of appropriate link.</h2>

<?php
//create list of headers to display
//Keys in the array are the list of column names in the resultset "$mainMenuItemList"  
$headingArray = array("id"=>"ID", "name"=>"Category Name", "email"=>"Email","phone"=>"Phone", "website_name"=>"Website" , "link_to_be_added"=>"Link to be added", "category_for_link"=>"Category for link", "linkrequest_date"=> "Date Link requested", "actions"=>"Actions" );
$viewresultSetObj = new viewResultSet;
echo $viewresultSetObj->createResultDisplay($headingArray, $data);

?>

