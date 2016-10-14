<?php
//if (!defined('IN_PHPBB')) exit;

/**
 * Error support (for production only!)
 */
error_reporting(0);
ini_set('log_errors', false);
ini_set('display_errors', false);
$settings['control_access'] = false;
require __DIR__ . '/vendor/autoload.php';


/**
 * Extend include_path
 */
$path = "/usr/home/lukasamd/domains/lukasamd.usermd.net/public_html/";
set_include_path(get_include_path() . PATH_SEPARATOR . $path . PATH_SEPARATOR . "{$path}classes/");
set_include_path(get_include_path() . PATH_SEPARATOR . $path . PATH_SEPARATOR . "{$path}includes/");

//echo get_include_path();
//exit;
/**
 * Integrate with phpBB 
 *  
 */  
$settings['control_access'] = false; 
require_once(DIR_BASE . 'integrator.php');


/**
 * Get config and initialize
 */
require_once('Core.php');
$core = Core::getInstance($config);


/**
 * Check acl-permission if it defined
 */
if (defined('AUTH_CHECK') && !$auth->acl_get(AUTH_CHECK))
{
    trigger_error('NOT_AUTHORISED');
}

