<?php
/**
*
* @package phpBB SEO GYM Sitemaps
* @version $id: gym_rss.php - 259 2010-03-18 19:25:40Z dcz $
* @copyright (c) 2006 - 2008 www.phpbb-seo.com
* @license http://opensource.org/osi3.0/licenses/lgpl-license.php GNU Lesser General Public License
*
*/
/**
*
* gym_rss [Polish]
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
	'RSS_MAIN' => 'Ustawienia RSS',
	'RSS_MAIN_EXPLAIN' => 'Są to główne ustawienia dla modułu RSS.<br/>Mogą być stosowane do wszystkich modułów RSS  w zależności od twoich ustawień nadpisywania RSS.',
	// Linking setup
	'RSS_LINKS_ACTIVATION' => 'Linki Forum',
	'RSS_LINKS_MAIN' => 'Główne linki',
	'RSS_LINKS_MAIN_EXPLAIN' => 'Pokaż lub nie linki rss i listy rss w stopce.<br/>Ta opcja wymaga aby główne linki były aktywowane w głównej konfiguracji.',
	'RSS_LINKS_INDEX' => 'Linki na głównej stronie',
	'RSS_LINKS_INDEX_EXPLAIN' => 'Pokaż lub nie linki do dostępnych kanałów rss dla każdego działu na stronie głównej. These links are added below the forum descritpions.<br/>Ta opcja wymaga aby główne linki były aktywowane w głównej konfiguracji.',
	'RSS_LINKS_CAT' => 'Linki na stronie działu',
	'RSS_LINKS_CAT_EXPLAIN' => 'Pokaż lub nie linki do kanałów rss aktualnego działu. These links are added below the forum title.<br/>Ta opcja wymaga aby główne linki były aktywowane w głównej konfiguracji.',
	// Reset settings
	'RSS_ALL_RESET' => 'Wszystkie moduły RSS',
	// Limits
	'RSS_LIMIT_GEN' => 'Główne limity',
	'RSS_LIMIT_SPEC' => 'Limity RSS',
	'RSS_URL_LIMIT_LONG' => 'Długie limity',
	'RSS_URL_LIMIT_LONG_EXPLAIN' => 'Ilość pokazywanych pozycji w długich wiadomościach RSS bez treści, wymaga aktywowanej opcji Zezwalaj na długie wiadomości.',
	'RSS_SQL_LIMIT_LONG' => 'Długie cykle SQL',
	'RSS_SQL_LIMIT_LONG_EXPLAIN' => 'Ilość pozycji odpytanych w czasie przez długą wiadomość RSS bez treści.',
	'RSS_URL_LIMIT_SHORT' => 'Krótkie limity',
	'RSS_URL_LIMIT_SHORT_EXPLAIN' => 'Ilość pokazywanych pozycji w krótkich wiadomościach RSS bez treści, wymaga aktywowanej opcji Zezwalaj na krótkie wiadomości.',
	'RSS_SQL_LIMIT_SHORT' => 'Krótkie cykle SQL',
	'RSS_SQL_LIMIT_SHORT_EXPLAIN' => 'Ilość pozycji odpytanych w czasie przez krótką wiadomość RSS bez treści.',
	'RSS_URL_LIMIT_MSG' => 'Domyślny limit z treścią',
	'RSS_URL_LIMIT_MSG_EXPLAIN' => 'Ilość domyślnie pokazywanych pozycji w wiadomościach z treścią, wymaga aktywowanej opcji Zezwalaj na pozycje z treścią.',
	'RSS_SQL_LIMIT_MSG' => 'Cykle SQL z treścią',
	'RSS_SQL_LIMIT_MSG_EXPLAIN' => 'Ilość pozycji odpytanych w czasie dla wiadomości z zawartością.',
	// Basic settings
	'RSS_SETTINGS' => 'Ustawienia',
	'RSS_C_INFO' => 'Informacja o prawach autorskich',
	'RSS_C_INFO_EXPLAIN' => 'Informacje o prawach autorskich będzie wyświetlenia w tagach autorskich RSS. Domyślnie jest to nazwa strony phpBB.',
	'RSS_SITENAME' => 'Nazwa strony',
	'RSS_SITENAME_EXPLAIN' => 'Nazwa strony będzie pokazywana w wiadomościach RSS. Domyślnie jest to nazwa strony phpBB.',
	'RSS_SITE_DESC' => 'Opis strony',
	'RSS_SITE_DESC_EXPLAIN' => 'Opis strony będzie pokazywany w wiadomościach RSS. Domyślnie jest to opis strony phpBB.',
	'RSS_LOGO_URL' => 'Logo strony',
	'RSS_LOGO_URL_EXPLAIN' => 'Plik graficzny do wykorzystania jako logo strony będzie pokazywany w wiadomościach RSS, w katalogu gym_sitemaps/images/.',
	'RSS_IMAGE_URL' => 'RSS logo',
	'RSS_IMAGE_URL_EXPLAIN' => 'Plik graficzny do wykorzystania jako logo RSS w wiadomościach RSS, w katlogu gym_sitemaps/images/.',
	'RSS_LANG' => 'Język RSS',
	'RSS_LANG_EXPLAIN' => 'Zadeklarowany język jako główny język w wiadomościach rss. Domyślnie jest to domyślny język phpBB.',
	'RSS_URL_EXPLAIN' => 'Wpisz pełny adres URL do twojego pliku gymrss.php, np. http://www.przyklad.pl/ewentualnie_katalog/ jeśli gymrss.php jest zainstalowane w http://www.przyklad.pl/ewentualnie_katalog/.<br/>Ta opcja jest przydatna, gdy phpBB nie jest zainstalowane w katalogu root domeny, a ty chciałbyś zainstalować plik gymrss.php w katalogu root.',
	// Auth settings
	'RSS_AUTH_SETTINGS' => 'Ustawienia autoryzacji',
	'RSS_ALLOW_AUTH' => 'Autoryzacja',
	'RSS_ALLOW_AUTH_EXPLAIN' => 'Aktywuj autoryzację dla wiadomości RSS. Jeśli aktywowane, zalogowani użytkownicy będą mogli przeglądać prywatne wiadomości i przeglądać prywatne fora w głównych wiadomościach jeśli mają odpowiednią autoryzację.',
	'RSS_CACHE_AUTH' => 'Buforuj prywatne wiadomości',
	'RSS_CACHE_AUTH_EXPLAIN' => 'Możesz wyłączyć buforowanie dla nie publicznych for jeśli dozwolone.<br/> Buforowanie prywatnych wiadomości zwiększy ilość buforowanych plików;  nie powinno być problemu, ale możesz zdecydować aby buforować tylko publiczne wiadomości.',
	'RSS_NEWS_UPDATE' => 'Aktualizacja wiadomości',
	'RSS_NEWS_UPDATE_EXPLAIN' => 'Jeśli wiadomości są aktywowane, możesz ustawić niestandardowy czas aktywności w godzinach dla wszystkich wiadomości. Wpisz 0 lub pozostaw niewypełnione aby deaktywować i użyć okresu regularnej aktualizacji.',
	'RSS_ALLOW_NEWS' => 'Zezwalaj na wiadomości',
	'RSS_ALLOW_NEWS_EXPLAIN' => 'Tak zwane wiadomości są niestandardowym modem który będzie utrzymywał pierwszą pozycję bez rozważania kolejnej odpowiedzi. Jest to dodatkowa wiadomość która nie będzie kolidować z innymi. Jest to przydatne, jeśli, na przykład, chcesz przesłać własne wiadomości do Google.',
	'RSS_ALLOW_SHORT' => 'Zezwalaj na krótkie wiadomości',
	'RSS_ALLOW_SHORT_EXPLAIN' => 'Zezwalaj lub nie, na użycie krótkich wiadomości RSS.',
	'RSS_ALLOW_LONG' => 'Zezwalaj na długie wiadomości',
	'RSS_ALLOW_LONG_EXPLAIN' => 'Zezwalaj lub nie, na użycie długich wiadomości RSS.',
	// Notifications
	'RSS_NOTIFY' => 'Powiadomienia',
	'RSS_YAHOO_NOTIFY' => 'Powiadomienia Yahoo',
	'RSS_YAHOO_NOTIFY_EXPLAIN' => 'Aktywuj powiadomienia Yahoo! dla RSS.<br/> Nie dotyczy głównych wiadomości (RSS.xml).<br/>Za każdym razem, gdy kanał wiadomości jest aktualizowany, zostanie wysłane powiadomienie do Yahoo!<br/><u>UWAGA :</u>MUSISZ wpisać twoje Yahoo! AppID poniżej aby wysyłać powiadomienia.',
	'RSS_YAHOO_APPID' => 'Yahoo! AppID',
	'RSS_YAHOO_APPID_EXPLAIN' => 'Wpisz własne Yahoo! AppID. Jeśli nie posiadasz, odwiedź <a href="http://api.search.yahoo.com/webservices/register_application">tą stronę</a>.<br/><u>UWAGA :</u>Będziesz musiał utworzyć konto Yahoo! zanim wygenerujesz Yahoo! AppID.',
	// Styling
	'RSS_STYLE' => 'Style Rss',
	'RSS_XSLT' => 'Stylowanie XSLT',
	'RSS_XSLT_EXPLAIN' => 'RSS może być stylowany używając <a href="http://www.w3schools.com/xsl/xsl_transformation.asp">XSL-Transform</a> Style Sheet.',
	'RSS_FORCE_XSLT' => 'Wymuś stylowanie',
	'RSS_FORCE_XSLT_EXPLAIN' => 'Czyż nie jest to trochę głupie, musimy wykonać trik z przeglądarkami w celu umożliwienia użycia xlst. Robimy to poprzez dodanie kilku znaków spacji na początku kodu xml.<br/>FF 2 i IE7 sprawdzają tylko 500 pierwszych znaków aby zdecydować czy jest to rss czy nie i nakładać swoje prywatne obsługiwanie',
	'RSS_LOAD_PHPBB_CSS' => 'Załaduj phpBB CSS',
	'RSS_LOAD_PHPBB_CSS_EXPLAIN' => 'Moduł GYM sitemap używa systemu szablonów phpBB3. XSL stylesheets jest używany do budowania stron html jest kompatybilny z stylami phpBB3.<btr/>Z tą opcją, można podjąć decyzję o zastosowaniu CCS phpBB w XSL stylesheet zamiast domyślnych. W ten sposób, wszystkie twoje zmiany w motywach takie jak tło i czcionka lub nawet grafika będą użyte w stylach stron RSS.<br/>Zmiany nastąpią tylko wyczyszczeniu cache RSS w menu "Konserwacja".<br/>Jeśli pliki stylu RSS nie znajdują się w aktualnym stylu, będzie użyty domyślny styl (zawsze dostępny, oparty na prosilver).<br/>Nie używaj szablonów prosilver z innymi stylami, CSSy nie będą współpracowały.',
	// Content
	'RSS_CONTENT' => 'Ustawienia treści',
	'RSS_CONTENT_EXPLAIN' => 'Tutaj można skonfigurować różne filtrowania treści / opcje formatowania. <br/>Mogą być zastosowane dla wszystkich modułów RSS w zależności od twoich ustawień nadpisywania RSS.',
	'RSS_ALLOW_CONTENT' => 'Zezwalaj na zawartość pozycji',
	'RSS_ALLOW_CONTENT_EXPLAIN' => 'Tutaj możesz wybrać, czy zezwolić na wyświetlanie treści wiadomości w całości lub częściowo w RSS. <br/><u>NOTE :</u> Ta opcja oznacza cięższą pracę serwera. Limity z treścią powinny być mniejsze niż te wysyłane bez.',
	'RSS_SUMARIZE' => 'Streszczenie pozycji',
	'RSS_SUMARIZE_EXPLAIN' => 'Tutaj można podsumować treści wiadomości umieszczane w RSS.<br/> Limit ustala maksymalną ilość zdań , słów lub znaków, zgodnie z metodą wybraną poniżej. Wpisz 0 aby wyświetlić wszystkie.',
	'RSS_SUMARIZE_METHOD' => 'Metoda streszczania',
	'RSS_SUMARIZE_METHOD_EXPLAIN' => 'Możesz wybrać pomiędzy trzema różnymi metodami w celu ograniczenia zawartości wiadomości w RSS.<br/> Ze względu na linie, ze względu na ilość słów i ze względu na ilość znaków. Tagi BBcode i słowa nie będą łamane.',
	'RSS_ALLOW_PROFILE' => 'Pokaż profile',
	'RSS_ALLOW_PROFILE_EXPLAIN' => 'Nazwa autora pozycji może być dodana do wiadomości RSS.',
	'RSS_ALLOW_PROFILE_LINKS' => 'Link profilu',
	'RSS_ALLOW_PROFILE_LINKS_EXPLAIN' => 'Jeśli nazwa autora jest załączona do wiadomości możesz zdecydować aby dodać link do strony odpowiedniego profilu phpBB.',
	'RSS_ALLOW_BBCODE' => 'Zezwalaj na BBcode',
	'RSS_ALLOW_BBCODE_EXPLAIN' => 'Tutaj możesz zdecydować czy parsować i wyświetlać lub nie bbcode.',
	'RSS_STRIP_BBCODE' => 'Parsowanie BBcode',
	'RSS_STRIP_BBCODE_EXPLAIN' => 'Możesz ustawić listę bbcode do wyłączenia z parsowania.<br/>Format jest prosty : <br/><ul><li> <u>Przecinek oddziela bbcodey :</u> Usuń tagi bbcode, zatrzymaj licznik. <br/><u>Przykład :</u> <b>img,b,quote</b> <br/> W tym przykładzie img, bold i quote bbcode nie będą prasowane, tagi bbcode same zostaną usunięte i treści w tagach bbcode pozostanie.</li><li> <u>Przecinek oddziela bbcodey z opcją dwukropek :</u> Usuń tagi bbcode i zdecyduj o ich zawartości. <br/><u>Przykład :</u> <b>img:1,b:0,quote,code:1</b> <br/> W tym przykładzie, img bbcode i link img będą usunięte, bold nie będzie przetważany, ale bold-ed text będzie zatrzymany, quote nie będzie prasowany, ale ich zawartość pozostanie, code bbcode i jego zawartość będą usunięte ze strony wyjściowej.</ul>Filtr będzie działał wówczas, jeśli bbcode jest bez zawartości. Podręczne do usunięcia zawartości tagów code i linków img ze strony wyjściowej.<br/>Filtrowanie nastąpi przed podsumowaniem.<br/> Magiczny parametr "wszystko" (może być wszystko:0 lub wszystko:1 do prasowania zawartości tagów bbcode) zajmie się wszystkimi na raz.',
	'RSS_ALLOW_LINKS' => 'Zezwalaj na aktywne linki',
	'RSS_ALLOW_LINKS_EXPLAIN' => 'Tutaj możesz zdecydować czy aktywować lub nie linki użyte w zawartości pozycji.<br/> Jeśli deaktywowane, linki i emaile będą w zawartości ale nie będą klikalne.',
	'RSS_ALLOW_EMAILS' => 'Zezwalaj na emaile',
	'RSS_ALLOW_EMAILS_EXPLAIN' => 'Tutaj możesz zdecydować czy wyświetlać "email MAŁPA domena KROPKA pl" czy "email@domain.com" w zawartości wiadomości.',
	'RSS_ALLOW_SMILIES' => 'Zezwalaj na uśmieszki',
	'RSS_ALLOW_SMILIES_EXPLAIN' => 'Tutaj możesz zdecydować czy prasować lub ignorować  zawartość uśmieszków.',
	'RSS_NOHTML' => 'HTML filter',
	'RSS_NOHTML_EXPLAIN' => 'Filtruj lub nie, html w kanałach rss. Jeśli aktywujes tę opcję, kanały rss będą zawierać tylko tekst.',
	// Old URL handling
	'RSS_1XREDIR' => 'Handle GYM 1x rewriten URL',
	'RSS_1XREDIR_EXPLAIN' => 'Aktywuj GYM 1x wykrywanie nadpisanych adresów URL. Moduł będzie wyświetlać niestandardową wiadomość z nowym adresem URL żądanej wiadomości.<br/><u>Uwaga :</u><br/>Ta opcja wymaga zgodności z regułami nadpisywania jak wyjaśniono w pliku instalacji.',
));
?>