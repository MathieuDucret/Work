<h1>Preview Mail Template</h1>
<p>Please enter an email address below to receive a test copy of the chosen template</p>
<?php
if($errmsg!=''){?><div class="errmsg"><?php echo $errmsg;?></div><?php }
$formObj = new formCreator;
$formObj->formNew('newsletterRegister','');
$formObj->formtextRow('To', 'subject',$data[0]['subject']);
?>
<tr>
	<td colspan="2"><h2>Message Data</h2></td>
</tr>
<tr>
	<td>From</td>
    <td style="border:1px solid #CCC;"><strong><?php echo 'info@'.SITE_TLD; ?></strong></td>
</tr>    
 <tr>
 	<td>Subject</td>
    <td style="border:1px solid #CCC;"><strong><?php echo strip_tags($data[0]['message']);?></strong></td>
 </tr>    
 <tr>
 	<td>Message</td>
    <td style="border:1px solid #CCC;"><?php echo $data[0]['message'];?></td>
 </tr>    
<?php
$formObj->formSubmit('','Send Preview');
?>