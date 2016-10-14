<?php
/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
    exit;
}
 
if (empty($lang) || !is_array($lang))
{
    $lang = array();
}
 
// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
 
// Adding new category
$lang['permission_cat']['sg_portal'] = 'Portal';
$lang['permission_cat']['sg_other'] = 'Inne';
 
// Adding the permissions
$lang = array_merge($lang, array(
    'acl_u_sg_portal_acp'    => array('lang' => 'Dostęp do ACP', 'cat' => 'sg_portal'),
    'acl_u_sg_portal_content'    => array('lang' => 'Artykuły', 'cat' => 'sg_portal'),
    'acl_u_sg_portal_categories'    => array('lang' => 'Kategorie', 'cat' => 'sg_portal'),
    'acl_u_sg_portal_sections'    => array('lang' => 'Sekcje', 'cat' => 'sg_portal'),
    'acl_u_sg_portal_newsletter'    => array('lang' => 'Newsletter', 'cat' => 'sg_portal'),
    'acl_u_sg_portal_comments'    => array('lang' => 'Komentarze', 'cat' => 'sg_portal'),
    'acl_u_sg_portal_censor'    => array('lang' => 'Ustawienia cenzora', 'cat' => 'sg_portal'), 
    'acl_u_sg_portal_konkurs'    => array('lang' => 'Konkursy', 'cat' => 'sg_portal'),
    'acl_u_sg_portal_panels'    => array('lang' => 'Panele', 'cat' => 'sg_portal'),
    'acl_u_sg_portal_polls'    => array('lang' => 'Ankiety', 'cat' => 'sg_portal'),
    'acl_u_sg_portal_pages'    => array('lang' => 'Dodatkowe strony', 'cat' => 'sg_portal'),
    'acl_u_sg_portal_pages_forum'    => array('lang' => 'Strony forum', 'cat' => 'sg_portal'),
    'acl_u_sg_portal_badbehavior'    => array('lang' => 'Ustawienia Bad Behavior', 'cat' => 'sg_portal'), 
    'acl_u_sg_portal_settings'    => array('lang' => 'Ustawienia portalu', 'cat' => 'sg_portal'), 
    
    'acl_u_sg_other_lab'    => array('lang' => 'Dostęp do labu', 'cat' => 'sg_other'),
    'acl_u_sg_other_img'    => array('lang' => 'Dostęp do IMG', 'cat' => 'sg_other'),
));
?>