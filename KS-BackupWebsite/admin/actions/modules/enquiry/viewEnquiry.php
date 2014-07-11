<h1>View Enquiry</h1>
<?php $_POST = $data[0];?>
<table id="form_table">
<form name="contact" method="post" action="contact">
	<?php if($errmsg != '') {?><tr>
    	<td id="errmsg" colspan="2"><?php echo $errmsg;?></td>
    </tr><?php } ?>
    <tr>
    	<td id="form_label">First Name</td>
        <td id="form_input"><input readonly type="text" name="first_name" <?php if(isset($_POST['first_name'])) echo "value='".$_POST['first_name']."'"; ?>></td>
    </tr>
    <tr>
    	<td id="form_label">Last Name</td>
        <td id="form_input"><input readonly type="text" name="last_name" <?php if(isset($_POST['last_name'])) echo "value='".$_POST['last_name']."'"; ?>></td>
    </tr>
    <tr>
    	<td id="form_label">Email Address</td>
        <td id="form_input"><input readonly type="text" name="email" <?php if(isset($_POST['email'])) echo "value='".$_POST['email']."'"; ?>></td>
    </tr>
    <tr>
    	<td id="form_label">Telephone</td>
        <td id="form_input"><input readonly type="text" name="telephone" <?php if(isset($_POST['telephone'])) echo "value='".$_POST['telephone']."'"; ?>></td>
    </tr>
    <tr>
    	<td id="form_label">Mobile</td>
        <td id="form_input"><input readonly type="text" name="mobile" <?php if(isset($_POST['mobile'])) echo "value='".$_POST['mobile']."'"; ?>></td>
    </tr>
    <tr>
    	<td id="form_label" style="text-align:left">Nature of Enquiry</td>
        <td id="form_input"><select name="nature">
        <option <?php if ($data[0]['enquiry']=='Enquiry') echo 'selected';?> value="Enquiry">Enquiry</option>
        <option <?php if ($data[0]['enquiry']=='Booking') echo 'selected';?> value="Booking">Booking</option>
        <option <?php if ($data[0]['enquiry']=='Feedback') echo 'selected';?> value="Feedback">Feedback</option>
        <option <?php if ($data[0]['enquiry']=='Other') echo 'selected';?> value="Other">Other</option>
        </select></td>
    </tr>
    <tr>
    	<td id="form_label">Comments</td>
        <td id="form_input"><textarea rows="10" cols="60" name="questions"><?php if(isset($_POST['questions'])) echo stripslashes($_POST['questions']); ?></textarea></td>
    </tr>
</form>
</table>
