<?php
if (!defined('IN_PHPBB')) exit;
SAC::checkPageAccess('u_sg_portal_panels');
ob_clean();

// Get data for GET / POST
$listItem = (isset($_GET['listItem'])) ? $_GET['listItem'] : '';
$panelSide = request_var('side', '');
$panelType = request_var('type', '');
$sql_side = '';

if (is_array($listItem))
{
    if ($panelSide != '')
    {
        $sql_side = ", panel_side = '" . $panelSide . "'";
    }

    foreach ($listItem as $position => $item)
    {
        $sql = "UPDATE " . DB_PANELS . "
            SET panel_order ='" . ($position + 1) . "'
            " . $sql_side . "
            WHERE panel_id ='" . $item . "'
            AND panel_type = '" . $panelType . "'";
        $db->sql_query($sql);
    }
    
    ob_clean();
    //header("Content-Type: text/html; charset=UTF-8\n");
    echo '<h3 class="success">Kolejność została zaktualizowana</h3>';
}