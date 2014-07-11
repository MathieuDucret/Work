<h1>Add Mail Template</h1>
<?php
if($errmsg!=''){?><div class="errmsg"><?php echo $errmsg;?></div><?php }
$formObj = new formCreator;
$formObj->formNew('bulkmailQueue','');
$formObj->formSelectRow('Mail Template','mail_template',$formObj->SelectQuery("SELECT id, subject FROM tbl_module_newsletter_templates","master"),'subject','id',$_POST['mail_template']);
$formObj->formSelectRow('Recepient List','recepient_list',array(array('display'=>'Newsletter Users','value'=>'newsletter'),array('display'=>'Client Users','value'=>'client')),'display','value',$_POST['recepient_list']);
$formObj->formSubmit();
?>