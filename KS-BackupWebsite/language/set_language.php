<?php
$language_id = mysql_real_escape_string($_GET['language_id']);
$referrer = hex2bin($_GET['referrer']);
if($_GET['referrer']=='')
{
	$referrer = str_replace('http://','',SITE_URL);
}
$languageObj = new languageManagement;
$set = $languageObj->setLanguage($language_id);
echo '<script type="text/javascript">window.location = "http://'.$referrer.'"</script>';
exit(0);