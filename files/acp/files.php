<?php
if (!defined('IN_PHPBB')) exit;
define('AUTH_CHECK', 'u_site_news_cats');

// Get data for GET / POST
$id = request_var('id', 0); 
$action = request_var('action', ''); 
$status = request_var('status', '');

// Messages
if ($status) 
{
	if ($status == 'updated') 
  {
		$message = '<strong>Plik został zaktualizowany!</strong>';
	} 
  else if ($status == 'added') 
  {
		$message = '<strong>Plik został dodany!</strong>';
	} 
  elseif ($status == 'deleted') 
  {
		$message = '<strong>Plik został usunięty!</strong>';
	}  
	$theme->panelOpen('Informacja');
	echo '<div class="adminInfo">' . $message . '</div>';
	$theme->panelClose();
}

if ($action == 'save') 
{
	$title = utf8_normalize_nfc(request_var('title', '', true));
	$access = request_var('access', 0);
  $mirror = $phpbb_seo->format_url($title); 
  $program = request_var('program', 0); 
  $version = request_var('version', 0);
	$sql_arr = array(
    'title'    => $title,
		'mirror'    => $mirror,
    'program'   => $program, 
    'access'    => $access,
    'version'    => $version,
	);
	if ($id) 
  {
		$sql = 'UPDATE ' . DB_FILES . ' 
						SET ' . $db->sql_build_array('UPDATE', $sql_arr) . '
						WHERE id = ' . $_GET['id'];
		$db->sql_query($sql);
    redirect("{$FILE_SELF}&action=status&status=updated");
	} 
	else 
  {
		$sql = 'INSERT INTO ' . DB_FILES . ' ' . $db->sql_build_array('INSERT', $sql_arr);
		$db->sql_query($sql);
    redirect("{$FILE_SELF}&action=status&status=added");
	}
}
elseif ($action == 'delete') 
{
  $sql = 'SELECT * 
          FROM ' . DB_FILES . '
					WHERE id = ' . $id; 
	$result = $db->sql_query($sql);
	$fileData = $db->sql_fetchrow($result);
  if ($fileData)
  {
    $sql = 'DELETE FROM ' . DB_FILES . '
            WHERE id = ' . $id;  
    $result = $db->sql_query($sql);
    redirect("{$FILE_SELF}&action=status&status=deleted");
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
    $sql = 'SELECT * 
            FROM ' . DB_FILES . '
  					WHERE id = ' . $id; 
  	$result = $db->sql_query($sql);
  	$row = $db->sql_fetchrow($result);
  	$title = $row['title'];
    $access = $row['access'];
    $version = $row['version'];
    $mirror = $row['mirror'];
    $formAction = "{$FILE_SELF}&id={$id}";
    $theme->panelOpen('Edycja istniejącego pliku');
  }
  else
  {
  	$title = '';
    $access = '';
    $version = '';
    $mirror = '';
    $formAction = $FILE_SELF;
  	$theme->panelOpen('Dodawanie nowego pliku');    
  }
	
  $programs_opts = ''; 
  $programsData = array();
  $selected = '';
  $sql = 'SELECT * FROM ' . DB_SOFTWARE . '
          ORDER BY title DESC';
  $result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result)) 
  {
  	$programsData[$row['id']] = array(
  	  'title' => stripslashes($row['title']), 
      'url_edit' => $FILE_SELF . "?action=edit&amp;id=" . $row['id'],
      'img_edit' => ' <a href="programs.php?action=edit&amp;id=' . $row['id'] . '"><img src="' . URL_FORUM . '/adm/images/icon_edit.gif" /></a>',
      'img_delete' => ' <a href="programs.php?action=delete&amp;id=' . $row['id'] . '"><img src="' . URL_FORUM . '/adm/images/icon_delete.gif" /></a>',
      'files' => array(),
		);
		if ($id)
    {
      $selected = ($id == $row['gallery'] ? " selected" : "");
    }
		$programs_opts .= "<option value='" . $row['id'] . "'$selected>" . stripslashes($row['title']) . "</option>";
	}
	?>
    <form name="inputform" method="post" action="<?php echo $formAction; ?>" onSubmit="return ValidateForm(this)">
      <table align="center" cellpadding="0" cellspacing="0" width="850px">
        <tr>
          <td width="100" class="tbl">Program</td>
          <td width="80%" class="tbl">
            <select name="cat_parent" class="textbox">
            <option value="0">- Brak -</option>
            <?php echo $programs_opts; ?></select>
          </td>
        </tr>
        <tr>
          <td width="150px" class="tbl">Nazwa:</td>
          <td class="tbl"><input type="text" name="title" value="<?php echo $title; ?>"required="required" class="textbox" style="width:250px;"></td>
        </tr>
        <tr>
          <td width="150px" class="tbl">Link:</td>
          <td class="tbl"><input type="text" name="mirror" value="<?php echo $mirror; ?>" class="textbox" style="width:250px;"></td>
        </tr>
        <tr>
          <td width="150px" class="tbl">Wersja:</td>
          <td class="tbl">
            <select name="version" class="textbox">
              <option value="stable" <?php if ($version == 'stable') echo 'selected="selected"'; ?>>Stabilna</option>
              <option value="beta" <?php if ($version == 'beta') echo 'selected="selected"'; ?>>Rozwojowa</option>
              <option value="other" <?php if ($version == 'other') echo 'selected="selected"'; ?>>Inna</option>
            </select>
          </td>
        </tr>
        <tr>
          <td width="150px" class="tbl">Dostęp:</td>
          <td class="tbl">
            <select name="access" class="textbox">
              <?php echo getAccessLevelOptions($access); ?>
            </select>
          </td>
        </tr>
        <tr>
          <td style="text-align:center" colspan="2" class="tbl">
            <br />
            <input type="hidden" name="action" value="save" />
            <input type="submit" name="save" value="Zapisz plik" class="button">
          </td>
        </tr>
      </table>
    </form> 
  <?php
  $theme->panelClose();
  $theme->panelOpen('Istniejące pliki');
  
  $categories = array();
  $sql = "SELECT * 
          FROM " . DB_FILES . "
          ORDER BY title, version";
  $result = $db->sql_query($sql);
  $filesCount = $db->sql_numrow($result);
  while ($row = $db->sql_fetchrow($result)) 
  {
  	$programsData[$row['program']]['files'][] = array(
  	  'title' => stripslashes($row['title']), 
  	  'mirror' => stripslashes($row['mirror']), 
      'version' => ($row['version'] == 'title') ? 'Tytuł' : 'Data dodania',
      'count' => $row['count'],
      'url_edit' => $FILE_SELF . "?action=edit&amp;id=" . $row['id'],
      'img_edit' => ' <a href="' . $FILE_SELF . "?action=edit&amp;id=" . $row['id'] . '"><img src="' . URL_FORUM . '/adm/images/icon_edit.gif" /></a>',
      'img_delete' => ' <a href="' . $FILE_SELF . "?action=delete&amp;id=" . $row['id'] . '"><img src="' . URL_FORUM . '/adm/images/icon_delete.gif" /></a>',
      'access' => SAC::getLevelName($row['access']),
    ); 
  }

  if ($filesCount)
  {
    ?>
      <table align="center" cellpadding="0" cellspacing="1" width="95%" class="tbl-border">
        <tr>
          <th align="center" class="tbl2" width="50%" colspan="2">Nazwa programu</th>
          <th align="center" class="tbl2">Dostęp</th>
          <th align="center" class="tbl2">Wersja</th>
          <th align="center" class="tbl2">Opcje</th>
        </tr>
    <?php
    foreach ($programsData as $program)
    { 
      ?>
        <tr>
          <td class="tbl1" valign="top" colspan="2">
            <b><a href="<?php echo $program['url_edit']; ?>"><?php echo $program['title']; ?></a></b>
          </td>
        </tr>
        <?php
        foreach ($program['files'] as $file)
        {
          ?>
            <tr>
              <td class="tbl1" style="width:5%"></td>
              <td class="tbl1" valign="top">
                <b><a href="<?php echo $file['url_edit']; ?>"><?php echo $file['title']; ?></a></b>
                <span class="small"> - Pobrań (<?php echo $file['count']; ?>)</span>
              </td>
              <td style="text-align:center" class="tbl1" valign="top"><?php echo $file['access']; ?></td>
              <td style="text-align:center" class="tbl1" valign="top"><?php echo $file['version']; ?></td>
              <td style="text-align:center" class="tbl1" valign="top"><?php echo $file['img_edit'] . $file['img_delete']; ?></td>
            </tr>
          <?php
        }
    }
    ?>
      </table>
    <?php
  }
  else
  {
    ?>
      <h3 class="error center">W bazie nie ma jeszcze żadnych plików</h3>
    <?php
  }
  $theme->panelClose();
}  
