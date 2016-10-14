<?php
/**
*
* @package phpBB SEO GYM Sitemaps
* @version $id: html_forum.php - 6931 11-20-2008 14:38:27 - 2.0.RC1 dcz $
* @copyright (c) 2006 - 2008 www.phpbb-seo.com
* @license http://opensource.org/osi3.0/licenses/lgpl-license.php GNU Lesser General Public License
*
*/
/**
*
* html_forum [English]
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
	'HTML_FORUM' => 'Moduł HTML Forum',
	'HTML_FORUM_EXPLAIN' => 'Są to ustawienia dla modułu HTML forum.<br/> Niektóre z nich mogą być nadpisane w zależności ustawień nadpisywania HTML.',
	'HTML_FORUM_EXCLUDE' => 'Wykluczenia Forum',
	'HTML_FORUM_EXCLUDE_EXPLAIN' => 'Tutaj możesz wykluczyć jedno lub kilka for z nasłuchiwania RSS.<br /><u>Uwaga :</u> Jeśli to pole nie jest wypełnione, odczyty wszystkich forach będą wyświetlane.',
	'HTML_FORUM_ALLOW_NEWS' => 'Wiadomości Forum',
	'HTML_FORUM_ALLOW_NEWS_EXPLAIN' => 'Strona wiadomości forum to jest strona wyświetlająca jednen lub kilka tematów  pierwszy post, obcięta lub nie, i pochodzących z jednego lub kilku for które możesz wybrać poniżej.',
	'HTML_FORUM_ALLOW_CAT_NEWS' => 'Kategoria wiadomości Forum',
	'HTML_FORUM_ALLOW_CAT_NEWS_EXPLAIN' => 'Aktywuj, lub nie, stronę wiadomości forum. Jeśli aktywowane, każde nie wykluczone forum będzie miało stronę wiadomości dla tematów tego forum.',
	'HTML_FORUM_NEWS_IDS' => 'Źródło wiadomości Froum',
	'HTML_FORUM_NEWS_IDS_EXPLAIN' => 'Możesz wybrać jedno lub kilka for, nawet jeśli prywatne, jako źródło dla twojej głównej strony wiadomości forum.<br /><u>Uwaga</u> :<br />Jeśli to pole nie jest wypełnione, wszystkie fora będą traktowane jako źródło dla strony wiadomości forum.',
	'HTML_FORUM_LTOPIC' => 'Opcjonalnie ostatni aktywny temat',
	'HTML_FORUM_INDEX_LTOPIC' => 'Pokaż w mapie forum',
	'HTML_FORUM_INDEX_LTOPIC_EXPLAIN' => 'Pokaż, lub nie, ostatni aktywny temat w mapie forum.<br/>Wpisz ilość tematów do wyświetlenia, 0 aby deaktywować.',
	'HTML_FORUM_CAT_LTOPIC' => 'Pokaż na forum kategorię map',
	'HTML_FORUM_CAT_LTOPIC_EXPLAIN' => 'Pokaż, lub nie, ostatni aktywny temat w każdej mapie forum.<br/>Wpisz ilość tematów do wyświetlenia, 0 aby deaktywować.',
	'HTML_FORUM_NEWS_LTOPIC' => 'Pokaż na stronie wiadomości forum',
	'HTML_FORUM_NEWS_LTOPIC_EXPLAIN' => 'Pokaż, lub nie, ostatni aktywny temat na stronie wiadomości forum.<br/>Wpisz ilość tematów do wyświetlenia, 0 aby deaktywować.',
	'HTML_FORUM_CAT_NEWS_LTOPIC' => 'Pokaż na stronie wiadomości kategorię',
	'HTML_FORUM_CAT_NEWS_LTOPIC_EXPLAIN' => 'Pokaż, lub nie, ostatni aktywny temat na na każdej stronie wiadomości.<br/>Wpisz ilość tematów do wyświetlenia, 0 aby deaktywować.',
	'HTML_FORUM_LTOPIC_PAGINATION' => 'Stronicowanie ostatni aktywny temat',
	'HTML_FORUM_LTOPIC_PAGINATION_EXPLAIN' => 'Pokaż, lub nie, stronicowanie tematu w ostatnim aktywnym temacie.',
	'HTML_FORUM_LTOPIC_EXCLUDE' => 'Wykluczenie ostatni aktywny temat',
	'HTML_FORUM_LTOPIC_EXCLUDE_EXPLAIN' => 'Tutaj możesz  wykluczyć jedno lub kilka for z nasłuchiwania ostatni aktywny temat.<br /><u>Uwaga :</u> Jeśli to pole nie jest wypełnione, wszystkie fora będą nasłuchiwane.',
	// Pagination
	'HTML_FORUM_PAGINATION' => 'Stronicowanie mapy Forum',
	'HTML_FORUM_PAGINATION_EXPLAIN' => 'Aktywuj, lub nie, stronicowanie map forum. Włącz to jeśli chcesz wyświetlać więcej niż jedną stronę i wykazać wszystkie tematy w każdej mapie forum.',
	'HTML_FORUM_PAGINATION_LIMIT' => 'Tematów na stronę',
	'HTML_FORUM_PAGINATION_LIMIT_EXPLAIN' => 'Kiedy stronicowanie mapy forum jest aktywowane, możesz tutaj zdefiniować ilość tematów pokazywanych na stronę.',
	// Content
	'HTML_FORUM_CONTENT' => 'Ustawienia zawartości forum',
	'HTML_FORUM_FIRST' => 'Sortowanie map',
	'HTML_FORUM_FIRST_EXPLAIN' => 'Mapy forum mogą być sortowane przeciwnie do pierwszy temat data założenia lub ostatni temat data założenia. Oznacza to, że możesz użyć daty utworzenia tematu lub ostatniej odpowiedzi w temacie .',
	'HTML_FORUM_NEWS_FIRST' => 'Sortowanie wiadomości',
	'HTML_FORUM_NEWS_FIRST_EXPLAIN' => 'Strona wiadomości forum może być sortowana przeciwnie do pierwszy temat data postu lub ostatni temat data postu. Oznacza to że możesz użyć kolejności założenie tematu lub ostatnia odpowiedź w temacie.',
	'HTML_FORUM_LAST_POST' => 'Pokaż ostatni post',
	'HTML_FORUM_LAST_POST_EXPLAIN' => 'Pokaż, lub nie, informację o ostatnim poście w wymienionym temacie.',
	'HTML_FORUM_POST_BUTTONS' => 'Pokaż przyciski postu',
	'HTML_FORUM_POST_BUTTONS_EXPLAIN' => 'Pokaż, lub nie, przyciski postu takie jak odpowiedź, edytuj itd ...',
	'HTML_FORUM_RULES' => 'Pokaż zasady forum',
	'HTML_FORUM_RULES_EXPLAIN' => 'Pokaż, lub nie, zasady forum w wiadomościach forum i na stronach map.',
	'HTML_FORUM_DESC' => 'Pokaż opis zasad forum',
	'HTML_FORUM_DESC_EXPLAIN' => 'Pokaż, lub nie, opis forum w wiadomościach forum i na stronach map.',
	// Reset settings
	'HTML_FORUM_RESET' => 'Moduł HTML forum',
	'HTML_FORUM_RESET_EXPLAIN' => 'Resetuj wszystkie opcje modułu HTML forum .do domyślnych wartości',
	'HTML_FORUM_MAIN_RESET' => 'Główne forum HTML',
	'HTML_FORUM_MAIN_RESET_EXPLAIN' => 'Resetuj do domyślnych wszystkie opcje w zakładce "Ustawienia HTML" (główne) modułu forum HTML.',
	'HTML_FORUM_CONTENT_RESET' => 'Wiadomości HTML forum',
	'HTML_FORUM_CONTENT_RESET_EXPLAIN' => 'Resetuj do domyślnych wszystkie opcje wiadomości modułu HTML forum.',
	'HTML_FORUM_CACHE_RESET' => 'Cache HTML forum',
	'HTML_FORUM_CACHE_RESET_EXPLAIN' => 'Resetuj do domyślnych wszystkie opcje buforowania modułu HTML forum.',
	'HTML_FORUM_MODREWRITE_RESET' => 'Nadpisywanie adresów URL forum HTML',
	'HTML_FORUM_MODREWRITE_RESET_EXPLAIN' => 'Resetuj do domyślnych wszystkie opcje nadpisywania URL modułu HTML forum.',
	'HTML_FORUM_GZIP_RESET' => 'HTML forum Gunzip',
	'HTML_FORUM_GZIP_RESET_EXPLAIN' => 'Resetuj do domyślnych wszystkie opcje Gunzip modułu HTML forum.',
	'HTML_FORUM_LIMIT_RESET' => 'Limity HTML forum',
	'HTML_FORUM_LIMIT_RESET_EXPLAIN' => 'Resetuj do domyślnych wszystkie opcje Limitów modułu HTML forum.',
	'HTML_FORUM_SORT_RESET' => 'Sortowanie HTML forum',
	'HTML_FORUM_SORT_RESET_EXPLAIN' => 'Resetuj do domyślnych wszystkie opcje Sortowania modułu HTML forum.',
	'HTML_FORUM_PAGINATION_RESET' => 'Stronicowanie HTML forum',
	'HTML_FORUM_PAGINATION_RESET_EXPLAIN' => 'Resetuj do domyślnych wszystkie opcje Stronicowania modułu HTML forum.',
));
?>