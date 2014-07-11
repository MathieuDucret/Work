
<style>
tr#bold td {
	font-weight:bold;
}
</style>
<h1>View Candidates</h1>
<p>Please select an option to perform on the following candidates</p>
<div>
        <?php
		$education_array = array(array('display'=>'Bachelor of Science'),array('display'=>'Bachelor of Arts'),array('display'=>'Masters'));
		$benefits_array = array(array('display'=>'Yes'),array('display'=>'No'));
		$gender_array = array(array('display'=>'Male'),array('display'=>'Female'));
		
		$ethnicbg_array = array(array('display'=>'White British'),array('display'=>'Afro Carribbean'),array('display'=>'Other'));
		$service_array = array(array('display'=>'Job Brokerage'),array('display'=>'Training'),array('display'=>'Business Coaching'),array('display'=>'One to One Information/Advice'),array('display'=>'Self Development Workshops'),array('display'=>'Childcare Services'),array('display'=>'Volunteering Opportunities'),array('display'=>'Welfare to Work Programmes'),array('display'=>'Other'));
		
		$formObj = new formCreator;
		$formObj->formNew('propertySearch');
		$formObj->formtextRow('Ref ID','client_id',$_POST['client_id']);
		$formObj->formtextRow('Name','name',$_POST['name']);
		$formObj->formtextRow('Email','email',$_POST['email']);
		$formObj->formSelectRow('Education Status*','education_status',$education_array,'display','display',$_POST['education_status'],1);
		?>
<tr>
	<td>Industry/Sector</td>
    <td>
    	<select id="industry" name="industry">
            <option <?php if($_POST['industry']=='') echo 'selected="selected"';?> value="">--Select--</option>
            <option <?php if($_POST['industry']=='Accountancy') echo 'selected="selected"';?> value="Accountancy">Accountancy</option>
            <option <?php if($_POST['industry']=='Aerospace') echo 'selected="selected"';?> value="Aerospace">Aerospace</option>
            <option <?php if($_POST['industry']=='Agriculture, Fishing, Forestry') echo 'selected="selected"';?> value="Agriculture, Fishing, Forestry">Agriculture, Fishing, Forestry</option>
            <option <?php if($_POST['industry']=='Banking, Insurance, Finance') echo 'selected="selected"';?> value="Banking, Insurance, Finance">Banking, Insurance, Finance</option>
            <option <?php if($_POST['industry']=='Catering and Hospitality') echo 'selected="selected"';?> value="Catering and Hospitality">Catering and Hospitality</option>
            <option <?php if($_POST['industry']=='Construction') echo 'selected="selected"';?> value="Construction">Construction</option>
            <option <?php if($_POST['industry']=='Customer Services') echo 'selected="selected"';?> value="Customer Services">Customer Services</option>
            <option <?php if($_POST['industry']=='Education') echo 'selected="selected"';?> value="Education">Education</option>
            <option <?php if($_POST['industry']=='Electronics') echo 'selected="selected"';?> value="Electronics">Electronics</option>
            <option <?php if($_POST['industry']=='Engineering, Manufacturing, Utilities') echo 'selected="selected"';?> value="Engineering, Manufacturing, Utilities">Engineering, Manufacturing, Utilities</option>
            <option <?php if($_POST['industry']=='Graduate, Trainees') echo 'selected="selected"';?> value="Graduate, Trainees">Graduate, Trainees</option>
            <option <?php if($_POST['industry']=='Health, Nursing') echo 'selected="selected"';?> value="Health, Nursing">Health, Nursing</option>
            <option <?php if($_POST['industry']=='Human Resources') echo 'selected="selected"';?> value="Human Resources">Human Resources</option>
            <option <?php if($_POST['industry']=='IT and Internet') echo 'selected="selected"';?> value="IT and Internet">IT and Internet</option>
            <option <?php if($_POST['industry']=='Legal') echo 'selected="selected"';?> value="Legal">Legal</option>
            <option <?php if($_POST['industry']=='Management Consultancy') echo 'selected="selected"';?> value="Management Consultancy">Management Consultancy</option>
            <option <?php if($_POST['industry']=='Marketing, Advertising, PR') echo 'selected="selected"';?> value="Marketing, Advertising, PR">Marketing, Advertising, PR</option>
            <option <?php if($_POST['industry']=='Media, New Media, Creative') echo 'selected="selected"';?> value="Media, New Media, Creative">Media, New Media, Creative</option>
            <option <?php if($_POST['industry']=='Not For Profit, Charities') echo 'selected="selected"';?> value="Not For Profit, Charities">Not For Profit, Charities</option>
            <option <?php if($_POST['industry']=='Oil, Gas, Alternative Energy') echo 'selected="selected"';?> value="Oil, Gas, Alternative Energy">Oil, Gas, Alternative Energy</option>            
            <option <?php if($_POST['industry']=='Property') echo 'selected="selected"';?> value="Property">Property</option>
            <option <?php if($_POST['industry']=='Public Sector and Services') echo 'selected="selected"';?> value="Public Sector and Services">Public Sector and Services</option>
            <option <?php if($_POST['industry']=='Recruitment Sales') echo 'selected="selected"';?> value="Recruitment Sales">Recruitment Sales</option>
            <option <?php if($_POST['industry']=='Retail, Wholesale') echo 'selected="selected"';?> value="Retail, Wholesale">Retail, Wholesale</option>
            <option <?php if($_POST['industry']=='Sales') echo 'selected="selected"';?> value="Sales">Sales</option>
            <option <?php if($_POST['industry']=='Science') echo 'selected="selected"';?> value="Science">Science</option>
            <option <?php if($_POST['industry']=='Secretarial, PAs, Administration') echo 'selected="selected"';?> value="Secretarial, PAs, Administration">Secretarial, PAs, Administration</option>
            <option <?php if($_POST['industry']=='Senior Appointments') echo 'selected="selected"';?> value="Senior Appointments">Senior Appointments</option>
            <option <?php if($_POST['industry']=='Social Services') echo 'selected="selected"';?> value="Social Services">Social Services</option>
            <option <?php if($_POST['industry']=='Telecommunications') echo 'selected="selected"';?> value="Telecommunications">Telecommunications</option>
            <option <?php if($_POST['industry']=='Transport, Logistics') echo 'selected="selected"';?> value="Transport, Logistics">Transport, Logistics</option>
            <option <?php if($_POST['industry']=='Travel, Leisure, Tourism') echo 'selected="selected"';?> value="Travel, Leisure, Tourism">Travel, Leisure, Tourism</option>
            <option <?php if($_POST['industry']=='Other') echo 'selected="selected"';?> value="Other">Other</option>
		</select>
	</td>
</tr>
<?php
		$formObj->formSelectRow('Gender','gender',$gender_array,'display','display',$_POST['gender'],1);
		$formObj->formSubmit('Search');
		
		?>
        <div style="text-align:right;">
<div id="resultCount"><strong><?php echo $rsObj->total_items;?></strong> results found for your search</div>
<?php ?><?php
$rsObj->getPreviousNextMenu();
?>
<br />
<?php
$rsObj->getNumberLinks();
?>
<?php ?></div>
<table>
	<tr>
    	<td>Ref ID</td>
    	<td>Name</td>
        <td>Email</td>        
        <td>Education Status</td>
        <td>Industry/Sector</td>
        <td>Gender</td>
        <td>Actions</td>
	</tr>        
        
   <?php  
for($i=0;$i<count($data);$i++)
{
	if($i%2) $class = 'searchResult1';
	else $class = 'searchResult2';
	?>
    <tr class="<?php echo $class;?>">
    	<td><?php echo $data[$i]['client_id'];?></td>
    	<td><?php echo $data[$i]['name'];?></td>
    	<td><?php echo $data[$i]['email'];?></td>
        <td><?php echo $data[$i]['education_status'];?></td>
        <td><?php echo $data[$i]['industry'];?></td>
        <td><?php echo $data[$i]['gender'];?></td>
		<td><?php echo ResultSetPagination::displayActions($data[$i]['client_id']);?></td>        
	</tr>
    <?php
}
?>
</table>
