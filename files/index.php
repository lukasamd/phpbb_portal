<?php
define('IN_PHPBB', true);
define('DIR_BASE', '');


require_once('core.php');




/**
 * Include controller class
 */  
try 
{
	$controller = Core::initModule();
	$controller->execute();
} 
catch (Exception $e) 
{
    $view = Registry::get('Theme');
    $view->outputMessage('404');
}




/**
 * Display debug info, only if debug is enabled
 *  
 */  
if (defined('DEBUG'))
{
	if (!empty($_REQUEST['explain']) && $auth->acl_get('a_') && defined('DEBUG_EXTRA') && method_exists($db, 'sql_report'))
	{
		$db->sql_report('display');
	}
}





