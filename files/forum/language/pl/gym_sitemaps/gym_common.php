<?php
/**
*
* @package phpBB SEO GYM Sitemaps
* @version $id: gym_common.php - 259 2010-03-18 19:25:40Z dcz $
* @copyright (c) 2006 - 2008 www.phpbb-seo.com
* @license http://opensource.org/osi3.0/licenses/lgpl-license.php GNU Lesser General Public License
*
*/
/**
*
* gym_common [Polish]
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
	'RSS_AUTH_SOME_USER' => '<b><u>Uwaga :</u></b>Ten spis pozycji jest spersonalizowany zgodnie z autoryzacją <b>%s</b>.<br/>Niektóre pozycje mogą być niedostępne jeśli użytkownik nie jest zalogowany.',
	'RSS_AUTH_THIS_USER' => '<b><u>Uwaga :</u></b>Ten spis pozycji jest spersonalizowany zgodnie z autoryzacją <b>%s</b>.<br/>Nie będzie dostępny jeśli użytkownik nie jest zalogowany.',
	'RSS_AUTH_SOME' => '<b><u>Uwaga :</u></b>Ten spis pozycji nie jest publiczny.<br/>Niektóre pozycje mogą być niedostępne jeśli użytkownik nie jest zalogowany.',
	'RSS_AUTH_THIS' => '<b><u>Uwaga :</u></b>Te pozycje nie są publiczne.<br/>Nie będzie dostępny jeśli użytkownik nie jest zalogowany.',
	'RSS_CHAN_LIST_TITLE' => 'Lista kanałów',
	'RSS_CHAN_LIST_DESC' => 'Ta lista kanałów nasłuchuje dostępne kanały RSS.',
	'RSS_CHAN_LIST_DESC_MODULE' => 'Ta lista kanałów nasłuchuje kanały RSS dostępne dla : %s.',
	'RSS_ANNOUCES_DESC' => 'Ten kanał nasłuchuje wszystkie globalne ogłoszenia : %s',
	'RSS_ANNOUNCES_TITLE' => 'Ogłoszenia z  : %s',
	'GYM_LAST_POST_BY' => 'Ostatni post przez ',
	'GYM_FIRST_POST_BY' => 'Napisany przez ',
	'GYM_LINK' => 'Link',
	'GYM_SOURCE' => 'Źródło',
	'GYM_RSS_SOURCE' => 'Źródło',
	'RSS_MORE' => 'więcej',
	'RSS_CHANNELS' => 'Kanały',
	'RSS_CONTENT' => 'Streszczenie',
	'RSS_SHORT' => 'Krótka lista',
	'RSS_LONG' => 'Długa lista',
	'RSS_NEWS' => 'Nowości',
	'RSS_NEWS_DESC' => 'Ostatnie nowości z',
	'RSS_REPORTED_UNAPPROVED' => 'Ta pozycja oczekuje na zatwierdzenie.',

	'GYM_HOME' => 'Strona Główna',
	'GYM_FORUM_INDEX' => 'Forum Index',
	'GYM_LASTMOD_DATE' => 'Data ostatniej zmiany',
	'GYM_SEO' => 'Search Engine Optimization',
	'GYM_MINUTES' => 'minut(a)',
	'GYM_SQLEXPLAIN' => 'Raport SQL',
	'GYM_SQLEXPLAIN_MSG' => 'Zalogowany jako Administrator, możesz sprawdzić %s dla tej strony.',
	'GYM_BOOKMARK_THIS' => 'Dodaj do zakładek',
	// Errors
	'GYM_ERROR_404' => 'Ta strona nie istnieje lub nie jest aktywna',
	'GYM_ERROR_404_EXPLAIN' => 'Serwer nie odnalazł takiej strony.',
	'GYM_ERROR_401' => 'Nie masz uprawnień aby przeglądać tą stronę.',
	'GYM_ERROR_401_EXPLAIN' => 'Ta strona jest dostępna tylko dla zalogowanych użytkowników z wymaganymi uprawnieniami.',
	'GYM_LOGIN' => 'Nie masz uprawnień aby przeglądać tą stronę.',
	'GYM_LOGIN_EXPLAIN' => 'Musisz być zarejestrowany i zalogowany aby przeglądać tą stronę.',
	'GYM_TOO_FEW_ITEMS' => 'Strona niedostępna',
	'GYM_TOO_FEW_ITEMS_EXPLAIN' => 'Ta strona nie zawiera wystarczającej ilości danych aby ją wyświetlić.',
	'GYM_TOO_FEW_ITEMS_EXPLAIN_ADMIN' => 'Brak źródło strony lub nie zawiera wystarczającej ilości danych aby ją wyświetlić.<br/>Błąd 404 nie znaleziono strony został wysłany do Search Engines aby odrzucić link.',

	'GOOGLE_SITEMAP' => 'Mapa strony',
	'GOOGLE_SITEMAP_OF' => 'Mapa strony dla',
	'GOOGLE_MAP_OF' => 'Mapa strony %1$s',
	'GOOGLE_SITEMAPINDEX' => 'Index Mapy strony',
	'GOOGLE_NUMBER_OF_SITEMAP' => 'Ilość Map stron w Indeksie Mapa Strony Google',
	'GOOGLE_NUMBER_OF_URL' => 'Ilość adresów URL w Mapie Strony Google',
	'GOOGLE_SITEMAP_URL' => 'Mapa strony adresów URL',
	'GOOGLE_CHANGEFREQ' => 'Zmień częstotliwość',
	'GOOGLE_PRIORITY' => 'priorytet',

	'RSS_FEED' => 'RSS',
	'RSS_FEED_OF' => 'RSS %1$s',
	'RSS_2_LINK' => 'RSS 2.0 link',
	'RSS_UPDATE' => 'Aktualizacja',
	'RSS_LAST_UPDATE' => 'Ostatnia aktualizacja',
	'RSS_SUBSCRIBE_POD' => '<h2>Dodaj ten kanał RSS do zakładek!</h2>Z wybranym serwisem.',
	'RSS_SUBSCRIBE' => 'Aby ręcznie subskrybować do tego kanału RSS, użyj następującego linku URL :',
	'RSS_ITEM_LISTED' => 'Jedna pozycja.',
	'RSS_ITEMS_LISTED' => 'wykaz pozycji.',
	'RSS_VALID' => 'RSS 2.0 ważny kanał',

	// Old URL handling
	'RSS_1XREDIR' => 'Ten kanał RSS został przeniesiony',
	'RSS_1XREDIR_MSG' => 'Ten kanał RSS został przeniesiony, możesz go znaleźć tutaj ',
	// HTML sitemaps
	'HTML_MAP' => 'Mapa Strony',
	'HTML_MAP_OF' => 'Mapa strony %1$s',
	'HTML_MAP_NONE' => 'Brak mapy strony',
	'HTML_NO_ITEMS' => 'Brak pozycji',
	'HTML_NEWS' => 'Nowości',
	'HTML_NEWS_OF' => 'Nowości dla %1$s',
	'HTML_NEWS_NONE' => 'Brak nowości',
	'HTML_PAGE' => 'Strona',
	'HTML_MORE' => 'Czytaj więcej',
	// Forum
	'HTML_FORUM_MAP' => 'Mapa strony Forum',
	'HTML_FORUM_NEWS' => 'Nowości For',
	'HTML_FORUM_GLOBAL_MAP' => 'Lista Globalnych Ogłoszeń',
	'HTML_FORUM_GLOBAL_NEWS' => 'Globalne ogłoszenia',
	'HTML_FORUM_ANNOUNCE_MAP' => 'Lista ogłoszeń',
	'HTML_FORUM_ANNOUNCE_NEWS' => 'Ogłoszenia',
	'HTML_FORUM_STICKY_MAP' => 'Lista przyklejonych',
	'HTML_FORUM_STICKY_NEWS' => 'Przyklejone',
	'HTML_LASTX_TOPICS_TITLE' => 'Ostatni %1$s aktywny temat',
));
?>