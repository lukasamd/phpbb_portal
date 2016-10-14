<?php
/**
*
* @package phpBB SEO GYM Sitemaps
* @version $id: gym_html.php - 259 2010-03-18 19:25:40Z dcz $
* @copyright (c) 2006 - 2008 www.phpbb-seo.com
* @license http://opensource.org/osi3.0/licenses/lgpl-license.php GNU Lesser General Public License
*
*/
/**
*
* gym_html [Polish]
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
	'HTML_MAIN' => 'Ustawienia HTML',
	'HTML_MAIN_EXPLAIN' => 'Główne ustawienia dla modułu HTML.<br/>Mogą być stosowane do wszystkich modułów HTML w zależnośći od nadrzędnych ustawień HTML.',
	// Linking setup
	'HTML_LINKS_ACTIVATION' => 'Linki forum',
	'HTML_LINKS_MAIN' => 'Główne linki',
	'HTML_LINKS_MAIN_EXPLAIN' => 'Pokaż lub nie główne linki nowości i map w stopce.<br/>Ta opcja wymaga aby główne linki były aktywowane w głównej konfiguracji.',
	'HTML_LINKS_INDEX' => 'Linki na głównej stronie',
	'HTML_LINKS_INDEX_EXPLAIN' => 'Pokaż lub nie linki do dostępnych map i nowości dla każdego działu na głównej stronie forum. These links are added below the forum descritpions.<br/>Ta opcja wymaga aby główne linki były aktywowane w głównej konfiguracji.',
	'HTML_LINKS_CAT' => 'Linki na stronie działu',
	'HTML_LINKS_CAT_EXPLAIN' => 'Pokaż lub nie linki do nowości i map stron aktualnego działu. Linki te są wyświetlane pod nazwą działu.<br/>Ta opcja wymaga aby główne linki były aktywowane w głównej konfiguracji.',
	// Reset settings
	'HTML_ALL_RESET' => 'Wszystkie moduły HTML',
	// Limits
	'HTML_RSS_NEWS_LIMIT' => 'Główne limity strony nowości',
	'HTML_RSS_NEWS_LIMIT_EXPLAIN' => 'Liczba elementów wyświetlanych na stronie głównej wiadomości, zebrane od skonfigurowanego źródła RSS dla głównej strony.',
	'HTML_MAP_TIME_LIMIT' => 'Limit czasowy dla modułu głównego mapy',
	'HTML_MAP_TIME_LIMIT_EXPLAIN' => 'Limit w dniach. Maksymalny wiek elementów branych pod uwagę przy budowie modułu głównego mapa strony. Może być bardzo przydatne, aby obniżyć obciążenie serwera na dużych bazach danych. Wpisz 0 dla bez limitu',
	'HTML_CAT_MAP_TIME_LIMIT' => 'Limit czasowy dla kategorii map',
	'HTML_CAT_MAP_TIME_LIMIT_EXPLAIN' => 'Limit w dniach. Maksymalny wiek elementów branych pod uwagę przy budowie modułu kategorii mapa stron. Może być bardzo przydatne, aby obniżyć obciążenie serwera na dużych bazach danych. Wpisz 0 dla bez limitu',
	'HTML_NEWS_TIME_LIMIT' => 'Time limits for News',
	'HTML_NEWS_TIME_LIMIT_EXPLAIN' => 'Limit w dniach. Maksymalny wiek elementów branych pod uwagę przy budowie modułu strona nowości. Może być bardzo przydatne, aby obniżyć obciążenie serwera na dużych bazach danych. Wpisz 0 dla bez limitu',
	'HTML_CAT_NEWS_TIME_LIMIT' => 'Time limit for category news',
	'HTML_CAT_NEWS_TIME_LIMIT_EXPLAIN' => 'Limit w dniach. Maksymalny wiek elementów branych pod uwagę przy budowie modułu kategoria stron z wiadomościami. Może być bardzo przydatne, aby obniżyć obciążenie serwera na dużych bazach danych. Wpisz 0 dla bez limitu',
	// sort
	'HTML_MAP_SORT_TITLE' => 'Sortowanie mapy',
	'HTML_NEWS_SORT_TITLE' => 'Sortowanie wiadomości',
	'HTML_CAT_SORT_TYPE' => 'Sortowanie dla kategorii mapy',
	'HTML_CAT_SORT_TYPE_EXPLAIN' => 'Na tej samej zasadzie jak wyżej, to odnosi się do modułu kategorii mapy strony, np. mapa forum dla modułu HTML forum.',
	'HTML_NEWS_SORT_TYPE' => 'Sorting for news page',
	'HTML_NEWS_SORT_TYPE_EXPLAIN' => 'Na tej samej zasadzie jak wyżej, to odnosi się do modułu strona wiadomości, np. strony wiadomości forum dla modułu HTML forum.',
	'HTML_CAT_NEWS_SORT_TYPE' => 'Sorting for category news pages',
	'HTML_CAT_NEWS_SORT_TYPE_EXPLAIN' => 'Na tej samej zasadzie jak wyżej, to odnosi się do modułu kategoria stron z wiadomościami, np. strona wiadomości forum dla modułu HTML forum.',
	'HTML_PAGINATION_GEN' => 'Główne Stronicowanie',
	'HTML_PAGINATION_SPEC' => 'Moduł stronicowanie',
	'HTML_PAGINATION' => 'Stronicowanie mapy strony',
	'HTML_PAGINATION_EXPLAIN' => 'Aktywuj stronicowanie na mapach strony. Możesz zdecydować się na wykorzystanie tylko jednego, lub kilku stron na witrynie mapy.',
	'HTML_PAGINATION_LIMIT' => 'Pozycji na stronę',
	'HTML_PAGINATION_LIMIT_EXPLAIN' => 'Gdy stronicowanie mapy strony jest włączone, możesz wybrać jak wiele pozycji wyświetlić na stronie.',
	'HTML_NEWS_PAGINATION' => 'Stronicowanie wiadomości',
	'HTML_NEWS_PAGINATION_EXPLAIN' => 'Aktywuj stronicowanie na stronie wiadomości. Możesz zdecydować się na wykorzystanie tylko jednego, lub kilku stron dla stron wiadomości.',
	'HTML_NEWS_PAGINATION_LIMIT' => 'Wiadomości na stronę',
	'HTML_NEWS_PAGINATION_LIMIT_EXPLAIN' => 'Gdy stronicowanie wiadomości jest aktywowane, możesz wybrać ile wiadomości ma być pokazanych na stronie.',
	'HTML_ITEM_PAGINATION' => 'Stronicowanie pozycji',
	'HTML_ITEM_PAGINATION_EXPLAIN' => 'Tutaj możesz zdecydować, wyświetlać stronicowane linki (gdy dostępne) dla pozycji na wykazie. Na przykład, moduł może dodatkowo wyświetlać linki stron tematów forum.',
	// Basic settings
	'HTML_SETTINGS' => 'Ustawienia',
	'HTML_C_INFO' => 'Informacje o prawach autorskich',
	'HTML_C_INFO_EXPLAIN' => 'Informacja do wyświetlenia w autorskich meta tagach do map witryn i stron z wiadomościami. Domyślnie nazwa strony phpBB. Niniejsze informacje będą wykorzystywane wyłącznie jeśli zainstalujesz phpBB SEO dynamic meta tag mod.',
	'HTML_SITENAME' => 'Nazwa strony',
	'HTML_SITENAME_EXPLAIN' => 'Nazwa strony do wyświetlenia w mapach stron i na stronach wiadomości. Domyślnie nazwa strony phpBB.',
	'HTML_SITE_DESC' => 'Opis strony',
	'HTML_SITE_DESC_EXPLAIN' => 'Opis strony do wyświetlenia w mapach stron i na stronach wiadomości. Domyślnie opis strony phpBB.',
	'HTML_LOGO_URL' => 'Logo strony',
	'HTML_LOGO_URL_EXPLAIN' => 'Plik obrazka do użycia jako logo strony w RSS, w katalogu gym_sitemaps/images/.',
	'HTML_URL_EXPLAIN' => 'Wpisz pełny adres URL do pliku map.php, np. http://www.przyklad.pl/ewentualnie_katlog/ jeśli map.php jest zainstalowany w http://www.przyklad.pl/ewentualnie_katlog/.<br/>Ta opcja jest przydatna, gdy phpBB nie jest zainstalowane w katalogu root domeny i chciałbyś umieścić plik map.php w katalogu root.',
	'HTML_RSS_NEWS_URL' => 'Głowna strona wiadomości źródła RSS',
	'HTML_RSS_NEWS_URL_EXPLAIN' => 'Wpisz pełny adres URL do RSS który chcesz pokazać na głównej stronie wiadomości, przykład http://www.przyklad.pl/gymrss.php?news&amp;aby wyświetlić wszystkie wiadomości dla wszystkich zainstalowanych modułów RSS na głównej stronie wiadomości HTML.<br />Możesz użyć RSS 2.0 jako źródło dla tej strony.',
	'HTML_STATS_ON_NEWS' => 'Pokaż statystyki forum na stronach wiadomości',
	'HTML_STATS_ON_NEWS_EXPLAIN' => 'Pokazuje, lub nie, statystyki forum na stronach wiadomości.',
	'HTML_STATS_ON_MAP' => 'Pokaż mapy statystyk forum',
	'HTML_STATS_ON_MAP_EXPLAIN' => 'Pokazuje, lub nie, statystyki forum na stronach map.',
	'HTML_BIRTHDAYS_ON_NEWS' => 'Pokaż urodziny na stronach wiadomości',
	'HTML_BIRTHDAYS_ON_NEWS_EXPLAIN' => 'Pokazuje, lub nie, urodziny na stronach wiadomości.',
	'HTML_BIRTHDAYS_ON_MAP' => 'Pokaż urodziny na stronach wiadomości',
	'HTML_BIRTHDAYS_ON_MAP_EXPLAIN' => 'Pokazuje, lub nie, urodziny na stronach wiadomości.',
	'HTML_DISP_ONLINE' => 'Pokaż użytkownik jest online',
	'HTML_DISP_ONLINE_EXPLAIN' => 'Pokazuje, lub nie, listę użytkowników online list na mapie strony i na stronach wiadomości.',
	'HTML_DISP_TRACKING' => 'Włącz śledzenie',
	'HTML_DISP_TRACKING_EXPLAIN' => 'Włącza, lub nie, śledzenie pozycji (przeczytana / nieprzeczytana).',
	'HTML_DISP_STATUS' => 'Włącz status',
	'HTML_DISP_STATUS_EXPLAIN' => 'Włącza, lub nie, system statusu pozycji (Ogłoszenie, Przyklejone, zamknięty itd ... ).',
	// Cache
	'HTML_CACHE' => 'Cache',
	'HTML_CACHE_EXPLAIN' => 'Tutaj możesz zdefiniować różne opcje buforowania dla trybu HTML. Buforowanie HTML jest oddzielone od innych rodzajów trybów (Google i RSS). Ten moduł używa standardu buforowania phpBB.<br/>Ta opcja nie może więc być dziedziczona z głównego poziomu, i tylko publiczne treści będą buforowane. Te ustawienie jednak, mogą być transmitowane do modułów HTML w zależności od nadrzędnych ustawień HTML.<br/><br/>Cache jest podzielony na dwa typy, jeden dla każdej kolumny na wyjście : Główna kolumna, zawiera mapy i wiadomości, i druga, która na przykład może być użyta, aby dodać ostatni aktywnych temat modułu HTML forum.',
	'HTML_MAIN_CACHE_ON' => 'Włącz główną kolumne buforowania',
	'HTML_MAIN_CACHE_ON_EXPLAIN' => 'Tutaj możesz włączyć / wyłączyć mapy stron i wiadomości kolumn buforowania.',
	'HTML_OPT_CACHE_ON' => 'Aktywuj opcjonalne buforowanie kolumny',
	'HTML_OPT_CACHE_ON_EXPLAIN' => 'Tutaj możesz aktywować / deaktywować opcjonalne buforowanie kolumny.',
	'HTML_MAIN_CACHE_TTL' => 'Okres buforowania',
	'HTML_MAIN_CACHE_TTL_EXPLAIN' => 'Maksymalna ilość godzin przez które główna kolumna buforowania będzie wykorzystywana, zanim zostanie zaktualizowana. Każdy buforowany plik zostanie zaktualizowany za każdym razem gdy ktoś będzie go przeglądać.',
	'HTML_OPT_CACHE_TTL' => 'Okres buforowania opcjonalnej kolumny',
	'HTML_OPT_CACHE_TTL_EXPLAIN' => 'Maksymalna ilość godzin przez które opcjonalna kolumna buforowania będzie wykorzystywana, zanim zostanie zaktualizowana. Każdy buforowany plik zostanie zaktualizowany za każdym razem gdy ktoś będzie go przeglądać.',
	// Auth settings
	'HTML_AUTH_SETTINGS' => 'Ustawienia autoryzacji',
	'HTML_ALLOW_AUTH' => 'Autoryzacja',
	'HTML_ALLOW_AUTH_EXPLAIN' => 'Aktywuj autoryzację dla mapy strony i strony wiadomości. Jeśli aktywowana, zalogowani użytkownicy będą mogli przeglądać prywatne zawartości i pozycje z prywatnych for, jeśli mają odpowiednie zezwolenia.',
	'HTML_ALLOW_NEWS' => 'Aktywuj wiadomości',
	'HTML_ALLOW_NEWS_EXPLAIN' => 'Każdy moduł może mieć stronę wiadomości nasłuchującą X aktywnych pozycji z ich zawartością, które mogą być filtrowane. Dla forum, strona wiadomości forum  jest to generalnie strona pokazująca 10 ostatnich tematów, ostatni tema pierwszy post streszczony pochodzący z wybranych publicznych lub prywatnych for.',
	'HTML_ALLOW_CAT_NEWS' => 'Aktywuj kategorię wiadomości',
	'HTML_ALLOW_CAT_NEWS_EXPLAIN' => 'Na tych samych zasadach co moduł wiadomości stron, każdy moduł kategorii może posiadać stronę wiadomosci.',
	// Content
	'HTML_NEWS' => 'Ustawienia wiadomości',
	'HTML_NEWS_EXPLAIN' => 'Tutaj można skonfigurować różne filtrowania treści / opcje formatowania wiadomości. <br/>Mogą być stosowane do wszystkich modułów HTML w zależności od twoich ustawień nadpisywania HTML.',
	'HTML_NEWS_CONTENT' => 'Ustawienia zawartości wiadomości',
	'HTML_SUMARIZE' => 'Pozycje streszczenia',
	'HTML_SUMARIZE_EXPLAIN' => 'Tutaj możesz podsumować treści wiadomości umieszczanych w wiadomościach strony.<br/> Limit ustala maksymalną ilość zdań, słów lub znaków, zgodnie z metodą wybrana poniżej. Wpisz 0 aby wyświetlić wszystko.',
	'HTML_SUMARIZE_METHOD' => 'Metoda sterszczania',
	'HTML_SUMARIZE_METHOD_EXPLAIN' => 'Możesz wybrać trzy różne metody na ograniczenie treści wiadomości w formacie RSS.<br/>Ze względu na liczbę linii, ze względu na ilość słów i ze względu na ilość znaków. Taki BBcode i słowa nie będą łamane.',
	'HTML_ALLOW_PROFILE' => 'Pokaż profile',
	'HTML_ALLOW_PROFILE_EXPLAIN' => 'Nazwa autora pozycji może być dodana do wysłania w razie potrzeby.',
	'HTML_ALLOW_PROFILE_LINKS' => 'Profil linku',
	'HTML_ALLOW_PROFILE_LINKS_EXPLAIN' => 'Jeśli nazwa autora znajduje się w treści, możesz zdecydować czy powiązać lub nie z odpowiednim profilem strony phpBB.',
	'HTML_ALLOW_BBCODE' => 'Zezwalaj na BBcodey',
	'HTML_ALLOW_BBCODE_EXPLAIN' => 'Można wybrać albo zanalizować i wyświetlić lub pominąć BBCode.',
	'HTML_STRIP_BBCODE' => 'Wyłączenie BBcode',
	'HTML_STRIP_BBCODE_EXPLAIN' => 'Tutaj możesz skonfigurować listę bbcodes do wyłączenia z parsowania.<br/>Format jest prosty : <br/><ul><li> <u>Przecinki oddzielają listy bbcode :</u> Usuń tagi bbcode, zatrzymaj zawartość. <br/><u>Przykład :</u> <b>img,b,quote</b> <br/> W tym przykładzie img, bold i quote bbcode nie będą prasowane, same tagi BBCode zostaną usunięte i treści wewnątrz tagów BBCode zostanie zatrzymana.</li><li> <u>Przecinek oddziela listy bbcode z opcją dwukropek :</u> Usuń tagi bbcode i zdecyduj o ich zawartości. <br/><u>Przykład :</u> <b>img:1,b:0,quote,code:1</b> <br/> W tym przykładzie, img bbcode i img link będzie usunięty, bold nie będzie rozpatrywane, ale bold-ed tekst będzie utrzymany, quote nie będzie prasowany, ale zawartość zostanie utrzymana, kod bbcode i zawartość będzie usunięta.</ul>Filter będzie pracował nawet wtedy kiedy bbcode jest pusty. Podręczne do usunięcia zawartości kodu tagów i linków img ze strony wyjściowej na przykład.<br/>Filtrowania nastąpi przed podsumowaniem.<br/> Magiczny parametr "wszystko" (może być wszystko:0 lub wszystko:1 aby wyłączyć zawartość tagów bbcode) zajmie się wszystkimi na naraz.',
	'HTML_ALLOW_LINKS' => 'Zezwalaj na aktywne linki',
	'HTML_ALLOW_LINKS_EXPLAIN' => 'Możesz wybrać włączyć lub nie linki użyte w zawartości pozycji.<br/> Jeśli deaktywowane, linki i emaile zostaną włączone w treści, ale nie będą klikalne.',
	'HTML_ALLOW_EMAILS' => 'Zezwalaj na Emaile',
	'HTML_ALLOW_EMAILS_EXPLAIN' => 'Tutaj możesz wybrać czy wysyłać "email MAŁPA domena KROPKA pl" zamiast "email@domena.pl" w zawartości pozycji.',
	'HTML_ALLOW_SMILIES' => 'Zezwalaj na uśmieszki',
	'HTML_ALLOW_SMILIES_EXPLAIN' => 'Tutaj możesz wybrać  czy prasować lub ignorować uśmieszki w zawartości.',
	'HTML_ALLOW_SIG' => 'Zezwalaj na podpisy',
	'HTML_ALLOW_SIG_EXPLAIN' => 'Tutaj możesz wybrać czy pokazywać lub nie opisy użytkowników w zawartości.',
	'HTML_ALLOW_MAP' => 'Aktywuj moduł mapy',
	'HTML_ALLOW_MAP_EXPLAIN' => 'Tutaj możesz aktywować / deaktywować moduł mapa strony.',
	'HTML_ALLOW_CAT_MAP' => 'Aktywuj moduł kategoria map',
	'HTML_ALLOW_CAT_MAP_EXPLAIN' => 'Tutaj możesz aktywować / deaktywować moduł kategoria map.',
));
?>