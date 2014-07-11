<script type="text/javascript">
function submitMe(val)
{
	document.news.submit()
}	

</script>
<div style = "text-align:center;">
<?php
$rsObj->getPreviousNextMenu();
?>
</div>
<h1>View News Categories</h1>

<form name="news" action="" method="post">
<?php
$formObj = new formCreator;
$language_array[0]['language'] .= ' (Default)';
$formObj->formSelectRowN('Language','selected_language" onchange="submitMe(this.options[this.selectedIndex].value);',$language_array,'language','id',$current_language);
?>
</form>
<?php
//create list of headers to display
//Keys in the array are the list of column names in the resultset "$mainMenuItemList"  

$headingArray = array("id"=>"ID", "name"=>"Category Name", "description"=>"Description", "actions"=>"Actions" );
$viewresultSetObj = new viewResultSet;
echo $viewresultSetObj->createResultDisplay($headingArray, $q);

?>
