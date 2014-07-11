<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0
* 24/11/09 
*****************************************/
//class used in admin panel
class Client extends DataBase
{
	function __construct()
	{
		parent::__construct();
	}
	
	function checkLogin($getPostArgs)
	{		
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		$errmsg = '';
		if (isset($getPostArgs['username']))
		{
			$checkUser = $this->SelectQuery("SELECT * FROM tbl_clients WHERE (username = '".$getPostArgs['username']."' OR email = '".$getPostArgs['username']."') AND password = '".md5($getPostArgs['password'])."'","master");
			if(count($checkUser)>0)
			{
				if($checkUser[0]['approved']!='1')
				{
					$errmsg = 'Your account is pending approval. Please try again shortly';
				}
				else
				{
					return $this->createSession($_POST);			
				}
			}
			else
			{
				$errmsg = 'Your user information is invalid. Please try again.';
			}
		}
		else
		{
			$errmsg = 'Please provide your login details and try again.';
		}
		return $errmsg;
	}
	
	function clientLogout()
	{
		unset($_SESSION['client']);
		if(isset($_COOKIE[session_name()])) 
		{
			setcookie(session_name(), '', time()-42000, '/');
		}	
		// Finally, destroy the session.
		session_destroy();		
		//echo "username value = " . $_SESSION['admin']['user'];		
		$URL="/";
		echo '<script type="text/javascript">
        window.location = "'.SITE_URL.'";
        </script>';
	}
	
	
	function createSession($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		$data = $this->SelectQuery("SELECT * FROM tbl_clients WHERE (username = '".$getPostArgs['username']."' OR email = '".$getPostArgs['username']."') AND password = '".md5($getPostArgs['password'])."'","master");
		$_SESSION['client']['username'] = $data[0]['username'];
		$_SESSION['client']['user_id'] = $data[0]['id'];
		$_SESSION['client']['clientgroupid'] = $data[0]['clientgroupid'];
		if($_SESSION['proceed']==1)
		{
			echo '<script type="text/javascript">
			window.location = "'.SITE_URL.'/shop/process_payment";
			</script>';
		}
		else
		{
			echo '<script type="text/javascript">
			window.location = "'.SITE_URL.'";
			</script>';
		}
	}
	
	function checkSession()
	{
		$getPostArgs = $_SESSION;
		if(isset($_SESSION['client']))
		{
			return true;
		}
		else
		{

			echo '<script type="text/javascript">
        window.location = "'.SITE_URL.'/must_be_loggedin";
        </script>';
		}
	}
			
	
	function forgotPassword($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		$checkExists = $this->SelectQuery("SELECT * FROM tbl_clients WHERE email = '".$getPostArgs['email']."'","master");
		if(count($checkExists)>0)
		{
			$mail_data = $this->SelectQuery("SELECT * FROM tbl_clients WHERE id='".$checkExists[0]['id']."'","master");
			
			
			$message = '';
			$message .= 'Your account details are as follows:<br /><br />';
			$message .= 'Username : '.$mail_data[0]['username'].'<br />';	
			$message .= 'Password : '.$mail_data[0]['pas0'].'<br />';
			$message .= '<br /><br /><a href="'.SITE_URL.'">Click here to login</a>';
			$subject = 'User details request from '.SITE_DOMAIN;
			
			$mailObj = new Mail;			
			if($mailObj->SendMail($mail_data[0]['email'],$message,$subject))
			{
				$errmsg = 'Your username and  password have been emailed to you.';	
			}
			else
			{
				$errmsg = 'There has been a problem with the mail system';
			}
				
			return $errmsg;
		}
		else
		{
			$errmsg = 'There is no account linked to your email address, please check your email address - if you are a new user please register';
			return $errmsg;
		}
	}
	
	function registerUser($getPostArgs)
	{	
		$errmsg = '';
		
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		$checkExists = $this->SelectQuery("SELECT * FROM tbl_clients WHERE username = '".$getPostArgs['username']."' OR email = '".$getPostArgs['email']."'","master");
		if(count($checkExists)>0)
		{
			$errmsg = 'User already exists with this username or email';
			return $errmsg;
		}
			
		foreach($_POST as $key => $val)
		{
			$errmsg .= $this->checkValues($key,$val);
		}
		if ($errmsg =='') 
		{
			unset($_POST['confirm_password']);
			$id = $this->InsertQuery("INSERT INTO tbl_clients (approved) VALUES ('".SHOP_APPROVAL_REQUIRED."')","master");
			foreach($_POST as $key => $val)
			{
				if ($key=='submit')
				{					
				}
				else if($key=='password')
				{
					$this->SelectQuery("UPDATE tbl_clients SET password = MD5('".mysql_real_escape_string($val)."'), pas0 = '".mysql_real_escape_string($val)."' WHERE id='".$id."'","master");
				}
				else
				{
					$this->SelectQuery("UPDATE tbl_clients SET ".mysql_real_escape_string($key)." = '".mysql_real_escape_string($val)."' WHERE id='".$id."'","master");
				}
			}
			$mail_data = $this->SelectQuery("SELECT * FROM tbl_clients WHERE id='".$id."'","master");
			$message = '';
			if(SHOP_APPROVAL_REQUIRED==0)
			{
				$errmsg = 'Once your registration is approved your user name and password details will be emailed to you. Note - we may contact you to confirm your details as part of the approval process.';	
				$message .= 'New account submitted for approval:<br /><br />';
				$subject = 'New Account Awaiting Approval';
			}
			else
			{
				$errmsg = 'Your registration has been successfully processed';
				$message .= 'Your account has been created<br /><br />';
				$subject = 'New Account Created';
			}

			$message .= 'First Name : '.$mail_data[0]['first_name'].'<br />';
			$message .= 'Last Name : '.$mail_data[0]['last_name'].'<br />';	
			$message .= 'Email : '.$mail_data[0]['email'].'<br />';			
			if(isset($mail_data[0]['company']))
			{
				$message .= 'Company : '.$mail_data[0]['company'].'<br />';
			}
			$message .= 'Username : '.$mail_data[0]['username'].'<br />';	

			
			$mailObj = new Mail;
			$mailObj->SendMail($mail_data[0]['email'],$message,$subject,CONTACT_EMAIL);
			if($_SESSION['proceed']==1)
			{
				echo '<script type="text/javascript">
				window.location = "'.SITE_URL.'/shop/process_payment";
				</script>';
			}
		}
		
		return $errmsg;
	}
	
	function check_email_address($email) 
	{
		if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) 
		{
			return 'Email address in incorrect format 1<br />';
		}
		$email_array = explode("@", $email);
		$local_array = explode(".", $email_array[0]);
		for ($i = 0; $i < sizeof($local_array); $i++) 
		{
			if(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&?'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",$local_array[$i])) 
			{
			  return 'Email address in incorrect format 2<br />';
			}
		}
		if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) 
		{
			$domain_array = explode(".", $email_array[1]);
			if (sizeof($domain_array) < 2) 
			{
				return 'Email address in incorrect format 3'; // Not enough parts to domain
			}
		}
	}
	
	function checkValues($field,$value)
	{
		$errmsg = '';
		if($field == 'email')
		{
			if($value=='')
				$errmsg .= 'Please ensure you enter an email address<br />';
			else
			{
				if(count($this->SelectQuery("SELECT * FROM tbl_contact WHERE email = '".$value."'","master"))>0)
				{
					$errmsg = 'An enquiry already exists with this email address<br />';
				}
				else if($this->check_email_address($value)!='')
					$errmsg .= $this->check_email_address($value);
			}
		}		
		else if($field == 'telephone')
		{
			if($value=='')
				$errmsg .= 'Please ensure you enter a telephone number<br />';
			else
			{
				if(!is_numeric($value)) 
					$errmsg .= 'Please ensure the telephone number is a number<br />';
				if(strlen($value) < 11 || strlen($value) > 11) 
					$errmsg .= 'Please ensure the telephone number has the correct number of digits. Ensure you have included your area code.<br />';
			}
			
		}
		else if($field == 'first_name')
		{
			if($value=='')
				$errmsg .= 'Please ensure you enter your first name<br />';
			if(preg_match('/[^a-zA-Z0-9- ]/',$value,$matches))
			{
				$errmsg .= 'Invalid characters were found in your first name<br />';
			}
		}
		else if($field == 'last_name')
		{
			if($value=='')
				$errmsg .= 'Please ensure you enter your last name<br />';
			if(preg_match('/[^a-zA-Z0-9- ]/',$value,$matches))
			{
				$errmsg .= 'Invalid characters were found in your last name<br />';
			}
		}
		else if($field == 'title')
		{
			if($value=='')
				$errmsg .= 'Please ensure you enter a title<br />';
			else
			{
				if(!ctype_alpha($value))
					$errmsg .= 'Please ensure only valid characters are in the title<br />';
			}
		}		
		else if($field == 'username')
		{
			if($value=='')
				$errmsg .= 'Please ensure you enter a username<br />';
		}
		else if($field == 'ouc')
		{
			if($value=='')
				$errmsg .= 'Please ensure you enter an OUC<br />';
		}	
		else if($field == 'job_title')
		{
			if($value=='')
				$errmsg .= 'Please ensure you enter your job title<br />';
		}			
		else if($field == 'address')
		{
			if($value=='')
				$errmsg .= 'Please ensure you enter an address<br />';
		}		
		else if($field == 'postcode')
		{
			if($value=='')
				$errmsg .= 'Please ensure you enter a postcode<br />';
		}			
		else if($field == 'mobile')
		{
			if($value!='')
			{
				if(!is_numeric($value)) 
					$errmsg .= 'Please ensure the mobile number is a number<br />';
				if(strlen($value) < 11 || strlen($value) > 11) 
					$errmsg .= 'Please ensure the mobile number has the correct number of digits. Ensure you have included the area code.<br />';
			}			
		}
		else if($field == 'questions')
		{
			if($value=='')
				$errmsg .= 'Please enter a comment or question for us to respond to<br />';
		}
		else if($field == 'password')
		{
			if($value=='')
				$errmsg .= 'Please ensure you enter a password<br />';
			if($value!=$_POST['confirm_password'])
				$errmsg .= 'You must ensure you have entered your password correctly twice<br />';
		}
		else if($field == 'reference')
		{
			if($value=='')
				$errmsg .= 'Please ensure you enter a reference<br />';
		}
		else if($field == 'taken_by')
		{
			if($value=='')
				$errmsg .= 'Please ensure you enter the name of whoever took the order<br />';
		}	
		return $errmsg;
	}	
	
	function updateUser($getPostArgs,$id)
	{ 
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);
		

		
		if(isset($getPostArgs['submit']))
		{	
			$checkExists = $this->SelectQuery("SELECT * FROM tbl_clients WHERE (username = '".$getPostArgs['username']."' OR email = '".$getPostArgs['email']."') AND id != '".$id."'","master");
			
			if(count($checkExists)>0)
			{
				$errmsg = 'User already exists with this username or email';
				return $errmsg;
			}
			foreach($_POST as $key => $val)
			{
				if($key=='password') continue;
				$errmsg .= $this->checkValues($key,$val);
			}
			if ($errmsg =='') 
			{
				if($getPostArgs['password']!='') $password = ', password = "'.md5($getPostArgs['confirm_password']).'", pas0 = "'.$getPostArgs['confirm_password'].'"';
				$query = $this->SelectQuery("UPDATE tbl_clients SET username ='". $getPostArgs['username'] . "',  email ='" .$getPostArgs['email'] ."'".$password.",  first_name = '".$getPostArgs['first_name']."', title = '".$getPostArgs['title']."', last_name = '".$getPostArgs['last_name']."', company = '".$getPostArgs['company']."' WHERE id ='" .$id. "'", "master");
					
	
				if (is_array($query))
				{
					$errmsg = "Your account has been successfully edited";
					
				}
				else 
				{
					$errmsg = "A problem occurred and your account has not been updated";			
				}
			}
			else
			{
				return $errmsg;
			}
		}
	}
	
	function addJob($getPostArgs)
	{
		$getPostArgs = $this->mysql_real_escape_array($getPostArgs);		
		if(isset($getPostArgs['submit']))
		{	
			if($getPostArgs['job_title']=='') $errmsg .= 'Please supply a job title<br />';
			if($getPostArgs['location']=='') $errmsg .= 'Please supply a location<br />';
			if($getPostArgs['industry']=='') $errmsg .= 'Please select an industry<br />';
			if($getPostArgs['job_type']=='') $errmsg .= 'Please select a job type<br />';
			if($getPostArgs['years_experience']=='') $errmsg .= 'Please select the number of years experience required<br />';
			if($getPostArgs['education_level']=='') $errmsg .= 'Please select a required education level<br />';
			if($getPostArgs['job_description']=='') $errmsg .= 'Please supply a job description<br />';
			if($getPostArgs['salary']=='') $errmsg .= 'Please supply a salary/remuneration/compensation<br />';
			
			if(stristr($getPostArgs['job_title'],'@')) $errmsg .= 'Please do not supply email addresses in the job title field';
			if(stristr($getPostArgs['job_description'],'@')) $errmsg .= 'Please do not supply email addresses in the description field';
			
			if($errmsg=='')
			{
				$this->InsertQuery("INSERT INTO tbl_jobs_data (client_id, job_title, location, industry, job_type, years_experience, education_level, salary, job_description, active) VALUES ('".$_SESSION['client']['user_id']."', '".$getPostArgs['job_title']."', '".$getPostArgs['location']."', '".$getPostArgs['industry']."', '".$getPostArgs['job_type']."', '".$getPostArgs['years_experience']."', '".$getPostArgs['education_level']."', '".$getPostArgs['salary']."', '".$getPostArgs['job_description']."', '".$getPostArgs['visible']."')");
				$errmsg = 'Job added successfully';
			}
			return $errmsg;
		}
	}
	
	function updateJob($id)
	{
		$id = mysql_real_escape_string($_GET['id']);
		$getPostArgs = $this->mysql_real_escape_array($_POST);		
		if(isset($getPostArgs['submit']))
		{
			$checkOwner = $this->SelectQuery("SELECT * FROM tbl_jobs_data WHERE id = '".$id."' AND client_id = '".$_SESSION['client']['user_id']."'","master");
			if(count($checkOwner)==0)
			{
				$errmsg = 'This job does not belong to you';
				return $errmsg;
			}
			if($id=='') $errmsg .= 'Please supply a job id';
			if($getPostArgs['job_title']=='') $errmsg .= 'Please supply a job title<br />';
			if($getPostArgs['location']=='') $errmsg .= 'Please supply a location<br />';
			if($getPostArgs['industry']=='') $errmsg .= 'Please select an industry<br />';
			if($getPostArgs['job_type']=='') $errmsg .= 'Please select a job type<br />';
			if($getPostArgs['years_experience']=='') $errmsg .= 'Please select the number of years experience required<br />';
			if($getPostArgs['education_level']=='') $errmsg .= 'Please select a required education level<br />';
			if($getPostArgs['job_description']=='') $errmsg .= 'Please supply a job description<br />';
			if($getPostArgs['salary']=='') $errmsg .= 'Please supply a salary/remuneration/compensation<br />';
			
			if($errmsg=='')
			{
				$this->InsertQuery("UPDATE tbl_jobs_data SET job_title='".$getPostArgs['job_title']."', location='".$getPostArgs['location']."', industry='".$getPostArgs['industry']."', job_type='".$getPostArgs['job_type']."', years_experience='".$getPostArgs['years_experience']."', education_level='".$getPostArgs['education_level']."', job_description='".$getPostArgs['job_description']."', active='".$getPostArgs['visible']."', salary='".$getPostArgs['salary']."', date_added = NOW() WHERE id = '".mysql_real_escape_string($_GET['id'])."'");
				$errmsg = 'Job updated successfully';
			}
			return $errmsg;
		}
	}
	
	function clientJobs()
	{
		$data = $this->SelectQuery("SELECT * FROM tbl_jobs_data WHERE client_id = '".$_SESSION['client']['user_id']."' ORDER BY date_added DESC","master");		
		return $data;
	}
		
	function countApplicants($id)
	{
		$data = $this->SelectQuery("SELECT COUNT(*) as cnt FROM tbl_jobs_applications WHERE job_id = '".$id."'","master");
		return $data[0]['cnt'];
	}
		
	
	
	function __destruct()
	{
		parent::__destruct();
	}

}
?>

