<?php
if (!defined('IN_PHPBB')) exit;
SAC::checkPageAccess('u_portal_pages');


// Get data for GET / POST
if (isset($_POST['page_id']))
{
    $_POST['page_id'] = (int) $_POST['page_id'];
}
if (isset($_GET['page_id']))
{
    $_GET['page_id']  = (int) $_GET['page_id'];
    $_POST['edit']    = true;
    $_POST['page_id'] = $_GET['page_id'];
}

// Obsluga informacji po wykonaniu operacji
if (isset($_GET['status']))
{
    if ($_GET['status'] == 'su')
    {
        $wiadomosc = '<strong>Strona została zaktualizowana!</strong>';
    }
    elseif ($_GET['status'] == 'sn')
    {
        $wiadomosc = '<strong>Strona została dodana!</strong>';
    }
    $theme->panelOpen('Informacja');
    echo '<div class="center">' . $wiadomosc . '</div>';
    $theme->panelClose();
}

if (isset($_POST['save']))
{
    $page_title       = strip_tags($_POST['page_title']);
    $page_description = strip_tags($_POST['page_description']);
    $page_access = request_var('page_access', 0);
    $page_panels = strip_tags($_POST['page_panels']);
    $page_url       = strip_tags($_POST['page_url']);
    $page_url_check = isset($_POST['page_url_check']) ? 1 : 0;
    $page_url_type  = strip_tags($_POST['page_url_type']);
    $page_content         = $_POST['page_content'];
    $page_comments_status = isset($_POST['page_comments_status']) ? 1 : 0;
    $page_date      = 0;
    $page_date_show = isset($_POST['page_date_show']) ? 1 : 0;
    $page_author      = ($_POST['page_author'] != '') ? getAuthorId($_POST['page_author']) : $user->data['user_id'];
    $page_author_show = isset($_POST['page_author_show']) ? 1 : 0;
    $page_reads_show  = isset($_POST['page_reads_show']) ? 1 : 0;
    if ($page_author == '')
    {
        $page_author = $userdata['user_name'];
    }

    // Jezeli czas zostal podany, utworzenie znacznika czasu
    if (($_POST['page_date']['mday'] != '--') && ($_POST['page_date']['mon'] != '--') && ($_POST['page_date']['year'] != '----'))
    {
        $page_date = mktime($_POST['page_date']['hours'], $_POST['page_date']['minutes'], 0, $_POST['page_date']['mon'], $_POST['page_date']['mday'], $_POST['page_date']['year']);
    }

    if ($page_date == 0)
    {
        $page_date = TIME_NOW;
    }
    $sql_arr = array(
        'page_title'       => $page_title,
        'page_description' => $page_description,
        'page_content'     => ($page_content),
        'page_panels'    => $page_panels,
        'page_access'    => $page_access,
        'page_url'       => $page_url,
        'page_url_check' => $page_url_check,
        'page_url_type'  => $page_url_type,
        'page_author'      => $page_author,
        'page_author_show' => $page_author_show,
        'page_date'      => $page_date,
        'page_date_show' => $page_date_show,
        'page_reads_show'      => $page_reads_show,
        'page_comments_status' => $page_comments_status,
    );

    if (isset($_GET['page_id']))
    {
        $sql = 'UPDATE ' . DB_PAGES . ' 
						SET ' . $db->sql_build_array('UPDATE', $sql_arr) . '
						WHERE page_id = ' . $_GET['page_id'];
        $db->sql_query($sql);
        redirect("{$FILE_SELF}&status=su&page_id=" . $_GET['page_id']);
    }
    else
    {
        $sql = 'INSERT INTO ' . DB_PAGES . ' ' . $db->sql_build_array('INSERT', $sql_arr);
        $db->sql_query($sql);
        redirect("{$FILE_SELF}&status=sn");
    }
}
else
{
    if (isset($_POST['edit']))
    {
        $sql    = 'SELECT * FROM ' . DB_PAGES . '
						WHERE page_id = ' . $_POST['page_id'];
        $result = $db->sql_query($sql);
        $row    = $db->sql_fetchrow($result);
        $page_title     = $row['page_title'];
        $page_url       = $row['page_url'];
        $page_url_check = ($row['page_url_check'] == '1' ? ' checked="checked"' : '');
        $page_url_type  = $row['page_url_type'];
        $page_panels      = $row['page_panels'];
        $page_access      = $row['page_access'];
        $page_author      = getAuthorName($row['page_author']);
        $page_author_show = ($row['page_author_show'] == '1' ? ' checked="checked"' : '');
        $page_description = stripslashes($row['page_description']);
        if ($row['page_date'] > 0)
        {
            $page_date            = getdate($row['page_date']);
        }
        $page_date_show       = ($row['page_date_show'] == '1' ? ' checked="checked"' : '');
        $page_reads_show      = ($row['page_reads_show'] == '1' ? ' checked="checked"' : '');
        $page_content         = stripslashes($row['page_content']);
        $page_comments_status = ($row['page_comments_status'] == '1' ? ' checked="checked"' : '');
    }

    if (isset($_POST['page_id']))
    {
        $action = "{$FILE_SELF}&page_id=" . $_POST['page_id'];
        $theme->panelOpen('Edycja istniejącej strony');
    }
    else
    {
        $page_title           = '';
        $page_author          = '';
        $page_author_show     = ' checked="checked"';
        $page_access          = 0;
        $page_panels          = 'others';
        $page_url             = '';
        $page_url_check       = '';
        $page_url_type        = '';
        $page_content         = '';
        $page_description     = '';
        $page_date_show       = '';
        $page_reads_show      = '';
        $page_comments_status = ' checked="checked"';
        $page_url_check       = ' checked="checked"';
        $action               = $FILE_SELF;
        $theme->panelOpen('Dodawanie nowej strony');
    }

    $editlist = '';
    $sel      = '';

    $sql    = 'SELECT page_id, page_title 
					FROM ' . DB_PAGES . '
					ORDER BY page_date DESC';
    $result = $db->sql_query($sql);
    while ($data = $db->sql_fetchrow($result))
    {
        if (isset($_POST['page_id']))
            $sel = ($_POST['page_id'] == $data['page_id'] ? ' selected="selected"' : '');
        if (isset($_GET['page_id']))
            $sel = ($_GET['page_id'] == $data['page_id'] ? ' selected="selected"' : '');
        $editlist .= "<option value='" . $data['page_id'] . "'$sel>" . $data['page_title'] . "</option>";
    }
    $access_opts = '';
    $selected    = '';
    $user_groups = SAC::getLevels();
    while (list($key, $user_group) = each($user_groups))
    {
        $selected = ($page_access == $user_group['0'] ? 'selected="selected"' : '');
        $access_opts .= '<option value="' . $user_group['0'] . '"' . $selected . '>' . $user_group['1'] . '</option>';
    }
    ?>
    <form name="selectform" method="post" action="<?= $FILE_SELF ?>">
        <div class="center">
            <br />
            <table align="center" cellpadding="0" cellspacing="1" class="tbl-border">
                <tr>
                    <td class="tbl2" colspan="2"><b>Aktualnie dodane podstrony</b></td>
                </tr>
                <tr>
                    <td class="tbl2">
                        <select name="page_id" class="textbox" style="width:250px;"><?= $editlist ?></select>
                        <input type="submit" name="edit" value="Edytuj" class="button">
                    </td>
                </tr>
            </table>
        </div>
        <hr style="margin:25px 10px;" />
    </form>
    <form name="inputform" method="post" action="<?= $action ?>" onSubmit="return ValidateForm(this)">
        <table align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td width="100px" class="tbl">Tytuł:</td>
                <td class="tbl"><input type="text" name="page_title" value="<?= $page_title ?>" class="textbox" style="width:250px;"></td>
            </tr>
            <tr>
                <td width="100px" class="tbl2">Adres:</td>
                <td class="tbl2"><input type="text" name="page_url" value="<?= $page_url ?>" class="textbox" style="width:250px;"></td>
            </tr>
            <tr>
                <td class="tbl"></td> 
                <td class="tbl"><input type="checkbox" name="page_url_check" value="yes"<?= $page_url_check ?>> Sprawdzaj zgodność adresu</td>
            </tr>
            <tr>
                <td class="tbl"></td> 
                <td class="tbl"><input type="text" name="page_url_type" value="<?= $page_url_type ?>" class="textbox" style="width:75px;"> Typ sprawdzania adresu</td>
            </tr>
            <tr>
                <td class='tbl2' style='white-space:nowrap'>Dostęp:</td>
                <td class='tbl2'><select name='page_access' class='textbox' style='width:150px;'><?= $access_opts ?></select></td>
            </tr>
            <tr>
                <td width="100px" class="tbl">Układ paneli:</td>
                <td class="tbl"><input type="text" name="page_panels" value="<?= $page_panels ?>" class="textbox" style="width:250px;"></td>
            </tr>
            <tr>
                <td width="100px" class="tbl2">Autor:</td>
                <td class="tbl2"><input type="text" name="page_author" value="<?= $page_author ?>" class="textbox" style="width:250px;"></td>
            </tr>
            <tr>
                <td class="tbl"></td> 
                <td class="tbl"><input type="checkbox" name="page_author_show" value="yes"<?= $page_author_show ?>> Pokazuj autora podstrony</td>
            </tr>
            <tr>
                <td class='tbl2'>Czas dodania:</td>
                <td class='tbl2'>
                    <select name="page_date[mday]" class="textbox">
                        <option>--</option>
    <?php
    for ($i = 1; $i <= 31; $i++)
        echo "<option" . (isset($page_date['mday']) && $page_date['mday'] == $i ? " selected" : "") . ">$i</option>";
    echo "</select><select name='page_date[mon]' class='textbox'><option>--</option>";
    for ($i = 1; $i <= 12; $i++)
        echo "<option" . (isset($page_date['mon']) && $page_date['mon'] == $i ? " selected" : "") . ">$i</option>";
    echo "</select><select name='page_date[year]' class='textbox'><option>----</option>";
    for ($i = 2010; $i <= date('Y'); $i++)
        echo "<option" . (isset($page_date['year']) && $page_date['year'] == $i ? " selected" : "") . ">$i</option>";
    echo "</select> /<select name='page_date[hours]' class='textbox'>";
    for ($i = 0; $i <= 24; $i++)
        echo "<option" . (isset($page_date['hours']) && $page_date['hours'] == $i ? " selected" : "") . ">$i</option>";
    echo "</select> :<select name='page_date[minutes]' class='textbox'>";
    for ($i = 0; $i <= 60; $i++)
        echo "<option" . (isset($page_date['minutes']) && $page_date['minutes'] == $i ? " selected" : "") . ">$i</option>";
    ?>
                    </select> 
                    (opcjonalnie)
                </td>
            </tr>
            <tr>
                <td class="tbl"></td> 
                <td class="tbl"><input type="checkbox" name="page_date_show" value="yes"<?= $page_date_show ?>> Pokazuj datę dodania</td>
            </tr>
            <tr>
                <td class="tbl2"></td> 
                <td class="tbl2"><input type="checkbox" name="page_comments_status" value="yes"<?= $page_comments_status ?>> Włącz Komentarze</td>
            </tr>
            <tr>
                <td class="tbl"></td> 
                <td class="tbl"><input type="checkbox" name="page_reads_show" value="yes"<?= $page_reads_show ?>> Pokazuj licznik czytań</td>
            </tr>
            <tr>
                <td colspan="2" valign="top" class="tbl"><br /><strong>Kod strony:</strong></td>
            </tr>
            <tr>
                <td colspan="2" class="tbl" style="background:white;border:1px solid black;"><textarea id="code" name="page_content"  cols="130" rows="40" class="textbox" style="background:white;"><?= $page_content ?></textarea></td>
            </tr>
            <tr>
                <td colspan="2" valign="top" class="tbl"><br /><strong>Skrócony opis (meta description):</strong></td>
            </tr>
            <tr>
                <td colspan="2" class="tbl"><textarea name="page_description" cols="130" rows="5" class="textbox"><?= $page_description ?></textarea></td>
            </tr>
            <tr>
                <td align='center' colspan='2' class='tbl'><br>
                    <input type='submit' name='save' value='Zapisz podstronę' class='button'></td>
            </tr>
        </table>
    </form>
    <script type="text/javascript">
        var editor = CodeMirror.fromTextArea('code', {
            height: "550px",
            parserfile: ["parsexml.js", "parsecss.js", "tokenizejavascript.js", "parsejavascript.js", "parsehtmlmixed.js"],
            stylesheet: ["<?php echo DIR_INCLUDES; ?>codemirror/css/xmlcolors.css", "<?php echo DIR_INCLUDES; ?>codemirror/css/jscolors.css", "<?php echo DIR_INCLUDES; ?>codemirror/css/csscolors.css"],
            path: "<?php echo DIR_INCLUDES; ?>codemirror/js/",
            lineNumbers: "on",
            disableSpellcheck: false
        });
        function ValidateForm(frm) 
        {
            if(frm.page_title.value=='') 
            {
                alert('Proszę podać tytuł strony dodatkowej!');
                return false;
            }
        }
    </script>
    <?php
    $theme->panelClose();
}
