<?php 
include('../../includes/inc.start.php');
$candidateObj = new Candidate;
$data = $candidateObj->viewJobs($_POST);
//Now display them however we wish
?>
