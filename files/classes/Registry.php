<?php
class Registry
{
	/**
	 * Objects instances
	 */
	private static $aInstances;

	/**
	 * Allowed phpBB classes
	 */	 	
	private static $aObjectPhpBB = array('auth', 'db', 'user', 'template');
    private static $phpBBAlreadyLoaded = false;
	
	/**
	 * Constructor - load all phpBB classes
	 */
	public function __construct()
	{
		self::loadBBClasses();
	}	 
  
	/**
	 * Load phpBB classes
	 */
	private static function loadBBClasses()
	{
    if (!self::$phpBBAlreadyLoaded)
    {  
  		foreach (self::$aObjectPhpBB as $class)
  		{
  			global $$class;
  
  			self::$aInstances[$class] = $$class;
  		}
      
      self::$phpBBAlreadyLoaded = true;
    }
	}	 
   
	
	/**
	 * Get class using singleton
	 * 	 
	 * @param $classname Class to load
	 * @return object Loaded class	 	 
	 */	 	 
	public function __get($classname)
	{
		if (!isset(self::$aInstances[$classname]))
		{
			self::$aInstances[$classname] = new $classname;
		}

		return self::$aInstances[$classname];
	}
  
  
  public static function get($classname)
  {
		if (!isset(self::$aInstances[$classname]))
		{
			self::$aInstances[$classname] = new $classname;
		}
    self::loadBBClasses();
    
    return self::$aInstances[$classname];
  }
}