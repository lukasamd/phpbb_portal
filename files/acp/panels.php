<?php
if (!defined('IN_PHPBB')) exit;
SAC::checkPageAccess('u_sg_portal_panels');


// Get data for GET / POST
$panel_id = request_var('panel_id', 0);
$order    = request_var('order', 0);
$status   = request_var('status', 0);
$action   = request_var('action', '');
$type     = request_var('type', 'index');

if ($action == "delete")
{
    $sql = 'SELECT * FROM ' . DB_PANELS . ' 
            WHERE panel_id = ' . $panel_id;
    $result     = $db->sql_query($sql);
    $panel_data = $db->sql_fetchrow($result);
    $sql = "DELETE FROM " . DB_PANELS . " 
            WHERE panel_id = '" . $panel_id . "'
            AND panel_type = '" . $type . "'";
    $db->sql_query($sql);
    
    $sql = "UPDATE " . DB_PANELS . " 
            SET panel_order = panel_order - 1 
            WHERE panel_side = '" . $panel_data['panel_side'] . "'
            AND panel_type = '" . $type . "'
            AND panel_order >= '" . $panel_data['panel_order'] . "'";
    $db->sql_query($sql);
    redirect($FILE_SELF . "&type={$type}");
}

if ($action == "setstatus")
{
    $sql = "UPDATE " . DB_PANELS . " 
          SET panel_status = '" . $status . "' 
          WHERE panel_id = '" . $panel_id . "'";
    $db->sql_query($sql);
}
$theme->panelOpen('Panele witryny');
?>
<table align='center' cellpadding='0' cellspacing='1' style="width:90%;">
    <tr>
        <td class='tbl2' style="text-align:center;">
            <form id="panelsType" action="<?php echo $FILE_SELF; ?>&" method="GET">
                <input type="hidden" name="p" value="panels" />
                <b>Wybrana podstrona do konfigurowania paneli:</b>
                <select id="panelType" name="type" class="textbox" style="width:150px">
                    <optgroup label="Aktualności">
                        <option value="index"<?php if ($type == 'index') echo ' selected="selected"'; ?>>Strona główna</option>
                        <option value="newsCats"<?php if ($type == 'newsCats') echo ' selected="selected"'; ?>>Kategorie newsów</option>
                        <option value="newsCat"<?php if ($type == 'newsCat') echo ' selected="selected"'; ?>>Kategoria newsa</option>
                        <option value="news"<?php if ($type == 'news') echo ' selected="selected"'; ?>>Pojedynczy news</option>
                    </optgroup>
                    <optgroup label="Inne">
                        <option value="others"<?php if ($type == 'others') echo ' selected="selected"'; ?>>Inne</option>
                        <option value="search"<?php if ($type == 'search') echo ' selected="selected"'; ?>>Wyszukiwarka</option>
                    </optgroup>  
                    <optgroup label="Dodatkowe strony">
                        <option value="passwordGenerator"<?php if ($type == 'passwordGenerator') echo ' selected="selected"'; ?>>Generator haseł</option>
                        <option value="lastComments"<?php if ($type == 'lastComments') echo ' selected="selected"'; ?>>Ostatnie komentarze</option>
                    </optgroup>  
                </select>
            </form>
            <script>
                $(document).ready(function()
                {
                    $('#panelType').change(function() {
                        $("#panelsType").submit();
                    });
                }); 
            </script>
        </td>
    </tr>
    <tr><td>&nbsp;</td></tr></table>
<div id="info" class="center"></div>
<?php
$ps = 1;
$i  = 1;
$dataSides = array(
    1 => array(
        'sign' => 'header',
        'name' => 'Góra',
    ),
    2      => array(
        'sign' => 'left',
        'name' => 'Lewa',
    ),
    3      => array(
        'sign' => 'right',
        'name' => 'Prawa',
    ),
    4      => array(
        'sign'      => 'footer',
        'name'      => 'Dół',
    ),
);
$dataPanels = array('header' => array(), 'left' => array(), 'right' => array(), 'footer' => array());
$sql    = "SELECT * FROM " . DB_PANELS . " 
        WHERE panel_type = '" . $type . "'
        ORDER BY panel_side, panel_order";
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result))
{
    $dataPanels[$row['panel_side']][] = $row;
}
for ($i = 1; $i <= count($dataSides); $i++)
{
    $side = $dataSides[$i]['sign'];
    ?>
    <div class="listTopMain">
        <div class="tbl3 listTopSecond">
            <div style="float:left;width:40%;"><b><?php echo $dataSides[$i]['name']; ?></b></div>
            <div style="float:left;width:20%;"><b>Typ</b></div>
            <div style="float:left;width:20%;"><b>Dostęp</b></div>
            <div style="float:right;width:20%;"><b>Opcje</b></div>
        </div>
    </div>
    <ul class="chooseList connected" class="tbl-border" data-side="<?php echo $dataSides[$i]['sign']; ?>">
        <?php
        if (count($dataPanels[$side]))
        {
            foreach ($dataPanels[$side] as $panel)
            {
                $options       = '';
                $styleLi       = 'tbl1';
                $panel['type'] = ($panel['panel_filename'] === '---') ? 'Kod' : 'Plik';
                $href = URLs::ACP('panel_editor', array("type={$type}" , "action=edit", "panel_id={$panel['panel_id']}"));
                $options .= "[<a href='{$href}'>Edytuj</a>] ";
                
                $href = URLs::ACP('self', array("action=setstatus", "panel_id={$panel['panel_id']}"));
                if ($panel['panel_status'] == 0)
                {
                    $href = URLs::ACP('self', array("action=setstatus", "panel_id={$panel['panel_id']}", "status=1"));
                    $options .= "[<a href='{$href}'>Włącz</a>] ";
                    $styleLi .= ' disabled';
                }
                else
                {
                    $href = URLs::ACP('self', array("action=setstatus", "panel_id={$panel['panel_id']}", "status=0"));
                    $options .= "[<a href='{$href}'>Wyłącz</a>] ";
                }
                $href = URLs::ACP('self', array("action=delete", "panel_id={$panel['panel_id']}", "type={$type}"));
                $options .= "[<a href='" . $href . "' onClick='return ConfirmDelete()'>Usuń</a>]";
                ?>
                <li id="listItem_<?php echo $panel['panel_id']; ?>" class="<?php echo $styleLi; ?>">   
                    <div style="float:left;width:40%;">
                        <img src='<?php echo DIR_ICONS; ?>icon_arrow.png' alt='move' class='handle' />
                        <?php echo $panel['panel_name']; ?>
                    </div>
                    <div style="float:left;width:20%;"><?php echo $panel['type']; ?></div>
                    <div style="float:left;width:20%;"><?php echo SAC::getLevelName($panel['panel_access']); ?></div>
                    <div style="float:right;width:20%;"><?php echo $options; ?></div>
                </li>
                <?php
            }
        }
        ?>
    </ul>
    <?php
}
?>
<br />
<div class="center">
    [ <a href='<?php echo URLs::ACP('panel_editor', array("type={$type}")); ?>'>Dodaj nowy panel</a> ]
</div>
<?php
$theme->panelClose();

$theme->panelOpen('Kopiowanie paneli');
echo "<form name='copy_settings_frm' action='" . $FILE_SELF . "?type='{$type}' method='post'>
<table class='center' width='70%' cellpadding='0' cellspacing='0'>";
if (isset($_POST['copy_settings']))
{
    if (isset($_POST['copy_from']) && isset($_POST['copy_to']) && $_POST['copy_from'] != $_POST['copy_to'])
    {
        $copy_from = request_var('copy_from', '');
        $copy_to   = request_var('copy_to', '');
        $sql = "DELETE FROM " . DB_PANELS . " 
            WHERE panel_type = '" . $copy_to . "'";
        $db->sql_query($sql);

        $sql    = "SELECT * FROM " . DB_PANELS . "
            WHERE panel_type = '" . $copy_from . "'";
        $result = $db->sql_query($sql);
        while ($row = $db->sql_fetchrow($result))
        {
            $sql_arr = array(
                'panel_name'     => $row['panel_name'],
                'panel_filename' => $row['panel_filename'],
                'panel_content'  => $row['panel_content'],
                'panel_side'     => $row['panel_side'],
                'panel_order'    => $row['panel_order'],
                'panel_status'   => $row['panel_status'],
                'panel_type'     => $copy_to,
            );
            $sql = 'INSERT INTO ' . DB_PANELS . ' ' . $db->sql_build_array('INSERT', $sql_arr);
            $db->sql_query($sql);
        }
        echo "<tr height='40'><td style='text-align:center;'>Skopiowano ustawienia.</td></tr>";
    }
    else
    {
        echo "<tr height='40'><td style='text-align:center;'><span style='color:red;'>Ustawienia nie zostały skopiowane.</span></td></tr>";
    }
}
$panelsTypes = '
  <optgroup label="Aktualności">
    <option value="index">Strona główna</option>
    <option value="newsCats">Kategorie newsów</option>
    <option value="newsCat">Kategoria newsa</option>
    <option value="news">Pojedynczy news</option>
  </optgroup>
  <optgroup label="Inne">
    <option value="others">Inne</option>
    <option value="search">Wyszukiwarka</option>
  <optgroup label="Inne">
    <option value="passwordGenerator">Generator haseł</option>
    <option value="lastComments">Ostatnie komentarze</option>';

echo "<tr><td style='text-align:center;'>
Kopiuj z: <select name='copy_from' class='textbox' style='width:200px;'>
" . $panelsTypes . "
</select> do:
<select name='copy_to' class='textbox' style='width:200px;'>
" . $panelsTypes . "
</select>
</td></tr><tr><td style='text-align:center;'>
<input type='submit' class='button' name='copy_settings' value='Kopiuj panele'>
</td></tr></table>
</form>
";

$theme->panelClose();
