<?php

/**
 * Get the forums we take our topics from
 */
$forum_ids = array_unique(array_keys(Core::$auth->acl_getf('f_read', true))); //ignored in sql statement to include all topics despite permissions

$sql = 'SELECT *
        FROM ' . TOPICS_TABLE . '
        WHERE ' . $db->sql_in_set('forum_id', $forum_ids) . '
        ORDER BY topic_time DESC
        LIMIT 10';
$result = $db->sql_query($sql);

while ($row = $db->sql_fetchrow($result))
{
    $topic_title = stripslashes($row['topic_title']);

    // www.phpBB-SEO.com SEO TOOLKIT BEGIN
    $topic_id = $row['topic_id'];
    $phpbb_seo->prepare_iurl($row, 'topic', '');
    $topic_url = append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . $row['forum_id'] . '&amp;t=' . $topic_id);
    // www.phpBB-SEO.com SEO TOOLKIT END

    $this->tpl->assign_block_vars('topics', array(
        'U_TOPIC' => $topic_url,
        'TOPIC_TITLE' => $topic_title,
    ));
}
$db->sql_freeresult($result);

$this->tpl->set_filenames(array('body' => 'section_last_topics.html'));
$this->tpl->display('body');
?>