<?php
if (!defined('IN_PHPBB')) exit;
SAC::checkPageAccess('u_sg_portal_pages_forum');


// Get data for GET / POST
$id     = request_var('id', 0);
$action = request_var('action', '');
$status = request_var('status', '');
$page = array();

// Messages
if ($status)
{
    if ($status == 'updated')
    {
        $message = '<strong>Strona została zaktualizowana!</strong>';
    }
    else if ($status == 'added')
    {
        $message = '<strong>Strona została dodana!</strong>';
    }
    else if ($status == 'deleted')
    {
        $message = '<strong>Strona została usunięta!</strong>';
    }
    $theme->panelOpen('Informacja');
    echo '<div class="adminInfo">' . $message . '</div>';
    $theme->panelClose();
}

if ($action == 'delete')
{
}
if ($action == 'save')
{
    $id = request_var('id', 0);
    $page['title']   = utf8_normalize_nfc(request_var('title', '', true));
    $page['slug']    = (isset($_POST['slug'])) ? $_POST['slug'] : $phpbb_seo->format_url($page['title']);
    $page['content'] = isset($_POST['content']) ? $_POST['content'] : '';
    if ($id)
    {
        $sql = 'UPDATE ' . CUSTOM_PAGES_TABLE . ' 
                SET ' . $db->sql_build_array('UPDATE', $page) . '
                WHERE id = ' . $id;
        $db->sql_query($sql);
        redirect("{$FILE_SELF}&status=updated");
    }
    else
    {
        $sql = 'INSERT INTO ' . CUSTOM_PAGES_TABLE . ' ' . $db->sql_build_array('INSERT', $page);
        $db->sql_query($sql);
        redirect("{$FILE_SELF}&status=added");
    }
}
else
{
    if ($action == 'edit')
    {
        $sql    = 'SELECT * FROM ' . CUSTOM_PAGES_TABLE . ' 
                WHERE id = ' . $id;
        $result = $db->sql_query($sql);
        $page   = $db->sql_fetchrow($result);
        $page   = array_map('stripslashes', $page);
    }
    if ($id)
    {
        $formAction = "{$FILE_SELF}&action=save&id={$id}";
        $theme->panelOpen('Dodatkowe podstrony');
    }
    else
    {
        $page = array(
            'title'   => '',
            'content' => '',
            'slug'    => '',
        );
        $formAction = "{$FILE_SELF}&action=save";
        $theme->panelOpen('Dodaj newsa');
    }
    ?>
    <form name="inputform" method="post" action="<?php echo $formAction; ?>" onSubmit="return ValidateForm(this);" >
        <table align="center" cellpadding="0" cellspacing="0" width="850px">
            <tr>
                <td width="100" class="tbl">Tytuł</td>
                <td width="80%" class="tbl"><input type="text" name="title" value="<?php echo $page['title']; ?>" required="required" class="textbox" style="width: 400px"></td>
            </tr>
            <tr>
                <td width="100" class="tbl">Adres</td>
                <td width="80%" class="tbl"><input type="text" name="slug" value="<?php echo $page['slug']; ?>" class="textbox" style="width: 400px"></td>
            </tr>
            <tr>
                <td colspan="2" valign="top" class="tbl"><strong>Treść:</strong></td>
            </tr>
            <tr>
                <td colspan="2" class="tbl" style="position:relative;">
                    <textarea id="code" name="content" cols="50" rows="20" style="width:90%;"><?php echo $page['content']; ?></textarea>
                    <div id="editor"></div>
                </td>
            </tr> 
            <tr>
                <td style="text-align:center" colspan="2" class="tbl">
                    <br />
                    <input type="submit" name="save" value="Zapisz stronę" class="button" />
                </td>
            </tr>
        </table>
    </form>
    

    
    
    <?php
    $theme->panelClose();
}
