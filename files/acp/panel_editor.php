<?php
if (!defined('IN_PHPBB')) exit;
SAC::checkPageAccess('u_sg_portal_panels');


// Get data for GET / POST
$action     = request_var('action', '');
$panel_id   = request_var('panel_id', 0);
$type       = request_var('type', '');
$step       = request_var('step', '');
$panel_side = request_var('panel_side', '');

if ($type == '')
{
    $type = 'index';
}

// Odczytanie wszystkich dostepnych sekcji
$temp   = opendir(DIR_PANELS);
while ($folder = readdir($temp))
{
    if (!in_array($folder, array('.', '..')) && strstr($folder, '_panel'))
    {
        if (is_dir(DIR_PANELS . $folder))
        {
            $panel_list[] = $folder;
        }
    }
}
closedir($temp);
sort($panel_list);

if (isset($_POST['save']))
{
    $error      = '';
    $panel_name = utf8_normalize_nfc(request_var('panel_name', '', true));
    if ($panel_name == '')
    {
        $error .= 'Brak Nazwy Panelu<br />';
    }
    $panel_filename = request_var('panel_filename', '');
    $panel_content  = ($panel_filename == '---') ? addslashes($_POST['content']) : '';
    $panel_side     = request_var('panel_side', '');
    $panel_access   = request_var('panel_access', 0);
    if ($panel_id)
    {
        if ($panel_name != '')
        {
            $sql    = "SELECT * FROM " . DB_PANELS . " 
			        WHERE panel_id='" . $panel_id . "'";
            $result = $db->sql_query($sql);
            $data   = $db->sql_fetchrow($result);
            if ($panel_name != $data['panel_name'])
            {
                $sql    = "SELECT * FROM " . DB_PANELS . " 
  			        WHERE panel_type = '" . $type . "' 
                AND panel_name = '" . $panel_name . "'";
                $result = $db->sql_query($sql);
                $data   = $db->sql_fetchrow($result);
                if ($data)
                {
                    $error .= 'Panel o takiej nazwie już istnieje<br />';
                }
            }
        }
        if ($error == '')
        {
            $sql = "UPDATE " . DB_PANELS . " SET 
              panel_name = '" . $panel_name . "', 
              panel_filename = '" . $panel_filename . "',
              panel_access = '" . $panel_access . "',
              panel_content = '" . $panel_content . "'
              WHERE panel_id='" . $panel_id . "'";
            $db->sql_query($sql);
        }
        $theme->panelOpen('Edytowanie panelu');
        echo "<center><br>";
        if ($error != '')
        {
            echo 'Panel nie został zapisany<br /><br />' . $error . '<br />';
        }
        else
        {
            echo 'Panel został zapisany<br /><br />' . $error . '<br />';
        }

        $link = URLs::ACP('panels', array("type={$type}"));
        echo "<a href='panels.php?type={$link}'>Przejdź do zarządzania panelami</a><br><br>
          <a href='index.php'>Powrot do Panelu Administracyjnego</a><br><br>
          </center>";
        $theme->panelClose();
    }
    else
    {
        if ($panel_name != '')
        {
            $sql    = "SELECT * FROM " . DB_PANELS . " 
			        WHERE panel_type = '" . $type . "' 
              AND panel_name = '" . $panel_name . "'";
            $result = $db->sql_query($sql);
            $data   = $db->sql_fetchrow($result);
            if ($data)
            {
                $error .= 'Panel o takiej nazwie już istnieje<br />';
            }
        }
        if ($error == '')
        {
            $sql        = "SELECT * FROM " . DB_PANELS . " 
			        WHERE panel_type = '" . $type . "' 
              AND panel_side = '" . $panel_side . "'
              ORDER BY panel_order DESC LIMIT 1";
            $result     = $db->sql_query($sql);
            $panel_data = $db->sql_fetchrow($result);
            if ($panel_data)
            {
                $neworder = $panel_data['panel_order'] + 1;
            }
            else
            {
                $neworder = 1;
            }
            $sql = "INSERT INTO " . DB_PANELS . " (panel_name, panel_filename, panel_content, panel_side, panel_order, panel_status, panel_type, panel_access) 
              VALUES('" . $panel_name . "', '" . $panel_filename . "', '" . $panel_content . "', '" . $panel_side . "', '" . $neworder . "', '0', '" . $type . "', '" . $panel_access . "')";
            $db->sql_query($sql);
        }

        $theme->panelOpen('Dodawanie nowego panelu');
        echo "<center><br>";
        if ($error != "")
        {
            echo "Wystąpił błąd<br><br>" . $error . "<br>";
        }
        else
        {
            echo "Panel został dodany<br><br>";
        }
        echo "<a href='panels.php?table=$type'>Zarządzanie panelami</a><br><br>
          <a href='index.php'>Strona główna administracji</a><br><br></center>";
        $theme->panelClose();
    }
}
else
{
    if ($action == "edit")
    {
        $sql    = "SELECT * FROM " . DB_PANELS . " 
		        WHERE panel_id='" . $panel_id . "'";
        $result = $db->sql_query($sql);
        $data   = $db->sql_fetchrow($result);
        if ($data)
        {
            $panel_name     = $data['panel_name'];
            $panel_filename = $data['panel_filename'];
            $panel_content  = stripslashes($data['panel_content']);
            $panel_side     = $data['panel_side'];
            $panel_access   = $data['panel_access'];
            $panelopts      = $panel_side == "left" || $panel_side == "right" ? " style='display:none'" : " style='display:block'";
        }
    }
    if ($panel_id)
    {
        $action         = URLs::ACP('self', array("type={$type}", "panel_id={$panel_id}"));;
        $theme->panelOpen('Edycja istniejącego panelu');
    }
    else
    {
        if (!isset($_POST['preview']))
        {
            $panel_name     = '';
            $panel_filename = "";
            $panel_content  = '';
            $panel_access   = '';
            $panel_side     = "";
            $panelon        = "";
            $panelopts      = " style='display:none'";
        }
        $action         = URLs::ACP('self', array("type={$type}"));;
        $theme->panelOpen('Dodawanie nowego panelu');
    }
    echo "<form name='editform' method='post' action='$action'>
        <table align='center' cellpadding='0' cellspacing='0' width='90%'>
        <tr>
          <td class='tbl'><b>Nazwa panelu:</b></td>
          <td class='tbl'><input type='text' name='panel_name' value='$panel_name' class='textbox' style='width:200px;'></td>
        </tr>";
    echo "<tr>
        <td class='tbl'><b>Plik panelu:</b></td>
        <td class='tbl'><select name='panel_filename' class='textbox' style='width:200px;'>";
    echo "<option value='---' " . ($panel_filename == '---' ? ' selected' : '') . ">---</option>";
    for ($i = 0; $i < count($panel_list); $i++)
    {
        echo "<option value='" . $panel_list[$i] . "'" . ($panel_filename == $panel_list[$i] ? " selected" : "") . ">$panel_list[$i]</option>";
    }
    echo "</select></td></tr>";
    echo "<tr><td class='tbl' colspan='2'><b>Kod panelu:</b></td></tr>";
    echo "<tr><td class='tbl' colspan='2'><textarea id='code' name='content' class='textbox' rows='15' style='width:100%'>" . $panel_content . "</textarea>";
    echo "<div id='editor'></div>";
    echo "</td></tr>";
    if (!$panel_id)
    {
        echo "<tr>
      <td class='tbl'>Umieszczenie</td>
      <td class='tbl'><select name='panel_side' class='textbox' style='width:150px;'>
      <option value='left'" . ($panel_side == "left" ? " selected" : "") . ">Lewa</option>
      <option value='header'" . ($panel_side == "header" ? " selected" : "") . ">Góra</option>
      <option value='right'" . ($panel_side == "right" ? " selected" : "") . ">Prawa</option>
      </select></td>
      </tr>";
    }
    ?>
    <tr>
        <td width="150px" class="tbl">Dostęp:</td>
        <td class="tbl">
            <select name="panel_access" class="textbox">
            <?php echo SAC::getLevelsSelect($panel_access); ?>
            </select>
        </td>
    </tr>
                <?php
                echo "<tr><td align='center' colspan='2' class='tbl'><br>";
                if ($panel_id)
                {
                    echo "<input type='hidden' name='panel_side' value='$panel_side'>";
                }
                ?>
    <input type='submit' name='preview' value='Podgląd' class='button'>
    <input type='submit' name='save' value='Zapisz' class='button'>
    </td>
    </tr>
    </table>
    </form>
    <?php
    $theme->panelClose();
}
