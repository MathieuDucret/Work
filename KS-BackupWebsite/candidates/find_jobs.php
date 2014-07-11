<script type="text/javascript">

	function setLimit(limit)
	{
		$('#limit').val(limit);
		$('#paged').val(1);
		performSearch(1);
	}
	
	function setPagination(limit,pageno)
	{
		$('#limit').val(limit);
		$('#paged').val(pageno);
		performSearch(1);
	}
	
	function performSearch(clicked)
	{				
		var searchString;
		var box = $('#results');
		var locationVal = $('#location').val();
		var industryVal = $('#industry').val();
		var jobtypeVal = $('#jobtype').val();
		var experienceVal = $('#experience').val();
		var educationVal = $('#education').val();
		
		var limitVal = $('#limit').val();
		var pagedVal = $('#paged').val();
		var orderVal = $('#order').val();
		
		if(clicked==1)
		{//A search was initiated so lets set the cookie with the search data
			$.cookie('search_cookie', 'location='+locationVal+'&industry='+industryVal+'&education='+educationVal+'&jobtype='+jobtypeVal+'&experience='+experienceVal+'&limit='+limitVal+'&order='+orderVal);
			searchString = 'location='+locationVal+'&industry='+industryVal+'&education='+educationVal+'&jobtype='+jobtypeVal+'&experience='+experienceVal+'&limit='+limitVal+'&order='+orderVal;
		}
		else
		{//No search, loaded with the page, so lets set the search data to the cookie data
			searchString = searchString = $.cookie('search_cookie');
		}	
		$.ajax({
			url: '/candidates/ajax/search_results.php',
			type: 'POST',
			data: searchString,
			success: function(data) {				
				var html = $(data);	
				box.empty();
				box.append(data);				
				/*Any events we want to check for in this bit place here*/
			}
		});	
	}

$(function(){ 		
	performSearch(0);
	
	$('#searchButton').click(function() {										 
		performSearch(1);
	});
});
</script>
<div id="center_content">
    <h1>View Available Jobs</h1>
    <form name="searchJobs" action="" method="post">
    
    <?php   
    $formObj = new formCreator;
    ?>
        <input type="hidden" name="limit" id="limit" value="<?php echo $_POST['limit'];?>" />
        <input type="hidden" name="paged" id="paged" value="<?php echo $_POST['paged'];?>" />
        <input type="hidden" name="order" id="order" value="<?php echo $_POST['order'];?>" />
        <input type="hidden" name="current_tab" id="current_tab" value="<?php echo $_POST['current_tab'];?>" />	
        <input type="hidden" name="location" id="location" value="" />	
    <table>
    <tr>
        <td>Industry/Sector</td>
        <td>
            <select id="industry" name="industry">
                <option <?php if($_POST['industry']=='') echo 'selected="selected"';?> value="">--All--</option>
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
    $formObj->formSelectRow('Job Type','jobtype',array(array('value'=>'Permanent'),array('value'=>'Contract'),array('value'=>'Temporary'),array('value'=>'Part Time')),'value','value',$_POST['job_type'],1);
    $formObj->formSelectRow('Years Experience Required','experience',array(array('value'=>'None'),array('value'=>'1+'),array('value'=>'2+'),array('value'=>'3+'),array('value'=>'4+'),array('value'=>'5+')),'value','value',$_POST['years_experience'],1);
    $formObj->formSelectRow('Education Level','education',array(array('value'=>'No Requirement'),array('value'=>'Secondary School'),array('value'=>'Vocational'),array('value'=>'Graduate'),array('value'=>'Post Graduate')),'value','value',$_POST['education_level'],1);
    ?>
    <tr>
        <td colspan="2"><div id="find_prop" style="float:right;"><a href="#results" id="searchButton">Search</a></div><div style="clear:both;"></div></td>
    </tr>
    </table>
    </form>
    <div id="results"></div>   
</div>     