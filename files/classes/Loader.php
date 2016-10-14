<?php
final class Loader
{
	static private $aInstances;
	
	
	static public function load($object)
	{
		$allow_objects = array('Registry', 'Core', 'Input', 'URLs', 'Theme', 'Comments');

		if (in_array($object, $allow_objects))
		{
			if (!isset(self::$aInstances[$object]))
			{
				$classname = "{$object}";
				self::$aInstances[$object] = new $classname;
			}
			return self::$aInstances[$object];	
		}
		else
		{
			throw new Exception('Invalid class to load');
		}
	}
}