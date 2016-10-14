<?php
/**
*
* @package phpBB SEO GYM Sitemaps
* @version $id: rss_forum.php - 3886 11-20-2008 14:38:27 - 2.0.RC1 dcz $
* @copyright (c) 2006 - 2008 www.phpbb-seo.com
* @license http://opensource.org/osi3.0/licenses/lgpl-license.php GNU Lesser General Public License
*
*/
/**
*
* rss_forum [English]
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
	'RSS_FORUM' => 'Moduł RSS Forum',
	'RSS_FORUM_EXPLAIN' => 'Są to ustawienia dla modułu RSS forum.<br/> Niektóre z nich mogą być nadpisane w zależności ustawień nadpisywania RSS i głównych ustawień.',
	'RSS_FORUM_ALTERNATE' => 'Alternatywne linki RSS',
	'RSS_FORUM_ALTERNATE_EXPLAIN' => 'Pokaż lub nie, alternatywne linki forum RSS w pasku nawigacji przeglądarki',
	'RSS_FORUM_EXCLUDE' => 'Wykluczenia Forum',
	'RSS_FORUM_EXCLUDE_EXPLAIN' => 'Tutaj możesz wykluczyć jedno lub kilka for z nasłuchiwania RSS.<br /><u>Uwaga :</u> Jeśli to pole nie jest wypełnione, odczyty wszystkich forach będą wyświetlane.',
	// Content
	'RSS_FORUM_CONTENT' => 'Ustawienia zawartości Forum',
	'RSS_FORUM_FIRST' => 'Pierwsza wiadomość',
	'RSS_FORUM_FIRST_EXPLAIN' => 'Pokaż lub nie, adres pierwszego postu dla wszystkich tematów wykazanych w RSS.<br/> Domyślnie, tylko ostatni post z każdego tematu jest w wykazie. Wyświetlanie pierwszego również oznacza trochę więcej pracy dla serwera.',
	'RSS_FORUM_LAST' => 'Ostatnia wiadomość',
	'RSS_FORUM_LAST_EXPLAIN' => 'Pokaż lub nie ostatni post dla  wszystkich tematów wykazanych w RSS.<br/>  Domyślnie, tylko ostatni post z każdego tematu jest w wykazie. Ta opcja jest przydatna, jeśli chcesz wykazać tylko adres pierwszego postu w RSS.<br/>Uwaga: Ustawienie Pierwsza wiadomość na TAK i  Ostatnia wiadomość na NIE jest tym samym co budowanie wiadomości RSS.',
	'RSS_FORUM_RULES' => 'Pokaż zasady Forum',
	'RSS_FORUM_RULES_EXPLAIN' => 'Pokaż lub nie, zasady forum w RSS.',
	// Reset settings
	'RSS_FORUM_RESET' => 'Moduł RSS forum',
	'RSS_FORUM_RESET_EXPLAIN' => 'Resetuj wszystkie opcje modułu RSS Forum do domyślnych wartości.',
	'RSS_FORUM_MAIN_RESET' => 'Główny reset RSS forum',
	'RSS_FORUM_MAIN_RESET_EXPLAIN' => 'Resetuj do domyślnych wszystkie opcje "Ustawienia RSS" (główna) zakładka modułu RSS forum.',
	'RSS_FORUM_CONTENT_RESET' => 'Zawartość RSS forum',
	'RSS_FORUM_CONTENT_RESET_EXPLAIN' => 'Resetuj do domyślnych wszystkie opcje Zawartość modułu RSS forum.',
	'RSS_FORUM_CACHE_RESET' => ' Cache RSS Forums',
	'RSS_FORUM_CACHE_RESET_EXPLAIN' => 'Resetuj do domyślnych wszystkie opcje buforowania modułu RSS forum.',
	'RSS_FORUM_MODREWRITE_RESET' => 'Nadpisywanie adresów RSS Forum',
	'RSS_FORUM_MODREWRITE_RESET_EXPLAIN' => 'Resetuj do domyślnych wszystkie opcje nadpisywania adresów modułu RSS forum.',
	'RSS_FORUM_GZIP_RESET' => 'Gunzip RSS Forum',
	'RSS_FORUM_GZIP_RESET_EXPLAIN' => 'Resetuj do domyślnych wszystkie opcje Gunzip modułu RSS forum.',
	'RSS_FORUM_LIMIT_RESET' => 'Limity RSS Forum',
	'RSS_FORUM_LIMIT_RESET_EXPLAIN' => 'Resetuj do domyślnych wszystkie opcje Limitów modułu RSS forum.',
	'RSS_FORUM_SORT_RESET' => 'Sortowanie RSS Forum',
	'RSS_FORUM_SORT_RESET_EXPLAIN' => 'Resetuj do domyślnych wszystkie opcje sortowania modułu RSS forum.',
	'RSS_FORUM_PAGINATION_RESET' => 'Stronicowanie RSS Forum',
	'RSS_FORUM_PAGINATION_RESET_EXPLAIN' => 'Resetuj do domyślnych wszystkie opcje stronicowania modułu RSS forum.',
));
?>