<?php
/**
*
* @package phpBB SEO GYM Sitemaps
* @version $id: install.php - 9151 11-26-2008 16:07:48 - 2.0.RC2 dcz $
* @copyright (c) 2006 - 2008 www.phpbb-seo.com
* @license http://opensource.org/osi3.0/licenses/lgpl-license.php GNU Lesser General Public License
*
*/
/**
*
* install [English]
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
	// Install
	'SEO_INSTALL_PANEL'	=> 'Gym Sitemaps &amp; RSS Panel Instalacyjny',
	'CAT_INSTALL_GYM_SITEMAPS' => 'Instaluj GYM Sitemaps',
	'CAT_UNINSTALL_GYM_SITEMAPS' => 'Odinstaluj GYM Sitemaps',
	'CAT_UPDATE_GYM_SITEMAPS' => 'Aktualizuj GYM Sitemaps',
	'SEO_ERROR_INSTALL'	=> 'Wystąpił błąd podczas procesu instalacji. Jeśli chcesz spróbować jeszcze raz, odinstaluj aktualną instalację.',
	'SEO_ERROR_INSTALLED'	=> 'Moduł %s jest już zainstalowany.',
	'SEO_ERROR_ID'	=> 'Moduł %1$ nie posiada ID.',
	'SEO_ERROR_UNINSTALLED'	=> 'Moduł %s jest już odinstalowany.',
	'SEO_ERROR_INFO'	=> 'Informacja :',
	'SEO_FINAL_INSTALL_GYM_SITEMAPS'	=> 'Zaloguj się do ACP',
	'SEO_FINAL_UPDATE_GYM_SITEMAPS'	=> 'Zaloguj się do ACP',
	'SEO_FINAL_UNINSTALL_GYM_SITEMAPS'	=> 'Wróc do strony głównej forum',
	'SEO_OVERVIEW_TITLE'	=> 'Przegląd GYM sitemaps &amp; RSS',
	'SEO_OVERVIEW_BODY'	=> '<p>Witaj w instalatorze phpBB SEO GYM sitemaps &amp; RSS %1$s.</p><p>Przeczytaj <a href="%3$s" title="Sprawdź opublikowany temat" target="_phpBBSEO"><b>opublikowany temat</b></a> więcej informacji</p><p><strong style="text-transform: uppercase;">Uwaga:</strong> Musisz edytować pliki i wykonać wymagane zmiany przed uruchomieniem kreatora instalacji.</p><p>Ten system instalacji przeprowadzi Cie przez cały proces instalacji GYM sitemaps &amp; RSS. Pozwoli Ci wygenerować skuteczny i Search Engine Optimized Google Sitemaps i RSS. Modułowa budowa pozwoli Ci wygenerować Google Sitemaps i RSS dla każdej aplikacji php/SQL zainstalowanej na Twojej stronie, używając dedykowanych plug-inów. Poznajmy sie na <a href="%3$s" title="Support forum" target="_phpBBSEO"><b>support forum</b></a> wszystko związane z modułem GYM Siteamps &amp; RSS.</p> ',
	'CAT_SEO_PREMOD'	=> 'GYM Sitemaps &amp; RSS',
	'SEO_INSTALL_INTRO'		=> 'Witaj w instalatorze phpBB SEO GYM sitemaps &amp; RSS.',
	'SEO_INSTALL_INTRO_BODY'	=> '<p>Jesteś przed instalacją moda %1$s %2$s. To narzędzie instalacyjne aktywuje GYM Sitemaps &amp; RSS w panelu administratora w phpBB ACP.</p><p>Po instalacji, będziesz musiał zlogować się do ACP aby ustawić odpowiednie opcje.</p>
	<p><strong>Note:</strong>Jeśli pierwszy raz instalowałeś tego moda, zachęcamy Cię do przetestowania wielu różnych ustawień na lokalnym serwerze.</p><br/>
	<p>Wymagania :</p>
	<ul>
		<li>Apache server (Linux OS) z mod_rewrite dla URL z funkcją nadpisywania.</li>
		<li>IIS server (Windows OS) z isapi_rewrite dla URL z funkcją nadpisywania, będziesz musiał dostosować metodę nadpisywania adresów w httpd.ini</li>
	</ul>',
	'SEO_INSTALL'		=> 'Instaluj',
	'UN_SEO_INSTALL_INTRO'		=> 'Witaj w deinstalatorze GYM Sitemaps &amp; RSS',
	'UN_SEO_INSTALL_INTRO_BODY'	=> '<p>Jesteś przed odinstalowaniem moda %1$s %2$s.</p>
	<p><strong>Uwaga:</strong> Mapy strony i kanały RSS nie będą dostępne po odinstalowaniu modułu.</p>',
	'UN_SEO_INSTALL'		=> 'Odinstaluj',
	'SEO_INSTALL_CONGRATS'		=> 'Gratulacje!',
	'SEO_INSTALL_CONGRATS_EXPLAIN'	=> '<p>Proces instalacji %1$s %2$s zakończony powodzeniem. Zaloguj się do phpBB ACP aby ustawić opcję moda.<p>
	<p>Będzie pokazywane w kategorii phpBB SEO;  z pomiędzy wielu innych rzeczy które będziesz mógł zrobić :</p>
	<h2>Google Sitemaps i RSS skonfigurowane prawidłowo</h2>
	<p>Google sitemaps i RSS feeds supports advanced XSLt styling, phpBB’s CSS will even be applied to these without editing a single line of code.</p>
	<p>Google sitemaps i RSS automatycznie wykryje phpBB SEO mod rewrites i jego ustawienia; używając innych metod nadpisywania adresów URL.</p>
	<h2>Wygeneruj spersonalizowany .htaccess</h2>
	<p>Z phpBB SEO mod rewrite i ustawionymi powyżej opcjami, będziesz mógł wygenerować spersonalizowany .htaccess i zapisać go bezpośrednio na serwerze.</p><br/><h3>Zainstaluj Raport :</h3>',
	'UN_SEO_INSTALL_CONGRATS'	=> 'Moduł GYM Sitemaps &amp; RSS ACP został usunięty.',
	'UN_SEO_INSTALL_CONGRATS_EXPLAIN'	=> '<p>Proces deinstalacji %1$s %2$ zakończony pomyślnie.<p>
	<p> Google sitemaps i RSS feeds nie są dostępne.</p>',
	'SEO_VALIDATE_INFO'	=> 'Informacja o weryfikacji :',
	'SEO_LICENCE_TITLE'	=> 'GNU LESSER GENERAL PUBLIC LICENSE',
	'SEO_LICENCE_BODY'	=> 'phpBB SEO GYM Sitemaps &amp; RSS opublikowany pod GNU LESSER GENERAL PUBLIC LICENSE.',
	'SEO_SUPPORT_TITLE'	=> 'Wsparcie',
	'SEO_SUPPORT_BODY'	=> 'Pełne wsparcie otrzymasz <a href="%1$s" title="Odwiedź %2$s forum" target="_phpBBSEO"><b>%2$s forum</b></a>. Odpowiemy na pytania dotyczące instalacji, problemy z konfiguracją, i najczęściej występującymi błędami.</p><p>Odwiedź nasze <a href="http://www.phpbb-seo.com/boards/" title="SEO Forum" target="_phpBBSEO"><b>Search Engine Optimization forums</b></a>.</p><p>Powinieneś <a href="http://www.phpbb-seo.com/boards/profile.php?mode=register" title="Zarejestrować się na phpBB SEO" target="_phpBBSEO"><b>rejestruj</b></a>, zaloguj i <a href="%3$s" title="Będziesz powiadamiany o aktualizacjach" target="_phpBBSEO"><b>subskrybuj do tematu wydania</b></a> aby być powiadamianym przez email o każdej aktualizacji.',
	// Security
	'SEO_LOGIN'		=> 'Musisz być zrejestrowany i zalogowany aby przeglądać tą stronę.',
	'SEO_LOGIN_ADMIN'	=> 'Musisz być zalogowany jako Administrator aby przeglądać tą stronę.<br/> Twoja sesja została wyczyszczona ze względu na bezpieczeństwo.',
	'SEO_LOGIN_FOUNDER'	=> 'Musisz być zalogowany jako Administrator aby przeglądać tą stronę.',
	'SEO_LOGIN_SESSION'	=> 'Sprawdzenie sesji nie powiodło się.<br/>Ustawienia nie zostały zmienione.<br/>Twoja sesja została wyczyszczona ze względu na bezpieczeństwo.',
	// Cache status
	'SEO_CACHE_FILE_TITLE'	=> 'Status pliku cache',
	'SEO_CACHE_STATUS'	=> 'Katalog cache jest skonfigurowany w : <b>%s</b>',
	'SEO_CACHE_FOUND'	=> 'Katalog cache został znaleziony.',
	'SEO_CACHE_NOT_FOUND'	=> 'Katalog cache nie został znaleziony.',
	'SEO_CACHE_WRITABLE'	=> 'Katalog cache jest zapisywalny.',
	'SEO_CACHE_UNWRITABLE'	=> 'Katalog cache jest nie zapisywalny. Musisz ustawić CHMOD na 0777.',
	'SEO_CACHE_FORUM_NAME'	=> 'Nazwa forum',
	'SEO_CACHE_URL_OK'	=> 'URL znajduje się w cache',
	'SEO_CACHE_URL_NOT_OK'	=> 'Ten adres forum nie znajduje się w cache',
	'SEO_CACHE_URL'		=> 'Końcowy URL',
	'SEO_CACHE_MSG_OK'	=> 'Plik cache został zaktualizowany.',
	'SEO_CACHE_MSG_FAIL'	=> 'Wystąpił błąd podczas aktualizacji pliku cache.',
	'SEO_CACHE_UPDATE_FAIL'	=> 'Adresk który wpisałeś nie może być użyty, cache pozostał niezmieniony.',
	// Update
	'UPDATE_SEO_INSTALL_INTRO'		=> 'Witaj w aktualizacji phpBB SEO GYM sitemaps &amp; RSS.',
	'UPDATE_SEO_INSTALL_INTRO_BODY'	=> '<p>Jesteś przed aktualizacją modułu %1$s do %2$s. Ten skrypt zaktualizuje bazę danych phpBB.<br/>Twoje dotychczasowe ustawienia nie zostaną zmienione.</p>
	<p><strong>Uwaga:</strong> Skrypt nie będzie aktualizował plików GYM Sitemaps &amp; RSS.<br/><br/>Aby aktualizować z wersji 2.0.x (phpBB3) <b>musisz</b> umieścić wszystkie pliki w katalogu <b>root/</b></p>',
	'UPDATE_SEO_INSTALL'		=> 'Aktualizacja',
	'SEO_ERROR_NOTINSTALLED'	=> 'GYM Sitemaps &amp; RSS nie jest zainstalowany!',
	'SEO_UPDATE_CONGRATS_EXPLAIN'	=> '<p>Aktualizacja %1$s to %2$s zakończona sukcesem.<p>
	<p><strong>Uwaga:</strong> Skrypt nie będzie aktualizował plików GYM Sitemaps &amp; RSS.</p><br/><b>Poszę</b> wykonaj zminę kodów wykazanych poniżej.<br/><h3>Raport aktualizacji :</h3>',
));
?>