<?php
if (!defined('IN_PHPBB')) exit;
SAC::checkPageAccess('u_sg_portal_polls');

// Get data for GET / POST
$id     = request_var('id', 0);
$action = request_var('action', '');
$status = request_var('status', '');

// Messages
if ($status)
{
    if ($status == 'updated')
    {
        $message = '<strong>Ankieta została zaktualizowana!</strong>';
    }
    else if ($status == 'added')
    {
        $message = '<strong>Ankieta została dodana!</strong>';
    }
    elseif ($status == 'deleted')
    {
        $message = '<strong>Ankieta została usunięta!</strong>';
    }
    $theme->panelOpen('Informacja');
    echo '<div class="adminInfo">' . $message . '</div>';
    $theme->panelClose();
}

if ($action == 'save')
{
    $title      = utf8_normalize_nfc(request_var('title', '', true));
    $maxOptions = request_var('maxOptions', 0);
    $access     = request_var('access', 0);
    $timeEnd    = isset($_POST['timeEnd']) ? TIME_NOW : 0;
    if ($id)
    {
        $sql_arr = array(
            'title'      => $title,
            'maxOptions' => $maxOptions,
            'timeEnd'    => $timeEnd,
            'access'     => $access,
        );
        $sql         = 'UPDATE ' . DB_POLLS . '
    				SET ' . $db->sql_build_array('UPDATE', $sql_arr) . '
					  WHERE id = ' . $id;
        $db->sql_query($sql);
        foreach ($_POST['pollOptions'] as $optionId => $optionTitle)
        {
            $sql_arr = array('title' => $optionTitle);
            $sql = 'UPDATE ' . DB_POLLS_OPTIONS . '
      				SET ' . $db->sql_build_array('UPDATE', $sql_arr) . '
						  WHERE id = ' . $optionId;
            $db->sql_query($sql);
        }
        redirect("{$FILE_SELF}&action=status&status=updated&id={$id}");
    }
    else
    {
        $sql_arr = array(
            'title'      => $title,
            'maxOptions' => $maxOptions,
            'timeStart'  => TIME_NOW,
            'timeEnd'    => $timeEnd,
            'access'     => $access,
        );
        $sql = 'INSERT INTO ' . DB_POLLS . ' ' . $db->sql_build_array('INSERT', $sql_arr);
        $db->sql_query($sql);
        $id  = $db->sql_nextid();
        foreach ($_POST['pollOptions'] as $optionId => $optionTitle)
        {
            $sql_arr = array(
                'poll'  => $id,
                'title' => $optionTitle,
                'votes' => 0,
            );
            $sql = 'INSERT INTO ' . DB_POLLS_OPTIONS . ' ' . $db->sql_build_array('INSERT', $sql_arr);
            $db->sql_query($sql);
        }
    }
    redirect("{$FILE_SELF}&action=status&status=added&id={$id}");
}
else if ($action == 'delete')
{
    $sql = 'DELETE FROM ' . DB_POLLS . '
				  WHERE id = ' . $id;
    $db->sql_query($sql);
    $sql = 'DELETE FROM ' . DB_POLLS_OPTIONS . '
				  WHERE poll = ' . $id;
    $db->sql_query($sql);
    $sql = 'DELETE FROM ' . DB_POLLS_VOTES . '
				  WHERE vote_poll = ' . $id;
    $db->sql_query($sql);
    redirect("{$FILE_SELF}&action=status&status=deleted");
}
else
{
    $editlist   = '';
    $countPolls = dbCount(DB_POLLS, 'id');
    if ($countPolls)
    {
        $sql    = 'SELECT *
            FROM ' . DB_POLLS . ' 
            ORDER BY id DESC';
        $result = $db->sql_query($sql);
        while ($row = $db->sql_fetchrow($result))
        {
            $selected = ($row['id'] == $id) ? ' selected="selected"' : '';
            $status   = (!$row['timeEnd']) ? ' (AKTYWNA)' : '';
            $editlist .= "<option value='" . $row['id'] . "'" . $selected . ">" . $row['title'] . $status . "</option>";
        }
        $theme->panelOpen('Aktualne ankiety');
        ?>
        <div class="center">
            <form name="editform" method="post" action="<?php echo $FILE_SELF; ?>&action=edit">
                <select name='id' class='textbox' style='width:300px;'><?php echo $editlist; ?></select>
                <input type="submit" name="edit" value="Edytuj" class="button" />
                <input type="submit" name="delete" value="Usuń" class="button" />
            </form>
        </div>
        <?php
        $theme->panelClose();
    }

    $pollData = array(
        'title'      => '',
        'maxOptions' => 1,
        'timeStart'  => 0,
        'timeEnd'    => 0,
        'access'     => 0,
        'options'    => array(),
    );
    if ($id && $action == 'edit')
    {
        $sql      = 'SELECT * 
            FROM ' . DB_POLLS . ' 
            WHERE id = ' . $id;
        $result   = $db->sql_query($sql);
        $pollData = $db->sql_fetchrow($result);
        $pollData = array(
            'title'      => stripslashes($pollData['title']),
            'maxOptions' => $pollData['maxOptions'],
            'timeStart'  => $pollData['timeStart'],
            'timeEnd'    => $pollData['timeEnd'],
            'access'     => $pollData['access'],
        );
        $sql    = 'SELECT * 
            FROM ' . DB_POLLS_OPTIONS . ' 
            WHERE poll = ' . $id;
        $result = $db->sql_query($sql);
        while ($row    = $db->sql_fetchrow($result))
        {
            $pollData['options'][$row['id']] = stripslashes($row['title']);
        }
        $theme->panelOpen('Edycja ankiety');
    }
    else
    {
        $theme->panelOpen('Dodawanie nowej ankiety');
    }
    ?>
    <form name='pollform' method='post' action='<?php echo $FILE_SELF; ?>&action=save'>
        <table id="pollData" align='center' width='70%' cellpadding='0' cellspacing='0' class='tbl'>
            <tr>
                <td>Tytuł<br />&nbsp;</td>
                <td><input type='text' name='title' value='<?php echo $pollData['title']; ?>' required="required" class='textbox' style='width:300px'><br />&nbsp;</td>
            </tr>
            <tr>
                <?php
                $i = 1;
                if ($id && count($pollData['options']))
                {
                    foreach ($pollData['options'] as $optionId => $optionTitle)
                    {
                        echo "<tr><td>Opcja $i<br />&nbsp;</td>";
                        echo "<td><input type='text' name='pollOptions[$optionId]' value='$optionTitle' class='textbox' style='width:300px'><br />&nbsp;</td></tr>";
                        $i++;
                        ;
                    }
                }
                else
                {
                    for ($i = 1; $i < 5; $i++)
                    {
                        echo "<tr><td>Opcja $i<br />&nbsp;</td>";
                        echo "<td><input type='text' name='pollOptions[]' value='' required='required' class='textbox' style='width:300px'><br />&nbsp;</td></tr>";
                    }
                }
                ?>
        </table>
        <table align='center' width='380' cellpadding='0' cellspacing='0'>
            <tr>
                <td align='center'><br>
    <?php
    if ($id != 0 && $pollData['timeEnd'] == 0)
    {
        echo "<input type='checkbox' name='timeEnd' value='yes'>Zakończ ankietę<br><br>";
    }
    if ($id != 0)
    {
        echo "<input type='hidden' name='id' value='" . $id . "' />";
    }
    else
    {
        echo "<input type='button' name='addOption' value='Dodaj opcję' class='button' /> &nbsp;";
    }
    if ($id == 0 || $id != 0 && $pollData['timeEnd'] == 0)
    {
        echo "<input type='submit' name='save' value='Zapisz' class='button'>";
    }
    else
    {
        echo 'Od ' . $user->format_date($pollData['timeStart']) . "<br>";
        echo 'Do ' . $user->format_date($pollData['timeEnd']) . "<br>";
    }
    echo "</td></tr></table></form>";
    $theme->panelClose();
}
