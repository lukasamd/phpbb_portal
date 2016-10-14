<?php
/**
*
* @package phpBB SEO GYM Sitemaps
* @version $id: gym_google.php - 259 2010-03-18 19:25:40Z dcz $
* @copyright (c) 2006 - 2008 www.phpbb-seo.com
* @license http://opensource.org/osi3.0/licenses/lgpl-license.php GNU Lesser General Public License
*
*/
/**
*
* gym_google [Polish]
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
	'GOOGLE_MAIN' => 'Ustawienia Google Sitemaps',
	'GOOGLE_MAIN_EXPLAIN' => 'Główne ustawienia dla modułu Google sitemap.<br/>Będą one stosowane do wszystkich modułów Google sitemaps domyślnie.',
	// Linking setup
	'GOOGLE_LINKS_ACTIVATION' => 'Linki Forum',
	'GOOGLE_LINKS_MAIN' => 'Główne linki',
	'GOOGLE_LINKS_MAIN_EXPLAIN' => 'Pokaż lub nie sitemapindex link w stopce.<br/>Ta opcja wymaga aby główne linki były aktywowane w głównej konfiguracji.',
	'GOOGLE_LINKS_INDEX' => 'Linki na głównej stronie',
	'GOOGLE_LINKS_INDEX_EXPLAIN' => 'Pokaż lub nie linki do dostępnych map stron dla każdego działu na głównej stronie forum. Linki te dodawane są pod opisem działu.<br/>Ta opcja wymaga aby główne linki były aktywowane w głównej konfiguracji.',
	'GOOGLE_LINKS_CAT' => 'Linki na stronie działu',
	'GOOGLE_LINKS_CAT_EXPLAIN' => 'Pokaż lub nie linki do map stron aktualnego działu. Linki te są wyświetlane pod nazwą działu.<br/>Ta opcja wymaga aby główne linki były aktywowane w głównej konfiguracji.',
	// Reset settings
	'GOOGLE_ALL_RESET' => '<b>Wszystkie</b> Moduły Google sitemaps',
	'GOOGLE_URL_EXPLAIN' => 'Wpisz pełny adres URL do Index sitemap np. http://www.przyklad.pl/ewentualnie_katalog/ jeśli sitemap.php jest zainstalowany w http://www.przyklad.pl/ewentualnie_katalog/.<br/>Ta opcja jest użyteczna jeżeli phpBB nie jest zainstalowany w katalogu root domeny i chciałbyś pozycjonować adresy z poziomu root domeny w Google sitemaps.',
	'GOOGLE_PING' => 'Google Ping',
	'GOOGLE_PING_EXPLAIN' => 'Ping Google za każdym razem gdy mapa strony aktualizuje się.',
	'GOOGLE_THRESHOLD' => 'Próg map stron',
	'GOOGLE_THRESHOLD_EXPLAIN' => 'Minimalna ilość pozycji do wyświetlenia w mapie strony.',
	'GOOGLE_PRIORITIES' => 'Ustawienia priorytetu',
	'GOOGLE_DEFAULT_PRIORITY' => 'Domyślny Priorytet',
	'GOOGLE_DEFAULT_PRIORITY_EXPLAIN' => 'Domyślny priorytet dla URL znajdujących się we wszystkich mapach stron; będzie stosowany chyba że dodatkowe opcje będą dostępne dzięki modułowi (ustaw wartość pomiędzy 0.0 &amp; 1.0 łącznie)',
	'GOOGLE_XSLT' => 'Stylowanie XSLT',
	'GOOGLE_XSLT_EXPLAIN' => 'Aktywowanie XSL style-sheet spowoduje wyświetlenie przyjaznej dla użytkownika strony Google sitemaps z linkami. Będzie to efektywne po wyczyszczeniu cache Google sitemaps używając linku powyżej Konserwacja.',
	'GOOGLE_LOAD_PHPBB_CSS' => 'Obciążenie phpBB CSS',
	'GOOGLE_LOAD_PHPBB_CSS_EXPLAIN' => 'Moduł GYM sitemap używa systemu szablonowania phpBB3. XSL stylesheets są używane do budowania strony html, i jest on kompatybilny ze stylami phpBB3.<br/>Z tym, można stosować phpBB CSS w XSL stylesheet zamiast do domyślnego. W ten sposób, wszystkie twoje zmiany w motywach takie jak tło i czcionki lub nawet obrazki będą używane w Google sitemap.<br/> Będzie to widoczne po wyczyszczeniu cache RSS w menu "Konserwacja".<br/>Jeśli pliku stylu Google sitemaps nie ma w aktualnym stylu, domyślny styl (zawsze dostępny, opierając się o prosilver) będzie używany.<br/> Nie próbuj używać szablonów prosilver z innym stylem, CSSy nie będą współpracować.',
    // Auth settings
	'GOOGLE_AUTH_SETTINGS' => 'Ustawienia autoryzacji',
	'GOOGLE_ALLOW_AUTH' => 'Autoryzacje',
	'GOOGLE_ALLOW_AUTH_EXPLAIN' => 'Aktywuj autoryzację dla map, zalogowani użytkownicy i boty będą mogli przeglądać mapy prywatnych działów jeżeli posiadają odpowiednie uprawnienia.',
	'GOOGLE_CACHE_AUTH' => 'Buforuj prywatne mapy',
	'GOOGLE_CACHE_AUTH_EXPLAIN' => 'Możesz wyłączyć buforowanie dla prywatnych map.<br/> Buforowanie prywatnych map zwiększy ilość buforowanych plików. Nie powinno być problemu, ale możesz zdecydować aby buforować tylko publiczne mapy.',
));
?>