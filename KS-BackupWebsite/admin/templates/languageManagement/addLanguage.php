<script type="text/javascript">


</script>
<h2>Add Language</h2>
<?php if($errmsg != '') echo '<div class="errmsg">'.$errmsg.'</div>';?>
<?php
$formObj= new formCreator;
$formObj->formNew('addLanguage','');
$formObj->formtextRow('Language', 'language',$_POST['language']);
$formObj->formSelectRow('Status', 'active',array(array('display'=>'Active','value'=>'1'),array('display'=>'Disabled','value'=>'0')),'display','value',$_POST['active']);
$formObj->formSelectRow('Default?', 'default_language',array(array('display'=>'Yes','value'=>'1'),array('display'=>'No','value'=>'0')),'display','value',$_POST['default_language']);
$formObj->formSubmit();
?>
