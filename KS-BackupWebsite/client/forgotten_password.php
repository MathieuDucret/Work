<div id="center_content" style="padding: 0px 0px 0px 0px;">
<?php
$clientObj = new Client;
$formObj = new formCreator;
$errmsg = '';
if($_POST['submit']=='Forgotten Password')
{
	$forgotPassword = $clientObj->forgotPassword($_POST);
	$errmsg = $forgotPassword;
}	
?>

<h1>Forgotten your password?</h1>
<p style="line-height: 20px;">If you have forgotten your password, please enter your e-mail address below, and click the 'Forgotten Password' button.  You will then receive an email with a link that you will need to follow to access your new account information.</p>
		<?php
        if($errmsg!='')
        {
            echo '<div class="errmsg">'.$errmsg.'</div>';
        }
        ?>
<?php
$formObj->formNew('forgotPassword','/client/forgotten_password');
$formObj->formtextRow('Email', 'email',$_POST['email']);
$formObj->formSubmit('','Forgotten Password');
?>
</div>