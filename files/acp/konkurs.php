<?php
if (!defined('IN_PHPBB')) exit;
SAC::checkPageAccess('u_sg_portal_konkurs');


$theme->panelOpen('Zgłoszenia konkursowe');

// Types
$type = request_var('type', '');
$action = request_var('action', '');
$types = array();
$select_opts = '';




if ($action == 'list')
{
    $sql = "SELECT tu.username
            FROM " . KONKURS_TABLE . " tk
            INNER JOIN " . USERS_TABLE . " tu ON (tk.user_id = tu.user_id)
            WHERE type = '" . $type . "'
            AND user_reputation >= 0
            AND user_warnings = 0
            ORDER BY id";
    $result = $db->sql_query($sql);
    
    ob_clean();
    echo '<pre>';
    while ($row = $db->sql_fetchrow())
    {
        echo $row['username'] . "\n";
    }
    echo '</pre>';
    exit;
}

$sql = 'SELECT DISTINCT type FROM ' . KONKURS_TABLE . ' ORDER BY dateline DESC';
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow())
{
    $types[] = $row['type'];
    $select_opts .= '<option value="' . $row['type'] . '"';
    if ($type == $row['type'])
    {
        $select_opts .= ' selected="selected"';
    }

    if ($type == '')
    {
        $type = $row['type'];
    }
    $select_opts .= '>' . $row['type'] . '</option>';
}

$u_list = URLs::ACP('self', array("type={$type}", "action=list"));

$sql = 'SELECT COUNT(id) AS votes FROM ' . KONKURS_TABLE;
$result = $db->sql_query($sql);
$num_votes = $db->sql_fetchfield('votes');

if ($num_votes)
{
    ?>
    <div class="center">
        <h3>Zgłoszenia konkursowe</h3>
        <form action="<?php $FILE_SELF; ?>" method="post">
            <strong>Wybrany konkurs:</strong>
            <select name="type" onchange="this.form.submit();">
                <?php echo $select_opts; ?>
            </select>
        </form>
        <br />
        <a href="<?php echo $u_list; ?>" target="_blank">Pobierz listę kwalifikowanych</a>
    </div>
    <br />


    <table align="center" cellpadding="0" cellspacing="1" class="tbl-border" style="width:70%;">
        <tr>
            <th class="tbl2">Lp.</th>
            <th class="tbl2">Login</th>
            <th class="tbl2">Reputacja</th>
            <th class="tbl2">Ostrzeżenia</th>
            <th class="tbl2" width="150px">Czas</th>
        </tr>
    <?php
    $sql = "SELECT tk.*, tu.username, tu.user_colour, tu.user_reputation, tu.user_warnings
    FROM " . KONKURS_TABLE . " tk
    INNER JOIN " . USERS_TABLE . " tu ON (tk.user_id = tu.user_id)
    WHERE type = '" . $type . "'
    ORDER BY id";
    $result = $db->sql_query($sql);

    $i = 1;
    while ($row = $db->sql_fetchrow($result))
    {
        $color_reput = ($row['user_reputation'] > 0) ? 'green' : 'red';
        $color_warn = ($row['user_warnings'] > 0) ? 'red' : 'green';
        
        $row['user_name'] = get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $row['username']);
        ?>
            <tr>
                <td class="tbl1" style="text-align:center"><?php echo $i; ?></td>
                <td class="tbl1">
            <?php echo $row['user_name']; ?>
                    <br />
                    <span class="small">
        <?php echo $row['user_email']; ?>
                        <br />
                        <a href="http://whois.domaintools.com/<?php echo $row['user_ip']; ?>"><?php echo $row['user_ip']; ?></a>
                    </span>
                </td>
                <td class="tbl1" style="text-align:center"><b style="color:<?php echo $color_reput; ?>"><?php echo $row['user_reputation']; ?><b></td>
                <td class="tbl1" style="text-align:center"><b style="color:<?php echo $color_warn; ?>"><?php echo $row['user_warnings']; ?><b></td>
                <td class="tbl1"><?php echo $user->format_date($row['dateline']); ?></td>
            </tr>
        <?php
        $i++;
    }
    ?>
    </table>
    <?php
}
else
{
    ?>
    <h3 class="center">Aktualnie nie ma żadnych zgłoszeń konkursowych.</h3>
        <?php
    }

    $theme->panelClose();

