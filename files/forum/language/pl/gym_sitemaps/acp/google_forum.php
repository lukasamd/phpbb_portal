<?php
/**
*
* @package phpBB SEO GYM Sitemaps
* @version $id: google_forum.php - 3715 11-20-2008 14:38:27 - 2.0.RC1 dcz $
* @copyright (c) 2006 - 2008 www.phpbb-seo.com
* @license http://opensource.org/osi3.0/licenses/lgpl-license.php GNU Lesser General Public License
*
*/
/**
*
* google_forum [English]
*
*/
/**
* DO NOT CHANGE
*/
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
	'GOOGLE_FORUM' => 'Mapy stron forum',
	'GOOGLE_FORUM_EXPLAIN' => 'Są to ustawienia modułu dla mapy strony forum Google.<br/> Niektóre z nich są nadpisywane w zależności od map stron Google i głównych ustawień nadpisywania.',
	'GOOGLE_FORUM_SETTINGS' => 'Ustawienia map stron Forum',
	'GOOGLE_FORUM_SETTINGS_EXPLAIN' => 'Następujące ustawienia są specyficzne dla modułu forum mapa strony Google.',
	'GOOGLE_FORUM_STICKY_PRIORITY' => 'Priorytet przyklejonych',
	'GOOGLE_FORUM_STICKY_PRIORITY_EXPLAIN' => 'Priorytet przyklejonych (wpisz cyfry pomiędzy 0.0 i 1.0).',
	'GOOGLE_FORUM_ANNOUCE_PRIORITY' => 'Priorytet Ogłoszeń',
	'GOOGLE_FORUM_ANNOUCE_PRIORITY_EXPLAIN' => 'Priorytet Ogłoszeń (wpisz cyfry pomiędzy 0.0 i 1.0).',
	'GOOGLE_FORUM_GLOBAL_PRIORITY' => 'Priorytet Globalnych Ogłoszeń',
	'GOOGLE_FORUM_GLOBAL_PRIORITY_EXPLAIN' => 'Priorytet Globalnych Ogłoszeń (wpisz cyfry pomiędzy 0.0 i 1.0).',
	'GOOGLE_FORUM_EXCLUDE' => 'Wyklucz forum',
	'GOOGLE_FORUM_EXCLUDE_EXPLAIN' => 'Tutaj możesz wykluczyć jedeo lub więcej for z mapy strony.<br /><u>Uwaga :</u> Jeśli to pole pozostanie niewypełnione, wszystkie działy ogólnodostępne będą w mapach.',
	// Reset settings
	'GOOGLE_FORUM_RESET' => 'Moduł mapy strony forum',
	'GOOGLE_FORUM_RESET_EXPLAIN' => 'Zresetuj moduł mapy strony dla wszystkich for do domyślnych wartości.',
	'GOOGLE_FORUM_MAIN_RESET' => 'Główne mapy strony for',
	'GOOGLE_FORUM_MAIN_RESET_EXPLAIN' => 'Zresetuj do domyślnych wszystkie ustawienia dla "Mapy stron for" zakładka (główne) modułu mapy strony forum.',
	'GOOGLE_FORUM_CACHE_RESET' => 'Cache map stron for',
	'GOOGLE_FORUM_CACHE_RESET_EXPLAIN' => 'Zresetuj do domyślnych wszystkie ustawienia w cache modułu modułu mapy strony forum.',
	'GOOGLE_FORUM_MODREWRITE_RESET' => 'Mapy stron for nadpisywanie URL',
	'GOOGLE_FORUM_MODREWRITE_RESET_EXPLAIN' => 'Zresetuj do domyślnych wszystkie ustawienia nadpisywania adresów URL modułu mapy strony forum.',
	'GOOGLE_FORUM_GZIP_RESET' => 'Mapy stron for gunzip',
	'GOOGLE_FORUM_GZIP_RESET_EXPLAIN' => 'Zresetuj do domyślnych wszystkie ustawienia gunzip modułu mapy strony forum.',
	'GOOGLE_FORUM_LIMIT_RESET' => 'Mapy stron for limity',
	'GOOGLE_FORUM_LIMIT_RESET_EXPLAIN' => 'Zresetuj do domyślnych wszystkie ustawienia limiów modułu mapy strony forum.',
	'GOOGLE_FORUM_SORT_RESET' => 'Mapy stron for Sortowanie',
	'GOOGLE_FORUM_SORT_RESET_EXPLAIN' => 'Zresetuj do domyślnych wszystkie ustawienia sortowania modułu mapy strony forum.',
	'GOOGLE_FORUM_PAGINATION_RESET' => 'Mapy stron for stronicowanie',
	'GOOGLE_FORUM_PAGINATION_RESET_EXPLAIN' => 'Zresetuj do domyślnych wszystkie ustawienia stronicowania modułu mapy strony forum.',
));
?>