<?php
if($_POST['fileLocation']!='')
{
	session_start();
	$_SESSION['image_done'] = $_POST['fileLocation'];
}
