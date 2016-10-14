<?php
if (!defined('IN_PHPBB')) exit;
SAC::checkPageAccess('u_sg_portal_censor');


// Get data for GET / POST
$status = request_var('status', '');


// Messages
if ($status)
{
    if ($status == 'updated')
    {
        $message = '<strong>Cenzor słów został zaktualizowany!</strong>';
    }
    $theme->panelOpen('Informacja');
    echo '<div class="adminInfo">' . $message . '</div>';
    $theme->panelClose();
}


// Save censor words to database
if (isset($_POST['save']))
{
    if ($_POST['words'] != '')
    {
        $words = explode("\n", $_POST['words']);

        $sql = "TRUNCATE TABLE " . DB_CENSOR;
        $db->sql_query($sql);

        $words_sql = array_map('trim', $words);
        $sql = "INSERT IGNORE INTO " . DB_CENSOR . " (word)
           VALUES ('" . implode("'),('", $words_sql) . "')";
        $db->sql_query($sql);
    }
    redirect("{$FILE_SELF}&status=updated");
}


$theme->panelOpen('Cenzor słów');

$sql = 'SELECT *
				FROM ' . DB_CENSOR . '
				ORDER BY word';
$result = $db->sql_query($sql);

$words = array();
while ($row = $db->sql_fetchrow($result))
{
    $words[] .= $row['word'];
}
?>
<form name="inputform" method="post" action="<?php echo $FILE_SELF; ?>">
    <table align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td class="tbl">Słowa zabronione:</td>
        </tr>
        <tr>
            <td class="tbl"><textarea name="words" cols="130" rows="40" class="textbox"><?php echo implode("\n", $words); ?></textarea></td>
        </tr>
        <tr>
            <td class='tbl' style="text-align:center">
                <br />
                <input type='submit' name='save' value='Zapisz ustawienia cenzora' class='button'>
            </td>
        </tr>
    </table>
</form>
<br />

<?php
$theme->panelClose();
