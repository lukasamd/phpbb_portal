<?php

// Locate config.php and set the basedir path
$folder_level = 'forum/';
while (!file_exists($folder_level . 'common.php'))
{
    $folder_level = '../' . $folder_level;
}
define('BASEDIR', $folder_level);


define('IN_PHPBB', true);
$phpbb_root_path = BASEDIR;

$phpEx = substr(strrchr(__FILE__, '.'), 1);
require_once($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();


/**
 * Access control
 */  
/*
if (isset($settings['control_access']) && $settings['control_access'])
{;
    $allowed_groups = array(12, 11, 17, 18, 26);
    if (!in_array($user->data['group_id'], $allowed_groups))
    {
    	trigger_error('Nie masz dostępu do tej strony');
    } 
}
*/


/**
 * Calculate global variables
 */ 
$actual_hour = (int) $user->format_date(time(), 'G');

// Generate logged in/logged out status
if ($user->data['user_id'] != ANONYMOUS)
{
	$u_login_logout = append_sid('http://' . $config['server_name'] . '/ucp.php', 'mode=logout', true, $user->session_id);
	$l_login_logout = sprintf($user->lang['LOGOUT_USER'], $user->data['username']);
}
else
{
	$u_login_logout = append_sid('http://' . $config['server_name'] . '/ucp.php', 'mode=login');
	$l_login_logout = $user->lang['LOGIN'];
}


/**
 * Set templates directory
 */ 
$template->set_custom_template(BASEDIR . 'main/template/', 'SafeGroup');


/**
 * Set global template variables
 */ 
$template->assign_vars(array(
    'CURRENT_YEAR' => date('Y'),
    
    'S_IS_ADMIN'            => ($auth->acl_get('a_') && !empty($user->data['is_registered'])),
    
    'S_USER_LOGGED_IN'		=> ($user->data['user_id'] != ANONYMOUS) ? true : false,
    'S_IS_BOT'				=> (!empty($user->data['is_bot'])) ? true : false,
    'S_USERNAME'			=> $user->data['username'],
    'S_REGISTER_ENABLED'	=> ($config['require_activation'] != USER_ACTIVATION_DISABLE) ? true : false,
    'U_RESTORE_PERMISSIONS'	=> ($user->data['user_perm_from'] && $auth->acl_get('a_switchperm')) ? append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=restore_perm') : '',
    
    // Login-logout link
    'L_LOGIN_LOGOUT'	    => $l_login_logout,
    'U_LOGIN_LOGOUT'		=> $u_login_logout,
    
    // TOP Mods
    'USER_LINK'             => get_username_string('full', $user->data['user_id'], $user->data['username'], '#FFF', $user->data['username']),
    'TOP_WELCOME_MESSAGE'   => ($actual_hour > 18 || $actual_hour < 5) ? $user->lang['TOP_GOOD_NIGHT'] : $user->lang['TOP_GOOD_DAY'],
    'IS_LUKASAMD'           => ($user->data['user_id'] == 293) ? true : false,
));