<?php
class Extender extends DataBase
{	
	public $type;
	public $resultArray;
	
	function process($type,$mode='normal')
	{
		if($type=='constants')
		{			
			$this->resultArray = $this->extendConstants();
		}
		
		if($mode=='test')
		{
			var_dump($this->resultArray);
			return true;
		}
	}
	function extendConstants()
	{
		$layoutObj = new Layout;
		$constants_array = array(
						   'CONTACT_EMAIL'=>$layoutObj->getSetting('contact_email'),
						   'SHOP_COMPANY_NAME'=>$layoutObj->getSetting('company_name'),
						   'PAYPAL_SECUREID'=>$layoutObj->getSetting('paypal_secureid'),
						   'SHOP_APPROVAL_REQUIRED'=>$layoutObj->getSetting('shop_approval_required'),
						   'EMAIL_FROM'=>$layoutObj->getSetting('email_from'),
							'NAME_FROM'=>$layoutObj->getSetting('name_from'),
							'WEBSITE_DOMAIN'=>$layoutObj->getSetting('website_domain')
						   );
		return $constants_array;
	}
}
?>


