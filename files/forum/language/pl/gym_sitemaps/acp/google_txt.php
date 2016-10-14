<?php
/**
*
* @package phpBB SEO GYM Sitemaps
* @version $id: google_txt.php - 4382 11-20-2008 14:38:27 - 2.0.RC1 dcz $
* @copyright (c) 2006 - 2008 www.phpbb-seo.com
* @license http://opensource.org/osi3.0/licenses/lgpl-license.php GNU Lesser General Public License
*
*/
/**
*
* google_txt [English]
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
	'GOOGLE_TXT' => 'TXT Sitemap',
	'GOOGLE_TXT_EXPLAIN' => 'Paramety modułu Google TXT sitemap. Mogą w pełni zintegrować listę URL z pliku tekstowego (adres na wiersz) w GYM sitemaps i skorzystać z funkcji modułów takich jak buforowanie i stylowanie XSL.<br/> Niektóre ustawienia mogą być zmienione w zależności od Google sitemaps i głównych ustawień nadpisywania.<br/>Każdy plik tekstowy dodany do folderu gym_sitemaps/sources/  będzie brany pod uwagę  po wyczyszczeniu pamięci podręcznej cache, używając linku powyżej Konserwacja.<br/> Każda lista adresów musi być zbudowana z jednego pełnego adresu URL na wiersz i będą musiały wyróżniać się podstawowym wzorem dla nazewnictwa plików: <b>google_</b>txt_nazwa_pliku<b>.txt</b>.<br />Wpis zostanie utworzony w SitemapIndex z adresem <b>przyklad.pl/sitemap.php?txt=txt_nazwa_pliku</b> i <b>przyklad.pl/txt-txt_nazwa_pliku.xml</b> kiedy adres nadpisany.<br/> Nazwa pliku źródłowego musi być zbudowana ze znaków alfanumerycznych (0-9a-z) plus oba separatory "_" i "-".<br/><u style="color:red;">Uwaga :</u><br/> Zaleca się, włączenie opcji Włącz Caching dla tego modułu aby zapobiec bezużytecznemu parsowaniu potencjalnie duże plików tekstowych..',
	// Main
	'GOOGLE_TXT_CONFIG' => 'Ustawienia TXT Sitemap',
	'GOOGLE_TXT_CONFIG_EXPLAIN' => 'Niektóre ustawienia mogą być zmienione w zależności od ustawień Google Sitemaps i głównych ustawień nadpisywania.',
	'GOOGLE_TXT_RANDOMIZE' => 'Losowo',
	'GOOGLE_TXT_RANDOMIZE_EXPLAIN' => 'Możesz losować adresy pobierane z pliku tekstowego. Zmiana kolejności na bieżąco może pomóc w indeksowaniu. Ta opcja jest także przydatny na przykład wtedy, gdy należy ograniczyć do 1000 adresów URL dla tego modułu i wykorzystania tekstu źródłowego plików z 5000 adresów, w takich przypadkach wszystkie 5000 adresów URL będzie regularnie wyświetlane na odpowiednich sitemapach.',
	'GOOGLE_TXT_UNIQUE' => 'Sprawdź duplikat',
	'GOOGLE_TXT_UNIQUE_EXPLAIN' => 'Uaktywnij, aby upewnić się, że jeżeli pojawią się pewne adresy URL więcej niż raz w tekście źródłowym, będzie on wyświetlany jedynie raz w sitemap.',
	'GOOGLE_TXT_FORCE_LASTMOD' => 'Ostatnia modyfikacja',
	'GOOGLE_TXT_FORCE_LASTMOD_EXPLAIN' => 'Możesz wymusić czas ostatniej modyfikacji opierając się o czas trwania cyklu cache (nawet jeśli cache nie jest uaktywniony) dla adresów URL w mapie witryny. Moduł będzie również obliczał priorytety i zmianiał częstotliwości w oparciu o ostatni czasu modyfikacji. Domyślnie, nie dodaje tagu ostatna modyfikacja.',
	// Reset settings
	'GOOGLE_TXT_RESET' => 'Moduł TXT Sitemaps',
	'GOOGLE_TXT_RESET_EXPLAIN' => 'Zresetuj do domyślnych wszystkie opcje sortowania modułu TXT Sitemaps.',
	'GOOGLE_TXT_MAIN_RESET' => 'Ustawienia TXT Sitemap',
	'GOOGLE_TXT_MAIN_RESET_EXPLAIN' => 'Zresetuj do domyślnych wszystkie opcje w "Ustawienia TXT Sitemap" (główna) zakładka modułu TXT Sitemap.',
	'GOOGLE_TXT_CACHE_RESET' => 'TXT Sitemap Cache',
	'GOOGLE_TXT_CACHE_RESET_EXPLAIN' => 'Zresetuj do domyślnych wszystkie opcje cache w module TXT Sitemap.',
	'GOOGLE_TXT_GZIP_RESET' => 'TXT Sitemap Gunzip',
	'GOOGLE_TXT_GZIP_RESET_EXPLAIN' => 'Zresetuj do domyślnych wszystkie opcje Gunzip w module TXT Sitemap.',
	'GOOGLE_TXT_LIMIT_RESET' => 'Limit TXT Sitemap',
	'GOOGLE_TXT_LIMIT_RESET_EXPLAIN' => 'Zresetuj do domyślnych wszystkie opcje Limitu w module TXT Sitemap.',
));
?>