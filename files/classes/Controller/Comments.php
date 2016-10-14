<?php

class Controller_Comments extends Controller
{

    public function __construct()
    {
        parent::__construct();
        define('MODULE', 'lastComments');
    }

    public function execute()
    {
        $urls = Registry::get('URLs');
        $view = Registry::get('Theme');

        $view->setMeta('title', 'Najnowsze komentarze');
        $view->setMeta('description', '');
        $view->setMeta('canonical', 'ostatnie-komentarze.html');
        $view->setOption('panels', 'lastComments');

        $modules[] = array('table' => DB_CONTENT, 'name' => 'aktualności', 'urls' => 'news');
        //$modules[] = array('table' => DB_SOFTWARE, 'name' => 'programy', 'urls' => 'program');


        foreach ($modules as $module)
        {

            $view->tpl->assign_block_vars('module', array(
                'TITLE' => $module['name'],
            ));

            $sql = "SELECT u.*, com.*
			        FROM " . DB_COMMENTS . " AS com 
			        LEFT JOIN " . USERS_TABLE . " AS u ON com.comment_name = u.user_id
			        WHERE comment_spam = 0 
					ORDER BY comment_id DESC LIMIT 10";
            $result = $this->Registry->db->sql_query($sql);
            


            while ($row = $this->Registry->db->sql_fetchrow($result))
            {
                $model = Registry::get('Model');
                $content = $model->Content->getContent(array($row['comment_item_id']));
                foreach ($content as $content);
                $row = array_merge($row, $content);
            
                $row['bbcode_options'] = OPTION_FLAG_BBCODE + OPTION_FLAG_SMILIES + OPTION_FLAG_LINKS;
                $row['comment_message'] = generate_text_for_display($row['comment_message'], $row['comment_bbcode_uid'], $row['comment_bbcode_bitfield'], $row['bbcode_options']);

                if (isset($row['username']))
                {
                    $row['comment_name'] = get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $row['username']);
                }

                $view->tpl->assign_block_vars('module.comment', array(
                    'ID' => $row['comment_id'],
                    'USERAGENT' => $row['comment_useragent'],
                    'MESSAGE' => $row['comment_message'],
                    'AVATAR' => Comments::getAvatar($row),
                    'TITLE' => $row['title'],
                    'URL' => $urls->buildUrl('content', $row),
                    'NAME' => $row['comment_name'],
                    'TIME' => Core::$user->format_date($row['comment_datestamp']),
                ));
            }
            $this->Registry->db->sql_freeresult($result);
        }

        $view->tpl->set_filenames(array('body' => 'page_last_comments.html'));
        $view->tpl->display('body');

        $view->renderPage();
    }

}