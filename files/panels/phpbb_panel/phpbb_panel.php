<?php
// Get informations about new posts
$forums = array_unique(array_keys(Core::$auth->acl_getf('f_read', true))); //ignored in sql statement to include all topics despite permissions
$forums[] = 0;

$sql = 'SELECT t.*, u.username, u.user_colour 
  			FROM ' . TOPICS_TABLE . ' AS t 
  			INNER JOIN ' . USERS_TABLE . ' AS u ON t.topic_last_poster_id = u.user_id
  			WHERE ' . $db->sql_in_set('forum_id', $forums) . '
				ORDER BY t.topic_last_post_time DESC 
				LIMIT 5';


if ($result = $db->sql_query($sql)) 
{	
	while ($row = $db->sql_fetchrow($result)) 
  {	 
    //if((Core::$user->data['user_id'] == ANONYMOUS) || (Core::$user->data['is_bot']))
    //{
  		// www.phpBB-SEO.com SEO TOOLKIT BEGIN
  		$topic_id = $row['topic_id'];
  		$phpbb_seo->prepare_iurl($row, 'topic', '');
  		$replies = (Core::$auth->acl_get('m_approve', $row['forum_id'])) ? $row['topic_replies_real'] : $row['topic_replies'];
  
  		if (($replies + 1) > $phpbb_seo->seo_opt['topic_per_page']) 
      {
  				$phpbb_seo->seo_opt['topic_last_page'][$topic_id] = floor($replies / $phpbb_seo->seo_opt['topic_per_page']) * $phpbb_seo->seo_opt['topic_per_page'];
  		}
  
  		$last_post_url = append_sid(URL_FORUM . "/viewtopic.$phpEx", 'f=' . $row['forum_id'] . '&amp;t=' . $topic_id . '&amp;start=' . @intval($phpbb_seo->seo_opt['topic_last_page'][$topic_id])) . '#p' . $row['topic_last_post_id'];
  		// www.phpBB-SEO.com SEO TOOLKIT END
		//}
    //else
		//{
    //  $last_post_url = append_sid(URL_FORUM . '/viewtopic.' . $phpEx . '?f=' . $row['forum_id'] . '&amp;t=' . $row['topic_id'] . '&amp;view=unread#unread'); 
    //}
    $this->tpl->assign_block_vars('post', array(
    	'TITLE' => trimlink($row['topic_title'], 50),
    	'POSTER' => get_username_string('full', $row['topic_last_poster_id'], $row['username'], $row['user_colour'], $row['username']),
    	'TIME' => Core::$user->format_date($row['topic_last_post_time']), 
    	'U_LAST_POST' => $last_post_url, 
    ));
  }
  $db->sql_freeresult($result);
  
  $this->tpl->set_filenames(array('body' => 'section_last_posts.html'));
	$this->tpl->display('body');
}
?>