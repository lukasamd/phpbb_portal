<?php
if (!defined('IN_PHPBB')) exit;
SAC::checkPageAccess('u_sg_portal_acp');


$theme->panelOpen('SafeGroup - Panel Administracyjny');

$counter = array();
$counter['comments'] = dbCount(DB_COMMENTS, 'comment_id');
$counter['news']     = dbCount(DB_CONTENT, 'id');
$counter['users']    = dbCount(USERS_TABLE, 'user_id');
?>
<div class="center"><h3>Ogólne statystyki serwisu</h3></div>
<table align="center" cellpadding="0" cellspacing="1" width="400px" class="tbl-border">
    <tr>
        <td class="tbl1">Wpisów:</td>
        <td class="tbl1"><?php echo $counter['news']; ?></td>
    </tr>
    <tr>
        <td class="tbl1">Komentarzy:</td>
        <td class="tbl1"><?php echo $counter['comments']; ?></td>
    </tr>
    <tr>
        <td class="tbl1">Zarejestrowanych:</td>
        <td class="tbl1"><?php echo $counter['users']; ?></td>
    </tr>  
</table>
<br /><hr /><br />
<?php
$contents_ids = array();
$sql = 'SELECT id
        FROM ' . DB_CONTENT . ' 
        ORDER BY views DESC 
        LIMIT 10';
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result))
{
    $contents_ids[] = $row['id'];
}

$model = Registry::get('Model');
$contents = $model->Content->getContent($contents_ids);

?>
<div class="center"><h3>Najpopularniejsze wpisy</h3></div>
<table align="center" cellpadding="0" cellspacing="1" width="80%" class="tbl-border">
    <tr>
        <th class="tbl2">News</th>
        <th class="tbl2">Czytań</th>
        <th class="tbl2">Komentarzy</th>
    </tr>
<?php
foreach ($contents as $row)
{
    ?>
    <tr>
        <td class="tbl1">
            <a href="<?php echo $urls->buildUrl('content', $row); ?>"><?php echo $row['title']; ?></a>
        </td>
        <td class="tbl1" align="center"><?php echo $row['views']; ?></td>
        <td class="tbl1" align="center"><?php echo $row['comments']; ?></td>
    </tr>
    <?php
}
$db->sql_freeresult();
?>
</table>
<br /><hr /><br />
<?php
$contents_ids = array();
$sql = 'SELECT id
        FROM ' . DB_CONTENT . ' 
        ORDER BY comments DESC 
        LIMIT 10';
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result))
{
    $contents_ids[] = $row['id'];
}

$model = Registry::get('Model');
$contents = $model->Content->getContent($contents_ids);
?>
<div class="center"><h3>Najczęściej komentowane wpisy</h3></div>
<table align="center" cellpadding="0" cellspacing="1" width="80%" class="tbl-border">
    <tr>
        <th class="tbl2">News</th>
        <th class="tbl2">Czytań</th>
        <th class="tbl2">Komentarzy</th>
    </tr>
<?php
foreach ($contents as $row)
{
    ?>
    <tr>
        <td class="tbl1">
            <a href="<?php echo $urls->buildUrl('content', $row); ?>"><?php echo $row['title']; ?></a>
        </td>
        <td class="tbl1" align="center"><?php echo $row['views']; ?></td>
        <td class="tbl1" align="center"><?php echo $row['comments']; ?></td>
    </tr>
    <?php
}
$db->sql_freeresult();
?>
</table>

<?php
$theme->panelClose();
require_once DIR_ACP . 'footer.php';
?>