<?php
class Input 
{
	public function __construct()
	{
	
	}
	
	public static function get($name, $def, $utf = false)
	{
		return request_var($name, $def, $utf);
	}


}