<?php
$headingArray = array("id"=>"ID","subject"=>"Subject", "message"=>"Message", "actions"=>"Actions" );
$viewresultSetObj = new viewResultSet;
echo $viewresultSetObj->createResultDisplay($headingArray, $data);
?>