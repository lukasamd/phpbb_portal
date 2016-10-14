<?php
if (!defined('IN_PHPBB')) exit;
SAC::checkPageAccess('u_portal_newsletter');


// Get data for GET / POST
$action = request_var('action', '');
$use_queue = true;


// Obsluga informacji po wykonaniu operacji
if (isset($_GET['status']))
{
    if ($_GET['status'] == 'send_ok')
    {
        $wiadomosc = '<strong>Newsletter został prawidłowo wysłany!</strong>';
    }
    elseif ($_GET['status'] == 'no_news')
    {
        $wiadomosc = '<strong>Nie znaleziono takiego newsa!</strong>';
    }
    elseif ($_GET['status'] == 'delete_ok')
    {
        $wiadomosc = '<strong>Adres email został pomyślnie usunięty!</strong>';
    }
    elseif ($_GET['status'] == 'change_ok')
    {
        $wiadomosc = '<strong>Pomyślnie zmieniono status adresu email!</strong>';
    }
    $theme->panelOpen('Informacja');
    echo '<div class="center">' . $wiadomosc . '</div>';
    $theme->panelClose();
}


switch ($action)
{

    // Wysylanie newslettera do grupy odbiorcow
    case 'send':
        $id = request_var('id', 0);
        $email_subject = utf8_normalize_nfc(request_var('message_subject', '', true));
        $sendNormal = request_var('sendNormal', '');

        if ($email_subject === '' && $id > 0)
        {
            /*
              $sql = 'SELECT * FROM ' . DB_CONTENT . '
              WHERE id = ' . $id;
              $result = $db->sql_query($sql);
              $emailData = $db->sql_fetchrow($result);
              $db->sql_freeresult($result);

              $emailData['news'] = stripslashes($emailData['news']);
              $emailData['news'] = ($emailData['breaks']) ? nl2br($emailData['news']) : $emailData['news'];

              $emailData = array(
              'SUBJECT'   => stripslashes($emailData['title']),
              'CONTENT'   => $emailData['news'],
              'DATE'   => $emailData['datestamp'],
              'ID' => (int) $emailData['id'],
              'SUBJECT-URL' => '<a href="' . $settings['siteurl'] . $urls->buildUrl('news', $emailData) . '"> ' . stripslashes($emailData['title']) . '</a>',
              );
             */
        }
        else
        {
            $emailData = array(
                'SUBJECT' => $email_subject,
                'CONTENT' => stripslashes($_POST['message_content']),
                'DATE' => TIME_NOW,
                'ID' => 0,
            );
        }

        if (!empty($emailData))
        {
            require_once DIR_INCLUDES . 'class_emogrifier.php';
            $code = new Emogrifier();

            $contentHTML = file_get_contents(DIR_INCLUDES . 'newsletter/contentHTML.txt');
            $contentCSS = file_get_contents(DIR_INCLUDES . 'newsletter/contentCSS.txt');

            $contentHTML = str_replace('{DATE}', date('d.m.Y', $emailData['DATE']), $contentHTML);
            $contentHTML = str_replace('{CONTENT}', $emailData['CONTENT'], $contentHTML);
            $contentHTML = str_replace('{SUBJECT}', $emailData['SUBJECT'], $contentHTML);
            //$contentHTML = str_replace('{SUBJECT-URL}', $emailData['SUBJECT-URL'], $contentHTML);

            $code->setHTML($contentHTML);
            $code->setCSS($contentCSS);
            $emailData['CONTENT'] = $code->emogrify();
            $emailOptions = serialize($emailData);

            // Pobieranie listy odbiorcow
            $sql = 'SELECT user_email
              FROM ' . USERS_TABLE . '
              WHERE user_allow_massemail = 1';
            $result = $db->sql_query($sql);


            // Zapisywanie emaili do kolejki wysylkowej
            //*
            $test_email = false;


            if ($test_email)
            {
                $sql_arry = array(
                    'newsletter_news' => (int) $emailData['ID'],
                    'newsletter_options' => serialize($emailData),
                    'newsletter_email' => 'lukasamd@gmail.com',
                    'newsletter_subject' => $emailData['SUBJECT'],
                );
                $sql = 'INSERT INTO ' . DB_NEWSLETTER_QUEUE . ' ' . $db->sql_build_array('INSERT', $sql_arry);
                $db->sql_query($sql);
            }
            else
            {
                while ($row = $db->sql_fetchrow($result))
                {
                    $sql_arry = array(
                        'newsletter_news' => (int) $emailData['ID'],
                        'newsletter_options' => $emailOptions,
                        'newsletter_email' => $row['user_email'],
                        'newsletter_subject' => $emailData['SUBJECT'],
                    );
                    $sql = 'INSERT INTO ' . DB_NEWSLETTER_QUEUE . ' ' . $db->sql_build_array('INSERT', $sql_arry);
                    $db->sql_query($sql);
                }
            }

            /*
              $sql = 'UPDATE ' . DB_CONTENT . '
              SET newsletter = 1
              WHERE id = ' . $id;
              $db->sql_query($sql);
             */
            redirect("{$FILE_SELF}&status=send_ok");
        }
        redirect($FILE_SELF);
        break;

    // Pobieranie listy zapisanych
    case 'subscriptions':
        $theme->panelOpen('Lista adresów zapisanych do newslettera');

        $sql = 'SELECT user_id, username, user_colour, user_email
            FROM ' . USERS_TABLE . '
            WHERE user_allow_massemail = 1
            ORDER BY user_id
						LIMIT ' . $Registry->Pagination->getPageSQL(30);
        $result = $db->sql_query($sql);
        ?>
        <table align="center" cellspacing="1" cellpadding="0" class="tbl-border" width="80%">
            <tr>
                <th class="tbl1">Login</th>
                <th class="tbl1">Email</th>
                <th class="tbl1">Operacje</th>
            </tr>
        <?php
        while ($row = $db->sql_fetchrow($result))
        {
            $url_delete = "{$FILE_SELF}&action=delete&amp;user_id=" . $row['user_id'];
            $url_profile = get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $row['username']);
            ?>
                <tr>
                    <td class="tbl2"><?php echo $url_profile; ?></td>
                    <td class="tbl2"><?php echo $row['user_email']; ?></td>
                    <td class="tbl2" align="center">
                        <a href="<?php echo $url_delete; ?>">Usuń</a>
                </tr>
            <?php
        }
        $db->sql_freeresult($result);
        ?></table><?php
        $countElements = dbCount(USERS_TABLE, 'user_id', 'user_allow_massemail = 1');
        $Registry->Pagination->generate(30, $countElements, 3, '', "{$FILE_SELF}&action=subscriptions");

        $theme->panelClose();
        break;


    // Pobieranie listy newsow wraz z informacja, czy newsletter zostal wyslany
    default:
        $theme->panelOpen('Newsletter - wysyłanie wiadomości do odbiorców');
        $sql = 'SELECT id, title, url, newsletter
            FROM ' . DB_CONTENT . '
            ORDER BY id DESC
            LIMIT 5';
        $result = $db->sql_query($sql);
        ?>
        <div style="text-align:right; font-size:11px;"><a href="<?php echo $FILE_SELF; ?>&action=subscriptions">[ Lista odbiorców ]</a></div>
        <?php
        echo '<form name="newsletterSending" method="post" action="' . $FILE_SELF . '&action=send">';
        echo '<table align="center" width="600px">';
        echo '<tr><td class="tbl1">';
        echo '<h4 class="center">Wybierz news do wysyłki newslettera:</h4>';
        echo '</td></tr><tr><td class="tbl2" align="center">';
        echo '<select name="id" id="selectNews" class="textbox">';
        while ($row = $db->sql_fetchrow($result))
        {
            echo '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
        }
        echo '<option value="none">Treść podawana ręcznie</option>';
        echo '</select>';


        echo '</td></tr><tr class="content"><td class="tbl1">';
        echo '<h4 class="center">Treść newslettera (HTML):</h4>';
        echo '</td></tr><tr class="content"><td class="tbl1">';
        echo 'Tytuł: <input type="text" name="message_subject" value="" class="textbox" style="width:300px;" />';
        echo '</td></tr><tr class="content"><td class="tbl2" align="center">';
        echo '<textarea name="message_content" cols="70" rows="12" style="width:90%" class="textbox"></textarea>';

        echo '</td></tr><tr><td style="text-align:center" class="tbl2">';
        echo '<input type="submit" name="sending" value="Rozpocznij teraz wysyłkę newslettera" class="button" />';
        echo '</td></tr>';
        echo '</table>';
        echo '</form>';
        $theme->panelClose();

        $actualSending = array();
        $sql = 'SELECT COUNT(newsletter_id) AS queue, newsletter_subject
            FROM ' . DB_NEWSLETTER_QUEUE . '
            GROUP BY newsletter_subject';
        $result = $db->sql_query($sql);
        while ($row = $db->sql_fetchrow($result))
        {
            $actualSending[] = $row;
        }
        $db->sql_freeresult($result);


        $theme->panelOpen('Aktualnie wysyłane newsy');
        if (!empty($actualSending))
        {
            echo '<table width="60%" align="center">';
            echo '<tr><th class="tbl1">Tytuł newsa</th><th class="tbl1">Pozostało</th></tr>';

            foreach ($actualSending as $row)
            {
                echo '<tr>';
                echo '<td class="tbl2">' . $row['newsletter_subject'] . '</td>';
                echo '<td class="tbl2" align="center">' . $row['queue'] . '</td>';
                echo '</tr>';
            }

            echo '</table>';
        }
        else
        {
            echo '<h3 class="center">Aktualnie nie są wysyłane żadne newsy</h3>';
        }

        $theme->panelClose();
        break;
}
?>
<script type="text/javascript">
    $("#selectNews").change(function()
    {
        if ($(this).val() == "none")
        {
            $(".content").show();
        }
        else
        {
            $(".content").hide();
        }
    });
</script>
<?php
