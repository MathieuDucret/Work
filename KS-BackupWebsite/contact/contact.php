<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/
require_once(COMMON_ROOT.'/classes/Contact.class.php');
$errmsg = '';
if(isset($_POST['submit']))
{
	$contactObj = new Contact;
	$errmsg = $contactObj->processForm($_POST);
}
?>
<div id="center_content">
<?php
$this->display_mode='extended';
echo$this->db_page_content;
?>
<table id="form_table">
<form name="contact" method="post" action="contact">
<input type="hidden" name="nature" value="Enquiry" />
	<?php if($errmsg != '') {?><tr>
    	<td id="errmsg" colspan="2"><?php echo $errmsg;?></td>
    </tr><?php } ?>
    <tr>
    	<td id="form_label">First Name</td>
        <td id="form_input"><input type="text" name="first_name" <?php if(isset($_POST['first_name'])) echo "value='".$_POST['first_name']."'"; ?>></td>
    </tr>
    <tr>
    	<td id="form_label">Last Name</td>
        <td id="form_input"><input type="text" name="last_name" <?php if(isset($_POST['last_name'])) echo "value='".$_POST['last_name']."'"; ?>></td>
    </tr>
    <tr>
    	<td id="form_label">Email Address</td>
        <td id="form_input"><input type="text" name="email" <?php if(isset($_POST['email'])) echo "value='".$_POST['email']."'"; ?>></td>
    </tr>
    <tr>
    	<td id="form_label">Telephone</td>
        <td id="form_input"><input type="text" name="telephone" <?php if(isset($_POST['telephone'])) echo "value='".$_POST['telephone']."'"; ?>></td>
    </tr>
    <tr>
    	<td id="form_label">Mobile</td>
        <td id="form_input"><input type="text" name="mobile" <?php if(isset($_POST['mobile'])) echo "value='".$_POST['mobile']."'"; ?>></td>
    </tr>
    <tr>
    	<td id="form_label">Comments</td>
        <td id="form_input"><textarea rows="10" cols="60" name="questions"><?php if(isset($_POST['questions'])) echo stripslashes($_POST['questions']); ?></textarea></td>
    </tr>
    <tr>
    	<td align="center" colspan="2" id="form_label"><input type="submit" name="submit" value="Submit"></td>
    </tr>
</form>
</table>
</div>
