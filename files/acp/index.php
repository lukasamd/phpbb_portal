<?php
define('IN_PHPBB', true);
define('DIR_BASE', '../');
require_once DIR_BASE . 'core.php';
require_once DIR_ACP . 'header.php';
SAC::checkPageAccess('u_sg_portal_acp');

$theme->panelOpen('SafeGroup - Panel Administracyjny');
// Default params
$id     = request_var('id', 0);
$action = request_var('action', '');
$status = request_var('status', '');

// Include page
$page = request_var('p', 'main');

// Check against CSRF
SAC::checkHash();

$page_filename = $page . '.php';
if (file_exists($page_filename))
{
    $FILE_SELF = '/acp/index.php?p=' . $page;
    require_once $page_filename;
}

$theme->panelClose();
require_once DIR_ACP . 'footer.php';
?>