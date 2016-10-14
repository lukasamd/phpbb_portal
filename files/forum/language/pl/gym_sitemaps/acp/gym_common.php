<?php
/**
*
* @package phpBB SEO GYM Sitemaps
* @version $id: gym_common.php - 279 2010-11-26 09:19:15Z dcz $
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
	// Main
	'ALL' => 'Wszystkie',
	'MAIN' => 'GYM Sitemaps',
	'MAIN_MAIN_RESET' => 'Główne ustawienia GYM sitemaps',
	'MAIN_MAIN_RESET_EXPLAIN' => 'Zresetuj wszystkie główne ustawienia GYM do domyślnych wartości.',
	// Linking setup
	'GYM_LINKS_ACTIVATION' => 'Linkowanie Forum',
	'GYM_LINKS_MAIN' => 'Główne linki',
	'GYM_LINKS_MAIN_EXPLAIN' => 'Pokazuj lub nie, linki do głównych stron GYM w stopce : Index mapy strony, główny kanał RSS i listę kanałów, główną mapę i nową stronę.',
	'GYM_LINKS_INDEX' => 'Linki na głównej stronie',
	'GYM_LINKS_INDEX_EXPLAIN' => 'Pokazuj lub nie, linki do dostepnych stron GYM dla każdego tematu na głównej stronie forum. Te linki są dodawane pod opisem tematu.',
	'GYM_LINKS_CAT' => 'Linki na stronie tematu',
	'GYM_LINKS_CAT_EXPLAIN' => 'Pokazuj lub nie, linki do dostepnych stron GYM na stronie tematu. Te linki są dodawane pod opisem tematu.',
	// Google sitemaps
	'GOOGLE' => 'Google',
	'GOOGLE_URL' => 'Adres URL mapy Google',
	// Reset settings
	'GOOGLE_MAIN_RESET' => 'Główne ustawienia Google Sitemap',
	'GOOGLE_MAIN_RESET_EXPLAIN' => 'Zresetuj wszystkie główne ustawienia Google Sitemap do domyślnych wartości.',
	// RSS feeds
	'RSS' => 'RSS',
	'RSS_URL' => 'Adres kanału RSS',
	'RSS_ALTERNATE' => 'Alternatywne linki RSS',
	'RSS_ALTERNATE_EXPLAIN' => 'Pokaż lub nie, alternatywne linki RSS w pasku nawigacyjnym przeglądarki',
	'RSS_LINKING_TYPE' => 'Typ linków RSS',
	'RSS_LINKING_TYPE_EXPLAIN' => 'Typ wiadomości do wyświetlenia na stronach forum.<br/>Może być ustawione :<br/><b>&bull; Wiadomości z lub bez treści</b><br/>Pozycje będą wyświetlane zgodnie z datą utworzenia, z lub bez zawartości,<br/><b>&bull; Regularne wiadomości z lub bez zawartości</b><br/>Pozycje będą wyświetlane ze względu na ostatnią aktywność, z lub bez zawartości.<br/>Dotyczy to tylko wyświetlanych linków, a nie aktualnie dostępnych kanałów.',
	'RSS_LINKING_NEWS' => 'Wiadomości',
	'RSS_LINKING_NEWS_DIGEST' => 'Wiadomości z zawartością',
	'RSS_LINKING_REGULAR' => 'Regularne wiadomości',
	'RSS_LINKING_REGULAR_DIGEST' => 'Wiadomości bez zawartości',
	// Reset settings
	'RSS_MAIN_RESET' => 'Główne ustawienia RSS',
	'RSS_MAIN_RESET_EXPLAIN' => 'Zresetuj wszystkie główne ustawienia RSS do domyślnych wartości.',
	'YAHOO' => 'Yahoo',
	// HTML
	'HTML_MAIN_RESET' => 'Globalne ustawienia HTML',
	'HTML_MAIN_RESET_EXPLAIN' => 'Zresetuj wszystkie główne ustawienia mapy i nowości HTML do domyślnych wartości.',
	'HTML' => 'Html',
	'HTML_URL' => 'HTML URL',

	// GYM authorisation array
	'GYM_AUTH_ADMIN' => 'Admin',
	'GYM_AUTH_GLOBALMOD' => 'Globalni Moderatorzy',
	'GYM_AUTH_REG' => 'Zalogowany',
	'GYM_AUTH_GUEST' => 'Gość',
	'GYM_AUTH_ALL' => 'Wszyscy',
	'GYM_AUTH_NONE' => 'Brak',
	// XSLT
	'GYM_STYLE' => 'Stylowanie',

	// Cache status
	'SEO_CACHE_FILE_TITLE' => 'Status Cache',
	'SEO_CACHE_STATUS' => 'Plik cache jest skonfigurowany w: <b>%s</b>',
	'SEO_CACHE_FOUND' => 'Znaleziono plik cache.',
	'SEO_CACHE_NOT_FOUND' => 'Nie znaleziono pliku cache.',
	'SEO_CACHE_WRITABLE' => 'Plik cache jest zapisywalny.',
	'SEO_CACHE_UNWRITABLE' => 'Plik cache <b>nie</b> jest zapisywalny.  Ustaw CHMOD dla katalogu cache na 0777.',
	
	// Mod Rewrite type
	'ACP_SEO_SIMPLE' => 'Simple',
	'ACP_SEO_MIXED' => 'Intermediate',
	'ACP_SEO_ADVANCED' => 'Advanced',
	'ACP_PHPBB_SEO_VERSION' => 'Wersja',
	'ACP_SEO_SUPPORT_FORUM' => 'Support Forum',
	'ACP_SEO_RELEASE_THREAD' => 'Najnowsze wydania',
	'ACP_SEO_REGISTER_TITLE' => 'Zarejestruj się',
	'ACP_SEO_REGISTER_UPDATE' => 'powiadomienia o aktualizacjach',
	'ACP_SEO_REGISTER_MSG' => 'Może chcesz %1$ aby było %2$',

	// Maintenance
	'GYM_MAINTENANCE' => 'Konserwacja',
	'GYM_MODULE_MAINTENANCE' => '%1$ konserwacja',
	'GYM_MODULE_MAINTENANCE_EXPLAIN' => 'Tutaj możesz zarządzać buforowanymi plikami wykorzystywanymi przez moduł %1$s.<br/> Są dwa typy: pierwszy, jest używany do przechowywania danych wyjściowych na stronach publicznych, i drugi używany do budowania każdego z modułów w ACP. Możesz usunąć moduły w ACP jeśli zaznaczysz opcję wyczyść cache; domyślnie czyszczenie zawartości cache dla wybranych modułów.',
	'GYM_CLEAR_CACHE' => 'Wyczyść %1$s cache',
	'GYM_CLEAR_CACHE_EXPLAIN' => 'Tutaj możesz wyczyścić cache dla modułu %1$s. Te pliki cache zawierają dane używane do budowania danych wyjściowych %1$s.<br/>To może być użyteczne jeśli chcesz wymusić aktualizację cache.',
	'GYM_CLEAR_ACP_CACHE' => 'Wyczyść %1$s ACP',
	'GYM_CLEAR_ACP_CACHE_EXPLAIN' => 'Możesz wybrać czyszczenie cache %1$s ACP zamiast konfigurować. Te pliki cache zawierają dane używane do budowania danych wyjściowych %1$s ACP.<br/>To może być użyteczne jeżeli chcesz aktywować nowe opcje, które mogą być dodawane do modułów tego typu wyjścia.',
	'GYM_CACHE_CLEARED' => 'Wyczyszczono cache w : ',
	'GYM_CACHE_NOT_CLEARED' => 'Wystąpił błąd podczas czyszczenia pamięci podręcznej, należy sprawdzić prawa folderu cache (CHMOD 0666 lub 0777).<br/>Obecnie folder znajduje się : ',
	'GYM_FILE_CLEARED' => 'Plik(i) usunięte: ',
	'GYM_CACHE_ACCESSED' => 'Folder cache został poprawnie rozpoznany, ale pliki nie zostały usunięte: ',
	'MODULE_CACHE_CLEARED' => 'Cache modułu ACP wyczyszczony, jęzeli skopiowałeś moduł, pokaże się w ACP.',
	
	// set defaults
	'GYM_SETTINGS' => 'Ustawienia',
	'GYM_RESET_ALL' => 'Zreseruj wszystko',
	'GYM_RESET_ALL_EXPLAIN' => 'Jeśli zaznaczyłeś tę opcję, wszystkie ustawienia powyżej będą zresetowane do domyślnych.',
	'GYM_RESET' => 'Reset %1$s config',
	'GYM_RESET_EXPLAIN' => 'Poniżej możesz zresetować moduł config %1$, lub całość modułu na raz lub w tylko określonej konfiguracji modułu.',

	'GYM_INSTALL' => 'Instaluj',
	'GYM_MODULE_INSTALL' => 'Instaluj moduł %1$',
	'GYM_MODULE_INSTALL_EXPLAIN' => 'Poniżej możesz aktywować / deaktywować moduł %1$.<br/>Jeśli właśnie załadowałeś moduł, musisz go aktywować przed użyciem.<br/>Jeśli nie możesz zobaczyć nowego modułu, sprubuj wyczyścić cache modułu na stronie konserwacji.',

	// Titles
	'GYM_MAIN' => 'Ustawienia GYM Sitemaps',
	'GYM_MAIN_EXPLAIN' => 'Są to ustawienia wspólne dla wszystkich rodzajów wyjść i dla wszystkich modułów.<br/> Mogą być stosowane do wszystkich typów wyjść (html, RSS, Google sitemaps, Yahoo! listy url) i/lub do wszystkich modułów w zależności od ustawień nadpisywania.',
	'MAIN_MAIN' => 'Przegląd GYM Sitemaps',
	'MAIN_MAIN_EXPLAIN' => 'GYM sitemaps jest bardzo elastyczny i przyjazny dla modułu phpBB Search Engine Optimized. Pozwoli Ci zbudować Google sitemaps, RSS 2.0 feeds, Yahoo! listę URL i html sitemaps dla twojego forum tak jak w przypadku każdej części witryny dzięki jego modularności.<br/><br/> Każdy typ wyjścia (Google, RSS, html & Yahoo) może pobierać pozycje z kilku list aplikacji zainstalowanych w witrynie (forum, album itd ...) za pomocą dedykowanego modułu.<br/>Możesz aktywować / deaktywować moduły używając linku Instaluj na stronie każdego modułu, każdy moduł posiada własną stronę konfiguracji.<br/><br/>Upewnij się że sprawdziłeś %1$s.<br/> Wsparcie można znaleźć na %2$s.<br/>Generalne wsparcie i dyskusje SEO można znaleźć na %3$s<br/><br/>Miłej zabawy ;-)',

	'GYM_GOOGLE' => 'Ustawienia Google Sitemaps',
	'GYM_GOOGLE_EXPLAIN' => 'Są to ustawienia wspólne dla wszystkich modułów Google Sitemaps (forum, niestandardowe itd ...).<br/> Mogą być stosowane do wszystkich modułów Google Sitemaps w zależności od ustawienia nadpisywania dla tego typu wyjścia.',
	'GYM_RSS' => 'RSS',
	'GYM_RSS_EXPLAIN' => 'Są to ustawienia wspólne dla wszystkich modułów RSS (forum, niestandardowe itd ...).<br/> Mogą być stosowane do wszystkich modułów RSS w zależności od ustawienia nadpisywania dla tego typu wyjścia.',
	'GYM_HTML' => 'Strony HTML',
	'GYM_HTML_EXPLAIN' => 'Są to ustawienia wspólne dla wszystkich modułów HTML (forum, niestandardowe itd ...).<br/> Mogą być stosowane do wszystkich modułów HTML w zależności od ustawienia nadpisywania dla tego typu wyjścia.',
	'GYM_MODULES_INSTALLED' => 'Aktywne moduły',
	'GYM_MODULES_UNINSTALLED' => 'Deaktywowane moduły',

	// Overrides
	'GYM_OVERRIDE_GLOBAL' => 'Globalnie',
	'GYM_OVERRIDE_OTYPE' => 'Typ wyjścia',
	'GYM_OVERRIDE_MODULE' => 'Moduł',
	
	// override messages
	'GYM_OVERRIDED_GLOBAL' => 'Ta opcja aktualnie jest nadpisan na najwyższym poziomie (Główne ustawienia)',
	'GYM_OVERRIDED_OTYPE' => 'Ta opcja aktualnie jest nadpisan na poziomie typ wyjścia',
	'GYM_OVERRIDED_MODULE' => 'Ta opcja aktualnie jest nadpisan na poziomie moduł',
	'GYM_OVERRIDED_VALUE' => 'Aktualna ustawiona wartość to : ',
	'GYM_OVERRIDED_VALUE_NOTHING' => 'nic',
	'GYM_COULD_OVERRIDE' => 'Ta opcja może być nadpisana, ale obecnie nie jest.',

	// Overridable / common options
	'GYM_CACHE' => 'Cache',
	'GYM_CACHE_EXPLAIN' => 'Tutaj można ustawić różne opcje buforowania. Pamiętaj, że te ustawienia mogą być zmienione w zależności od ustawienia nadpisywania.',
	'GYM_MOD_SINCE' => 'Aktywuj odpytywanie',
	'GYM_MOD_SINCE_EXPLAIN' => 'Moduł zapyta przeglądarkę czy posiada aktualną werję strony w buforze przed ponownym wysłaniem treści.<br /><u>Uwaga :</u> Opcja ta będzie dotyczyć wszystkich rodzajów wyjść.',
	'GYM_CACHE_ON' => 'Aktywuj buforowanie',
	'GYM_CACHE_ON_EXPLAIN' => 'Możesz aktywować / deaktywować buforowanie dla tego modułu.',
	'GYM_CACHE_FORCE_GZIP' => 'Wymuś kompresję cache',
	'GYM_CACHE_FORCE_GZIP_EXPLAIN' => 'Pozwala na wymuszenie kompresji gunzip dla buforowanych plików pomimo nie stosowania gunzip. To może trochę pomóc zaoszczędzić miejsce na dysku, ale będzie oznaczało trochę więcej pracy dla serwera, aby zdekompresować plik przed jego wysłaniem do przeglądarki.',
	'GYM_CACHE_MAX_AGE' => 'Okres cache',
	'GYM_CACHE_MAX_AGE_EXPLAIN' => 'Maksymalna liczba godzin przez które buforowany plik zostanie wykorzystywany, zanim zostanie zaktualizowany. Każdy buforowany plik zostanie zaktualizowany za każdym razem gdy ktoś będzie go przeglądać.',
	'GYM_CACHE_AUTO_REGEN' => 'Automatyczna aktualizacja Cache',
	'GYM_CACHE_AUTO_REGEN_EXPLAIN' => 'Jeśli aktywujesz automatyczną aktualizację cache, listy wyjściowe będą aktualizowane jednorazowo, jeśli nie, będziesz musiał ręcznie czyścić cache poprzez użycie linku powyżej Konserwacja, aby nowe dresy pojawiły się na liście.',
	'GYM_SHOWSTATS' => 'Statystyki Cache',
	'GYM_SHOWSTATS_EXPLAIN' => 'Wyślij lub nie, generowane statystyki do kodu źródłowego.<br /><u>UWAGA :</u> Czas trwania jest to czas potrzebny do zbudowania strony. Ten krok nie jest powtarzany jeżeli zapisywany jest z bufora.',
	'GYM_CRITP_CACHE' => 'Szyfruj nazwy plików cache',
	'GYM_CRITP_CACHE_EXPLAIN' => 'Szyfruj lub nie, nazwy plików cache. Bezpieczniej jest utrzymywać zaszyfrowane nazwy plików cache ,  ale dla procesu debugowania łatwiej jest sprawdzać nazwy plików które nie są zaszyfrowane.<br /><u>UWAGA :</u> Ta opcja dotyczy wszystkich plików cache.',

	'GYM_MODREWRITE' => 'Nadpisywanie URL',
	'GYM_MODREWRITE_EXPLAIN' => 'Tutaj możesz ustawić różne opcje nadpisywania adresów URL. Pamiętaj, te ustawienia mogą być nadpisane w zależności od głównych ustawień nadpisywania.',
	'GYM_MODREWRITE_ON' => 'Aktywuj nadpisywanie URL',
	'GYM_MODREWRITE_ON_EXPLAIN' => 'Ta opcja aktywuje nadpisywanie adresów URL dla modułu linki.<br /><u>UWAGA :</u> MUSISZ używać Apache server z załadowanym modułem mod_rewrite lub IIS server z uruchomionym modułem isapi_rewrite ABY poprawnie ustawić reguły nadpisywania w .htaccess (lub httpd.ini z IIS ).',
	'GYM_ZERO_DUPE_ON' => 'Aktywuj Zero Duplicate',
	'GYM_ZERO_DUPE_ON_EXPLAIN' => 'Ta opcja aktywuje Zero Duplicate dla modułu linki.<br /><u>UWAGA :</u>  W tej wersji przekierowania będą miały miejsce po wyczyszczeniu cache.',
	'GYM_MODRTYPE' => 'Typ nadpisywania URL',
	'GYM_MODRTYPE_EXPLAIN' => 'Te opcje są nadpisywane przez phpBB SEO mod rewrite (wykrywa automatycznie ).<br/>Możesz ustawić cztery rodzaje nadpisywania URL: Brak, Simple, Mixed i Advanced :<br/><ul><li><b>Brak :</b> Bez nadpisywania URL;<br></li><li><b>Simple :</b>Statyczne nadpisywanie URL dla wszystkich linków, bez użycia tytułów tematów;<br></li><li><b>Mixed :</b> Tytuły tematów i kategorii będą osadzane w adresie URL, ale tytuły tematów pozostaną nadpisane statycznie;<br></li><li><b>Advanced :</b> Wszystkie tytuły tematów będą osadzane w URL;</li></ul>',

	'GYM_GZIP' => 'GUNZIP',
	'GYM_GZIP_EXPLAIN' => 'Tutaj możesz ustawić różne opcje gunzip. Pamiętaj, te ustawienia mogą być nadpisane w zależności od głównych ustawień nadpisywania.%1$s',
	'GYM_GZIP_FORCED' => '<br/><b style="color:red;">UWAGA :</b> Kompresja Gun-zip jest aktywowana w phpBB. Będzie wymuszona w tym module.',
	'GYM_GZIP_CONFIGURABLE' => '<br/><b style="color:red;">UWAGA :</b> Kompresja Gun-zip nie jest aktywowana w phpBB. Możesz ustawić poniższe opcje według własnego życzenia.',
	'GYM_GZIP_ON' => 'Aktywuj gunzip',
	'GYM_GZIP_ON_EXPLAIN' => 'To aktywuje kompresję gunzip na wyjściu. Może to spowodować znaczne zmniejszenie danych wysyłanych do przeglądarki, a co za tym idzie wydłużenie czasu przesyłania danych.',
	'GYM_GZIP_EXT' => 'Rozszerzenia Gunzip',
	'GYM_GZIP_EXT_EXPLAIN' => 'Tutaj możesz wybrać czy używać lub nie rozszerzenia .gz w module URL. To działa tylko wtedy gdy gunzip i nadpisywanie URL są aktywowane.',
	'GYM_GZIP_LEVEL' => 'Poziom kompresji Gunzip',
	'GYM_GZIP_LEVEL_EXPLAIN' => 'Liczba całkowita pomiędzy 1 i 9, 9 największa kompresja. Przeważnie nie warto ustawiać powyżej 6.<br /><u>UWAGA :</u> Ta opcja dotyczy wszystkich typów wyjścia.',

	'GYM_LIMIT' => 'Limity',
	'GYM_LIMIT_EXPLAIN' => 'Tutaj możesz ustawić limit który będzie miał zastosowanie przy budowie wyjścia : ilość wychodzących adresów url, cykli SQL (ilość zapytań w tym samym czasie) i wiek list.<br/>Pamiętaj, te ustawienia mogą być nadpisane w zależności od głównych ustawień nadpisywania.',
	'GYM_URL_LIMIT' => 'Limity pozycji',
	'GYM_URL_LIMIT_EXPLAIN' => 'Maksymalna ilość pozycji do wyjścia.',
	'GYM_SQL_LIMIT' => 'Cykle SQL',
	'GYM_SQL_LIMIT_EXPLAIN' => 'Dla wszystkich rodzajów wyjścia, z wyjątkiem html, zapytania SQL są podzielone na kilka aby móc obsługiwać dużą ilośc zapytań bez zby dużego obciążenia.<br/>Określ ilość zapytań w tym samym czasie. Ilość zapytań SQL będzie ilością pozycji podzieloną przez cykl.',
	'GYM_TIME_LIMIT' => 'Limit czasu',
	'GYM_TIME_LIMIT_EXPLAIN' => 'Limit w dniach. Maksymalny wiek pozycji wziętych pod uwagę podczas budowania list wyjścia. Może być bardzo użyteczna aby obniżyć obciążenie serwera przy dużych bazach danych. Wpisz 0 dla bez limitów',

	'GYM_SORT' => 'Sortowanie',
	'GYM_SORT_EXPLAIN' => 'Tutaj możesz wybrać jak sortowaś wyjście.<br/>Pamiętaj, te ustawienia mogą być nadpisane w zależności od głównych ustawień nadpisywania.',
	'GYM_SORT_TYPE' => 'Sortowanie domyślne',
	'GYM_SORT_TYPE_EXPLAIN' => 'Wszystkie linki wyjściowe są domyślnie sortowane ze względu na aktywność(malejąco). <br /> Możesz ustawić aby były sortowane Rosnąco na przykład jżeli chcesz aby linki do starej zawartości były łatwiej wyszukiwane przez silniki szukania.<br/>Pamiętaj, te ustawienia mogą być nadpisane w zależności od głównych ustawień nadpisywania.',

	'GYM_PAGINATION' => 'Stronicowanie',
	'GYM_PAGINATION_EXPLAIN' => 'Tutaj możesz ustawić różne opcje stronicowania. Pamiętaj, te ustawienia mogą być nadpisane w zależności od głównych ustawień nadpisywania.',
	'GYM_PAGINATION_ON' => 'Aktywuj Stronicowanie',
	'GYM_PAGINATION_ON_EXPLAIN' => 'Tutaj możesz zdecydować czy wysyłać stronicowane linki (gdy dostępne) dla wykazanych pozycji. Na przykład, moduł dodatkowo może wysyłać linki stron tematów kategorii forum.',
	'GYM_LIMITDOWN' => 'Stronicowanie: Mniejszy Limit',
	'GYM_LIMITDOWN_EXPLAIN' => 'Wpisz ile stronicowanych stron, zaczynając od pierwszej strony, powinno być wysłanych.',
	'GYM_LIMITUP' => 'Stronicowanie: Większy Limit',
	'GYM_LIMITUP_EXPLAIN' => 'Wpisz ile stronicowanych stron, zaczynając od ostatniej strony, powinno być wysłanych.',

	'GYM_OVERRIDE' => 'Nadpisywanie',
	'GYM_OVERRIDE_EXPLAIN' => 'GYM sitemaps jest w pełni modularny. Każdy typ wyjścia (Google, RSS ...) używa własnego modułu wyjścia odpowiedniego do typu wykazu pozycji. Na przykład, pierwszy moduł dla wszystkich typów wyjść to moduł forum, wykazuje pozycje z forum.<br/> Dużo opcji, takich jak nadpisywanie URL, buforowanie, kompresja gunzip itd ..., są powtarzane na kilku poziomach GYM sitemaps ACP. To pozwala na użycie innych ustawień dla tej samej opcji w zależności od typu wyjścia i modułu wyjścia. Ale może się zdarzyć, że będziesz wolał, na przykład, aktywować nadpisywanie URL na wszystkich modułach GYM sitemaps jednocześnie (wszystkie typy wyjścia i wszystkie moduły).<br/> Włąśnie na to pozwolą ci ustawienia nadpisywania dla wielu typów ustawień. <br/>Proces dziedziczenia przechodzi od najwyższego poziomu ustawień (Główna konfiguracja) do poziomu typu wyjścia (Google, RSS ...) i kończy się na najniższym poziomie : modułu wyjścia (forum, album ...)<br/>Ustawienia nadpisywania mogą mieć trzy wartości :<br/><ul><li><b>Globalne :</b> Będą użyte główne ustawienia;<br></li><li><b>Typ wyjścia :</b> Będą użyte ustawienia typu wyjścia dla tego modułu;<br></li><li><b>Moduł :</b> Będą użyte najniższe dostępne ustawienia, np., pierwsze moduły, i jeśli nie ustawione, typ wyjścia pierwszy itd. do globalnych ustawień jeśli dostępne.</li></ul>',
	'GYM_OVERRIDE_ON' => 'Aktywuj główne nadpisywanie',
	'GYM_OVERRIDE_ON_EXPLAIN' => 'Tutaj możesz aktywować / deaktywować główne nadpisywanie. Deaktywowanie jest tym samym co ustawianie wszystkich nadpisywań do "modułu", pozwolić typom wyjścia nadpisywać ustawienia aby ustawić  nadpisanie modułu.',
	'GYM_OVERRIDE_MAIN' => 'Domyślne nadpisywanie',
	'GYM_OVERRIDE_MAIN_EXPLAIN' => 'Ustaw poziomy nadpisywania dla innych typów ustawień którch mogą używać moduły.',
	'GYM_OVERRIDE_CACHE' => 'Nadpisywanie cache',
	'GYM_OVERRIDE_CACHE_EXPLAIN' => 'Jaki poziom nadpisywania ustawić dla opcji buforowania.',
	'GYM_OVERRIDE_GZIP' => 'Nadpisywanie Gunzip',
	'GYM_OVERRIDE_GZIP_EXPLAIN' => 'Jaki poziom nadpisywania ustawić dla opcji gunzip.',
	'GYM_OVERRIDE_MODREWRITE' => 'Nadrzędne nadpisywanie URL',
	'GYM_OVERRIDE_MODREWRITE_EXPLAIN' => 'Jaki poziom nadpisywania ustawić dla opcji nadpisywania URL.',
	'GYM_OVERRIDE_LIMIT' => 'Nadrzędny Limit',
	'GYM_OVERRIDE_LIMIT_EXPLAIN' => 'Jaki poziom nadpisywania ustawić dla opcji limit.',
	'GYM_OVERRIDE_PAGINATION' => 'Nadrzędne Stronicowanie',
	'GYM_OVERRIDE_PAGINATION_EXPLAIN' => 'Jaki poziom nadpisywania ustawić dla opcji stronicowanie.',
	'GYM_OVERRIDE_SORT' => 'Nadrzędne Sortowanie',
	'GYM_OVERRIDE_SORT_EXPLAIN' => 'Jaki poziom nadpisywania ustawić dla opcji sortowanie.',

	// Mod rewrite
	'GYM_MODREWRITE_ADVANCED' => 'Advanced',
	'GYM_MODREWRITE_MIXED' => 'Mixed',
	'GYM_MODREWRITE_SIMPLE' => 'Simple',
	'GYM_MODREWRITE_NONE' => 'Brak',

	// Sorting
	'GYM_ASC' => 'Rosnąco',
	'GYM_DESC' => 'Malejąco',

	// Other
	// robots.txt
	'GYM_CHECK_ROBOTS' => 'Sprawdź wyłączenia z pliku robots.txt',
	'GYM_CHECK_ROBOTS_EXPLAIN' => 'Sprawdza i stosuje się do listy adresów URL pliku wykluczeń robots.txt jeżeli dostępny. MOD uwzględnia i automatycznie aktualizuje plik robots.txt.<br />Ta opcja jest szczególnie przydatna dla importu TXT i XML, gdy nie jest pewne, że import list adresów URL nie zawiera żadnych zakazanych URL.<br/><br /><u>Uwaga</u> :<br />Ta opcja wymaga więcej pracy w pliku źródłowym, zaleca się korzystać z buforowania aktywnego.',
	// summarize method
	'GYM_METHOD_CHARS' => 'Według znaków',
	'GYM_METHOD_WORDS' => 'Według słów',
	'GYM_METHOD_LINES' => 'Według lini',
	
	// script location checking
	'GYM_WRONG_PHPBB_URL' => 'Ustawienia serwera phpBB nie są poprawne. Musisz poprawnie skonfigurować <a href="%1$s"><b>ustawienia adresów URL serwera</b></a>.<br/><a href="http://www.phpbb-seo.com/en/phpbb-forum/server-and-cookie-settings-t4451.html" onclick ="window.open(this.href); return false;">Więcej informacji na ten temat</a>',
	'GYM_WRONG_SCRIPT_URL' => 'Skonfigurowany adres URL dla trybu <b>%1$s</b> nie jest poprawny. Musi prowadzić do pliku <b>%2$s</b> który znajduje się na Twoim serwrze.', 
	'GYM_WRONG_SCRIPT_DOMAIN' => 'Skonfigurowany adres URL dla trybu <b>%1$s</b> nie jest zgodny z adresem phpBB. Adres URL musi być taki sam (http:// lub https://) do instalacji phpBB. Zdarza się to jedynie wtedy kiedy $phpbb_root_path została zmieniona manualnie i / lub plik został przeniesiony.<br/>Uwaga, $phpbb_root_path musi być relatywna do ścieżki z katalogu gdzie <b>%3$s</b> jest katalogiem gdzie phpBB jest zainstalowane, i musi się zaczynać od "./".<br/>Zgodnie z ustawieniami, $phpbb_root_path powinna być ustawiona <b>%4$s</b> w <b>%3$s</b>.',
	'GYM_WRONG_SITEMAP_LOCATION' => 'Plik <b>sitemap.php</b> jest zlokalizowany w miejscu gdzie nie może zostać użyty do utworzenia listy adresów forum.<br/>Musis znajdować się <b>w lub nad</b> katalogiem phpBB aby działać.<br/>Skonfigurowana lokalizacja : <b>%1$s</b><br/>Lokalizacja phpBB : <b>%2$s</b>',
	'GYM_GO_CONFIG_SCRIPT_URL' => 'Przejdź do naprawy konfiguracji : <a href="%2$s"><b>%1$s</b></a>',
));
?>