<?php
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_reputation.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);





if ($user->data['user_id'] == 293)
{
    echo time() - 3600 * 24 * 30;
    exit;


    $sql = "SELECT user_reputation_notify
            FROM " . USERS_TABLE . "
            WHERE user_id = '1106'";
    $result = $db->sql_query($sql);
    $user_notify = (int) $db->sql_fetchfield('user_reputation_notify');
  
    if (!$user_notify)
    {
        echo 'TEST';
    }
    exit;


    include($phpbb_root_path . 'includes/acp/auth.' . $phpEx);
    $auth_admin = new auth_admin();
    
    $auth_admin->acl_add_option(array(
        'local'     => array(),
        'global'    => array('u_other_lab', 'u_other_img')
    ));



    //resync_user_reputation(4437);
    exit;

    /*
    // Setup $auth_admin class so we can add permission options
    include($phpbb_root_path . 'includes/acp/auth.' . $phpEx);
    $auth_admin = new auth_admin();
    
    // Add permissions
    $auth_admin->acl_add_option(array(
        'local'      => array(),
        'global'   => array('u_malware_access'),
    ));
    */
    
    
    //if ($auth->acl_get('u_malware_access'))
    //{
    //    echo 'JEB!';
    //}
    
    
    $sql = 'SELECT *
            FROM ' . USERS_TABLE . "
            WHERE user_id = '5811'";
    $result = $db->sql_query($sql);
    $user_session = $db->sql_fetchrow($result);
    
    
    $auth->acl($user_session);
    echo 'die!';
    
    if ($auth->acl_get('u_malware_access'))
    {
        echo 'JEB!';
    }


    //resync_user_reputation(356);
    
    /*
    $from_id = $user->data['user_id']; 
    $to_id = 1813; 
    $text = "Videotesty dla kanału SafeGroup"; 
    $value = 20;
    
    $sql = 'INSERT INTO ' . REPUTATION_TABLE . ' ' . $db->sql_build_array('INSERT', array(
            'user_id'	=> $from_id,
            'post_id'	=> 0,
            'poster_id'	=> $to_id,
            'topic_id'	=> 0,
            'forum_id'	=> 0,
            'add_time'	=> time(),
            'value'     => $value,
            'text' => $text, 
    ));
    */
    
    //
    //$db->sql_query($sql);
    
    
    // Resync reputation counter
    //resync_user_reputation($to_id);
    
    // Send pm to user 
    //send_reputation_pm($from_id, $to_id, 0, $value, $text);
    
    
    // Password test


}
?>