<h1>Property Enquiry</h1>
<form action="" method="POST">
<table>
<?php
$formObj = new formCreator;
$formObj->formtextRow('Date','date_time',date('d-m-Y h:i:s',strtotime($data[0]['date_time'])),1);
$formObj->formtextRow('Contact Name','contact_name',$data[0]['contact_name'],1);
$formObj->formtextRow('Tel No','phone',$data[0]['phone'],1);
$formObj->formtextRow('Email','email',$data[0]['email'],1);
$formObj->formtextAreaRow('Property Address', '',$data[0]['address_1'].', '.$data[0]['town'].', '.$data[0]['postcode'],6,30,1);
$formObj->formtextAreaRow('Message', 'message',$data[0]['message'],6,30,1);
?>
</table>
</form>

