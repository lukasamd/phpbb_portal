<?php
class Config
{
	private static $config;


	public static function setConfigData($array)
	{
		self::$config = $array;
	}

	public static function getConfig($name)
	{
		return self::$config[$name];
	}
}

?>