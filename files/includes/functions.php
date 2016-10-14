<?php


function sg_trim($string = '', $max_length = 0, $filter = false)
{
    if (mb_strlen($string) > $max_length)
    {
        $string = trim(mb_substr($string, 0, $max_length));
    }
    
    if ($filter)
    {
        $string = sg_filter_var($string);
    }
    
    return $string;
}


function sg_filter_var($string = '')
{
    $string = strip_tags($string);
    $string = htmlspecialchars($string);
    $string = addslashes($string);
    
    return $string;
}


// Trim a line of text to a preferred length

function trimlink($text, $length)

{

    $dec = array('&', '"', '\'', '\\', '\"', '\\\'', '<', '>');

    $enc = array('&amp;', '&quot;', '&#39;', '&#92;', '&quot;', '&#39;', '&lt;', '&gt;');

    $text = str_replace($enc, $dec, $text);

    if (mb_strlen($text) > $length)

        $text = trim(mb_substr($text, 0, ($length - 3))) . '...';

    $text = str_replace($dec, $enc, $text);

    return $text;

}



function isHomeURL()

{

    if ($_SERVER['REQUEST_URI'] == '/')

    {

        return true;

    }

    return false;

}



function newsletterSending()

{

    global $db, $phpbb_root_path, $phpEx, $config;



    set_config('newsletter_time', TIME_NOW, true);



    // Pobieranie listy emaili z kolejki wysylkowej

    $emailList = $deleteList = array();

    $sql = 'SELECT * FROM ' . DB_NEWSLETTER_QUEUE . ' ORDER BY newsletter_news LIMIT 50';

    $result = $db->sql_query($sql);



    // Przeksztalcanie kolejki na tablice z danymi

    while ($row = $db->sql_fetchrow($result))

    {

        $emailList[] = $row;

    }



    // Jezeli sa jakies emaile do wysylki, wykonujemy ja

    if ($email_count = count($emailList))

    {

        include_once($phpbb_root_path . 'includes/functions_messenger.' . $phpEx);

        include_once($phpbb_root_path . 'includes/functions_user.' . $phpEx);

        $messenger = new messenger();



        for ($i = 0; $i < $email_count; $i++)

        {

            $emailData = unserialize($emailList[$i]['newsletter_options']);



            $messenger->set_mail_html(true);

            $messenger->{(($email_count == 1) ? 'to' : 'bcc')}($emailList[$i]['newsletter_email'], $emailList[$i]['newsletter_email']);

            $messenger->from('"SafeGroup.pl" <lukasz.tkacz@safegroup.pl>');

            $messenger->replyto('"SafeGroup.pl" <lukasz.tkacz@safegroup.pl>');

            $messenger->template('newsletter', 'pl');

            $messenger->headers('X-AntiAbuse: Board servername - ' . $config['server_name']);

            $messenger->headers('X-AntiAbuse: User_id - 1');

            $messenger->headers('X-AntiAbuse: Username - LukasAMD');

            $messenger->assign_vars(array(

                'SUBJECT' => $emailData['SUBJECT'],

                'CONTENT' => $emailData['CONTENT'],

            ));

            $messenger->send();



            $deleteList[] = $emailList[$i]['newsletter_id'];

        }

        unset($emailList);

        $messenger->save_queue();



        // Usuwanie z bazy informacji o juz wyslanych wiadomosciach

        $sql = 'DELETE FROM ' . DB_NEWSLETTER_QUEUE . ' WHERE newsletter_id IN (' . implode(',', $deleteList) . ')';

        $db->sql_query($sql);

    }

    return true;

}



// Pobieranie ID uzytkownika o danym loginie

function getAuthorId($username)

{

    global $db;



    if ($username == '')

    {

        return 'Redakcja SafeGroup.pl';

    }



    $searchUsername = utf8_clean_string($username);



    $sql = "SELECT user_id FROM " . USERS_TABLE . "

          WHERE username_clean = '" . $searchUsername . "'";

    $result = $db->sql_query($sql);

    $row = $db->sql_fetchrow($result);

    $db->sql_freeresult($result);



    if ($row)

    {

        return $row['user_id'];

    }

    else

    {

        return $username;

    }

}



// Pobieranie nloginu uzytkownika o danym ID

function getAuthorName($user_id)

{

    global $db;



    $searchUser_id = (int) $user_id;

    if ($searchUser_id == 0)

    {

        return $user_id;

    }



    $sql = "SELECT username FROM " . USERS_TABLE . "

          WHERE user_id = '" . $searchUser_id . "'";

    $result = $db->sql_query($sql);

    $row = $db->sql_fetchrow($result);

    $db->sql_freeresult($result);



    if ($row)

    {

        return $row['username'];

    }

    return '';
}



function dbCount($table, $field, $sql_where = '')

{

    global $db;



    if ($sql_where != '')

    {

        $sql_where = 'WHERE ' . $sql_where;

    }

    $sql = "SELECT COUNT({$field}) AS countElements 

          FROM {$table} {$sql_where}";

    $result = $db->sql_query($sql);

    $count = (int) $db->sql_fetchfield('countElements');

    $db->sql_freeresult($result);



    return $count;

}

?>