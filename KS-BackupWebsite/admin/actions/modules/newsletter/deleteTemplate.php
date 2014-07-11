<h1>Edit Mail Template</h1>
<?php
if($errmsg!=''){?><div class="errmsg"><?php echo $errmsg;?></div><?php }
$formObj = new formCreator;
$formObj->formNew('newsletterRegister','');
$formObj->formtextRow('Subject', 'subject',$data[0]['subject'],1);
$formObj->formtextAreaRow('Message', 'message',$data[0]['message'],4,4,1);
$formObj->formSubmit();
$formObj->formAddCK('message');
?>