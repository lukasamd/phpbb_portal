<?php
if (!defined('IN_PHPBB')) exit;
define('AUTH_CHECK', 'u_site_news_cats');

$theme->panelOpen('Sprawdzanie dostępności plików działu download');
// Sprawdzanie czy pliki istniaja
$sql = 'SELECT tf.*, tp.title AS program_title
        FROM ' . DB_FILES . ' AS tf
        INNER JOIN ' . DB_SOFTWARE . ' AS tp ON tf.program = tp.id';
$result = $db->sql_query($sql);
$pattern = 'HTTP/1.1 200';
$errors_array = array();
$errors = 0;
while($row = $db->sql_fetchrow($result))
{
  $ch = curl_init($row['url']);
  curl_setopt($ch, CURLOPT_HEADER, 1);
  curl_setopt($ch, CURLOPT_NOBODY, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $data = curl_exec($ch);
  curl_close($ch);
  if(stripos($data, $pattern) === FALSE)
  {
    $row['error'] = $data;
    $errors_array[] = $row;
    $errors++;
  }
}

if ($errors)
{
  ?>
    <h3 class="center">Niestety, znaleziono problemy z plikami!</h3>
    <br />
    <table align="center" cellpadding="0" cellspacing="1" class="center tbl-border" style="width:50%;">
    <tr>
      <th class="tbl1" align="center">Program</th>
      <th class="tbl1" align="center">Plik</th>
      <th class="tbl1" align="center">Błąd</th>
    </tr>
  <?php
  foreach ($errors_array as $id => $file_data)
  {
    ?>
      <tr>
        <td class="tbl1"><a href="programs.php?action=edit&amp;id=<?php echo $file_data['program']; ?>"><?php echo $file_data['program_title']; ?></a></td>
        <td class="tbl1"><a href="files.php?action=edit&amp;id=<?php echo $file_data['id']; ?>"><?php echo $file_data['title']; ?></a></td>
        <td class="tbl1"><?php echo $file_data['error']; ?></td>
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
    <h3 class="center">Hurra! Nie wykryto żadnych problemów!</h3>
  <?php
}

$theme->panelClose();
require_once DIR_ACP . 'footer.php';
?>