<?php
if (!defined('IN_PHPBB')) exit;
SAC::checkPageAccess('u_sg_portal_content');


// Messages
if ($status)
{
    if ($status == 'updated')
    {
        $message = '<strong>Wpis został zaktualizowany!</strong>';
    }
    else if ($status == 'added')
    {
        $message = '<strong>Wpis został dodany!</strong>';
    }
    else if ($status == 'deleted')
    {
        $message = '<strong>Wpis został usunięty!</strong>';
    }
    $theme->panelOpen('Informacja');
    echo '<div class="adminInfo">' . $message . '</div>';
    $theme->panelClose();
}

$content = array(
    'title'          => utf8_normalize_nfc(request_var('title', '', true)),
    'meta'           => '',
    'section'        => request_var('section', 0),
    'image'          => request_var('image', ''),
    'content'        => isset($_POST['content']) ? $_POST['content'] : '',
    'breaks'         => isset($_POST['breaks']) ? 1 : 0,
    'draft'          => isset($_POST['draft']) ? 1 : 0,
    'start'          => 0,
    'access'         => request_var('access', 0),
    'comments_allow' => isset($_POST['comments_allow']) ? 1 : 0,
    'comments_view'  => isset($_POST['comments_view']) ? 1 : 0,
);
$content_tags = utf8_normalize_nfc(request_var('tags', '', true));
$content_categories = request_var('category', array('' => 0));
$content_author = request_var('author', '');



if ($action == 'save' && $_SERVER['REQUEST_METHOD'] == 'POST')
{
    $content['title'] = ($content['title']) ? $content['title'] : 'Brak tytułu';
    $content['meta'] = trimlink(strip_tags($content['content']), 400);
    if ($_POST['start']['mday'] != '--' && $_POST['start']['mon'] != '--' && $_POST['start']['year'] != '----')
    {
        $content['start'] = mktime($_POST['start']['hours'], $_POST['start']['minutes'], 0, $_POST['start']['mon'], $_POST['start']['mday'], $_POST['start']['year']);
    }
    
    if ($id)
    {
        if ($content['start'])
        {
            $content['time'] = $content['start'];
        }
        $sql = 'UPDATE ' . DB_CONTENT . ' 
				SET ' . $db->sql_build_array('UPDATE', $content) . '
				WHERE id = ' . $id;
        $db->sql_query($sql);
    }
    else
    {
        $content['time'] = ($content['start']) ? $content['start'] : TIME_NOW;
        $sql_arr['newsletter'] = 0;
        $sql = 'INSERT INTO ' . DB_CONTENT . ' ' . $db->sql_build_array('INSERT', $content);
        $db->sql_query($sql);
        $id = $db->sql_nextid();
    }
    
    sg_tags_set($id, $content_tags);
    sg_categories_set($id, $content_categories);
    sg_author_set($id, $content_author);
    $urls->Model->setURL($content['title'], $id, true);
    
    redirect(URLs::ACP('self', array('action=edit', "id={$id}", "status=updated")));
}
else
{
    $content['author'] = Core::$user->data['username'];
    
    if ($action == 'edit')
    {
        $sql = 'SELECT * FROM ' . DB_CONTENT . ' 
                WHERE id = ' . $id;
        $result = $db->sql_query($sql);
        $row    = $db->sql_fetchrow($result);
        $content = array(
            'title'          => stripslashes($row['title']),
            'section'        => $row['section'],
            'image'          => $row['image'],
            'author'         => sg_author_get($id),
            'content'        => stripslashes($row['content']),
            'breaks'         => $row['breaks'] == 1 ? 'checked' : '',
            'draft'          => $row['draft'] == 1 ? 'checked' : '',
            'start'          => ($row['start']) ? getdate($row['start']) : '',
            'access'         => $row['access'],
            'comments_allow' => $row['comments_allow'] == 1 ? 'checked' : '',
            'comments_view'  => $row['comments_view'] == 1 ? 'checked' : '',
        );
        $content_tags = sg_tags_get($id);
        $content_categories = sg_categories_get($id);
    }
    if ($id)
    {   $formAction = URLs::ACP('self', array('action=save' , "id={$id}"));
        $theme->panelOpen('Edytuj newsa');
    }
    else
    {
        $formAction = URLs::ACP('self', array('action=save'));
        $theme->panelOpen('Dodaj newsa');
    }
    
    // Get categories
    $content['sel_cats'] = $content['sel_sections'] = $content['checkboxes_categories'] = '';
    $selected = $checked = '';
    
    $sql = 'SELECT * FROM ' . DB_CATEGORIES . ' ORDER BY cat_title';
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result))
    {
        $checked = (in_array($row['cat_id'], $content_categories)) ? ' checked="checked"' : '';
        $content['checkboxes_categories'] .= "<input type='checkbox' name='category[]' value='{$row['cat_id']}'{$checked} />{$row['cat_title']}<br />";
    }

    // Get sections
    $sql = 'SELECT * FROM ' . DB_SECTIONS . ' ORDER BY section_title';
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result))
    {
        $selected = ($content['section'] == $row['section_id'] ? 'selected="selected"' : '');
        $content['sel_sections'] .= '<option value="' . $row['section_id'] . '"' . $selected . '>' . $row['section_title'] . '</option>';
    }

    // Oczywtywanie listy plikow-grafik
    $image_files = makefilelist(DIR_IMAGES, ".|..|index.php", true);
    $image_list  = makefileopts($image_files, $content['image']);
    ?>
    <form name="inputform" method="post" action="<?php echo $formAction; ?>" onSubmit="return ValidateForm(this);">

    <div style="clear:both; border-bottom:1px dotted #888; padding-bottom:30px; overflow:hidden;">
    
        <div style="float:left; width: 50%; border-right:1px dotted #888;">
        <table align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td width="100" class="tbl">Sekcja</td>
                <td width="80%" class="tbl">
                    <select name="section" class="textbox" style="width:150px;">
                        <option value="0">Domyślna</option>
                        <?php echo $content['sel_sections']; ?></select>
                </td>
            </tr>
            <tr>
                <td width="100" class="tbl">Tytuł</td>
                <td width="80%" class="tbl"><input type="text" name="title" value="<?php echo $content['title']; ?>" required="required" class="textbox" style="width: 400px"></td>
            </tr>
            <tr>
                <td width="100px" class="tbl">Autor:</td>
                <td class="tbl"><input type="text" name="author" value="<?php echo $content['author']; ?>" class="textbox" style="width:400px;"></td>
            </tr>
            <tr>
                <td class="tbl">Czas startu:</td>
                <td class="tbl">
                    <select name="start[mday]" class="textbox">
                        <option>--</option>
                        <?php
                        for ($i = 1; $i <= 31; $i++)
                            echo "<option" . (isset($content['start']['mday']) && $content['start']['mday'] == $i ? " selected" : "") . ">$i</option>";
                        echo "</select><select name='start[mon]' class='textbox'><option>--</option>";
                        for ($i = 1; $i <= 12; $i++)
                            echo "<option" . (isset($content['start']['mon']) && $content['start']['mon'] == $i ? " selected" : "") . ">$i</option>";
                        echo "</select><select name='start[year]' class='textbox'><option>----</option>";
                        for ($i = 2010; $i <= date('Y'); $i++)
                            echo "<option" . (isset($content['start']['year']) && $content['start']['year'] == $i ? " selected" : "") . ">$i</option>";
                        echo "</select> /<select name='start[hours]' class='textbox'>";
                        for ($i = 0; $i <= 24; $i++)
                            echo "<option" . (isset($content['start']['hours']) && $content['start']['hours'] == $i ? " selected" : "") . ">$i</option>";
                        echo "</select> :<select name='start[minutes]' class='textbox'>";
                        for ($i = 0; $i <= 60; $i++)
                            echo "<option" . (isset($content['start']['minutes']) && $content['start']['minutes'] == $i ? " selected" : "") . ">$i</option>";
                        ?>
                    </select> 
                </td>
            </tr>
            <tr>
                <td class="tbl">Dostęp:</td>
                <td class="tbl">
                    <select name="access" class="textbox"><?php echo SAC::getLevelsSelect($content['access']); ?></select>
                </td>
            </tr>
            <tr>
                <td class="tbl" valign="top">Inne:</td>
                <td class="tbl">
                    <input type="checkbox" name="draft" value="yes"<?php echo $content['draft']; ?>>Zapisanie jako szkic<br />
                    <input type="checkbox" name="breaks" value="yes"<?php echo $content['breaks']; ?>>Automatyczne łamanie linii<br />
                    <input type="checkbox" name="comments_allow" value="yes"<?php echo $content['comments_allow']; ?>> Włącz Komentarze<br />
                    <input type="checkbox" name="comments_view" value="yes"<?php echo $content['comments_view']; ?>> Pokazuj Komentarze
                </td>
            </tr>
        </table>
        </div>
        
        <div style="float:left; padding-left: 20px;">
        <table align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td width="100px" class="tbl">Tagi:</td>
                <td class="tbl"><input type="text" name="tags" value="<?php echo $content_tags; ?>" class="textbox" style="width:400px;"></td>
            </tr>
            <tr>
                <td width="100" class="tbl" valign="top">Kategorie:</td>
                <td width="80%" class="tbl"><?php echo $content['checkboxes_categories']; ?></td>
            </tr>
            <tr>
                <td width="100px" class="tbl" valign="top">Grafika:</td>
                <td class="tbl">
                    <select name="image" class="textbox" onchange="update_image(this.options[selectedIndex].value);"><?php echo $image_list; ?></select>
                    <img src="<?php echo DIR_IMAGES . $content['image']; ?>" id="add_image_src" title="" style="max-width:100px; max-height:100px; float:right;" />  
                </td>
            </tr> 
        </table>
        </div>
    </div>
        
    <table align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="2" valign="top" class="tbl"><strong>Treść:</strong></td>
        </tr>
        <tr>
            <td colspan="2" class="tbl"><textarea class="ckeditor" name="content" cols="130" rows="40"><?php echo $content['content']; ?></textarea></td>
        </tr> 
        <tr>
            <td style="text-align:center" colspan="2" class="tbl">
                <br />
                <input type="submit" name="save" value="Zapisz news" class="button" />
            </td>
        </tr>
    </table>
    </form>
    <?php
    $theme->panelClose();
}
