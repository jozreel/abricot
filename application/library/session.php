<?php
class ab_session
{
	
	public function session_start()
	{
		session_start();
	}
	
	public function session_destroy()
	{
		session_destroy();
	}
	
	public function set_session_vars($var, $key = '')
	{
		if(is_array($var))
		{
			
			$a = session_id();
			if(!empty($a))
			foreach($var as $key=>$val)
			{
				{
				   $_SESSION[$key]=$val;
				}
			}
		
		}
		else
		{if(!empty($key)&& !empty($val))
			$_SESSION[$key]=$val;
		}
	}
}