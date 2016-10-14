<?php
/**
*
* info_acp_phpbb_seo [English]
*
* @package Ultimate SEO URL phpBB SEO
* @version $Id: info_acp_phpbb_seo.php 131 2009-10-25 12:03:44Z dcz $
* @copyright (c) 2006 - 2009 www.phpbb-seo.com
* @license http://www.opensource.org/licenses/rpl1.5.txt Reciprocal Public License 1.5
* @tłumaczenie: napus <<<<<<<<<<<<<http://phpBB3-mods.pl>>>>>>>>>>>>>>>>>>
*/
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

$lang = array_merge($lang, array(
	'ACP_CAT_PHPBB_SEO' => 'phpBB SEO',
	'ACP_MOD_REWRITE' => 'Ustawienia nadpisywania URL',
	'ACP_PHPBB_SEO_CLASS' => 'Ustawienia phpBB SEO',
	'ACP_FORUM_URL' => 'Zarządzanie adresami Forum',
	'ACP_HTACCESS' => '.htaccess',
	'ACP_SEO_EXTENDED' => 'Rozszerzona konfiguracja',
	'ACP_PREMOD_UPDATE' => '<h1>Najnowsze wydania</h1>
	<p>Ta aktualizacja dotyczy tylko premoda, nie phpBB3.</p>
	<p>Dostępna jest nowa wersja phpBB SEO premod : %1$s<br/>Odwiedź<a href="%2$s" title="The release thread"><b>temat wydań</b></a> i zaktualizuj moda.</p>',
	'SEO_LOG_INSTALL_PHPBB_SEO' => '<strong>phpBB SEO mod rewrite zainstalowany (v%s)</strong>',
	'SEO_LOG_INSTALL_PHPBB_SEO_FAIL' => '<strong>Próba instalacji phpBB SEO mod rewrite zakończona niepowodzeniem</strong><br/>%s',
	'SEO_LOG_UNINSTALL_PHPBB_SEO' => '<strong>phpBB SEO mod rewrite został odinstalowany (v%s)</strong>',
	'SEO_LOG_UNINSTALL_PHPBB_SEO_FAIL' => '<strong>Próba deinstalacji phpBB SEO mod rewrite zakończona niepowodzeniem</strong><br/>%s',
	'SEO_LOG_CONFIG_SETTINGS' => '<strong>Zmieniono ustawienia phpBB SEO</strong>',
	'SEO_LOG_CONFIG_FORUM_URL' => '<strong>Zmieniono Forum URL</strong>',
	'SEO_LOG_CONFIG_HTACCESS' => '<strong>Wygenerowano nowy .htaccess</strong>',
	'SEO_LOG_CONFIG_EXTENDED' => '<strong>Zmieniono rozszerzone ustawienia phpBB SEO</strong>',
));

?>