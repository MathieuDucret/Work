<script type="text/javascript">


</script>
<h2>Edit Language</h2>
<?php if($errmsg != '') echo '<div class="errmsg">'.$errmsg.'</div>';?>
<?php
$formObj= new formCreator;
$formObj->formNew('addLanguage','');
$formObj->formtextRow('Language', 'language',$data[0]['language']);
$formObj->formSelectRow('Status', 'active',array(array('display'=>'Active','value'=>'1'),array('display'=>'Disabled','value'=>'0')),'display','value',$data[0]['active']);
$formObj->formSelectRow('Default Language', 'default_language',array(array('display'=>'Yes','value'=>'1'),array('display'=>'No','value'=>'0')),'display','value',$data[0]['default_language']);
$formObj->formSubmit();
?>
