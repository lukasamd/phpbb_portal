<?php
if (!defined('IN_PHPBB')) exit;
SAC::checkPageAccess('a_');

// Get data for GET / POST
if (isset($_POST['id']))
{
    $_POST['id'] = (int) $_POST['id'];
}
if (isset($_GET['id']))
{
    $_GET['id']    = (int) $_GET['id'];
    $_POST['edit'] = true;
    $_POST['id']   = $_GET['id'];
}

// Obsluga informacji po wykonaniu operacji
if (isset($_GET['status']))
{
    if ($_GET['status'] == 'su')
    {
        $message = '<strong>Program został zaktualizowany!</strong>';
    }
    elseif ($_GET['status'] == 'sn')
    {
        $message = '<strong>Program został dodany!</strong>';
    }
    $theme->panelOpen('Informacja');
    echo '<div class="center">' . $message . '</div>';
    $theme->panelClose();
}

if (isset($_POST['save']))
{
    $id    = request_var('id', 0);
    $title = utf8_normalize_nfc(request_var('title', '', true));
    $url   = $phpbb_seo->format_url($title);
    $sql_arr = array(
        'title'          => $title,
        'url'            => $url,
        'meta'           => trimlink(strip_tags($_POST['content']), 400),
        'cat'            => request_var('cat', 0),
        'company'        => request_var('company', 0),
        'version'        => request_var('version', ''),
        'is_polish'      => isset($_POST['is_polish']) ? 1 : 0,
        'content'        => $_POST['content'],
        'time'           => TIME_NOW,
        'comments_allow' => isset($_POST['comments_allow']) ? 1 : 0,
    );

    if ($id)
    {
        $sql = 'UPDATE ' . DB_SOFTWARE . ' 
						SET ' . $db->sql_build_array('UPDATE', $sql_arr) . '
						WHERE id = ' . $id;
        $db->sql_query($sql);
        redirect("{$FILE_SELF}&status=su");
    }
    else
    {
        $sql_arr['time_add'] = $sql_arr['time'];
        $sql = 'INSERT INTO ' . DB_SOFTWARE . ' ' . $db->sql_build_array('INSERT', $sql_arr);
        $db->sql_query($sql);
        redirect("{$FILE_SELF}&status=sn");
    }
}
else
{
    if (isset($_POST['edit']))
    {
        $sql    = 'SELECT * FROM ' . DB_SOFTWARE . ' 
            WHERE id = ' . $_POST['id'];
        $result = $db->sql_query($sql);
        $row    = $db->sql_fetchrow($result);
        $title          = stripslashes($row['title']);
        $cat            = $row['cat'];
        $company        = $row['company'];
        $version        = $row['version'];
        $content        = stripslashes($row['content']);
        $comments_allow = ($row['comments_allow']) ? 'checked' : '';
        $is_polish      = ($row['is_polish']) ? 'checked' : '';
    }

    if (isset($_POST['id']))
    {
        $action = "{$FILE_SELF}&id=" . $_POST['id'];
        $theme->panelOpen('Edytuj program');
    }
    else
    {
        $title          = '';
        $company        = 0;
        $version        = '';
        $is_polish      = '';
        $comments_allow = 'checked';
        $content        = '';
        $action = $FILE_SELF;
        $theme->panelOpen('Dodaj program do bazy');
    }

    $sql    = 'SELECT * FROM ' . DB_SOFTWARE_CATS . ' 
          ORDER BY cat_title';
    $result = $db->sql_query($sql);
    $cat_opts = '';
    $selected = '';
    while ($row      = $db->sql_fetchrow($result))
    {
        if (isset($cat))
            $selected = ($cat == $row['cat_id'] ? 'selected="selected"' : '');
        $cat_opts .= '<option value="' . $row['cat_id'] . '"' . $selected . '>' . $row['cat_title'] . '</option>';
    }
    $editlist = '';
    $selected = '';
    $sql      = 'SELECT * FROM ' . DB_SOFTWARE . ' 
          ORDER BY time_add DESC';
    $result   = $db->sql_query($sql);
    while ($row      = $db->sql_fetchrow($result))
    {
        if (isset($_POST['id']))
            $selected = ($_POST['id'] == $row['id'] ? " selected" : "");
        $editlist .= "<option value='" . $row['id'] . "'$selected>" . stripslashes($row['title']) . "</option>";
    }

    $sql    = 'SELECT id, name FROM ' . DB_COMPANIES . ' 
          ORDER BY name';
    $result = $db->sql_query($sql);
    $selected  = ($company == 0) ? ' selected="selected"' : '';
    $companies = '<option value=""' . $selected . '>- Brak -</option>';
    while ($row       = $db->sql_fetchrow($result))
    {
        $selected = ($company == $row['id']) ? ' selected="selected"' : '';
        $companies .= '<option value="' . $row['id'] . '"' . $selected . '>' . stripslashes($row['name']) . '</option>';
    }
    ?>
    <?php if ($cat_opts != '') : ?>
        <div class="center">
            <?php if ($editlist != '') : ?>
                <form name="selectform" method="post" action="<?php echo $FILE_SELF; ?>">
                    <br />
                    Programy w bazie: 
                    <select name="id" class="textbox" style="width:400px"><?php echo $editlist; ?></select>
                    <input type="submit" name="edit" value="Edytuj" class="button">
                </form>	
            <?php else : ?>
                <h4 class="error">W bazie nie znajdują się jeszcze żadne programy</h4>
            <?php endif; ?>
        </div>
        <hr style="margin:25px 10px;" />
        <form name="inputform" method="post" action="<?php echo $action; ?>" onSubmit="return ValidateForm(this);">
            <table align="center" cellpadding="0" cellspacing="0" width="850px">
                <tr>
                    <td width="100" class="tbl">Kategoria</td>
                    <td width="80%" class="tbl">
                        <select name="cat" class="textbox">
                            <option value="0">- Brak -</option>
                            <?php echo $cat_opts; ?></select>
                    </td>
                </tr>
                <tr>
                    <td width="100" class="tbl">Firma</td>
                    <td width="80%" class="tbl">
                        <select name="company" class="textbox">
                            <?php echo $companies; ?></select>
                    </td>
                </tr>
                <tr>
                    <td width="100" class="tbl">Nazwa</td>
                    <td width="80%" class="tbl"><input type="text" name="title" value="<?php echo $title; ?>" class="textbox" style="width: 400px"></td>
                </tr> 
                <tr>
                    <td width="100" class="tbl">Wersja</td>
                    <td width="80%" class="tbl"><input type="text" name="version" value="<?php echo $version; ?>" class="textbox" style="width: 100px"></td>
                </tr> 
                <tr>
                    <td class="tbl"></td> 
                    <td class="tbl"><input type="checkbox" name="is_polish" value="yes"<?php echo $is_polish; ?>> Polska wersja</td>
                </tr>
                <tr>
                    <td class="tbl"></td> 
                    <td class="tbl"><input type="checkbox" name="comments_allow" value="yes"<?php echo $comments_allow; ?>> Włącz Komentarze</td>
                </tr>
                <tr>
                    <td colspan="2" valign="top" class="tbl"><strong>Opis programu:</strong></td>
                </tr>
                <tr>
                    <td colspan="2" class="tbl"><textarea name="content" cols="130" rows="40"><?php echo $content; ?></textarea></td>
                </tr> 
                <tr>
                    <td style="text-align:center" colspan="2" class="tbl">
                        <br />
                        <input type="submit" name="save" value="Zapisz program" class="button">
                    </td>
                </tr>
            </table>
        </form>
        <script type="text/javascript">
            function ValidateForm(frm) 
            {
                if(frm.title.value=='') 
                {
                    alert('Proszę podać nazwę programu!');
                    return false;
                }
            }
        </script>
    <?php else : ?>
        <h3 class="error center">
            Brak dostępnych kategorii programów w bazie.
            <br />
            Najpierw dodaj przynajmniej jedną kategorię.
            <br /><br />
            <a href="programsCats.php">--Zarządzanie kategoriami programów --</a></h3>
    <?php endif; ?>
    <?php
    $theme->panelClose();
}
