<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/

class Contact extends DataBase
{		
	function processForm($getPostArgs)
	{	
		$errmsg = '';
		$getPostArgs['questions'] = strip_tags($getPostArgs['questions']);
		foreach($_POST as $key => $val)
		{
			$errmsg .= $this->checkValues($key,$val);
		}
		if ($errmsg =='') 
		{
			$id = $this->InsertQuery("INSERT INTO tbl_contact (questions) VALUES ('0')","master");
			foreach($_POST as $key => $val)
			{
				if ($key=='submit')
				{
					$this->SelectQuery("UPDATE tbl_contact SET ip = '".mysql_real_escape_string($_SERVER['REMOTE_ADDR'])."' WHERE id='".mysql_real_escape_string($id)."'","master");
				}
				else
				{
					$this->SelectQuery("UPDATE tbl_contact SET ".mysql_real_escape_string($key)." = '".mysql_real_escape_string($val)."' WHERE id='".mysql_real_escape_string($id)."'","master");
				}
			}
			$mail_data = $this->SelectQuery("SELECT * FROM tbl_contact WHERE id='".$id."'","master");
			
			$errmsg = 'Message successfully received';	
			$message = '';
			$message .= 'New enquiry received:<br /><br />';
			$message .= 'First Name : '.$mail_data[0]['first_name'].'<br />';
			$message .= 'Last Name : '.$mail_data[0]['last_name'].'<br />';
			$message .= 'DateTime : '.$mail_data[0]['date_time'].'<br />';			
			$message .= 'Telephone : '.$mail_data[0]['telephone'].'<br />';			
			$message .= 'Mobile : '.$mail_data[0]['mobile'].'<br />';
			$message .= 'Email : '.$mail_data[0]['email'].'<br />';
			$message .= 'Nature of enquiry : '.$mail_data[0]['nature'].'<br />';
			$message .= 'Questions : '.stripslashes($mail_data[0]['questions']).'<br />';	
			$message .= 'IP : '.$mail_data[0]['ip'].'<br />';			
			$subject = 'New enquiry';
			
			$mailObj = new Mail;
			if($mailObj->SendMail(CONTACT_EMAIL,$message,$subject))
			{
				$errmsg='Enquiry Successfully Received';
			}
			else
			{
				'There was a problem with your enquiry and it has NOT been submitted.';
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
				$errmsg .= 'Please ensure you enter your email address<br />';
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
				$errmsg .= 'Please ensure you enter your telephone number<br />';
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
			else
			{
				if(!ctype_alpha($value))
					$errmsg .= 'Please ensure only valid characters are in your first name<br />';
			}
		}
		else if($field == 'last_name')
		{
			if($value=='')
				$errmsg .= 'Please ensure you enter your last name<br />';
			else
			{
				if(!ctype_alpha($value))
					$errmsg .= 'Please ensure only valid characters are in your last name<br />';
			}
		}
		else if($field == 'mobile')
		{
			if($value!='')
			{
				if(!is_numeric($value)) 
					$errmsg .= 'Please ensure the mobile number is a number<br />';
				if(strlen($value) < 11 || strlen($value) > 11) 
					$errmsg .= 'Please ensure the mobile number has the correct number of digits. Ensure you have included your area code.<br />';
			}			
		}
		else if($field == 'questions')
		{
			if($value=='')
				$errmsg .= 'Please enter a comment or question for us to respond to<br />';
		}
		return $errmsg;
	}
		
	function SendMail($sender,$receiver,$message,$subject)
	{
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-Transfer-encoding: 8bit\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\n";
		$headers .= "X-Priority: 1\n";
		$headers .= "X-MSMail-Priority: High\n";
		$headers .= "X-Mailer: php\n";
		//$headers .= "Content-type: text/html; charset=UTF-8\r\n";
		$headers .= "From: ".$sender."\r\n";
		$headers .= "Bcc: p.tarr@ifc.gb.com"."\r\n";
		return @mail($receiver,$subject,$message,$headers);
	}	
}
?>