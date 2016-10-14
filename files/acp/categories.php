<?php
if (!defined('IN_PHPBB')) exit;
SAC::checkPageAccess('u_sg_portal_categories');

// Get data for GET / POST
$cat_id = request_var('cat_id', 0);
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
    $cat_title   = utf8_normalize_nfc(request_var('cat_title', '', true));
    $cat_desc    = utf8_normalize_nfc(request_var('cat_desc', '', true));
    $cat_url     = $phpbb_seo->format_url($cat_title);
    $cat_parent  = request_var('cat_parent', 0);
    $cat_sorting = utf8_normalize_nfc(request_var('cat_sorting', '', true));
    $sql_arr = array(
        'cat_title'   => $cat_title,
        'cat_url'     => $cat_url,
        'cat_desc'    => $cat_desc,
        'cat_parent'  => $cat_parent,
        'cat_sorting' => $cat_sorting,
    );
    if ($cat_id)
    {
        $sql = 'UPDATE ' . DB_CATEGORIES . ' 
						SET ' . $db->sql_build_array('UPDATE', $sql_arr) . '
						WHERE cat_id = ' . $_GET['cat_id'];
        $db->sql_query($sql);
        redirect("{$FILE_SELF}&action=status&status=updated");
    }
    else
    {
        $sql = 'INSERT INTO ' . DB_CATEGORIES . ' ' . $db->sql_build_array('INSERT', $sql_arr);
        $db->sql_query($sql);
        redirect("{$FILE_SELF}&action=status&status=added");
    }
}
elseif ($action == 'delete')
{
    $sql     = 'SELECT * 
          FROM ' . DB_CATEGORIES . '
					WHERE cat_id = ' . $cat_id;
    $result  = $db->sql_query($sql);
    $catData = $db->sql_fetchrow($result);
    if ($catData)
    {
        $newCat = request_var('newCat', 0);
        if ($newCat)
        {
            $sql    = 'UPDATE ' . DB_CONTENT . '
              SET cat = ' . $newCat . '
    					WHERE cat = ' . $cat_id;
            $result = $db->sql_query($sql);
            $sql    = 'DELETE FROM ' . DB_CATEGORIES . '
              WHERE cat_id = ' . $cat_id;
            $result = $db->sql_query($sql);
            redirect("{$FILE_SELF}&action=status&status=deleted");
        }
        $theme->panelOpen('Usuwanie kategorii: "' . $catData['cat_title'] . '"');
        $sql    = 'SELECT cat_id, cat_title  
            FROM ' . DB_CATEGORIES . '
  					WHERE cat_id <> ' . $cat_id . '
            ORDER BY cat_title';
        $result = $db->sql_query($sql);
        $formAction = "{$FILE_SELF}&action=delete";
        $categories = '';
        while ($row = $db->sql_fetchrow($result))
        {
            $categories .= '<option value="' . $row['cat_id'] . '">' . $row['cat_title'] . '</option>';
        }
        ?>
        <form name="inputform" method="post" action="<?php echo $formAction; ?>" onSubmit="return ConfirmDelete()">
            <table align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="tbl">Wybierz kategorię, do której mają być przeniesione wpisy.</td>
                </tr>
                <tr>
                    <td class="tbl">
                        <select name="newCat" class="textbox">
                            <?php echo $categories; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center" colspan="2" class="tbl">
                        <br />
                        <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>" />
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
        $sql    = 'SELECT * 
            FROM ' . DB_CATEGORIES . '
  					WHERE cat_id = ' . $cat_id;
        $result = $db->sql_query($sql);
        $row    = $db->sql_fetchrow($result);
        $cat_title   = $row['cat_title'];
        $cat_desc    = stripslashes($row['cat_desc']);
        $cat_parent  = $row['cat_parent'];
        $cat_sorting = $row['cat_sorting'];
        $formAction  = "{$FILE_SELF}&cat_id={$cat_id}";
        $theme->panelOpen('Edycja istniejącej kategorii');
    }
    else
    {
        $cat_title   = '';
        $cat_desc    = '';
        $cat_parent  = 0;
        $cat_sorting = '';
        $formAction = $FILE_SELF;
        $theme->panelOpen('Dodawanie nowej kategorii');
    }

    $sql    = 'SELECT * FROM ' . DB_CATEGORIES . ' 
          WHERE cat_parent = 0
          ' . (isset($cat_id) ? 'AND cat_id <> ' . $cat_id : '') . '
          ORDER BY cat_title';
    $result = $db->sql_query($sql);
    $cat_opts = '';
    $selected = '';
    while ($row      = $db->sql_fetchrow($result))
    {
        $selected = ($cat_parent == $row['cat_id'] ? 'selected="selected"' : '');
        $cat_opts .= '<option value="' . $row['cat_id'] . '"' . $selected . '>' . $row['cat_title'] . '</option>';
    }
    ?>
    <form name="inputform" method="post" action="<?php echo $formAction; ?>" onSubmit="return ValidateForm(this)">
        <table align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td width="150px" class="tbl">Nazwa:</td>
                <td class="tbl"><input type="text" name="cat_title" value="<?php echo $cat_title; ?>" required="required" class="textbox" style="width:250px;"></td>
            </tr>
            <tr>
                <td width="100" class="tbl">Kategoria nadrzędna</td>
                <td width="80%" class="tbl">
                    <select name="cat_parent" class="textbox">
                        <option value="0">- Brak -</option>
    <?php echo $cat_opts; ?></select>
                </td>
            </tr>
            <tr>
                <td width="150px" class="tbl">Metoda sortowania:</td>
                <td class="tbl">
                    <select name="cat_sorting" class="textbox">
                        <option value="title" <?php if ($cat_sorting == 'title') echo 'selected="selected"'; ?>>Tytuł</option>
                        <option value="time" <?php if ($cat_sorting == 'time') echo 'selected="selected"'; ?>>Czas dodania</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" valign="top" class="tbl"><br /><strong>Opis kategorii:</strong></td>
            </tr>
            <tr>
                <td colspan="2" class="tbl"><textarea name="cat_desc" cols="130" rows="10" class="textbox"><?php echo $cat_desc; ?></textarea></td>
            </tr>
            <tr>
                <td style="text-align:center" colspan="2" class="tbl">
                    <br />
                    <input type="hidden" name="action" value="save" />
                    <input type="submit" name="save" value="Zapisz kategorię" class="button">
                </td>
            </tr>
        </table>
    </form> 
    <?php
    $theme->panelClose();
    $theme->panelOpen('Istniejące kategorie wpisów');
    ?>
    <table align="center" cellpadding="0" cellspacing="1" width="95%" class="tbl-border">
        <tr>
            <th align="center" class="tbl2" width="50%" colspan="2">Nazwa kategorii</th>
            <th align="center" class="tbl2">Sortuj wg.</th>
            <th align="center" class="tbl2">Opcje</th>
        </tr>
    <?php
    $categories = array();
    $sql    = "SELECT * 
          FROM " . DB_CATEGORIES . "
          WHERE cat_parent = 0 
          ORDER BY cat_title";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result))
    {
        $u_edit = URLs::ACP('self', array('action=edit' , "cat_id={$row['cat_id']}"));
        $u_delete = URLs::ACP('self', array('action=delete' , "cat_id={$row['cat_id']}"));
    
        $categories[$row['cat_id']] = array(
            'cat_title'   => stripslashes($row['cat_title']),
            'cat_sorting' => ($row['cat_sorting'] == 'title') ? 'Tytuł' : 'Data dodania',
            'url_edit'    => $u_edit,
            'url_delete'  => $u_delete,
            'img_edit'    => buildIconLink('edit', $u_edit),
            'img_delete'  => buildIconLink('delete', $u_delete),
            'subcats'     => array(),
        );
    }
    $sql    = "SELECT * 
          FROM " . DB_CATEGORIES . "
          WHERE cat_parent <> 0 
          ORDER BY cat_title";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result))
    {
        $u_edit = URLs::ACP('self', array('action=edit' , "cat_id={$row['cat_id']}"));
        $u_delete = URLs::ACP('self', array('action=delete' , "cat_id={$row['cat_id']}"));
    
        $categories[$row['cat_parent']]['subcats'][$row['cat_id']] = array(
            'cat_title'   => stripslashes($row['cat_title']),
            'cat_sorting' => ($row['cat_sorting'] == 'title') ? 'Tytuł' : 'Data dodania',
            'url_edit'    => $u_edit,
            'url_delete'  => $u_delete,
            'img_edit'    => buildIconLink('edit', $u_edit),
            'img_delete'  => buildIconLink('delete', $u_delete),
        );
    }

    foreach ($categories as $category)
    {
        ?>
            <tr>
                <td class="tbl1" valign="top" colspan="2">
                    <b><a href="<?php echo $category['url_edit']; ?>"><?php echo $category['cat_title']; ?></a></b>
                </td>
                <td style="text-align:center" class="tbl1" valign="top"><?php echo $category['cat_sorting']; ?></td>
                <td style="text-align:center" class="tbl1" valign="top"><?php echo $category['img_edit'] . $category['img_delete']; ?></td>
            </tr>
        <?php
        foreach ($category['subcats'] as $subCat)
        {
            ?>
                <tr>
                    <td class="tbl1" style="width:5%"></td>
                    <td class="tbl1" valign="top">
                        <b><a href="<?php echo $subCat['url_edit']; ?>"><?php echo $subCat['cat_title']; ?></a></b>
                    </td>
                    <td style="text-align:center" class="tbl1" valign="top"><?php echo $subCat['cat_sorting']; ?></td>
                    <td style="text-align:center" class="tbl1" valign="top"><?php echo $subCat['img_edit'] . $subCat['img_delete']; ?></td>
                </tr>
            <?php
        }
    }
    ?>
    </table>
        <?php
        $theme->panelClose();
    }
    require_once DIR_ACP . 'footer.php';
    