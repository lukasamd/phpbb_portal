<?php

class Core
{
    /** 
    * Private - user class
    *
    */
    public static $user;
    public static $auth;


	/**
	 * Object instance
	 */
	private static $instance;


	/**
	 * Constructor - register autoloader
	 */
	private function __construct($config)
	{
		// Init loader
        define('DIR_CLASSES', DIR_BASE . 'classes/');
		spl_autoload_register(array($this, 'loader'));
    
		// Set all config
		Config::setConfigData($config);
    
		// Load all constats & functions
		require_once(DIR_BASE . 'includes/constants.php');
		require_once(DIR_INCLUDES . 'functions.php');

        // Start session management
        self::$user = Registry::get("user");
        self::$auth = Registry::get("auth");

        // Enable buffering 
        ob_start();
	}

	

	/**
	 * Instance getter - get class instance (Singleton)
	 * 
	 * @return object Class instance		 	 
	 */
	public static function getInstance($config)
	{
		if (empty(self::$instance))
		{
			self::$instance = new Core($config);
		}

		return self::$instance; 
	} 

	 
	/**
	 * Automatic classes loader
	 * 	 
	 * @param $classname Class to load 
	 */	 
	public function loader($classname)
	{
		$classname_down = strtolower($classname);

		if (!class_exists($classname) && $classname != $classname_down)
		{
			$file = str_replace("_", DIRECTORY_SEPARATOR, $classname);
			$file = DIR_CLASSES . "{$file}.php";
			if (is_file($file)) require_once($file);
		}
	}	
    
    
    public function initModule()
    {
        $module = Input::get('module', 'Content'); 
        if (!strstr($module, '_'))
        {
        	$module = "Controller_{$module}";
        }
    
        if (!class_exists($module))
        {
            throw new Exception('Division by zero.');
        }
        else
        {
            return new $module;
        }
    }
}