<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/

class callbackHandler {
	
	public $errmsg;		
	public $status; //Set this to 1 if successful so we can kill dialog windows
	
	private static $_instance;
 
    public static function getInstance() 
    {
        if (!(self::$_instance instanceof self))
        {
            self::$_instance = new self();
        }
 
        return self::$_instance;
    }
 
    // Do not allow an explicit call of the constructor: $v = new Singleton();
    final private function __construct() { }
 
    // Do not allow the clone operation: $x = clone $v;
    final private function __clone() { }

	function ajaxCallback($buffer)
	{						
		if($this->errmsg!='')
		{
			return $this->errmsg;
		}
		else
		{
			return $buffer;
		}
	}
}
?>