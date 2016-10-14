<?php
if (!defined('IN_PHPBB')) exit;
SAC::checkPageAccess('u_sg_portal_sections');

// Get data for GET / POST
$section_id = request_var('section_id', 0);
$action = request_var('action', '');
$status = request_var('status', '');

// Messages
if ($status)
{
    if ($status == 'updated')
    {
        $message = '<strong>Kategoria została zaktualizowana!</strong>';
    }
    else if ($status == 'added')
    {
        $message = '<strong>Kategoria została dodana!</strong>';
    }
    elseif ($status == 'deleted')
    {
        $message = '<strong>Kategoria została usunięta!</strong>';
    }
    $theme->panelOpen('Informacja');
    echo '<div class="adminInfo">' . $message . '</div>';
    $theme->panelClose();
}

if ($action == 'save')
{
    $sql_arr = array(
        'section_title'     => utf8_normalize_nfc(request_var('section_title', '', true)),
        'section_desc'      => utf8_normalize_nfc(request_var('section_desc', '', true)),
        'section_access'    => request_var('section_access', 0),
        'section_sign'      => utf8_normalize_nfc(request_var('section_sign', '', true)),
    );
    if ($section_id)
    {
        $sql = 'UPDATE ' . DB_SECTIONS . ' 
				SET ' . $db->sql_build_array('UPDATE', $sql_arr) . '
				WHERE section_id = ' . $_GET['section_id'];
        $db->sql_query($sql);
        redirect("{$FILE_SELF}&action=status&status=updated");
    }
    else
    {
        $sql = 'INSERT INTO ' . DB_SECTIONS . ' ' . $db->sql_build_array('INSERT', $sql_arr);
        $db->sql_query($sql);
        redirect("{$FILE_SELF}&action=status&status=added");
    }
}
elseif ($action == 'delete')
{
    $sql = 'SELECT * FROM ' . DB_SECTIONS . '
            WHERE section_id = ' . $section_id;
    $result  = $db->sql_query($sql);
    $sectionData = $db->sql_fetchrow($result);
    if ($sectionData)
    {
        $newSection = request_var('newSection', 0);
        if ($newSection)
        {
            $sql = 'UPDATE ' . DB_CONTENT . ' 
                    SET section = ' . $newSection . '
    				WHERE section = ' . $section_id;
            $result = $db->sql_query($sql);
            $sql = 'DELETE FROM ' . DB_SECTIONS . '
                    WHERE section_id = ' . $section_id;
            $result = $db->sql_query($sql);
            redirect("{$FILE_SELF}&action=status&status=deleted");
        }
        $theme->panelOpen('Usuwanie kategorii: "' . $sectionData['section_title'] . '"');
        $sql = 'SELECT section_id, section_title  
                FROM ' . DB_SECTIONS . '
                WHERE section_id <> ' . $section_id . '
                ORDER BY section_title';
        $result = $db->sql_query($sql);
        $formAction = "{$FILE_SELF}&action=delete";
        $sections = '';
        while ($row = $db->sql_fetchrow($result))
        {
            $sections .= '<option value="' . $row['section_id'] . '">' . $row['section_title'] . '</option>';
        }
        ?>
        <form name="inputform" method="post" action="<?php echo $formAction; ?>" onSubmit="return ConfirmDelete()">
            <table align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="tbl">Wybierz sekcję, do której mają być przeniesione wpisy.</td>
                </tr>
                <tr>
                    <td class="tbl">
                        <select name="newSection" class="textbox">
                            <?php echo $sections; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center" colspan="2" class="tbl">
                        <br />
                        <input type="hidden" name="section_id" value="<?php echo $section_id; ?>" />
                        <input type="submit" name="delete" value="Usuń kategorię" class="button">
                    </td>
                </tr>
            </table>
        </form> 
        <?php
        $theme->panelClose();
    }
    else
    {
        redirect($FILE_SELF);
    }
}
else
{
    if ($action == 'edit')
    {
        $sql = 'SELECT * FROM ' . DB_SECTIONS . '
  				WHERE section_id = ' . $section_id;
        $result = $db->sql_query($sql);
        $row    = $db->sql_fetchrow($result);
        $section_title   = $row['section_title'];
        $section_desc    = stripslashes($row['section_desc']);
        $section_access  = $row['section_access'];
        $section_sign    = $row['section_sign'];
        $formAction  = "{$FILE_SELF}&section_id=" . $section_id;
        $theme->panelOpen('Edycja istniejącej kategorii');
    }
    else
    {
        $section_title   = '';
        $section_desc    = '';
        $section_access  = '';
        $section_sign    = '';
        $formAction = $FILE_SELF;
        $theme->panelOpen('Dodawanie nowej kategorii');
    }
    ?>
    <form name="inputform" method="post" action="<?php echo $formAction; ?>" onSubmit="return ValidateForm(this)">
        <table align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td width="150px" class="tbl">Nazwa:</td>
                <td class="tbl"><input type="text" name="section_title" value="<?php echo $section_title; ?>" required="required" class="textbox" style="width:250px;"></td>
            </tr>
            <tr>
                <td width="150px" class="tbl">Oznaczenie:</td>
                <td class="tbl"><input type="text" name="section_sign" value="<?php echo $section_sign; ?>" class="textbox" style="width:250px;"></td>
            </tr>
            <tr>
                <td width="150px" class="tbl">Opis:</td>
                <td class="tbl"><input type="text" name="section_desc" value="<?php echo $section_desc; ?>" class="textbox" style="width:250px;"></td>
            </tr>
            <tr>
                <td width="150px" class="tbl">Dostęp:</td>
                <td class="tbl">
                    <select name="section_access" class="textbox">
                    <?php echo SAC::getLevelsSelect($section_access); ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="text-align:center" colspan="2" class="tbl">
                    <br />
                    <input type="hidden" name="action" value="save" />
                    <input type="submit" name="save" value="Zapisz sekcję" class="button">
                </td>
            </tr>
        </table>
    </form> 
    <?php
    $theme->panelClose();
    $theme->panelOpen('Istniejące sekcje');
    ?>
    <table align="center" cellpadding="0" cellspacing="1" width="95%" class="tbl-border">
        <tr>
            <th align="center" class="tbl2" width="40%">Nazwa</th>
            <th align="center" class="tbl2">Oznaczenie</th>
            <th align="center" class="tbl2">Dostęp</th>
            <th align="center" class="tbl2">Opcje</th>
        </tr>
    <?php
    $sections = array();
    $sql = "SELECT * FROM " . DB_SECTIONS . "
            ORDER BY section_title";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result))
    {
        $u_edit = URLs::ACP('self', array('action=edit' , "section_id={$row['section_id']}"), true);
        $u_delete = URLs::ACP('self', array('action=delete' , "section_id={$row['section_id']}"), true);
    
        $sections[$row['section_id']] = array(
            'section_title'   => stripslashes($row['section_title']),
            'section_sign'   => stripslashes($row['section_sign']),
            'section_desc'   => stripslashes($row['section_desc']),
            'url_edit'    => $u_edit,
            'url_delete'  => $u_delete,
            'img_edit'    => buildIconLink('edit', $u_edit),
            'img_delete'  => buildIconLink('delete', $u_delete),
            'section_access'  => SAC::getLevelName($row['section_access']),
        );
    }
    foreach ($sections as $section)
    {
        $section['section_link'] = "<a href='{$section['url_edit']}'>{$section['section_title']}</a><br /><span class='small'>{$section['section_desc']}</span>";
        ?>
        <tr>
            <td style="font-weight:bold;" class="tbl1" valign="top"><?php echo $section['section_link']; ?></td>
            <td style="text-align:center" class="tbl1" valign="top"><?php echo $section['section_sign']; ?></td>
            <td style="text-align:center" class="tbl1" valign="top"><?php echo $section['section_access']; ?></td>
            <td style="text-align:center" class="tbl1" valign="top"><?php echo $section['img_edit'] . $section['img_delete']; ?></td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php
    $theme->panelClose();
}
