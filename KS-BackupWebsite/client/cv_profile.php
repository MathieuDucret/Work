<h2>CV Information</h2>
<?php
?>
<table class="table_data">
<tr>
	<td style="width:170px;">Personal Statement</td>
    <td style="border:1px solid #000;padding:10px;margin:20px;"><?php echo $data[$i]['personal_statement'];?></td>
</tr> 
<tr>
	<td colspan="2">&nbsp;</td>
</tr>     
<tr>
	<td>Education &amp; Training</td>
    <td style="border:1px solid #000;padding:10px;margin:20px;"><?php echo $data[$i]['education_training'];?></td>
</tr>
<tr>
	<td colspan="2">&nbsp;</td>
</tr> 
<tr>
	<td>Employment History</td>
    <td style="border:1px solid #000;padding:10px;margin:20px;"><?php echo $data[$i]['employment_history'];?></td>
</tr>  
<tr>
	<td colspan="2">&nbsp;</td>
</tr>  
<tr>
	<td>Reference 1</td>
    <td style="border:1px solid #000;padding:10px;margin:20px;"><?php echo $data[$i]['reference_1'];?></td>
</tr> 
<tr>
	<td colspan="2">&nbsp;</td>
</tr> 
<tr>
	<td>Reference 2</td>
    <td style="border:1px solid #000;padding:10px;margin:20px;"><?php echo $data[$i]['reference_2'];?></td>
</tr> 
<tr>
	<td colspan="2">&nbsp;</td>
</tr> 
<tr>
	<td>Additional Skills</td>
    <td style="border:1px solid #000;padding:10px;margin:20px;"><?php echo $data[$i]['additional_skills'];?></td>
</tr>
<tr>
	<td colspan="2"><button onClick="window.location='/contact/contact'">To get more information about this candidate, click here to send King Stage an enquiry with this candidates reference number.</button></td>
</tr>     
</table>