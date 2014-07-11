<h1>Add Mail Template</h1>
<?php
if($errmsg!=''){?><div class="errmsg"><?php echo $errmsg;?></div><?php }
$formObj = new formCreator;
$formObj->formNew('newsletterRegister','');
$formObj->formtextRow('Subject', 'subject',$_POST['subject']);
$formObj->formtextAreaRow('Message', 'message',$_POST['message'],4,4);
$formObj->formSubmit();
$formObj->formAddCK('message')
?>