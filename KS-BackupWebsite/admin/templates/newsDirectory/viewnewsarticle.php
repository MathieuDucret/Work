<?php
/****************************************
* Author - esyed
* Company - Internet Concepts Limited
* Revision - 1.0 
* 18/11/09
*****************************************/?>

<div style = "text-align:center;">
<?php
$rsObj->getPreviousNextMenu();
?>
</div>
<h1>View News articles for <?php echo $_GET['catname']; ?> category</h1>
<p>Please select an option to perform on the following categories.</p>

<?php
//create list of headers to display
//Keys in the array are the list of column names in the resultset "$mainMenuItemList"  
$headingArray = array("id"=>"ID", "author"=>"Category Name", "title"=>"Description", "publisher"=>"Publisher" , "date_published"=>"Published On", "date_added"=>"Date Added", "stripped_content"=> "Content", "actions"=>"Actions" );
$viewresultSetObj = new viewResultSet;
echo $viewresultSetObj->createResultDisplay($headingArray, $q);
?>


<div style = "text-align:center;">
<?php
$rsObj->getPreviousNextMenu();
?>
<br /> <br /> <br /> 
<?php
$rsObj->getNumberLinks();
?>
</div>