<?php
$currency_id = $_GET['currency_id'];
$referrer = hex2bin($_GET['referrer']);
if($_GET['referrer']=='')
{
	$referrer = str_replace('http://','',SITE_URL);
}
$shopObj = new shoppingCart;
$set = $shopObj->setCurrency($currency_id);
echo '<script type="text/javascript">window.location = "http://'.$referrer.'"</script>';
exit(0);