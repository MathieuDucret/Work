<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0
* 24/11/09 
*****************************************/
//class used in admin panel
class Candidate extends DataBase
{
	function __construct()
	{
		parent::__construct();
	}
	
	function candidateRegister()
	{
		$getPostArgs = $this->mysql_real_escape_array($_POST);
		if(isset($getPostArgs['submit']))
		{
			$checkExists = $this->SelectQuery("SELECT * FROM tbl_clients WHERE email = '".$getPostArgs['email']."' OR username = '".$getPostArgs['username']."'","master");			
			if(count($checkExists)==0)
			{
				if($getPostArgs['name']=='') $errmsg .= 'Please provide your full name<br />';
				if($getPostArgs['password']=='') $errmsg .= 'Please provide a password<br />';
				if($getPostArgs['confirm_password']=='') $errmsg .= 'Please confirm your password<br />';
				if($getPostArgs['password']!=''&&$getPostArgs['confirm_password']!='')
				{
					if($getPostArgs['password']!=$getPostArgs['confirm_password']) $errmsg .= 'Please ensure you enter your password correctly in both boxes<br />';
				}
				if($getPostArgs['username']=='') $errmsg .= 'Please choose a username<br />';
				if($getPostArgs['address']=='') $errmsg .= 'Please provide your full address<br />';
				if($getPostArgs['phone']=='') $errmsg .= 'Please provide your phone number<br />';
				if($getPostArgs['email']=='') $errmsg .= 'Please provide your email address<br />';
				else
				{
					$errmsg .= Client::check_email_address($getPostArgs['email']);
				}
				if($getPostArgs['education_status']=='') $errmsg .= 'Please provide your education status<br />';
				if($getPostArgs['industry']=='') $errmsg .= 'Please specify your industry/sector<br />';
				if($getPostArgs['dob']=='') $errmsg .= 'Please provide the date of your birth<br />';
				else
				{
					$exploded_dob = explode('-',$getPostArgs['dob']);
					if(!checkdate($exploded_dob[1],$exploded_dob[2],$exploded_dob[0]))
					{
						$errmsg .= 'Date of birth is invalid. Ensure the date of birth is the in the format yyyy-mm-dd (e.g. for 14th December 1980, 1980-11-14)<br />';
					}
				}

				
				if($getPostArgs['gender']=='') $errmsg .= 'Please specify your gender<br />';
				
				if($errmsg =='')
				{
					//Now we check the CV is all OK
					if($getPostArgs['personal_statement']=='') $errmsg .= 'Please provide a personal statement<br />';
					if($getPostArgs['education_training']=='') $errmsg .= 'Please provide your education and any training you have undergone<br />';					
					if($getPostArgs['employment_history']=='') $errmsg .= 'Please provide your employment history<br />';					
					if($getPostArgs['reference_1']=='') $errmsg .= 'Please provide full details of your first reference<br />';					
					if($getPostArgs['reference_2']=='') $errmsg .= 'Please provide full details of your second reference<br />';									
					if($errmsg=='')
					{
						if($_SESSION['image_done']!='')
						{
							$video_upload = $_SESSION['image_done'];
						}
						else
						{
							$video_upload = '';
						}

						
						$client_id = $this->InsertQuery("INSERT INTO tbl_clients (title, username, password, email, pas0, clientgroupid, first_name, last_name, approved, subscribe_status) VALUES ('".$getPostArgs['title']."', '".$getPostArgs['username']."', '".md5($getPostArgs['password'])."', '".$getPostArgs['email']."', '".$getPostArgs['password']."', 3, '".$getPostArgs['first_name']."', '".$getPostArgs['last_name']."', 0, 1)","master");
						
						$candidate_id = $this->InsertQuery("INSERT INTO tbl_candidates_data (client_id, name, address, phone, email, education_status, industry, dob, gender, ethnic_bg, type_service, cv_upload, video_upload) VALUES ('".$client_id."', '".$getPostArgs['name']."', '".$getPostArgs['address']."', '".$getPostArgs['phone']."', '".$getPostArgs['email']."', '".$getPostArgs['education_status']."', '".$getPostArgs['industry']."', '".$getPostArgs['dob']."', '".$getPostArgs['gender']."', '".$getPostArgs['ethnic_bg']."', '".$getPostArgs['type_service']."', '".$getPostArgs['cv_upload']."', '".$video_upload."')","master");
												
						$cv_id = $this->InsertQuery("INSERT INTO tbl_candidates_cv_data (candidate_id, personal_statement, education_training, employment_history, reference_1, reference_2, additional_skills) VALUES ('".$client_id."', '".$getPostArgs['personal_statement']."', '".$getPostArgs['education_training']."', '".$getPostArgs['employment_history']."', '".$getPostArgs['reference_1']."', '".$getPostArgs['reference_2']."', '".$getPostArgs['additional_skills']."')","master");
																																																																																																																 
						if($client_id)
						{
							$errmsg = 'Successfully created your account. We will now review your CV data before your account is live, so please wait and try to login later.';
							$mail_data = $this->SelectQuery("SELECT * FROM tbl_clients WHERE id='".$client_id."'","master");
							$message = '';
							$subject = 'King Stage London - Account Awaiting Approval';
							$message .= 'Datetime : '.date('d m Y H:i:s').'<br />';			
							$message .= 'Name : '.$candidate_id[0]['name'].'<br />';							
							$message .= 'Email : '.$mail_data[0]['email'].'<br />';			
							$message .= 'Username : '.$mail_data[0]['username'].'<br />';					
							
							$mailObj = new Mail;
							$mailObj->SendMail($mail_data[0]['email'],$message,$subject,CONTACT_EMAIL);
						}
						else
						{ 
							$errmsg ='There was a problem inserting the record';
						}																																																																																																																
					}
				}
			}
			else
			{
				$errmsg = 'A record already exists with this email address or username<br />';
			}
		}
		return $errmsg;
	}
	
	function viewUnapprovedCandidates($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($_POST);
		$where = 'WHERE approved=0 ';
		if($getPostArgs['client_id']!='') $where .= 'AND client_id = "'.$getPostArgs['client_id'].'" ';
		if($getPostArgs['name']!='') $where .= 'AND name LIKE "%'.$getPostArgs['name'].'%" ';
		if($getPostArgs['address']!='') $where .= 'AND address LIKE "%'.$getPostArgs['address'].'%" ';
		if($getPostArgs['email']!='') $where .= 'AND email = "'.$getPostArgs['email'].'" ';
		if($getPostArgs['education_status']!='') $where .= 'AND education_status = "'.$getPostArgs['education_status'].'" ';
		if($getPostArgs['industry']!='') $where .= 'AND industry = "'.$getPostArgs['industry'].'" ';
		if($getPostArgs['gender']!='') $where .= 'AND gender = "'.$getPostArgs['gender'].'" ';
		if($getPostArgs['ethnic_bg']!='') $where .= 'AND ethnic_bg = "'.$getPostArgs['ethnic_bg'].'" ';
		if($getPostArgs['type_service']!='') $where .= 'AND type_service = "'.$getPostArgs['type_service'].'" ';				
		
		if(isset($getPostArgs['submit']))
		{
			$_SESSION['candidate_unapproved_search'] = $where;
		}
		else
		{
			if($_SESSION['candidate_unapproved_search']!='')
			{
				$where = $_SESSION['candidate_unapproved_search'];
			}						
		}
		$table = "tbl_candidates_data";

		$rsObj = new ResultSetPagination($_GET['limit'], $_GET['cat'], $_GET['paged'], $where.' ORDER BY date_time DESC', $table, "admin", $_GET['page']);
		//$data = $this->SelectQuery("SELECT * FROM ".$table." ".$where,"master");
		$total_pages = $rsObj->total_pages;
		$paged = $rsObj->paged;
		$data = $rsObj->getLimitSet($rsObj->limit_array);
		//$data = $this->SelectQuery("SELECT * FROM tbl_estateagent_property_data","master");		
		require_once(COMMON_ROOT.'/admin/templates/Candidates/viewCandidates.php');		
	}
	
	function viewApprovedCandidates($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($_POST);
		$where = 'WHERE approved="1" ';
		if($getPostArgs['client_id']!='') $where .= 'AND client_id = "'.$getPostArgs['client_id'].'" ';
		if($getPostArgs['name']!='') $where .= 'AND name LIKE "%'.$getPostArgs['name'].'%" ';
		if($getPostArgs['address']!='') $where .= 'AND address LIKE "%'.$getPostArgs['address'].'%" ';
		if($getPostArgs['email']!='') $where .= 'AND email = "'.$getPostArgs['email'].'" ';
		if($getPostArgs['education_status']!='') $where .= 'AND education_status = "'.$getPostArgs['education_status'].'" ';
		if($getPostArgs['industry']!='') $where .= 'AND industry = "'.$getPostArgs['industry'].'" ';
		if($getPostArgs['gender']!='') $where .= 'AND gender = "'.$getPostArgs['gender'].'" ';
		if($getPostArgs['ethnic_bg']!='') $where .= 'AND ethnic_bg = "'.$getPostArgs['ethnic_bg'].'" ';
		if($getPostArgs['type_service']!='') $where .= 'AND type_service = "'.$getPostArgs['type_service'].'" ';				
		
		if(isset($getPostArgs['submit']))
		{
			$_SESSION['candidate_approved_search'] = $where;
		}
		else
		{
			if(isset($_SESSION['candidate_approved_search']))
			{
				$where = $_SESSION['candidate_approved_search'];
			}
		}
		$table = "tbl_candidates_data";
		$rsObj = new ResultSetPagination($_GET['limit'], $_GET['cat'], $_GET['paged'], $where.' ORDER BY date_time DESC', $table, "admin", $_GET['page']);
		//$data = $this->SelectQuery("SELECT * FROM ".$table." ".$where,"master");
		$total_pages = $rsObj->total_pages;
		$paged = $rsObj->paged;
		$data = $rsObj->getLimitSet($rsObj->limit_array);
		//$data = $this->SelectQuery("SELECT * FROM tbl_estateagent_property_data","master");		
		require_once(COMMON_ROOT.'/admin/templates/Candidates/viewCandidates.php');		
	}
	
	function approveCandidate($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		if(isset($getPostArgs['submit']))
		{
			$checkExists = $this->SelectQuery("SELECT * FROM tbl_clients WHERE (email = '".$getPostArgs['email']."' OR username = '".$getPostArgs['username']."') AND id != '".mysql_real_escape_string($_GET['id'])."'","master");
			if(count($checkExists)==0)
			{
				if($getPostArgs['name']=='') $errmsg .= 'Please provide the full name<br />';
				
				if($getPostArgs['username']=='') $errmsg .= 'Please supply a username<br />';
				if($getPostArgs['address']=='') $errmsg .= 'Please provide the full address<br />';
				if($getPostArgs['phone']=='') $errmsg .= 'Please provide the phone number<br />';
				if($getPostArgs['email']=='') $errmsg .= 'Please provide the email address<br />';
				else
				{
					$errmsg .= Client::check_email_address($getPostArgs['email']);
				}
				if($getPostArgs['industry']=='') $errmsg .= 'Please specify the industry/sector<br />';
				if($getPostArgs['dob']=='') $errmsg .= 'Please provide the date of your birth<br />';
				else
				{
					$exploded_dob = explode('-',$getPostArgs['dob']);
					if(!checkdate($exploded_dob[1],$exploded_dob[2],$exploded_dob[0]))
					{
						$errmsg .= 'Date of birth is invalid. Ensure the date of birth is the in the format yyyy-mm-dd (e.g. for 14th December 1980, 1980-11-14)<br />';
					}
				}
				
				if($getPostArgs['gender']=='') $errmsg .= 'Please specify the gender<br />';																	
				//Now we check the CV is all OK
				if($getPostArgs['personal_statement']=='') $errmsg .= 'Please provide a personal statement<br />';
				if($getPostArgs['education_training']=='') $errmsg .= 'Please provide the education and any training that has been undertaken<br />';					
				if($getPostArgs['employment_history']=='') $errmsg .= 'Please provide the employment history<br />';					
				if($getPostArgs['reference_1']=='') $errmsg .= 'Please provide full details of the first reference<br />';					
				if($getPostArgs['reference_2']=='') $errmsg .= 'Please provide full details of the second reference<br />';	
				
				if($errmsg=='')
				{					
					$query = $this->ExecQuery("UPDATE tbl_clients SET username='".$getPostArgs['username']."', email='".$getPostArgs['email']."', approved = '1' WHERE id ='" .mysql_real_escape_string($_GET['id']). "'", "master");
					
					$candidate_query = $this->ExecQuery("UPDATE tbl_candidates_data SET name='".$getPostArgs['name']."', address='".$getPostArgs['address']."', phone='".$getPostArgs['phone']."', email='".$getPostArgs['email']."', education_status='".$getPostArgs['education_status']."', industry='".$getPostArgs['industry']."', dob='".$getPostArgs['dob']."', gender='".$getPostArgs['gender']."', ethnic_bg='".$getPostArgs['ethnic_bg']."', type_service='".$getPostArgs['type_service']."', cv_upload='".$getPostArgs['cv_upload']."', approved='1' WHERE client_id='".mysql_real_escape_string($_GET['id'])."'","master");
					
					$cv_query = $this->ExecQuery("UPDATE tbl_candidates_cv_data SET personal_statement='".$getPostArgs['personal_statement']."', education_training='".$getPostArgs['education_training']."', employment_history='".$getPostArgs['education_history']."', reference_1='".$getPostArgs['reference_1']."', reference_2='".$getPostArgs['reference_2']."', additional_skills='".$getPostArgs['additional_skills']."' WHERE client_id = '".mysql_real_escape_string($_GET['id'])."'","master");

					
					//direct to correct output page depending on success of query
					if($query)
					{
						$mail_data = $this->SelectQuery("SELECT * FROM tbl_clients WHERE id='".$getPostArgs['id']."'","master");
						$message = '';
						$message .= 'New account has been successfully approved:<br /><br />';
						$message .= 'First Name : '.$mail_data[0]['first_name'].'<br />';
						$message .= 'Last Name : '.$mail_data[0]['last_name'].'<br />';
		
						$message .= 'Email : '.$mail_data[0]['email'].'<br />';			
						$message .= 'Username : '.$mail_data[0]['username'].'<br />';	
						$subject = 'New Account Approved';
						
						$mailObj = new Mail;
						$mailObj->SendMail(CONTACT_EMAIL,$message,$subject);
						$mailObj->SendMail($mail_data[0]['email'],$message,$subject);
						echo '<script type="text/javascript">window.location = "'.SITE_URL.'/admin/Candidate/viewUnapprovedCandidates"</script>';
						exit(0);
					}
					else 
					{
						$errmsg = "Selected account has not been successfully approved";
						require_once(COMMON_ROOT."/admin/templates/successError/error.php");
					}
				}
			}
			else
			{
				$errmsg = 'Another user already exists with this username or email address';
			}
		}
		$data = $this->SelectQuery("SELECT * FROM tbl_clients WHERE id = '".$getPostArgs['id']."'", "master");
		$candidatedata = $this->SelectQuery("SELECT * FROM tbl_candidates_data WHERE client_id = '".$getPostArgs['id']."'", "master");
		$cv_data = $this->SelectQuery("SELECT * FROM tbl_candidates_cv_data WHERE candidate_id = '".$getPostArgs['id']."'", "master");
		require_once(COMMON_ROOT."/admin/actions/modules/Candidates/approveCandidate.php");
	}
	
	function editCandidate($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		if(isset($getPostArgs['submit']))
		{
			$checkExists = $this->SelectQuery("SELECT * FROM tbl_clients WHERE (email = '".$getPostArgs['email']."' OR username = '".$getPostArgs['username']."') AND id != '".mysql_real_escape_string($_GET['id'])."'","master");
			if(count($checkExists)==0)
			{
				if($getPostArgs['name']=='') $errmsg .= 'Please provide the full name<br />';
				
				if($getPostArgs['username']=='') $errmsg .= 'Please supply a username<br />';
				if($getPostArgs['address']=='') $errmsg .= 'Please provide the full address<br />';
				if($getPostArgs['phone']=='') $errmsg .= 'Please provide the phone number<br />';
				if($getPostArgs['email']=='') $errmsg .= 'Please provide the email address<br />';
				else
				{
					$errmsg .= Client::check_email_address($getPostArgs['email']);
				}
				if($getPostArgs['education_status']=='') $errmsg .= 'Please provide the education status<br />';
				if($getPostArgs['industry']=='') $errmsg .= 'Please specify the industry/sector<br />';
				if($getPostArgs['dob']=='') $errmsg .= 'Please provide the date of your birth<br />';
				else
				{
					$exploded_dob = explode('-',$getPostArgs['dob']);
					if(!checkdate($exploded_dob[1],$exploded_dob[2],$exploded_dob[0]))
					{
						$errmsg .= 'Date of birth is invalid. Ensure the date of birth is the in the format yyyy-mm-dd (e.g. for 14th December 1980, 1980-11-14)<br />';
					}
				}
				
				if($getPostArgs['gender']=='') $errmsg .= 'Please specify the gender<br />';				
				if($getPostArgs['type_service']=='') $errmsg .= 'Please specify which service they are interested in<br />';									
				
				//Now we check the CV is all OK
				if($getPostArgs['personal_statement']=='') $errmsg .= 'Please provide a personal statement<br />';
				if($getPostArgs['education_training']=='') $errmsg .= 'Please provide the education and any training that has been undertaken<br />';					
				if($getPostArgs['employment_history']=='') $errmsg .= 'Please provide the employment history<br />';					
				if($getPostArgs['reference_1']=='') $errmsg .= 'Please provide full details of the first reference<br />';					
				if($getPostArgs['reference_2']=='') $errmsg .= 'Please provide full details of the second reference<br />';	
				
				if($errmsg=='')
				{					
					$query = $this->ExecQuery("UPDATE tbl_clients SET username='".$getPostArgs['username']."', email='".$getPostArgs['email']."', approved = '1' WHERE id ='" .mysql_real_escape_string($_GET['id']). "'", "master");
					
					$candidate_query = $this->ExecQuery("UPDATE tbl_candidates_data SET name='".$getPostArgs['name']."', address='".$getPostArgs['address']."', phone='".$getPostArgs['phone']."', email='".$getPostArgs['email']."', education_status='".$getPostArgs['education_status']."', industry='".$getPostArgs['industry']."', dob='".$getPostArgs['dob']."', gender='".$getPostArgs['gender']."', ethnic_bg='".$getPostArgs['ethnic_bg']."', type_service='".$getPostArgs['type_service']."', cv_upload='".$getPostArgs['cv_upload']."', approved='1' WHERE client_id='".mysql_real_escape_string($_GET['id'])."'","master");
					
					$cv_query = $this->ExecQuery("UPDATE tbl_candidates_cv_data SET personal_statement='".$getPostArgs['personal_statement']."', education_training='".$getPostArgs['education_training']."', employment_history='".$getPostArgs['education_history']."', reference_1='".$getPostArgs['reference_1']."', reference_2='".$getPostArgs['reference_2']."', additional_skills='".$getPostArgs['additional_skills']."' WHERE client_id = '".mysql_real_escape_string($_GET['id'])."'","master");

					
					//direct to correct output page depending on success of query
					if($query)
					{
						$mail_data = $this->SelectQuery("SELECT * FROM tbl_clients WHERE id='".$getPostArgs['id']."'","master");
						$message = '';
						$message .= 'New account has been successfully approved:<br /><br />';
						$message .= 'First Name : '.$mail_data[0]['first_name'].'<br />';
						$message .= 'Last Name : '.$mail_data[0]['last_name'].'<br />';
		
						$message .= 'Email : '.$mail_data[0]['email'].'<br />';			
						$message .= 'Username : '.$mail_data[0]['username'].'<br />';	
						$subject = 'New Account Approved';
						
						$mailObj = new Mail;
						$mailObj->SendMail(CONTACT_EMAIL,$message,$subject);
						$mailObj->SendMail($mail_data[0]['email'],$message,$subject);
						echo '<script type="text/javascript">window.location = "'.SITE_URL.'/admin/Candidate/viewApprovedCandidates"</script>';
						exit(0);
					}
					else 
					{
						$errmsg = "Selected account has not been successfully approved";
						require_once(COMMON_ROOT."/admin/templates/successError/error.php");
					}
				}
			}
			else
			{
				$errmsg = 'Another user already exists with this username or email address';
			}
		}
		$data = $this->SelectQuery("SELECT * FROM tbl_clients WHERE id = '".$getPostArgs['id']."'", "master");
		$candidatedata = $this->SelectQuery("SELECT * FROM tbl_candidates_data WHERE client_id = '".$getPostArgs['id']."'", "master");
		$cv_data = $this->SelectQuery("SELECT * FROM tbl_candidates_cv_data WHERE candidate_id = '".$getPostArgs['id']."'", "master");
		require_once(COMMON_ROOT."/admin/actions/modules/Candidates/approveCandidate.php");
	}
	
	function searchCandidates($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($_POST);
		if(strlen($getPostArgs['search_field'])<=4)
		{
			$getPostArgs['search_field']='';
		}		
		if($getPostArgs['submit']!='')
		{//Submit is set
			if($getPostArgs['search_field']!='' && $getPostArgs['submit']!='') 
			{
				$where = 'WHERE MATCH (a.personal_statement, a.education_training, a.employment_history, a.reference_1, a.reference_2) AGAINST ("'.$getPostArgs['search_field'].'" IN BOOLEAN MODE) AND a.candidate_id = b.id AND b.approved="1"';
				$_SESSION['cv_search_king']=$where;
			}
			else
			{
				$where = 'WHERE 1=2';
			}
		}
		else
		{//Submit is blank
			if($_GET['paged'] || $_GET['limit'])
			{
				$where = $_SESSION['cv_search_king'];
			}
			else
			{
				$where = 'WHERE 1=2';
			}
		}
	
		$table = "tbl_candidates_cv_data a, tbl_clients b";
		$rsObj = new ResultSetPagination($_GET['limit'], $_GET['cat'], $_GET['paged'], $where, $table, "client", $_GET['page']);
		//$data = $this->SelectQuery("SELECT * FROM ".$table." ".$where,"master");
		$total_pages = $rsObj->total_pages;
		$paged = $rsObj->paged;
		$data = $rsObj->getLimitSet($rsObj->limit_array);	
		
		include(COMMON_ROOT.'client/cv_search_results.php');
	}
	
	function viewCandidate()
	{
		$id = mysql_real_escape_string($_GET['id']);
		$data = $this->SelectQuery("SELECT * FROM tbl_clients WHERE id = '".$id."'", "master");
		$candidatedata = $this->SelectQuery("SELECT * FROM tbl_candidates_data WHERE client_id = '".$id."'", "master");
		$cv_data = $this->SelectQuery("SELECT * FROM tbl_candidates_cv_data WHERE candidate_id = '".$id."'", "master");
		require_once(COMMON_ROOT.'/admin/actions/modules/Candidates/viewCandidate.php');		
	}
	

	
	function viewJobs()
	{	
		if(is_array($getPostArgs))
		{
			$_SESSION['search']['location'] = $getPostArgs['location'];
			$_SESSION['search']['industry'] = $getPostArgs['industry'];
			$_SESSION['search']['jobtype'] = $getPostArgs['jobtype'];
			$_SESSION['search']['experience'] = $getPostArgs['experience'];
			$_SESSION['search']['education'] = $getPostArgs['education'];
		}
		else
		{
			$getPostArgs['location'] = $_SESSION['search']['location'];
			$getPostArgs['industry'] = $_SESSION['search']['industry'];
			$getPostArgs['jobtype'] = $_SESSION['search']['jobtype'];
			$getPostArgs['experience'] = $_SESSION['search']['experience'];
			$getPostArgs['education'] = $_SESSION['search']['education'];
		}		
		$getPostArgs = $this->mysql_real_escape_array($_POST);
		$table = 'tbl_jobs_data';
		$where = 'active="1" ';
		
		if($getPostArgs['location']!='')
		{
			$where .= 'AND location = "'.$getPostArgs['location'].'" ';
		}
		if($getPostArgs['industry']!='')
		{
			$where .= 'AND industry = "'.$getPostArgs['industry'].'" ';
		}
		if($getPostArgs['jobtype']!='')
		{
			$where .= 'AND job_type = "'.$getPostArgs['jobtype'].'" ';
		}
		if($getPostArgs['experience']!='')
		{
			$where .= 'AND years_experience = "'.$getPostArgs['experience'].'" ';
		}
		if($getPostArgs['education']!='')
		{
			$where .= 'AND education_level = "'.$getPostArgs['education'].'" ';
		}
		
		$order = 'date_added DESC';
		$rsObj = new ResultSetPagination($getPostArgs['limit'], $_GET['id'], $getPostArgs['paged'],"WHERE ".$where, $table, 'candidates', 'search_results', 'ORDER BY '.$order,'*');
		$total_pages = $rsObj->total_pages;
		$paged = $rsObj->paged;
		$data = $rsObj->getLimitSet($rsObj->limit_array);
		require_once(COMMON_ROOT.'candidates/templates/job_results.php');
	}
	
	function jobApply($id)
	{
		$id = mysql_real_escape_string($id);
		if($_POST['submit']!='')
		{
			$my_application = $this->SelectQuery("SELECT * FROM tbl_jobs_applications WHERE client_id = '".$_SESSION['client']['user_id']."' AND job_id = '".$id."'","master");
			if(count($my_application)>0)
			{
				$errmsg = 'You have already applied for this position';
			}
			else
			{
				$app_id = $this->InsertQuery("INSERT INTO tbl_jobs_applications (job_id, client_id) VALUES ('".$id."', '".$_SESSION['client']['user_id']."')","master");
				if($app_id)
				{
					$job_data = $this->SelectQuery("SELECT * FROM tbl_jobs_data WHERE id = '".$id."'","master");
					$client_data = $this->SelectQuery("SELECT * FROM tbl_candidates_data WHERE client_id = '".$_SESSION['client']['user_id']."'","master");
										
					$message = '';
					$message .= 'New application has been successfully received:<br /><br />';
					$message .= 'Job ID : '.$id.'<br />';		
					$message .= 'Client ID : '.$client_data[0]['id'].' ('.$client_data[0]['email'].' - '.$client_data[0]['name'].')<br />';		
					$message .= 'Unique Applicant ID : '.$client_data[0]['client_id'].'<br />';
					$subject = 'New Job Application';
						
					$mailObj = new Mail;
					$mailObj->SendMail($client_data[0]['email'],$message,$subject);
					$mailObj->SendMail(CONTACT_EMAIL,$message,$subject);
					$errmsg = 'Successfully applied for position';
				}
				else
				{
					$errmsg = 'There was a problem. Please try again';
				}
			}
		}		
		return $errmsg;		
	}
	
	
	function updateProfile($getPostArgs)
	{
		if(isset($getPostArgs['submit']))
		{
			$checkExists = $this->SelectQuery("SELECT * FROM tbl_clients WHERE (email = '".$getPostArgs['email']."' OR username = '".$getPostArgs['username']."') AND id != '".$_SESSION['client']['user_id']."'","master");
			if(count($checkExists)==0)
			{
				if($getPostArgs['name']=='') $errmsg .= 'Please provide your full name<br />';
				
				if($getPostArgs['username']=='') $errmsg .= 'Please supply a username<br />';
				if($getPostArgs['address']=='') $errmsg .= 'Please provide your full address<br />';
				if($getPostArgs['phone']=='') $errmsg .= 'Please provide your phone number<br />';
				if($getPostArgs['email']=='') $errmsg .= 'Please provide your email address<br />';
				else
				{
					$errmsg .= Client::check_email_address($getPostArgs['email']);
				}
				if($getPostArgs['education_status']=='') $errmsg .= 'Please provide your education status<br />';
				if($getPostArgs['industry']=='') $errmsg .= 'Please specify your industry/sector<br />';
				
				if($getPostArgs['dob']=='') $errmsg .= 'Please provide the date of your birth<br />';
				else
				{
					$exploded_dob = explode('-',$getPostArgs['dob']);
					if(!checkdate($exploded_dob[1],$exploded_dob[2],$exploded_dob[0]))
					{
						$errmsg = 'Date of birth is invalid. Ensure the date of birth is the in the format yyyy-mm-dd (e.g. for 14th December 1980, 1980-11-14)<br />';
					}
				}				
				
				$getPostArgs['dob'] = $getPostArgs['dob_year'].'-'.$getPostArgs['dob_month'].'-'.$getPostArgs['dob_day'];
				//Now we check the CV is all OK
				if($getPostArgs['personal_statement']=='') $errmsg .= 'Please provide a personal statement<br />';
				if($getPostArgs['education_training']=='') $errmsg .= 'Please provide the education and any training that has been undertaken<br />';					
				if($getPostArgs['employment_history']=='') $errmsg .= 'Please provide the employment history<br />';					
				if($getPostArgs['reference_1']=='') $errmsg .= 'Please provide full details of your first reference<br />';					
				if($getPostArgs['reference_2']=='') $errmsg .= 'Please provide full details of your second reference<br />';	
				
				if($errmsg=='')
				{					
					$query = $this->ExecQuery("UPDATE tbl_clients SET username='".$getPostArgs['username']."', email='".$getPostArgs['email']."', approved = '0' WHERE id ='" .$_SESSION['client']['user_id']. "'", "master");
					
					$candidate_query = $this->ExecQuery("UPDATE tbl_candidates_data SET name='".$getPostArgs['name']."', address='".$getPostArgs['address']."', phone='".$getPostArgs['phone']."', email='".$getPostArgs['email']."', education_status='".$getPostArgs['education_status']."', industry='".$getPostArgs['industry']."', dob='".$getPostArgs['dob']."', gender='".$getPostArgs['gender']."', ethnic_bg='".$getPostArgs['ethnic_bg']."', type_service='".$getPostArgs['type_service']."', cv_upload='".$getPostArgs['cv_upload']."', approved='0' WHERE client_id='".$_SESSION['client']['user_id']."'","master");
					
					$cv_query = $this->ExecQuery("UPDATE tbl_candidates_cv_data SET personal_statement='".$getPostArgs['personal_statement']."', education_training='".$getPostArgs['education_training']."', employment_history='".$getPostArgs['education_history']."', reference_1='".$getPostArgs['reference_1']."', reference_2='".$getPostArgs['reference_2']."', additional_skills='".$getPostArgs['additional_skills']."' WHERE client_id = '".$_SESSION['client']['user_id']."'","master");

					
					//direct to correct output page depending on success of query
					if($query)
					{
						$mail_data = $this->SelectQuery("SELECT * FROM tbl_clients WHERE id='".$getPostArgs['id']."'","master");
						$message = '';
						$message .= 'New account requires approval again due to changes in information:<br /><br />';
						$message .= 'Name : '.$getPostArgs['name'].'<br />';
		
						$message .= 'Email : '.$getPostArgs['email'].'<br />';			
						$message .= 'Username : '.$getPostArgs['username'].'<br />';	
						$subject = 'New account requires approval again due to changes in information';
						
						$mailObj = new Mail;
						$mailObj->SendMail(CONTACT_EMAIL,$message,$subject);
						//$mailObj->SendMail($mail_data[0]['email'],$message,$subject);
						$errmsg = 'Your account has been updated. Because of changes in your profile, it will need to be approved by admin again.';
					}
					
				}
			}
			else
			{
				$errmsg = 'Another user already exists with this username or email address';
			}
		}
		return $errmsg;		
	}
	
	function deleteCandidate()
	{
		$id = mysql_real_escape_string($_GET['id']);
		if($_POST['submit']!='')
		{	
			$delete = $this->SelectQuery("DELETE FROM tbl_clients WHERE id = '".$id."'", "master");
			$data = $this->ExecQuery("DELETE FROM tbl_candidates_data WHERE client_id = '".$id."'","master");	
			$cv_data = $this->SelectQuery("DELETE FROM tbl_candidates_cv_data WHERE candidate_id = '".$id."'","master");	
			
			$errmsg = 'Successfully deleted candidate';
			echo '<script type="text/javascript">window.location = "'.SITE_URL.'/admin/Candidate/viewUnapprovedCandidates"</script>';
			exit(0);
		}
		$data = $this->SelectQuery("SELECT * FROM tbl_clients WHERE id = '".$id."'", "master");
		$candidatedata = $this->SelectQuery("SELECT * FROM tbl_candidates_data WHERE client_id = '".$id."'", "master");
		$cv_data = $this->SelectQuery("SELECT * FROM tbl_candidates_cv_data WHERE candidate_id = '".$id."'", "master");
		
		require_once(COMMON_ROOT.'/admin/actions/modules/Candidates/deleteCandidate.php');	
	}
	
	
	
	function __destruct()
	{
		parent::__destruct();
	}

}
?>

