<script type="text/javascript">


</script>
<h2>Delete Language</h2>
<?php if($errmsg != '') echo '<div class="errmsg">'.$errmsg.'</div>';?>
<?php
$formObj= new formCreator;
$formObj->formNew('deleteLanguage','');
$formObj->formtextRow('Language', 'language',$data[0]['language'],1);
$formObj->formSelectRow('Status', 'active',array(array('display'=>'Active','value'=>'1'),array('display'=>'Disabled','value'=>'0')),'display','value',$data[0]['active'],1);
$formObj->formSubmit();
?>
