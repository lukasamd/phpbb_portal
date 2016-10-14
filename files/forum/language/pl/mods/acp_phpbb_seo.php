<?php
/** 
*
* phpbb_seo [Polish]
*
* @package Ultimate SEO URL phpBB SEO
* @version $Id: acp_phpbb_seo.php 249 2010-03-11 05:08:04Z Typo $
* @copyright (c) 2006 - 2009 www.phpbb-seo.com
* @license http://www.opensource.org/licenses/rpl1.5.txt Reciprocal Public License 1.5
*
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
	// ACP Main CAT
	'ACP_CAT_PHPBB_SEO'	=> 'phpBB SEO',
	'ACP_MOD_REWRITE'	=> 'Ustawienia nadpisywania URL',
	// ACP phpBB seo class
	'ACP_PHPBB_SEO_CLASS'	=> 'Ustawienia phpBB SEO',
	'ACP_PHPBB_SEO_CLASS_EXPLAIN'	=> 'Tutaj możesz ustawić różne opcje phpBB SEO %1$s mod (%2$s).<br/>Domyślne ustawienia takie jak separatory i przyrostki muszą być ustawiane w <b>phpbb_seo/includes/setup_phpbb_seo.php</b>, jeżeli zmienisz te wartości musisz aktualizować .htaccess',
	'ACP_PHPBB_SEO_VERSION' => 'Wersja',
	'ACP_PHPBB_SEO_MODE' => 'Tryb',
	'ACP_SEO_SUPPORT_FORUM' => 'Support Forum',
	// ACP forum urls
	'ACP_FORUM_URL'	=> 'Zarządzanie adresami forum',
	'ACP_FORUM_URL_EXPLAIN'		=> 'Tutaj możesz zobaczyć jakie adresy zawiera plik cache, tytuły tematów do wstawienia w ich adresy URL.<br/>Temat w kolorze zielonym znajduje sie w cache, w kolorze czerwonym nie.<br/><br/><b style="color:red">Uwaga</b><ul><b>jakis-tytul-fxx/</b> będzie zawsze dobrze przekierowywany z Zero Duplicate ale nie będzie problemu jeżeli zmienisz <b>jakis-tytul/</b> na <b>cos-innego/</b>.<br/> W takich przypadkach, <b>jakis-tytul/</b> będzie traktowany jako temat który nie istnieje jeżeli nie ustawisz odpowiedniego przekierowania.</ul>',
	'ACP_NO_FORUM_URL'	=> '<b>Zarządzanie Forum URL wyłączone<b><br/> Zarządzanie Forum URL jest dostępne tylko w trybie Zaawansowanym i Mixed i kiedy Forum URL caching jest aktywowany.<br/>Forum URLs są już skonfigurowane pozostaną aktywne w trybie Zaawansowanym i Mixed.',
	// ACP .htaccess
	'ACP_HTACCESS'	=> '.htaccess',
	'ACP_HTACCESS_EXPLAIN'	=> 'To narzędzie pomoże Ci zbudować Twój .htacess.<br/>Wersja zaproponowana poniżej opiera się na Twoich ustawieniach phpbb_seo/phpbb_seo_class.php.<br/>Możesz zmienić wartości $seo_ext i $seo_static zanim zainstalujesz .htaccess aby otrzymać zpersonalizowane adresy URLs.<br/>Dla przykładu możesz wybrać .htm zamiast .html, \'wiadomosc\' zamiast \'post\' \'ekipa\' zamiast \'the-team\' itd.<br/>Jeśli zmienisz te wartości w chwili kiedy już zostały zindeksowane, musisz zmienić przekierowania.<br/>Domyślne ustawienia nie są złe mimo wszystko, możesz pominąć ten krok jeżeli tak uważasz.<br/>Teraz jest najlepszy czas aby to zrobić, później będzie wymagało utworzenia dodatkowych przekierowań.<br/>Domyślnie .htaccess powinien znaleźć sie w katalogu głównym domeny (np gdzie www.przyklad.pl jest odsyłany).<br/>Jeśli phpBB jest zainstalowane w podkatalogu, wybranie więcej opcji poniżej doda opcję zapisu w folderze w którym jest zainstalowane phpBB.',
	'SEO_HTACCESS_RBASE'	=> 'lokalizacja .htaccess',
	'SEO_HTACCESS_RBASE_EXPLAIN' => 'Umieścić .htaccess w folderze phpBB ?<br/>Ustawienia RewriteBase pozwolą na umieszczenie .htaccess w folderze gdzie zainstalowany jest phpBB. Jest to zwłaszcza bardzo wygodne aby zapisać .htaccess w folderze domeny nawet jeśli phpBB jest zainstalowane w podfolderze, ale może umieścić plik w folderze phpBB.',
	'SEO_HTACCESS_SLASH'	=> 'RegEx Prawy Ukośnik',
	'SEO_HTACCESS_SLASH_EXPLAIN'	=> 'W zależności od hostingu jaki używasz, możesz pozbyć się lub dodać ukośnik ("/") na początku prawej części każdego rewriterules. Ten ukośnik jest używany domyślnie kiedy .htaccess jest umieszczony w folderze domeny. Jest to przeciwieństwo kiedy phpBB jest zainstalowane w podfolderze a Ty chcesz używać .htaccess w tym samym folderze.<br/>Ustawienia domyślne powinny generalnie działać, ale jeśli nie działają, spróbuj wygenerować .htaccess poprzez nacisnięcie przycisku "Re-generate".',
	'SEO_HTACCESS_WSLASH'	=> 'RegEx Lewy Ukośnik',
	'SEO_HTACCESS_WSLASH_EXPLAIN'	=> 'W zależności od hostingu jaki używasz, możesz dodać ukośnik ("\") na początku lewej części każdego rewriterules. Ten ukośnik ("\") domyślnie nie jest nigdy używany.<br/>Ustawienia domyślne powinny generalnie działać, ale jeśli nie działają, spróbuj wygenerować .htaccess poprzez nacisnięcie przycisku "Re-generate".',
	'SEO_MORE_OPTION'	=> 'Więcej Opcji',
	'SEO_MORE_OPTION_EXPLAIN' => 'Jeśli pierwszy sugerowany .htaccess nie działa.<br/>Upewnij się że mod_rewrite jest aktywowany na serwerze.<br/>Wtedy, upewnij się czy znajduje się we właściwym folderze.<br/>Jeśli to nie wystarczy, użyj "Więcej Opcji".',
	'SEO_HTACCESS_SAVE' => 'Zapisz .htaccess',
	'SEO_HTACCESS_SAVE_EXPLAIN' => 'Jeśli zaznaczone, plik .htaccess będzie wygenerowany podczas wysyłania w folderze phpbb_seo/cache/. Jest gotowy do użycia z Twoimi ustawieniami, ale musisz go przenieść we właściwe miejsce.',
	'SEO_HTACCESS_ROOT_MSG'	=> 'Kiedy będziesz gotów, możesz zaznaczyć kod .htaccess, i wkleić go do pliku .htaccess lub użyć opcji "Zapisz .htaccess".<br/> Ten .htaccess powinien być umieszczony w folderze domeny, który w Twoim wypadku jest tam gdzie prowadzi <u>%1$s</u>.<br/><br/>Możesz wygenerować .htaccess aby użyć w ewentualnym podfolderze używając "Więcej Opcji".',
	'SEO_HTACCESS_FOLDER_MSG' => 'Kiedy będziesz gotów, możesz zaznaczyć kod .htaccess, i wkleić go do pliku .htaccess lub użyć opcji "Zapisz .htaccess".<br/> Ten .htaccess powinien być umieszczony w folderze domeny, który w Twoim wypadku jest tam gdzie prowadzi <u>%1$s</u>.',
	'SEO_HTACCESS_CAPTION' => 'Legenda',
	'SEO_HTACCESS_CAPTION_COMMENT' => 'Komentarze',
	'SEO_HTACCESS_CAPTION_STATIC' => 'Statyczne części, edytowane w phpbb_seo_class.php',
	'SEO_HTACCESS_CAPTION_DELIM' => 'Separatory, edytowane w phpbb_seo_class.php',
	'SEO_HTACCESS_CAPTION_SUFFIX' => 'Przyrostki, edytowane w phpbb_seo_class.php',
	'SEO_HTACCESS_CAPTION_SLASH' => 'Opcjonalne ukośniki',
	'SEO_SLASH_DEFAULT'	=> 'Domyślnie',
	'SEO_SLASH_ALT'		=> 'Zastąpiono',
	'SEO_MOD_TYPE_ER'	=> 'Typ nadpisywania nie jest ustawiony poprawnie w phpbb_seo/phpbb_seo_class.php.', 
	'SEO_SHOW'		=> 'Pokaż',
	'SEO_HIDE'		=> 'Ukryj',
	'SEO_SELECT_ALL'	=> 'Zaznacz wszystko',
	// ACP extended
	'ACP_SEO_EXTENDED_EXPLAIN' => 'Rozszerzone ustawienia modów phpBB SEO.',
	'SEO_EXTERNAL_LINKS' => 'Zewnętrzne linki',
	'SEO_EXTERNAL_LINKS_EXPLAIN' => 'Otwórz lub nie, zewnętrzne linki w nowym oknie przeglądarki',
	'SEO_EXTERNAL_SUBDOMAIN' => 'Sub-domain linki',
	'SEO_EXTERNAL_SUBDOMAIN_EXPLAIN' => 'Otwórz lub nie, sub-domeny (domeny twojego forum) linki w nowym oknie przeglądarki',
	'SEO_EXTERNAL_CLASSES' => 'Zewnętrzne opisane klasami css',
	'SEO_EXTERNAL_CLASSES_EXPLAIN' => 'tutaj możesz zdefiniować klasy css które będą aktywowały otwieranie linków w nowych oknach przeglądarki. Nazwy klas oddzielaj przecinkiem, przykład: postlink,external',
	// Titles
	'SEO_PAGE_TITLES' => '<a href="http://www.phpbb-seo.com/en/phpbb-seo-toolkit/optimal-titles-t1289.html" title="Optimal Titles mod" onclick="window.open(this.href); return false;">Tytuły stron</a>',
	'SEO_APPEND_SITENAME' => 'Dodawaj nazwę strony do tytułów stron',
	'SEO_APPEND_SITENAME_EXPLAIN' => 'Dodawaj lub nie, nazwę strony do tytułów stron.<br/><b style="color:red;">Uwaga :</b><br/>Ta opcja wymaga poprawnych edycji w overall_header.html dla Optimal titles mod, w przeciwnym wypadku nazwa strony może się powtarzać w tytułach stron',
	// Meta
	'SEO_META' => '<a href="http://www.phpbb-seo.com/en/phpbb-seo-toolkit/seo-dynamic-meta-tags-t1308.html" title="Dynamic Meta tags mod" onclick="window.open(this.href); return false;">Meta tags</a>',
	'SEO_META_TITLE' => 'Tytuł Meta',
	'SEO_META_TITLE_EXPLAIN' => 'Domyślny tytuł Meta, używany na stronie ale nie definiuje tytułu strony. Deaktywuje tytuł meta jeśli tag jest pusty',
	'SEO_META_DESC' => 'Opis Meta',
	'SEO_META_DESC_EXPLAIN' => 'Domyślny opis Meta, używany na stronie ale nie definiuje tytułu strony',
	'SEO_META_DESC_LIMIT' => 'Limit opisu Meta',
	'SEO_META_DESC_LIMIT_EXPLAIN' => 'Limit słów opisu tagu Meta',
	'SEO_META_BBCODE_FILTER' => 'Bbcodes Filter',
	'SEO_META_BBCODE_FILTER_EXPLAIN' => 'Lista BBCodów oddzielona przecinkami która będzie filtrowana w meta tagach. Inne będą deaktywowane i ich zawartość może znaleźć się w tagach meta.<br/> Domyślnie filtrowane bbcodey : <b>img,url,flash,code</b>.<br/><b style="color:red;">Uwaga :</b><br/>Brak filtrowania bbcodów  img, url i flash nie jest dobrym pomysłem, również code w większości przypadków. Ogólnie mówiąc, zatrzymaj tylko te  bbcodey których zawartość może być wartościowa dla meta tagów',
	'SEO_META_KEYWORDS' => 'Słowa kluczowe Meta',
	'SEO_META_KEYWORDS_EXPLAIN' => 'Domyślne słowa kluczowe Meta, używany na stronie ale nie definiuje słów kluczowych meta. Wpisz listę słów kluczowych',
	'SEO_META_KEYWORDS_LIMIT' => 'Limit słów kluczowych Meta',
	'SEO_META_KEYWORDS_LIMIT_EXPLAIN' => 'Limit słów dla słów kluczowych Meta tag',
	'SEO_META_MIN_LEN' => 'Filter krótkich słów',
	'SEO_META_MIN_LEN_EXPLAIN' => 'Minimalna ilość znaków w słowie które będzie uwzględnione w słowach kluczowych Meta tag, będą uwzględniane tylko słowa posiadające więcej znaków niż ustawiony limit',
	'SEO_META_CHECK_IGNORE' => 'Ignoruj filtr słów',
	'SEO_META_CHECK_IGNORE_EXPLAIN' => 'Zastosuj lub nie, wyjątek search_ignore_words.php w słowach kluczowych meta tag',
	'SEO_META_LANG' => 'Język Meta',
	'SEO_META_LANG_EXPLAIN' => 'Język kodu używany w meta tagach',
	'SEO_META_COPY' => 'Prawa kopiowania Meta',
	'SEO_META_COPY_EXPLAIN' => 'Prawa kopiowania używane w meta tagach. Deaktywuje prawa kopiowania meta tag jeśli puste',
	'SEO_META_FILE_FILTER' => 'Plik filtru',
	'SEO_META_FILE_FILTER_EXPLAIN' => 'Lista fizycznych plików php oddzielonych przecinkiem które nie powinny być indeksowane (robots:noindex,follow). Przykład : ucp,mcp',
	'SEO_META_GET_FILTER' => '_GET filter',
	'SEO_META_GET_FILTER_EXPLAIN' => 'Lista zmiennych _GET oddzielona przecinkiem które nie powinny być indeksowane (robots:noindex,follow). Przykład : style,hilit,sid',
	'SEO_META_ROBOTS' => 'Meta Robots',
	'SEO_META_ROBOTS_EXPLAIN' => 'Meta Robots tag informuje boty jak indeksować Twoje strony. Domyślnie ustawione jest "index,follow", które pozwala botom na indeksowanie i buforowanie Twoich stron i przechodzenie do linków umieszczonych na nich. Deaktywuje meta Robots tag jeśli puste.<br/><b style="color:red;">Uwaga :</b><br/>Ten tag jest sensowny, w przypadku wykorzystania "noindex", żadna z Twoich stron nie będzie indeksowana',
	'SEO_META_NOARCHIVE' => 'Niearchiwalne Meta Roboty',
	'SEO_META_NOARCHIVE_EXPLAIN' => 'Niearchiwalne tagi Meta Roboty informują boty czy mogą buforować strony. Jeśli rozważamy tylko buforowanie, nie ma to związku z indeksowaniem i SERPs strony.<br/>Tutaj możesz wybrać listę forów które będą posiadały dodaną opcję "Niearchiwalne" do ich meta robots.<br/>Funkcja może być poręczna na przykład jeśli posiadasz fora otwarte dla botów ale zamknięte gości. Dodając opcję "Niearchiwalne" będzie chroniło gości przed dostępem do zawartości poprzez buforowany silnik wyszukiwania, podczas gdy forum i jego tematy będą ciągle widoczne w SERPs',
	// Install
	'SEO_INSTALL_PANEL'	=> 'phpBB SEO Panel Instalacji',
	'SEO_ERROR_INSTALL'	=> 'Wystąpił błąd podczas instalacji. Deinstalacja jest bezpiecznym wyjściem przed ponowną próbą instalacji.',
	'SEO_ERROR_INSTALLED'	=> '%s moduł jest już zainstalowany.',
	'SEO_ERROR_ID'	=> '%1$ moduł nie miał ID.',
	'SEO_ERROR_UNINSTALLED'	=> '%s  moduł jest odinstalowany.',
	'SEO_ERROR_INFO'	=> 'Informacja :',
	'SEO_FINAL_INSTALL_PHPBB_SEO'	=> 'Zaloguj do ACP',
	'SEO_FINAL_UNINSTALL_PHPBB_SEO'	=> 'Wróć do strony głównej',
	'CAT_INSTALL_PHPBB_SEO'	=> 'Instalacja',
	'CAT_UNINSTALL_PHPBB_SEO'	=> 'Deinstalacja',
	'SEO_OVERVIEW_TITLE'	=> 'Przegląd phpBB SEO Mod rewrite',
	'SEO_OVERVIEW_BODY'	=> 'Witamy w naszym publicznym wydaniu %1$s phpBB3 SEO mod rewrite %2$s.</p><p>Przeczytaj <a href="%3$s" title="Sprawdź temat wydania" target="_phpBBSEO"><b>temat wydania</b></a> aby uzyskać więcej informacji</p><p><strong style="text-transform: uppercase;">Uwaga:</strong> Musisz już mieć wymagane zmiany w plikach umieszczonych na serwerze przed uruchomieniem kreatora instalacji.</p><p>System instalacji przeprowadzi Cię przez proces instalacji phpBB3 SEO mod rewrite ACP. Pozwoli Ci wybrać reguły nadpisywania adresów URL</p>.',
	'CAT_SEO_PREMOD'	=> 'phpBB SEO Premod',
	'SEO_PREMOD_TITLE'	=> 'Przegląd phpBB SEO Premod',
	'SEO_PREMOD_BODY'	=> 'Witamy w naszym publicznym wydaniu phpBB SEO Premod.</p><p>Przeczytaj <a href="http://www.phpbb-seo.com/boards/phpbb-seo-premod/seo-url-premod-vt1549.html" title="Sprawdź temat wydania" target="_phpBBSEO"><b>temat wydania</b></a> aby uzyskać więcej informacji</p><p><strong style="text-transform: uppercase;">Uwaga:</strong> Musisz wybrać pomiędzy trzema trybami nadpisywania phpBB3 SEO.<br/><br/><b>Dostępne są trzy różne standarty nadpisywania adresów URL :</b><ul><li><a href="http://www.phpbb-seo.com/boards/simple-seo-url/simple-phpbb3-seo-url-vt1566.html" title="Więcej szczegółów o Simple mod"><b>The Simple mod</b></a>,</li><li><a href="http://www.phpbb-seo.com/boards/mixed-seo-url/mixed-phpbb3-seo-url-vt1565.html" title="Więcej szczegółów o Mixed mod"><b>The Mixed mod</b></a>,</li><li><a href="http://www.phpbb-seo.com/boards/advanced-seo-url/advanced-phpbb3-seo-url-vt1219.html" title="Więcej szczegółów o Advanced mod"><b>Advanced</b></a>.</li></ul>Ten wybór jest bardzo ważny, my zachęcamy do znalezienia trochę czasu aby w pełni odkryć zalety SEO premod przed przejściem do online.<br/>Ten premod jest prosty w instalacji jak phpBB3.<br/><br/>
	<p>Wymagania dla nadpisywania adresów URL :</p>
	<ul>
		<li>Apache server (linux OS) z mod_rewrite module.</li>
		<li>IIS server (windows OS) z isapi_rewrite module, będziesz musiał przystosować rewriterules w httpd.ini</li>
	</ul>
	<p>Po instalacji, będziesz musiał zalogować się do ACP ustawić i aktywować moda.</p>',
	'SEO_LICENCE_TITLE'	=> 'OBUSTRONNA LICENJA PUBLICZNA',
	'SEO_LICENCE_BODY'	=> 'phpBB SEO mod rewrites jest udostępniany zgodnie z licencją RPL która mówi że nie możesz usunąć napisów phpBB SEO.<br/>Po więcej szczegółów o możliwości usunięcia skontakuj się z administratorem phpBB SEO ( SeO lub dcz).',
	'SEO_PREMOD_LICENCE'	=> 'phpBB SEO mod rewrites i Zero Duplicate załączone w tym Premod są wydane zgodnie z licencją RPL która mówi że nie możesz usunąć napisów phpBB SEO.<br/>Po więcej szczegółów o możliwości usunięcia skontakuj się z administratorem phpBB SEO (SeO lub dcz).',
	'SEO_SUPPORT_TITLE'	=> 'Wsparcie',
	'SEO_SUPPORT_BODY'	=> 'Pełne wsparcie na <a href="%1$s" title="Visit the %2$s SEO URL forum" target="_phpBBSEO"><b>%2$s SEO URL forum</b></a>. Odpowiemy na pytania o Instalacji, problemach konfiguracji, i wsparcie w kwestii najczęstszych problemów.</p><p>Odwiedź nas <a href="http://www.phpbb-seo.com/boards/" title="SEO Forum" target="_phpBBSEO"><b>Search Engine Optimization forums</b></a>.</p><p><a href="http://www.phpbb-seo.com/boards/profile.php?mode=register" title="Register to phpBB SEO" target="_phpBBSEO"><b>Zarejestruj się</b></a>, zaloguj i <a href="%3$s" title="Bądź powiadamiany o aktualizacjach" target="_phpBBSEO"><b> subskrybuj temat wydania</b></a> aby być powiadamianym przez email o każdej aktualizacji.',
	'SEO_PREMOD_SUPPORT_BODY'	=> 'Pełne wsparcie na <a href="http://www.phpbb-seo.com/boards/phpbb-seo-premod-vf61/" title="Visit the phpBB SEO Premod forum" target="_phpBBSEO"><b>phpBB SEO Premod forum</b></a>. Odpowiemy na pytania o Instalacji, problemach konfiguracji, i wsparcie w kwestii najczęstszych problemów.</p><p>Odwiedź nas <a href="http://www.phpbb-seo.com/boards/" title="SEO Forum" target="_phpBBSEO"><b>Search Engine Optimization forums</b></a>.</p><p><a href="http://www.phpbb-seo.com/boards/profile.php?mode=register" title="Register to phpBB SEO" target="_phpBBSEO"><b>Zarejestruj się</b></a>, zaloguj i <a href="http://www.phpbb-seo.com/boards/viewtopic.php?t=1549&watch=topic" title="Bądź powiadamiany o aktualizacjach" target="_phpBBSEO"><b>subskrybuj temat wydania</b></a> aby być powiadamianym przez email o każdej aktualizacji.',
	'SEO_INSTALL_INTRO'		=> 'Witaj w kreatorze instalacji phpBB SEO',
	'SEO_INSTALL_INTRO_BODY'	=> '<p>Jesteś przed instalacją %1$s phpBB SEO mod rewrite %2$s. Narzędzia instalatora phpBB SEO mod rewrite aktywują panel kontrolny w phpBB ACP.</p><p>Po instalacji, będziesz musiał zalogować się do ACP aby ustawić i aktywować moda.</p>
	<p><strong>Uwaga:</strong> Jeśli pierwszy raz instalujesz tego moda, zachęcamy do znalezienia trochę czasu aby przetestować różne standarty adresów url jakie ten mod potrafi wygenerować na lokalnym lub prywatnym. Możesz odkryć po miesiącu że chcesz inne adresy URL.</p><br/>
	<p>Wymagania :</p>
	<ul>
		<li>Apache server (linux OS) z modułem mod_rewrite.</li>
		<li>IIS server (windows OS) z modułem isapi_rewrite, ale będziesz musiał przystosować rewriterules w httpd.ini</li>
	</ul>',
	'SEO_INSTALL'		=> 'Instaluj',
	'UN_SEO_INSTALL_INTRO'		=> 'Witaj w kreatorze deinstalacji phpBB SEO',
	'UN_SEO_INSTALL_INTRO_BODY'	=> '<p>Jesteś przed deinstalacją %1$s phpBB SEO mod rewrite %2$s ACP module.</p>
	<p><strong>Uwaga:</strong> To nie dezaktywuje nadpisywania adresów URL z Twojego forum tak długo aż nie usuniesz kodu z edytowanych plików.</p>',
	'UN_SEO_INSTALL'		=> 'Odinstaluj',
	'SEO_INSTALL_CONGRATS'			=> 'Gratulacje!',
	'SEO_INSTALL_CONGRATS_EXPLAIN'	=> '<p>Pomyślnie zainstalowałeś %1$s phpBB3 SEO mod rewrite %2$s. Powinieneś zalogować się do phpBB ACP i ustawić odpowiednie opcje nadpisywania adresów URL.<p>
	<p>W nowej kategorii phpBB SEO, będziesz mógł :</p>
	<h2>Ustawić i aktywować nadpisywanie adresów URL</h2>
		<p>Nie śpiesz się, tutaj możesz ustawić adresy URL tak jak chcesz aby wyglądały. Opcja zero duplicate też może być ustawiona tutaj jeśli jest zainstalowana.</p>
	<h2>Prawidłowo wybierz adresy URL</h2>
		<p>Używając Mixed lub Advanced mod, będziesz mógł dysocjować adresy URL forum z ich tytułów i wybrać jakie kolwiek słowa które będą prowadziły do forum</p>
	<h2>Wygeneruj .htaccess</h2>
	<p>Kiedy ustawisz powyższe opcje, będziesz mógł wygenerować .htaccess natychmiast i zapisać go na serwerze.</p>',
	'UN_SEO_INSTALL_CONGRATS'	=> 'Moduł phpBB SEO ACP został usunięty.',
	'UN_SEO_INSTALL_CONGRATS_EXPLAIN'	=> '<p>Pomyślnie odinstalowałeś %1$s phpBB3 SEO mod rewrite %2$s.<p>
	<p>To nie dezaktywuje nadpisywania adresów URL z Twojego forum tak długo aż nie usuniesz kodu z edytowanych plików.</p>',
	'SEO_VALIDATE_INFO'	=> 'Informacja o weryfikacji :',
	'SEO_SQL_ERROR' => 'Błąd SQL',
	'SEO_SQL_TRY_MANUALLY' => 'Użytkownik bazy danych nie posiada wymaganych uprawnień aby wykonać zapytanie SQL, wykonaj je ręcznie (phpMyadmin) :',
	// Security
	'SEO_LOGIN'		=> 'Musisz być zarejestrowany i zalogowany aby zobaczyć tą stronę.',
	'SEO_LOGIN_ADMIN'	=> 'Musisz być zalogowany jako Administrator aby zobaczyć tą stronę.<br/>Twoja sesja została zniszczona z powodu bezpieczeństwa.',
	'SEO_LOGIN_FOUNDER'	=> 'Musisz być zalogowany jako założyciel aby zobaczyć tą stronę.',
	'SEO_LOGIN_SESSION'	=> 'Sprawdzenie sesji nie powiodło się.<br/>Ustawienie nie zostały ustawione.<br/>Twoja sesja została zniszczona z powodu bezpieczeństwa.',
	// Cache status
	'SEO_CACHE_FILE_TITLE'	=> 'Status plików Cache',
	'SEO_CACHE_STATUS'	=> 'Folder cache znajduje się w : <b>%s</b>',
	'SEO_CACHE_FOUND'	=> 'Folder cache został pomyślnie znaleziony.',
	'SEO_CACHE_NOT_FOUND'	=> 'Folder cache nie został znaleziony.',
	'SEO_CACHE_WRITABLE'	=> 'Folder cache jest zapisywalny.',
	'SEO_CACHE_UNWRITABLE'	=> 'Folder cache nie jest zapisywalny. Musisz ustawić prawa pliku CHMOD na 0777.',
	'SEO_CACHE_INNER_UNWRITABLE' => 'Some files within the cache directory may not be writable, make sure you properly CHMOD the cache directory AND all files in it.',
	'SEO_CACHE_FORUM_NAME'	=> 'Nazwa Forum',
	'SEO_CACHE_URL_OK'	=> 'Buforowany URL',
	'SEO_CACHE_URL_NOT_OK'	=> 'Te adresy URL nie znajdują się w cache',
	'SEO_CACHE_URL'		=> 'Końcowy URL',
	'SEO_CACHE_MSG_OK'	=> 'Plik cache  został aktualizowany z powodzeniem.',
	'SEO_CACHE_MSG_FAIL'	=> 'Wystąpił błąd podczas aktualizacji pliku cache.',
	'SEO_CACHE_UPDATE_FAIL'	=> 'Adres URL który wpisałeś nie może być użyty, cache pozostał niezmieniony.',
	// Seo advices
	'SEO_ADVICE_DUPE'	=> 'Wykryto podwójny wpis w adresie URL : <b>%1$s</b>.<br/>Pozostanie niezmieniony do czasu aktualizacji.',
	'SEO_ADVICE_RESERVED'	=> 'Wykryto zarezerwowany wpis w tytule adresu URL forum (używany przez inny adres URL, takich jak profil użytkownika) : <b>%1$s</b>.<br/>Pozostanie niezmieniony do czasu aktualizacji.',
	'SEO_ADVICE_LENGTH'	=> 'Adres URL w cache  jest trochę za długi.<br/>Rozważ użycie krótszych',
	'SEO_ADVICE_DELIM'	=> 'Adres URL w cache zawiera SEO separator i ID.<br/>Rozważ ustawienie orginalnego.',
	'SEO_ADVICE_WORDS'	=> 'Adres URL w cache zawiera zbyt wiele słów.<br/>Rozważ ustawienie mniej słów.',
	'SEO_ADVICE_DEFAULT'	=> 'Końcowy adres URL, po formatowaniu, jest domyślny.<br/>Rozważ ustawienie orginalnego.',
	'SEO_ADVICE_START'	=> 'Adres URL nie mogą się kończyć z parametrem numeracji, dzielenia.<br/>Zostały usunięte z wysłanych adresów.',
	'SEO_ADVICE_DELIM_REM'	=> 'Wysłane adresy URL nie mogą kończyć się separatorami.<br/>Zostały usunięte z wysłanych adresów.',
	// Mod Rewrite type
	'ACP_SEO_SIMPLE'	=> 'Simple',
	'ACP_SEO_MIXED'		=> 'Mixed',
	'ACP_SEO_ADVANCED'	=> 'Advanced',
	'ACP_ULTIMATE_SEO_URL'	=> 'Ultimate SEO URL',
	// URL Sync
	'SYNC_REQ_SQL_REW' => 'Musisz aktywować nadpisywanie SQL aby użyć tego skryptu !',
	'SYNC_TITLE' => 'Synchronizacja URL',
	'SYNC_WARN' => 'Uwaga, nie zatrzymuj skryptu do zakończenia jego działania, zrób kopię zapasową bazy danych przed użyciem skryptu!',
	'SYNC_COMPLETE' => 'Synchronizacja zakończona !',
	'SYNC_RESET_COMPLETE' => 'Reset zakończony !',
	'SYNC_PROCESSING' => '<b>Przetwarzanie, proszę czekać ...</b><br/><br/><b>%1$s%%</b> zostały przetworzone. <br/>Do tej pory, <b>%2$s</b> pozycji zostało przetworzonych.<br/><b>%3$s</b> wszystkich pozycji, <b>%4$s</b> są przetwarzane w czasie.<br/>Szybkość : <b>%5$s pozycji.</b><br/>Czas spędzony w tym cyklu : <b>%6$ss</b><br/>Szacowany pozostały czas : <b>%7$s minut(a)</b>',
	'SYNC_ITEM_UPDATED' => '<b>%1$s</b> pozycji zostało aktualizowanych',
	'SYNC_TOPIC_URLS' => 'Synchronizacja adresów tematów/wątków',
	'SYNC_RESET_TOPIC_URLS' => 'Resetuj wszystkie adresy tematów/wątków',
	'SYNC_TOPIC_URL_NOTE' => 'Aktywowałeś opcję nadpisywania SQL, powinieneś zsynchronizować wszystkie adresy tematów/wątków poprzez przejście %sdo tej strony%s jeśli jeszcze nie byłeś.<br/>Nie spowoduje to jakichkolwiek zmian w aktualnych adresach<br/><b style="color:red">Uwaga :</b><br/><em>Powinieneś zsynchronizować adresy tematów/wątków po ustawieniu twoich standardów dla adresów URL. Nie będzie dramatu, jeśli zmienia się standarty url po synchronizacji adresów tematów/wątków, ale należy to zrobić ponownie za każdym razem.<br/>Nie będzie dramatu jeśli nie zrobisz, twoje adresy tematów/wątków w takich przypadkach będą aktualizowane podczas każdej wizyty tematu/wątku,  w przypadku tematu będzie pusty lub nie pasujący do aktualnego standardu.</em>',
	// phpBB SEO Class option
	'url_rewrite' => 'Aktywuj nadpisywanie URL',
	'url_rewrite_explain' => 'Kiedy ustawisz opcje poniżej, i wygenerujesz własny .htaccess, możesz aktywować nadpisywanie adresów URL i sprawdzić czy nadpisywanie działa prawidłowo. Jeśli pojawi się błąd 404 prawdopodobnie problem leży w .htaccess, spróbuj narzędzi .htaccess aby wygenerować nowy.',
	'modrtype' => 'Typy nadpisywania adresów URL',
	'modrtype_explain' => 'phpBB SEO premod jest kompatybilny z trzema rodzajami phpBB SEO mod rewrite.<br/><a href="http://www.phpbb-seo.com/boards/simple-seo-url/simple-phpbb3-seo-url-vt1566.html" title="Więcej informacji o Simple mod"><b>Simple</b></a> <a href="http://www.phpbb-seo.com/boards/mixed-seo-url/mixed-phpbb3-seo-url-vt1565.html" title="Więcej informacji o Mixed mod"><b>Mixed</b></a> i <a href="http://www.phpbb-seo.com/boards/advanced-seo-url/advanced-phpbb3-seo-url-vt1219.html" title="Więcej informacji o Advanced mod"><b>Advanced</b></a>.<br/><b style="color:red">Uwaga</b><br/><ul style="margin-left:20px">Modyfikacja opcji zmieni wszystkie adresy URL  na twojej stronie.<br/>Robienie tego z już zindeksowanymi stronami powinno być rozważone ze szczególną ostrożnością i nie za często.<br/></ul>',
	'sql_rewrite' => 'Aktywuj nadpisywanie SQL',
	'sql_rewrite_explain' => 'Ta opcja pozwala na wybranie adresów url dla każdego tematu. Będziesz mógł dokładnie ustawić url tematu przy zakładaniu nowego tematu lub podczas edycji istniejącego. Funkcja ta jest jednak ograniczona do adminów i moderatorów forum.<br/><br/><b style="color:red">Uwaga :</b><br/><em>Włączenie tej opcji nie zmieni adresów tematów.  Dotychczasowe adresy będą przechowywane w bazie danych. Ale nie powinieneś wyłaczać jeżeli już korzystasz z tej opcji. W takich przypadkach, zpersonalizowane adresy będą traktowane jak by nie istniały.<br/>Funkcja ta ma także ogromną zaletę zapinania nadpisywanych adresów, szczególnie przy korzystaniu z opcji wirtualnego folderu w trybie advanced, i zmienia je na dużo łatwiejsze adresy do pobrania z każdej strony.</em>',
	'profile_inj' => 'Wstawianie Profili i grup',
	'profile_inj_explain' => 'Tutaj możesz wybrać wstawianie nazwy użytkowników, nazwy grup i stronę wiadomości użytkownika (patrz niżej) do ich adresów URL zamiast domyślnego nadpisywania statycznego, <b>phpBB/uzytkownik-uxx.html</b> zamiast <b>phpBB/uzytkownikxx.html</b>.<br/><b style="color:red">Uwaga</b><br/><ul style="margin-left:20px">Zmiana tej opcji wymaga aktualizacji .htaccess</ul>',
	'profile_vfolder' => 'Wirtualny folder Profili',
	'profile_vfolder_explain' => 'Tutaj możesz wybrać symulację struktury folderu dla profili i strony wiadomości użytkowników (patrz niżej), <b>phpBB/uzytkownik-uxx/(tematy/)</b> lub <b>phpBB/uzytkownikxx/(tematy/)</b> zamiast <b>phpBB/uzytkownik-uxx(-tematy).html</b> i <b>phpBB/uzytkownikxx(-tematy).html</b>.<br/><b style="color:red">Uwaga</b><br/><ul style="margin-left:20px">Opcja Usuwanie ID Profilu nadpisze to ustawienie.<br/>Zmiana tej opcji wymaga aktualizacji .htaccess</ul>',
	'profile_noids' => 'Usuwanie ID profilu',
	'profile_noids_explain' => 'Kiedy opcja Wstawianie Profili i grup jest aktywna, możesz tutaj wybrać aby użyć <b>przyklad.pl/phpBB/uzytkownik/nazwauzytkownika</b> zamiast domyślnej <b>przyklad.pl/phpBB/nazwauzytkownika-uxx.html</b>. phpBB używa ekstra, ale lekkich, zapytań SQL o takich stronach jak ID użytkownika.<br/><b style="color:red">Uwaga</b><br/><ul style="margin-left:20px">Znaki specjalne nie będą obsługiwane również przez przeglądarkę. FF zawsze koduje adresy URL (<a href="http://www.php.net/urlencode">Kodowanie adresów URL()</a>), i wygląda na to że używa w pierwszej kolejności Latin1, kiedy IE i Opera nie. O zaawansowanych opcjach kodowania adresów URL możesz przeczytać w pliku instalacyjnym, przeczytaj zawartość pliku instalacyjnego.<br/>Zmiana tej opcji wymaga aktualizacji .htaccess</ul>',
	'rewrite_usermsg' => 'Najczęściej Szukane i nadpisywanie stron wiadomości Użytkowników',
	'rewrite_usermsg_explain' => 'Ta opcja ma sens jeśli ustawisz uprawnienia dostępu do stron profili i stron wyszukiwania dla wszyskich.<br/> Używanie tej opcji spowoduje większe użycie funkcji Szukaj i co za tym idzie spowoduje większe obciążenie serwera.<br/> Typy nadpisywania adresów URL (z i bez ID) kierują do jednego kompletu dla profili i grup.<br/><b>phpBB/messages/nickname/topics/</b> zamiast <b>phpBB/nickname-uxx-topics.html</b> lub <b>phpBB/memberxx-topics.html</b>.<br/>Dodatkowo ta opcja aktywuje nadpisywanie strony Najczęściej Szukane, takich jak aktywne tematy, posty bez odpowiedzi i nowe posty.<br/><b style="color:red">Uwaga</b><br/><ul style="margin-left:20px">Usuwanie ID  w tych linkach będzie oznaczało takie same limity jak dla profili użytkowników.<br/>Zmiana tej opcji wymaga aktualizacji .htaccess</ul>',
	'rewrite_files' => 'Nadpisywanie załączników',
	'rewrite_files_explain' => 'Aktywuj nadpisywanie załączników phpBB. Może być bardzo pomocne jeśli posiadasz wiele obrazków/zdjęć wartych zindeksowania. Boty muszą mieć uprawnienia do pobierania tych plików aby je zindeksować.<br/><br/><b style="color:red">Uwaga :</b><br/><em>Upewnij się że posiadasz wymagane reguły nadpisywania (# PHPBB pliki wszystkich trybów) w twoim .htaccess kiedy aktywujesz tą opcję.</em>',
	'rem_sid' => 'Usuwanie SID',
	'rem_sid_explain' => 'SID będzie usuwany z 100% adresów URL przechodzących przez plik phpbb_seo class, dla gości i botów.<br/>Boty nie będą widziały SIDów na forum, w adresach URL tematów i postów, ale goście którzy nie akceptują cookies będą tworzyli więcej niż jedną sesję.<br/>Zero duplicate http 301 przekierowuje adresy URL z SID dla gości i botów domyślnie.',
	'rem_hilit' => 'Usuwanie Podświetleń',
	'rem_hilit_explain' => 'Podświetlenia będą usuwane z 100% adresów URL przechodzących przez plik phpbb_seo class, dla gości i botów.<br/>Boty nie będą widziały Podświetleń na forum, w adresach URL tematów i postów.<br/>Zero duplicate będzie automatycznie aktywowane, np http 301 przekieruje adresy url  z podświetleniami dla gości i botów.',
	'rem_small_words' => 'Usuń krótkie słowa',
	'rem_small_words_explain' => 'Pozwala na usuwanie wszystkich słów które mają mniej niż trzy litery w nadpisywanych adresach URL.<br/><b style="color:red">Uwaga</b><br/><ul style="margin-left:20px">Filtrowanie potencjalnie zmieni dużo adresów URL na Twojej stronie.<br/>Nawet jeśli zero duplikate mod przejmie wszystkie wymagane przekierowania przy zmianie tej opcji, użycie tej opcji z już zindeksowanymi stronami powinno być ponownie rozważone.<br/></ul>',
	'virtual_folder' => 'Wirtualny Folder',
	'virtual_folder_explain' => 'Pozwala dodać adresy URL forum jako wirtualny folder w adresach URL tematów.<br/><u>Przykład :</u><ul style="margin-left:20px"><b>forum-tytul-fxx/temat-tytul-txx.html</b> zamiast <b>temat-tytul-txx.html</b><br/>na adres URL tematu.</ul><br/><b style="color:red">Uwaga</b><br/><ul style="margin-left:20px">Opcja wstawiania Wirtualny Folder może zmienić wszystkie adresy Twojego forum.<br/>używanie tej opcji z już zindeksowanymi stronami powinno być ponownie rozważone.<br/></ul>',
	'virtual_root' => 'Wirtualny Root',
	'virtual_root_explain' => 'Jeśli phpBB jest zainstalowane w podfolderze (przykład phpBB3/), możesz symulować folder root dla nadpisanych linków.<br/><u>Przykład :</u><ul style="margin-left:20px"><b>phpBB3/forum-tytul-fxx/temat-tytul-txx.html</b> zamiast <b>forum-tytul-fxx/temat-tytul-txx.html</b><br/>dla adresów URL tematów.</ul><br/>To może być podręczne aby trochę skrócić adresy URL, zwłaszcza kiedy używasz opcji "Wirtualny Folder". Nie nadpisane linki będą widoczne i będą działały w folderze phpBB.<br/><br/><b style="color:red">Uwaga :</b><br/><ul style="margin-left:20px">Używanie tej opcji wymaga używania strony głównej dla forum index (jak forum.html).<br/> Ta opcja może zmienić wszystkie adresy URL na Twojej stronie.<br/>używanie tej opcji z już zindeksowanymi stronami powinno być ponownie rozważone.<br/></ul>',
	'cache_layer' => 'Forum URL caching',
	'cache_layer_explain' => 'Włącza cache dla adresów URL forum i pozwala oddzielić tytuły tematów od ich adresów URL<br/><u>Przykład :</u><ul style="margin-left:20px"><b>forum-tytuł-fxx/</b> zamiast <b>jakis-tytul-fxx/</b><br/>dla adresów forum URL.</ul><br/><b style="color:red">Uwaga</b><br/><ul style="margin-left:20px">Ta opcja pozwoli Ci zmienić adresy URL forum, potencjalnie wiele adresów URL tematów jeśli używasz opcji Wirtualny Folder.<br/>Adresy tematów będą zawsze poprawnie przekierowywane z Zero Duplicate.<br/>Będą również przekierowywane tak długo jak będziesz stosował separatory i ID.</ul>',
	'rem_ids' => 'Usuwanie ID Forum/Tematu',
	'rem_ids_explain' => 'Rozwiąż problem z ID i separatorami w adresach URL forum. Włącz tą opcję tylko wtedy gdy URL caching jest aktywowany.<br/><u>Przykład :</u><ul style="margin-left:20px"><b>jakis-tytul-fxx/</b> zamiast <b>jakis-tytul/</b><br/>dla adresów URL forum.</ul><br/><b style="color:red">Uwaga</b><br/><ul style="margin-left:20px">Ta opcja pozwoli Ci zmienić adresy URL forum, potencjalnie wiele adresów URL tematów jeśli używasz opcji Wirtualnego Folderu.<br/>Adresy tematów będą zawsze poprawnie przekierowywane z Zero Duplicate.<br/><u> Nie będzie problemu z adresami URL forum:</u><br/><ul style="margin-left:20px"><b>jakis-tytul-fxx/</b> będzie zawsze dobrze przekierowywany z Zero Duplicate ale nie będzie problemu jeśli zmienisz <b>jakis-tytul/</b> na <b>cos-innego/</b>.<br/> W takich przypadkach, <b>jakis-tytul/</b> będzie traktowany jako forum które nie istnieje.<br/>Więc musisz zdecydować czy użyć tej opcji czy nie.</ul></ul>',
	// copytrights
	'copyrights' => 'Prawa Autorskie',
	'copyrights_img' => 'Link baner',
	'copyrights_img_explain' => 'Tutaj możesz wybrać aby pokazać link Prawa Autorskie phpBB SEO jako baner lub tekst.',
	'copyrights_txt' => 'Link text',
	'copyrights_txt_explain' => 'Tutaj możesz wpisać tekst który będzie użyty jako link Prawa Autorskie phpBB SEO. Zostaw pusty aby użyć domyślnego.',
	'copyrights_title' => 'Link tytuł',
	'copyrights_title_explain' => 'Tutaj możesz wpisać tekst który będzie użyty jako tytuł linku Prawa Autorskie phpBB SEO. Zostaw pusty aby użyć domyślnego.',
	// Zero duplicate
	// Options 
	'ACP_ZERO_DUPE_OFF' => 'Wyłącz',
	'ACP_ZERO_DUPE_MSG' => 'Post',
	'ACP_ZERO_DUPE_GUEST' => 'Gość',
	'ACP_ZERO_DUPE_ALL' => 'Wszystko',
	'zero_dupe' =>'Zero duplictate',
	'zero_dupe_explain' => 'Następujące ustawienia dotyczą Zero duplicate, możesz je modyfikować według własnych potrzeb.<br/>Te ustawienia nie wpływają na parametry .htacess.',
	'zero_dupe_on' => 'Aktywuj Zero duplictate',
	'zero_dupe_on_explain' => 'Pozwala aktywować lub deaktywować przekierowania Zero duplicate.',
	'zero_dupe_strict' => 'Tryb ścisły',
	'zero_dupe_strict_explain' => 'Kiedy aktywowane, zero duplicate będzie sprawdzało czy żądany adres URL dokładnie pasuje do adresu wysyłanego.<br/>Kiedy ustawione na nie, zero dupe upewni się że adres url jest pierwszą częścią żądanego adresu.<br/>Jest to ułatwienie pracy z modami które mogłyby kolidować z zero dupe przez dodawanie zmiennych GET.',
	'zero_dupe_post_redir' => 'Przekierowanie Postów',
	'zero_dupe_post_redir_explain' => 'Ta opcja określa jak postępować z adresami postów; może określić cztery parametry :<ul style="margin-left:20px"><li><b>&nbsp;wyłącz</b>, bez przekierowań adresów url,</li><li><b>&nbsp;post</b>, upewnia się czy postxx.html jest używany jako adrest postu,</li><li><b>&nbsp;gość</b>, przekierowywuje gości jeśli jest taka potrzeba do adresu tematu postu, i upewnia się że postxx.html  jest dostępny tylko dal zarejestrowanych użytkowników,<li><b>&nbsp;wszystkie</b>, przekierowywuje jeśli potrzebne do odpowiedniego adresu tematu.</li></ul><br/><b style="color:red">Uwaga</b><br/><ul style="margin-left:20px">Utrzymywanie adresów <b>postxx.html</b> jest niszczące dla SEO wise tak długo jak trzymasz disallow dla  adresów postów w pliku robots.txt.<br/><br/>Jeśli przekierowywujesz postxx.html w każdym przypadku, to znaczy że wiadomość która będzie w poście danego tematu i później będzie przeniesiona do innego tematu zobaczy zmianę adresu, który dzięki zero duplicate mod nie jest destrukcyjny dla SEO wise, ale poprzedni link do postu nie będzie już kierował do niego w takich przypadkach.</ul>.',
	// no duplicate
	'no_dupe' => 'No duplicate',
	'no_dupe_on' => 'Aktywuj No duplicate',
	'no_dupe_on_explain' => 'No duplicate mod zastępuje adres postu z odpowiednim adresem tematu (ze stronicowaniem).<br/>Nie wykorzystuje SQL, to znaczy że będzie wykonywał trochę więcej pracy ale nie powinien być problemem dla obciążenia serwera.',
));
?>
