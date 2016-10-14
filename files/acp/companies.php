<?php
if (!defined('IN_PHPBB')) exit;
SAC::checkPageAccess('u_portal_companies');

// Get data for GET / POST
$id = request_var('id', 0); 
$action = request_var('action', ''); 
$status = request_var('status', '');

// Messages
if ($status) 
{
	if ($status == 'updated') 
  {
		$message = '<strong>Firma została zaktualizowana!</strong>';
	} 
  else if ($status == 'added') 
  {
		$message = '<strong>Firma została dodana!</strong>';
	} 
  elseif ($status == 'deleted') 
  {
		$message = '<strong>Firma została usunięta!</strong>';
	}  
	$theme->panelOpen('Informacja');
	echo '<div class="adminInfo">' . $message . '</div>';
	$theme->panelClose();
}
             
if ($action == 'save') 
{
	$name = utf8_normalize_nfc(request_var('name', '', true));
	$info = utf8_normalize_nfc(request_var('info', '', true));
	$website = utf8_normalize_nfc(request_var('website', '', true));
  $url = $phpbb_seo->format_url($name);
	$sorting = utf8_normalize_nfc(request_var('sorting', '', true));
	$sql_arr = array(
    'name'    => $name,
    'url'    => $url,
    'info'    => $info,
    'website'    => $website,
    'url'    => $url,
    'sorting'    => $sorting,
	);
	if ($id) 
  {
		$sql = 'UPDATE ' . DB_COMPANIES . ' 
						SET ' . $db->sql_build_array('UPDATE', $sql_arr) . '
						WHERE id = ' . $id;
		$db->sql_query($sql);
    redirect("{$FILE_SELF}&action=status&status=updated");
	} 
	else 
  {
		$sql = 'INSERT INTO ' . DB_COMPANIES . ' ' . $db->sql_build_array('INSERT', $sql_arr);
		$db->sql_query($sql);
		redirect("{$FILE_SELF}&action=status&status=added");
	}
}
elseif ($action == 'delete') 
{
  $sql = 'SELECT * 
          FROM ' . DB_COMPANIES . '
					WHERE id = ' . $id; 
	$result = $db->sql_query($sql);
	$catData = $db->sql_fetchrow($result);
  if ($catData)
  {
    $sql = 'DELETE FROM ' . DB_COMPANIES . '
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
            FROM ' . DB_COMPANIES . '
  					WHERE id = ' . $id; 
  	$result = $db->sql_query($sql);
  	$row = $db->sql_fetchrow($result);
  	$name = stripslashes($row['name']);
  	$info = stripslashes($row['info']);
  	$website = $row['website']; 
    $sorting = $row['sorting'];
    $formAction = "{$FILE_SELF}&id={$id}";
    $theme->panelOpen('Edycja istniejącej firmy');
  }
  else
  {
  	$name = '';
  	$info = '';
    $website = '';
    $sorting = '';
    $formAction = $FILE_SELF;
  	$theme->panelOpen('Dodawanie nowej firmy');    
  }
	?>
    <form name="inputform" method="post" action="<?php echo $formAction; ?>" onSubmit="return ValidateForm(this)">
      <table align="center" cellpadding="0" cellspacing="0" width="850px">
        <tr>
          <td width="150px" class="tbl">Nazwa:</td>
          <td class="tbl"><input type="text" name="name" value="<?php echo $name; ?>" required="required" class="textbox" style="width:250px;"></td>
        </tr>
        <tr>
          <td width="150px" class="tbl">Strona www:</td>
          <td class="tbl"><input type="text" name="website" value="<?php echo $website; ?>" class="textbox" style="width:250px;"></td>
        </tr>
        <tr>
          <td width="150px" class="tbl">Metoda sortowania:</td>
          <td class="tbl">
            <select name="sorting" class="textbox">
              <option value="title" <?php if ($sorting == 'title') echo 'selected="selected"'; ?>>Tytuł</option>
              <option value="time" <?php if ($sorting == 'time') echo 'selected="selected"'; ?>>Czas dodania</option>
            </select>
          </td>
        </tr>
        <tr>
          <td colspan="2" valign="top" class="tbl"><br /><strong>Opis firmy:</strong></td>
        </tr>
        <tr>
          <td colspan="2" class="tbl"><textarea id="redactor" name="info" cols="130" rows="10" class="textbox"><?php echo $info; ?></textarea></td>
        </tr>
        <tr>
          <td style="text-align:center" colspan="2" class="tbl">
            <br />
            <input type="hidden" name="action" value="save" />
            <input type="submit" name="save" value="Zapisz firmę" class="button">
          </td>
        </tr>
      </table>
    </form> 
  <?php
  $theme->panelClose();
  $theme->panelOpen('Baza firm');
  
  $companies = array();
  $sql = "SELECT * 
          FROM " . DB_COMPANIES . "
          ORDER BY name";
  $result = $db->sql_query($sql);
  while ($row = $db->sql_fetchrow($result)) 
  {
  	$companies[$row['id']] = array(
  	  'name' => stripslashes($row['name']), 
      'sorting' => ($row['sorting'] == 'title') ? 'Tytuł' : 'Data dodania',
      'url_edit' => $FILE_SELF . "?action=edit&amp;id=" . $row['id'],
      'img_edit' => buildIconLink('edit', $FILE_SELF . "?action=edit&id={$row['id']}"),
      'img_delete' => buildIconLink('delete', $FILE_SELF . "?action=edit&id={$row['id']}"),
      'website' => stripslashes($row['website']),
    ); 
  }
  if (!empty($companies))
  {
    ?>
      <table align="center" cellpadding="0" cellspacing="1" width="95%" class="tbl-border">
        <tr>
          <th align="center" class="tbl2" width="50%" colspan="2">Nazwa</th>
          <th align="center" class="tbl2">WWW</th>
          <th align="center" class="tbl2">Sortuj wg.</th>
          <th align="center" class="tbl2">Opcje</th>
        </tr>
    <?php
    foreach ($companies as $company)
    { 
      ?>
        <tr>
          <td class="tbl1" valign="top" colspan="2">
            <b><a href="<?php echo $company['url_edit']; ?>"><?php echo $company['name']; ?></a></b>
          </td>
          <td style="text-align:center" class="tbl1" valign="top"><?php echo $company['website']; ?></td>
          <td style="text-align:center" class="tbl1" valign="top"><?php echo $company['sorting']; ?></td>
          <td style="text-align:center" class="tbl1" valign="top"><?php echo $company['img_edit'] . $company['img_delete']; ?></td>
        </tr>
        <?php
    }
    ?>
      </table>
    <?php
  }
  else
  {
    ?>
      <h3 class="error center">W bazie nie ma jeszcze żadnej firmy</h3>
    <?php
  }
  $theme->panelClose();
}  
require_once DIR_ACP . 'footer.php';