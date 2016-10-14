<?php



class Comments extends Controller

{

    // Comment item data

    public $item = array();

    

    // Single comment data

    private $comment = array();

    

    // Error for backend

    private $errors = array();

    

    // Reply for ajax

    private $reply = array();

    

    // Alis to check is user guest

    private $isGuest = 0;

    

    // Status of view comments

    private $statusView = false;

    

    // Status of new comments

    private $statusAllow = false;

    

    // Local cache for logged in

    private $commentersData = array();

    

    // Key for comment form

    private $formKey = 'comments';



    /**

     * Comments class constructor, initialize data 

     * 

     */

    public function __construct()

    {

        parent::__construct();



        $this->item['id'] = Input::get('id', 0);

        $this->item['ajax'] = 0;

        $this->item['data'] = array();



        $this->isGuest = (Core::$user->data['user_id'] == ANONYMOUS) ? 1 : 0;



        $this->reply['info'] = '';

    }



    /**

     * Setter for item id setting

     * @param int $id    

     * 

     */

    public function setItem($id)

    {

        $this->item['id'] = $id;

    }



    /**

     * Setter for comment id

     * @param int $id    

     * 

     */

    public function setComment($id)

    {

        $this->comment['comment_id'] = $id;

    }



    public function setStatus($status)

    {

        if (isset($status['view']))

        {

            $this->statusView = $status['view'];

        }

        if (isset($status['allow']))

        {

            $this->statusAllow = $status['allow'];

        }

    }



    /**

     * Setter for ajax setting 

     * @param string $ajax    

     * 

     */

    public function setAjax($ajax)

    {

        $this->item['ajax'] = $ajax;

    }



    /**

     * Prepare comments to display and send data to view   

     * 

     */

    public function showComments()

    {

        $view = Registry::get('Theme');



        if (!$this->statusView)

        {

            return;

        }



        $this->resetCommentData();



        if ($this->statusAllow)

        {

            if (isset($_POST['commentSubmit']))

            {

                $this->insertComment();

            }

            $this->showCommentForm();

        }



        $sql_ary = array(

            'comment_item_id' => $this->item['id'],

            'comment_spam' => 0,

        );



        $sql = 'SELECT tc.*, tu.user_id, tu.username, tu.user_colour, tu.user_avatar, tu.user_avatar_type, tu.user_avatar_width, tu.user_avatar_height 

    			FROM ' . DB_COMMENTS . ' AS tc

    			LEFT JOIN ' . USERS_TABLE . ' AS tu ON tc.comment_name = tu.user_id

                WHERE ' . $this->Registry->db->sql_build_array('SELECT', $sql_ary) . '

                ORDER BY comment_datestamp';

        $result = $this->Registry->db->sql_query($sql);



        $commentCounter = 0;

        while ($row = $this->Registry->db->sql_fetchrow($result))

        {

            $commentCounter++;



            // Get logged name and avatar from local cache

            if (!$row['comment_guest'])

            {

                // Build cache if needed

                if (!isset($this->commentersData[$row['user_id']]))

                {

                    $this->commentersData[$row['user_id']] = array(

                        'NAME' => get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $row['username']),

                        'AVATAR' => $this->getAvatar($row),

                    );

                }

            

                $row['comment_name'] = $this->commentersData[$row['user_id']]['NAME'];

                $row['comment_avatar'] = $this->commentersData[$row['user_id']]['AVATAR'];

            }

            else

            {

                $row['comment_avatar'] = $this->getAvatar($row);

            }

            

            $row['comment_bbcode'] = $row['comment_smilies'] = 0;

            $row['bbcode_options'] = (($row['comment_bbcode']) ? OPTION_FLAG_BBCODE : 0) + (($row['comment_smilies']) ? OPTION_FLAG_SMILIES : 0) + (($row['comment_magic_url']) ? OPTION_FLAG_LINKS : 0);



            $view->tpl->assign_block_vars('comment', array(

                'ID' => $row['comment_id'],

                'NAME' => $row['comment_name'],

                'AVATAR' => $row['comment_avatar'],

                'MESSAGE' => generate_text_for_display($row['comment_message'], $row['comment_bbcode_uid'], $row['comment_bbcode_bitfield'], $row['bbcode_options']),

                'U_REPORT' => $this->buildReportLink($row),

                'TIME' => Core::$user->format_date($row['comment_datestamp']),

                'TIME_SEO' => date('c', $row['comment_datestamp']),

                'USERAGENT' => $row['comment_useragent'],

            ));

        }



        $view->tpl->assign_vars(array(

            'A_CAN_EDIT' => Core::$auth->acl_get('u_sg_portal_comments'),

            'U_ACPLINK' => URLs::ACP('comments', array("action=display", "comment_item_id={$this->item['id']}")),

            'S_USER_LOGGED_IN' => !$this->isGuest,
            'COMMENT_ITEM_ID' => $this->item['id'],
            'COMMENT_COUNTER' => $commentCounter,

        ));



        $this->Registry->db->sql_freeresult($result);



        $view->tpl->set_filenames(array('body' => 'comment_list.html'));

        $view->tpl->display('body');

    }



    /**

     * Prepare comment form to display and send data to view   

     * 

     */

    private function showCommentForm()

    {

        $view = Registry::get('Theme');



        $view->tpl->assign_vars(array(

            'COMMENT_FORM' => true,

            'A_CAN_EDIT' => Core::$auth->acl_get('u_sg_portal_comments'),

            'COMMENT_MESSAGE' => $this->comment['message'],

            'COMMENT_AUTHOR' => $this->comment['author'],
            'S_COMMENT_AUTHOR' => ($this->comment['author']) ? true : false,

            'ITEM_ID' => $this->item['id'],
            
            'FORM_ACTION' => htmlspecialchars($_SERVER['REQUEST_URI']),

            'INFO_OK' => ($this->reply['info'] != '') ? $this->reply['info'] : false,

            'INFO_ERROR' => !empty($this->errors),

        ));

        add_form_key($this->formKey);





        // Comment errors

        if (!empty($this->errors))

        {

            foreach ($this->errors as $error)

            {

                $view->tpl->assign_block_vars('error', array('ERROR' => $error));

            }

        }

    }



    /**

     * Build link to report comment be registered members

     * @return string Report link      

     * 

     */

    private function buildReportLink($row)

    {

        $link = '';

        if (!$this->isGuest && $row['comment_reported'] == 0)

        {

            $urls = Registry::get('urls');

            $urls->newUrl('index.php');

            $urls->addToUrl('module', 'Comment_Report');

            $urls->addToUrl('comment_id', $row['comment_id']);

            $href = $urls->getUrl();

            $link = '<span class="commentReport"><a href="' . $href . '"><img src="images/icons/icon_report.png"></a></span>';

        }



        return $link;

    }



    /**

     * Insert new comment - validate data, validate censor etc.   

     * 

     */

    public function insertComment()

    {
        if (!$this->isItemExist())

        {

            return;

        }



        $this->comment = array(

            'message' => utf8_normalize_nfc(request_var('commentMessage', '', true)),

            'author' => ($this->isGuest) ? utf8_normalize_nfc(request_var('commentEmail', '', true)) : Core::$user->data['user_id'],
            'email' => ($this->isGuest) ? utf8_normalize_nfc(request_var('commentNick', '', true)) : Core::$user->data['user_id'],
            
            'ip' => Core::$user->ip,

            'spam' => 0,

        );



        $this->validateComment();

        $this->checkCensor();

        //$this->checkSpam();



        if (empty($this->errors))

        {

            $uid = $bitfield = $options = '';

            $allow_bbcode = $allow_smilies = false;

            $allow_urls = true;

            generate_text_for_storage($this->comment['message'], $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies);

            $sql_ary = array(

                'comment_item_id' => $this->item['id'],
                
                'comment_guest' => ($this->isGuest) ? 1 : 0,

                'comment_name' => $this->comment['author'],

                'comment_email' => md5(mb_strtolower(trim($this->comment['email']))),

                'comment_message' => $this->comment['message'],

                'comment_bbcode_uid' => $uid,

                'comment_bbcode_bitfield' => $bitfield,

                'comment_magic_url' => 1,

                'comment_bbcode' => 0,

                'comment_smilies' => 0,

                'comment_datestamp' => time(),

                'comment_ip' => $this->comment['ip'],

                'comment_spam' => $this->comment['spam'],

                'comment_useragent' => sg_trim($_SERVER['HTTP_USER_AGENT'], 250, true),

            );



            $sql = 'INSERT INTO ' . DB_COMMENTS . ' ' . $this->Registry->db->sql_build_array('INSERT', $sql_ary);

            $this->Registry->db->sql_query($sql);



            if ($this->comment['spam'] == 0)

            {

                $this->reply['info'] = 'Twój komentarz został dodany!';

            }

            else

            {

                $this->reply['info'] = '<h4 class="komunikat-ok center">Twój komentarz oczekuje na zatwierdzenie.</h4>';

            }

            $this->resetCommentData();

        }



        // Reply for ajax comments

        if ($this->item['ajax'])

        {

            if ($this->reply['info'] != '')

            {

                if ($this->comment['spam'] == 0)

                {

                    $this->reply['error'] = 0;

                    $sql = 'SELECT tc.*, tu.user_id, tu.username, tu.user_colour, tu.user_avatar, tu.user_avatar_type, tu.user_avatar_width, tu.user_avatar_height 

      			FROM ' . DB_COMMENTS . ' AS tc

      			LEFT JOIN ' . USERS_TABLE . ' AS tu ON tc.comment_name = tu.user_id

          	WHERE comment_id = ' . $this->Registry->db->sql_nextid();

                    $result = $this->Registry->db->sql_query($sql);

                    $row = $this->Registry->db->sql_fetchrow($result);

                    $this->Registry->db->sql_freeresult($result);



                    $row['bbcode_options'] = 0 + 0 + OPTION_FLAG_LINKS;

                    $row['comment_message'] = generate_text_for_display($row['comment_message'], $row['comment_bbcode_uid'], $row['comment_bbcode_bitfield'], $row['bbcode_options']);

                    $row['comment_avatar'] = $this->getAvatar($row);



                    if (isset($row['username']))

                    {

                        $row['comment_name'] = get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $row['username']);

                    }





                    $this->reply['comment'] = '<li id="' . $row['comment_id'] . '">

            <span class="commentAuthor" title="' . $row['comment_useragent'] . '">

              ' . $row['comment_avatar'] . $row['comment_name'] . '

            </span>

            <time datetime="' . date('c', $row['comment_datestamp']) . '" pubdate class="commentDate">' . Core::$user->format_date($row['comment_datestamp']) . '</time>

            <p class="commentMessage">' . $row['comment_message'] . '</p>

          </li>';

                }

                else

                {

                    $this->reply['error'] = 1;

                }

            }

            else

            {

                $this->reply['error'] = 1;

                foreach ($this->errors as $error)

                {

                    $this->reply['info'] .= '<h4 class="error center">' . $error . '</h4>';

                }

            }



            echo json_encode($this->reply);

        }

        $this->resyncCommentCounter();

    }



    /**

     * Get comment avatar to display

     * @param array $avatarData Comment data

     * @return string Avatar link with image or standard avatar     

     * 

     */

    public function getAvatar($avatarData)

    {

        global $phpbb_root_path, $phpEx;



        if (is_int($avatarData))

        {

            $sql = "SELECT tu.user_avatar, tu.user_avatar_type, tu.user_avatar_width, tu.user_avatar_height 

  			FROM " . DB_COMMENTS . " AS tc

  			LEFT JOIN " . USERS_TABLE . " AS tu ON tc.comment_name = tu.user_id

      	WHERE comment_id = '{$avatarData}'";

            $result = $this->Registry->db->sql_query($sql);

            $avatarData = $this->Registry->db->sql_fetchrow($result);

        }



        if (empty($avatarData))

        {

            return '';

        }



        $avatar_img = '';

        switch ($avatarData['user_avatar_type'])

        {

            case AVATAR_UPLOAD:

                if (!Config::getConfig('allow_avatar_upload'))

                {

                    return '';

                }

                $avatar_img = '//' . Config::getConfig('server_name') . "/download/file.$phpEx?avatar=";

                break;



            case AVATAR_GALLERY:

                if (!Config::getConfig('allow_avatar_local'))

                {

                    return '';

                }

                $avatar_img = '//' . Config::getConfig('server_name') . '/' . Config::getConfig('avatar_gallery_path') . '/';

                break;



            case AVATAR_REMOTE:

                if (!Config::getConfig('allow_avatar_remote'))

                {

                    return '';

                }

                break;



            default:
                // Maybe gravatar?
                if ($avatarData['comment_email'] != '')
                {    
                    $avatar_img = "//www.gravatar.com/avatar/{$avatarData['comment_email']}";
                    
                }
                else
                {
                    $avatar_img = Config::getConfig('portal_url') . 'images/commentGuest.gif';
                }


                break;

        }



        $avatar_img .= $avatarData['user_avatar'];

        return '<img src="' . $avatar_img . '" style="width:50px;height=50px;" class="commentAvatar" alt="Avatar użytkownika" />';

    }



    /**

     * Check comment by word censor and modify spam field if needed

     * 

     */

    private function checkCensor()

    {

        if (Config::getConfig('portal_censor_enabled') && !Core::$auth->acl_get('u_sg_portal_comments'))

        {

            $sql = "SELECT * FROM " . DB_CENSOR;

            $result = $this->Registry->db->sql_query($sql);

            while ($row = $this->Registry->db->sql_fetchrow($result))

            {

                if (stristr($this->comment['message'], $row['word']))

                {

                    $this->comment['spam'] = 1;

                    break;

                }



                if ($this->isGuest)

                {

                    if (stristr($this->comment['author'], $row['word']))

                    {

                        $this->comment['spam'] = 1;

                        break;

                    }

                }

            }

            $this->Registry->db->sql_freeresult($result);



            return;

        }

    }



    /**

     * Check comment by anti-spam systems and modyify spam field in comment data

     * 

     */

    private function checkSpam()

    {

        // Akismet

        if (Config::getConfig('portal_akismet_portal') && Config::getConfig('portal_akismet_key') != ''

                && !Core::$auth->acl_get('u_sg_portal_comments'))

        {

            require_once(DIR_CLASSES . 'Akismet.php');

            require_once(DIR_CLASSES . 'SocketWriteRead.php');



            $akismet = new Akismet(Config::getConfig('portal_url'), Config::getConfig('portal_akismet_key'));

            $akismet->setCommentAuthor($this->comment['author']);

            $akismet->setCommentAuthorEmail('');

            $akismet->setCommentAuthorURL('');

            $akismet->setCommentContent($this->comment['message']);

            $akismet->setPermalink($_SERVER['REQUEST_URI']);



            if ($akismet->isCommentSpam())

            {

                $this->comment['spam'] = 1;

            }

        }

    }



    /**

     * Reset internal comment data

     * 

     */

    private function resetCommentData()

    {

        $this->comment['message'] = '';

        $this->comment['author'] = '';

        $this->comment['ip'] = '';

    }





    /**

     * Resyncronize (recalculate) comments for choosen item

     * 

     */

    public function resyncCommentCounter()

    {
        if (!$this->isItemExist())

        {

            return;

        }



        $sql_where = "comment_item_id = '{$this->item['id']}'";
        $sql_where .= " AND comment_spam = '0'";

        $comments = dbCount(DB_COMMENTS, 'comment_item_id', $sql_where);



        $sql = "UPDATE " . DB_CONTENT . "

						SET comments = '" . $comments . "'

            WHERE id = '" . $this->item['id'] . "'";

        $this->Registry->db->sql_query($sql);

    }



    /**

     * Validate input data - email, lengths etc. and say if comment is correct

     * @return bool

     * 

     */

    private function validateComment()

    {

        // Validate antispam nick

        if (preg_match('/^' . get_preg_expression('email') . '$/i', $this->comment['author']))

        {

            $this->errors[] = 'Wystąpił nieoczekiwany błąd!';

        }
        
        if ($this->isGuest && $this->comment['email'] != '' && !preg_match('/^' . get_preg_expression('email') . '$/i', $this->comment['email']))
        {
            $this->errors[] = 'Podany email jest nieprawidłowy!';
        }
        
        
        // Is author field empty or too long / too short?

        if (mb_strlen($this->comment['email']) > 200)

        {

            $this->errors[] = 'Podany email jest zbyt długi!';

            return;

        }


        /*
        if (!check_form_key($this->formKey))

        {

            $this->errors[] = 'Formularz jest nieprawidłowy! Spróbuj ponownie.';

            return;

        }
        */



        // Is author field empty?

        if ($this->comment['author'] == '')

        {

            $this->errors[] = 'Podanie nicka jest wymagane!';

            return;

        }



        // Is author field empty or too long / too short?

        if ($this->isGuest && (mb_strlen($this->comment['author']) < 3 || mb_strlen($this->comment['author']) > 50))

        {

            $this->errors[] = 'Nick musi mieć od 3 do 50 znaków!';

            return;

        }



        // Is message field empty?

        if ($this->comment['message'] == '')

        {

            $this->errors[] = 'Podanie treści wiadomości jest wymagane!';

            return;

        }



        // Is message field too short or too long?

        if (mb_strlen($this->comment['message']) < 3 || mb_strlen($this->comment['message']) > 1000)

        {

            $this->errors[] = 'Komentarz musi mieć od 3 do 1000 znaków!';

            return;

        }



        // Antiflood check

        $sql = "SELECT MAX(comment_datestamp) AS time

            FROM " . DB_COMMENTS . "

            WHERE comment_ip = '" . $this->comment['ip'] . "'";

        $result = $this->Registry->db->sql_query($sql);

        $floodCheck = (int) $this->Registry->db->sql_fetchfield('time');

        $this->Registry->db->sql_freeresult($result);



        if (($floodCheck + 15) > time())

        {

            $this->errors[] = 'Musisz odczekać przynajmniej 15 sekund przed dodaniem nowego komentarza!';

        }



        return;

    }



    /**

     * Check if comment item exists in database

     * @return bool    

     * 

     */

    protected function isItemExist()

    {

        $sql = 'SELECT id 

                FROM ' . DB_CONTENT . '

                WHERE id = ' . $this->item['id'];

        if (!$result = $this->Registry->db->sql_query($sql))

        {

            redirect(Config::getConfig('portal_url'));

        }



        $this->item['data'] = $this->Registry->db->sql_fetchrow($result);

        $this->Registry->db->sql_freeresult($result);



        return true;

    }



    /**

     * Delete comment by id

     * @param int $comment_id     

     * 

     */

    public function deleteComment($comment_id)

    {

        $comment_id = (int) $comment_id;

        $comment = $this->getCommentData($comment_id);



        $this->item['id'] = $comment['comment_item_id'];



        $sql = "DELETE FROM " . DB_COMMENTS . " WHERE comment_id = '{$comment_id}'";

        $this->Registry->db->sql_query($sql);



        $this->resyncCommentCounter();

    }



    /**

     * Get comment data by id

     * @param int $comment_id     

     * @return array Comment data

     *    

     */

    public function getCommentData($comment_id)

    {

        $sql = "SELECT * FROM " . DB_COMMENTS . "

                WHERE comment_id = '{$comment_id}'";

            

        $result = $this->Registry->db->sql_query($sql);

        $row = $this->Registry->db->sql_fetchrow($result);

        $this->Registry->db->sql_freeresult($result);



        return $row;

    }



}