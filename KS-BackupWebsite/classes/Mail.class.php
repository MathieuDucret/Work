<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/
class Mail
{
	var $sender;
	var $receiver;
	var $message;
	var $subject;
	var $bcc;
	var $errmsg;
	var $errcount;
	var $check;
	
	function __contruct()
	{
	}
	
	function checkFields($sender,$receiver,$message,$subject,$bcc)
	{
		if($sender!='') $this->sender = $sender;
		else 
		{
			$this->errmsg .= 'No sender supplied<br />';
			$this->errcount++;
		}
		if($receiver!='') $this->receiver = $receiver;
		else 
		{
			$this->errmsg .= 'No receiver supplied<br />';
			$this->errcount++;
		}
		if($message!='') $this->message = $message;
		else 
		{
			$this->errmsg .= 'No message supplied<br />';
			$this->errcount++;
		}
		if($subject!='') $this->subject = $subject;
		else 
		{
			$this->errmsg .= 'No subject supplied<br />';
			$this->errcount++;
		}
		if($bcc!='') $this->bcc = $bcc;
		else 
		{
			$this->errmsg .= 'No bcc supplied<br />';
		}		
		if($this->errcount>0)
		{
			return false;
		}
		else
		{
			$this->check = 1;
			return true;
		}
	}
	
	function SendMail($receiver,$message,$subject,$bcc='',$attachment='',$domain='')
	{
		$data = $this->tokenReplacement($receiver, $subject, $message);
		//This returns a an array with the original message and the message with the replacements
		$message = $data['altered']['message'];
		$subject = $data['altered']['subject'];
		
		//Bits that apply to PEAR and old fashioned mail()
		$message = '<html><head></head><body>' . $message;
		$message = $message . '</body></html>';
		$from = NAME_FROM.' <'.EMAIL_FROM.'>';
		if(include('Mail.php') && include('Mail/mime.php'))
		{ //We have access to the PEAR library
			$text = strip_tags($message);
			$html = $message;
			$crlf = "\r\n";
			$hdrs = array(
						  'From'    => $from,
						  'Subject' => $subject
						  );
			
			$mime = new Mail_mime($crlf);
			
			$mime->setTXTBody($text);
			$mime->setHTMLBody($html);
			if($attachment!='')
			{
				$mime->addAttachment($attachment, 'application/octet-stream');
			}
			if($bcc!='')
			{
				$mime->addBcc($bcc);
			}
			
			//do not ever try to call these lines in reverse order
			$body = $mime->get();
			$hdrs = $mime->headers($hdrs);
			
			$mail =& Mail::factory('mail');
			$mail->send($receiver, $hdrs, $body);
		}
		else
		{ //No PEAR so lets do it the old fashioned way
			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "Content-Transfer-encoding: 8bit\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\n";
			$headers .= "X-Mailer: ICE System\n";
			//$headers .= "Content-type: text/html; charset=UTF-8\r\n";
			$headers .= "From: ".$from." <Info>\r\n";
			if($bcc!='')
			{
				$headers .= "Bcc: ".$bcc."\r\n";
			}	
			return mail($receiver,$subject,$message,$headers);
		}		
		
	}
	
	function tokenReplacement($receiver, $subject, $message)
	{	
		$dbObj = new DataBase;
		$user_data = $dbObj->SelectQuery("SELECT * FROM tbl_clients WHERE email ='".$receiver."'","master");
		if(count($user_data)==0)
		{
			$user_data = $dbObj->SelectQuery("SELECT first_name, last_name FROM tbl_module_newsletter_users WHERE email='".$receiver."'","master");
			if(count($user_data)==0)
			{
				$data['original']['message'] = $message;
				$data['original']['subject'] = $subject;
				$data['altered']['message'] = $message;
				$data['altered']['subject'] = $subject;
				return $data;
			}
		}
		
		//$user_data = $dbObj->SelectQuery("(SELECT * FROM tbl_clients WHERE email ='".$receiver."') UNION (SELECT first_name, last_name FROM tbl_module_newsletter_users WHERE email='".$receiver."') LIMIT 0,1","master");
		
		$unsubscribe = '<a href="http://www.'.WEBSITE_DOMAIN.'/newsletter/unsubscribe/'.md5('sAldjf367gxbzfsdhf'.$receiver).'/">Click here to opt-out of future mailings</a>';
		
		//Original data
		$data['original']['message'] = $message;
		$data['original']['subject'] = $subject;
		$data['altered']['message'] = $message;
		$data['altered']['subject'] = $subject;
		
		//Message replaces
		$data['altered']['message'] = str_replace('%FIRST_NAME%', $user_data[0]['first_name'], $data['altered']['message']);
		$data['altered']['message'] = str_replace('%LAST_NAME%', $user_data[0]['last_name'], $data['altered']['message']);
		$data['altered']['message'] = str_replace('%USERNAME%', $user_data[0]['username'], $data['altered']['message']);
		$data['altered']['message'] = str_replace('%PASSWORD%', $user_data[0]['pas0'], $data['altered']['message']);
		
		$data['altered']['message'] = str_replace('%UNSUBSCRIBE_LINK%', $unsubscribe , $data['altered']['message']);
		//Subject replaces
		$data['altered']['subject'] = str_replace('%FIRST_NAME%', $user_data[0]['first_name'], $data['altered']['subject']);
		$data['altered']['subject'] = str_replace('%LAST_NAME%', $user_data[0]['last_name'], $data['altered']['subject']);		
		
		return $data;
	}
	
}