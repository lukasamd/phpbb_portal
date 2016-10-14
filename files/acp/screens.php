<?php
if (!defined('IN_PHPBB')) exit;
SAC::checkPageAccess('u_portal_screens');

// Get data for GET / POST
$id     = request_var('id', 0);
$cat    = request_var('cat', 0);
$action = request_var('action', '');
$status = request_var('status', '');
$error  = request_var('error', 0);
// Constants
define('DIR_SCREEN', DIR_SCREENSHOTS . 'c' . $cat . '/');

// Messages
if ($status)
{
    if ($status == 'save')
    {
        $message = 'Zdjęcie zostało dodane.';
    }
    elseif ($status == 'edit')
    {
        $message = 'Zdjęcie zostało uaktualnione.';
    }
    elseif ($status == 'deletepic')
    {
        $message = 'Zdjęcie zostało usunięte ze screena.';
    }
    elseif ($status == 'delete')
    {
        $message = 'Screen został usunięty.';
    }
    elseif ($status == 'error')
    {
        $message = 'Screen nie został dodany!<br />';
        if ($error == 1)
        {
            $message .= 'Błędny format pliku';
        }
        elseif ($error == 2)
        {
            $message .= 'Obraz musi być mniejszy niż: ' . parsebytesize($config['portal_photo_max_b']) .
                    ' KB';
        }
        elseif ($error == 3)
        {
            $message .= 'Obraz musi być w formacie GIF, JPEG lub PNG';
        }
        elseif ($error == 4)
        {
            $message .= 'Maksymalna rozdzielczość to: ' . $config['portal_photo_max_w'] .
                    ' x ' . $config['portal_photo_max_h'] . ' pikseli';
        }
    }
    $theme->panelOpen('Informacja');
    echo '<div class="adminInfo">' . $message . '</div>';
    $theme->panelClose();
}

$theme->panelOpen('Dodawanie screenów');
if ($action == 'deletepic')
{
    $row    = $db->sql_fetchrow($db->sql_query("SELECT filename,thumb1,thumb2 FROM " .
                    DB_PHOTOS . " WHERE id='" . $id . "'"));
    $result = $db->sql_query("UPDATE " . DB_PHOTOS .
            " SET filename='', thumb1='', thumb2='' WHERE id='" . $id . "'");
    // Delete files and thumbs
    @unlink(DIR_SCREEN . $row['filename']);
    @unlink(DIR_SCREEN . $row['thumb1']);
    if ($row['thumb2'])
    {
        @unlink(DIR_SCREEN . $row['thumb2']);
    }
    redirect($FILE_SELF . "?status=deletepic&cat={$cat}");
}
elseif ($action == 'delete')
{
    $row    = $db->sql_fetchrow($db->sql_query("SELECT cat,filename,thumb1,thumb2,userOrder FROM " . DB_PHOTOS . " WHERE id='$id'"));
    $result = $db->sql_query("UPDATE " . DB_PHOTOS .
            " SET userOrder=(userOrder-1) WHERE userOrder>'" . $row['userOrder'] .
            "' AND cat='$cat'");
    $result = $db->sql_query("DELETE FROM " . DB_PHOTOS . " WHERE id='$id'");
    if ($row['filename'])
    {
        @unlink(DIR_SCREEN . $row['filename']);
    }
    if ($row['thumb1'])
    {
        @unlink(DIR_SCREEN . $row['thumb1']);
    }
    if ($row['thumb2'])
    {
        @unlink(DIR_SCREEN . $row['thumb2']);
    }
    redirect($FILE_SELF . "?status=delete&cat={$cat}");
}
elseif ($action == 'mup')
{
    $order = request_var('order', 0);
    $row = $db->sql_fetchrow($db->sql_query("SELECT id FROM " . DB_PHOTOS . " WHERE cat='$cat' AND userOrder='{$order}'"));
    $db->sql_query("UPDATE " . DB_PHOTOS . " SET userOrder=userOrder+1 WHERE id='" . $row['id'] . "'");
    $db->sql_query("UPDATE " . DB_PHOTOS . " SET userOrder=userOrder-1 WHERE id='$id'");
    redirect($FILE_SELF . "?cat=$cat");
}
elseif ($action == "mdown")
{
    $order = request_var('order', 0);
    $row = $db->sql_fetchrow($db->sql_query("SELECT id FROM " . DB_PHOTOS . " WHERE cat='$cat' AND userOrder='{$order}'"));
    $db->sql_query("UPDATE " . DB_PHOTOS . " SET userOrder=userOrder-1 WHERE id='" . $row['id'] . "'");
    $db->sql_query("UPDATE " . DB_PHOTOS . " SET userOrder=userOrder+1 WHERE id='$id'");
    redirect($FILE_SELF . "?cat=$cat");
}
elseif (isset($_POST['save_photo']))
{
    $error      = '';
    $title      = utf8_normalize_nfc(request_var('title', '', true));
    $userOrder  = request_var('userOrder', 0);
    $photo_file = '';
    $thumb1     = '';
    $thumb2     = '';
    if (is_uploaded_file($_FILES['photo_pic_file']['tmp_name']))
    {
        $photo_types = array('.gif', '.jpg', '.jpeg', '.png');
        $photo_pic  = $_FILES['photo_pic_file'];
        $photo_name = strtolower(substr($photo_pic['name'], 0, strrpos($photo_pic['name'], ".")));
        $photo_ext  = strtolower(strrchr($photo_pic['name'], "."));
        $photo_dest = DIR_SCREEN;
        if (!preg_match("/^[-0-9A-Z_\.\[\]]+$/i", $photo_pic['name']))
        {
            $error = 1;
        }
        elseif ($photo_pic['size'] > ($config['portal_photo_max_b'] * 1024))
        {
            $error = 2;
        }
        elseif (!in_array($photo_ext, $photo_types))
        {
            $error = 3;
        }
        else
        {
            if ($action == 'edit')
            {
                $photo_name = $id;
            }
            else
            {
                $sql        = "SHOW TABLE STATUS LIKE '" . DB_PHOTOS . "'";
                $result     = $db->sql_query($sql);
                $photo_name = (int) $db->sql_fetchfield('Auto_increment');
            }
            $photo_file = image_exists($photo_dest, $photo_name . $photo_ext);
            move_uploaded_file($photo_pic['tmp_name'], $photo_dest . $photo_file);
            chmod($photo_dest . $photo_file, 0644);
            $imagefile  = @getimagesize($photo_dest . $photo_file);
            if ($imagefile[0] > $config['portal_photo_max_w'] || $imagefile[1] > $config['portal_photo_max_h'])
            {
                $error = 4;
                unlink($photo_dest . $photo_file);
            }
            else
            {
                $thumb1 = image_exists($photo_dest, $photo_name . "_t1" . $photo_ext);
                createthumbnail($imagefile[2], $photo_dest . $photo_file, $photo_dest . $thumb1, $config['portal_thumb_w'], $config['portal_thumb_h']);
                if ($imagefile[0] > $config['portal_photo_w'] || $imagefile[1] > $config['portal_photo_h'])
                {
                    $thumb2 = image_exists($photo_dest, $photo_name . "_t2" . $photo_ext);
                    createthumbnail($imagefile[2], $photo_dest . $photo_file, $photo_dest . $thumb2, $config['portal_photo_w'], $config['portal_photo_h']);
                }
            }
        }
    }
    if (!$error)
    {
        if ($action == 'edit')
        {
            $update_photos = $photo_file ? "filename='$photo_file', thumb1='$thumb1', thumb2='$thumb2', " : "";
            $result        = $db->sql_query("UPDATE " . DB_PHOTOS . " SET title='$title', " . $update_photos . "time='" . TIME_NOW . "' WHERE id='$id'");
            redirect($FILE_SELF . "?status=edit&cat=$cat");
        }
        else
        {
            if (!$userOrder)
            {
                $sql       = "SELECT MAX(userOrder) AS maxOrder FROM " . DB_PHOTOS . " WHERE cat = '" . $cat . "'";
                $result    = $db->sql_query($sql);
                $userOrder = (int) $db->sql_fetchfield('maxOrder');
                $userOrder++;
            }
            $result = $db->sql_query("UPDATE " . DB_PHOTOS . " SET userOrder=(userOrder+1) WHERE userOrder>='$userOrder' AND cat='$cat'");
            $result = $db->sql_query("INSERT INTO " . DB_PHOTOS .
                    " (cat, title, filename, thumb1, thumb2, time, userOrder) VALUES ('$cat', '$title', '$photo_file', '$thumb1', '$thumb2', '" .
                    TIME_NOW . "', '$userOrder')");
            redirect($FILE_SELF . "?status=save&cat=$cat");
        }
    }
    if ($error)
    {
        redirect($FILE_SELF . "?status=error&error=$error&cat=$cat");
    }
}
else
{
    if ($action == "edit")
    {
        $result     = $db->sql_query("SELECT * FROM " . DB_PHOTOS . " WHERE id='{$id}'");
        $row        = $db->sql_fetchrow($result);
        $title      = $row['title'];
        $filename   = $row['filename'];
        $thumb1     = $row['thumb1'];
        $thumb2     = $row['thumb2'];
        $userOrder  = $row['userOrder'];
        $formAction = $FILE_SELF . "?action=edit&cat=$cat&id=" . $row['id'];
    }
    else
    {
        $title      = '';
        $filename   = '';
        $thumb1     = '';
        $thumb2     = '';
        $userOrder  = '';
        $formAction = $FILE_SELF . "?cat=$cat";
    }
    echo "<form name='inputform' method='post' action='$formAction' enctype='multipart/form-data'>
        	<table align='center' cellspacing='0' cellpadding='0' class='tbl-border'>
        <tr>
        <td class='tbl2'>Nazwa:</td>
        <td class='tbl2'><input type='textbox' name='title' value='$title' maxlength='100' class='textbox' style='width:330px;'></td>
        </tr>
        <tr>";
    if (!$action)
    {
        echo "<td class='tbl2'>Kolejność:</td>
            <td class='tbl2'><input type='textbox' name='userOrder' value='$userOrder' maxlength='5' class='textbox' style='width:60px;'></td>
            </tr>";
    }
    if ($action && $thumb1 && file_exists(DIR_SCREEN . $thumb1))
    {
        echo "<tr><td valign='top' class='tbl2'>Miniaturka:</td>
            <td class='tbl2'><img src='" . DIR_SCREEN . $thumb1 . "' border='1' alt='$thumb1'></td>
            </tr>";
    }
    echo "<tr><td valign='top' class='tbl2'>Obraz: ";
    if ($action && $thumb2 && file_exists(DIR_SCREEN . $thumb2))
    {
        echo "<br /><br /><a class='small' href='" . $FILE_SELF . "?action=deletepic&cat=$cat&id=$id'>Usuń</a></td>
            <td class='tbl2'><img src='" . DIR_SCREEN . $thumb2 . "' border='1' alt='$thumb2'>";
    }
    elseif ($action && $filename && file_exists(DIR_SCREEN . $filename))
    {
        echo "<br /><br /><a class='small' href='" . $FILE_SELF . "?action=deletepic&cat=$cat&id=$id'>Usuń</a></td>
            <td class='tbl2'><img src='" . DIR_SCREEN . $filename . "' border='1' alt='$filename'>";
    }
    else
    {
        echo "</td><td class='tbl2'><input type='file' name='photo_pic_file' class='textbox' style='width:250px;'>";
    }
    echo "</td>
        </tr>
        <tr>
        <td colspan='2' style='text-align:center' class='tbl2'><br />
        <input type='submit' name='save_photo' value='Zapisz' class='button'>";
    if ($action)
    {
        echo "<input type='hidden' name='userOrder' value='$userOrder'>";
    }
    echo "</td></tr></table></form>";
}
$theme->panelClose();

// Display screens from album
$theme->panelOpen('Screeny w albumie:');
$rows = dbCount(DB_PHOTOS, 'id', "cat = '{$cat}'");
if ($rows)
{
    $result         = $db->sql_query("SELECT * FROM " . DB_PHOTOS . " WHERE cat='{$cat}' ORDER BY userOrder");
    $tpl_rowCounter = 0;
    echo "<table cellpadding='0' cellspacing='0' width='100%' class='tbl-border'><tr>";
    while ($row = $db->sql_fetchrow($result))
    {
        $up   = "";
        $down = "";
        if ($rows != 1)
        {
            $orderu = $row['userOrder'] - 1;
            $orderd = $row['userOrder'] + 1;
            if ($row['userOrder'] == 1)
            {
                $down = buildIconLink('right', $FILE_SELF . "?cat={$cat}&action=mdown&order={$orderd}&id={$row['id']}");
            }
            elseif ($row['userOrder'] < $rows)
            {
                $up   = buildIconLink('left', $FILE_SELF . "?cat={$cat}&action=mup&order={$orderu}&id={$row['id']}");
                $down = buildIconLink('right', $FILE_SELF . "?cat={$cat}&action=mdown&order={$orderd}&id={$row['id']}");
            }
            else
            {
                $up = buildIconLink('left', $FILE_SELF . "?cat={$cat}&action=mup&order={$orderu}&id={$row['id']}");
            }
        }
        if ($tpl_rowCounter != 0 && ($tpl_rowCounter % 4 == 0))
        {
            echo "</tr><tr>";
        }
        echo "<td style='text-align:center' valign='top' class='tbl2'>";
        echo "<b>{$row['title']}</b><br /><br />";
        if ($row['thumb1'] && file_exists(DIR_SCREEN . $row['thumb1']))
        {
            echo "<img src='" . DIR_SCREEN . $row['thumb1'] . "' alt='Podgląd' border='0'>";
        }
        else
        {
            echo 'Brak zdjęcia';
        }
        echo "<br /><br />" . $up;
        echo "&nbsp;<a href='" . $FILE_SELF . "?action=edit&cat=$cat&id={$row['id']}'>Edytuj</a> &mdash; ";
        echo "&nbsp;<a href='" . $FILE_SELF . "?action=delete&cat=$cat&id={$row['id']}'>Usuń</a>&nbsp; " . $down;
        echo "</td>";
        $tpl_rowCounter++;
    }
    echo "</tr></table>";
}
else
{
    echo '<div class="adminInfo">Brak zdjęć w wybranym albumie!</div>';
}
$theme->panelClose();

echo "</td>";
require_once DIR_ACP . 'footer.php';
?>