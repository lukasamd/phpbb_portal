<?php
/**
*
* @package phpBB SEO GYM Sitemaps
* @version $id: google_xml.php - 5441 11-20-2008 14:38:27 - 2.0.RC1 dcz $
* @copyright (c) 2006 - 2008 www.phpbb-seo.com
* @license http://opensource.org/osi3.0/licenses/lgpl-license.php GNU Lesser General Public License
*
*/
/**
*
* google_xml [English]
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
	'GOOGLE_XML' => 'XML Sitemap',
	'GOOGLE_XML_EXPLAIN' => 'Parametr modułu XML Google Sitemap. Mogą w pełni zintegrować listę URL z pliku xml (adres na wiersz) w GYM sitemaps i skorzystać z funkcji modułów takich jak buforowanie i stylowanie XSL.<br/> Niektóre ustawienia mogą być zmienione w zależności od Google sitemaps i głównych ustawień nadpisywania.<br/>Każdy  plik xml dodany do folderu gym_sitemaps/sources/  będzie brany pod uwagę  po wyczyszczeniu pamięci podręcznej cache, używając linku powyżej konserwacja.<br/> Każda lista adresów musi być zbudowana z jednego pełnego adresu URL na wiersz i będą musiały wyróżniać się podstawowym wzorem dla nazewnictwa plików: <b>google_</b>xml_nazwa_pliku<b>.xml</b>.<br />Wpis zostanie utworzony w SitemapIndex z adresem      <b>przyklad.pl/sitemap.php?xml=xml_nazwa_pliku</b> lub <b>przyklad.pl/xml-xml_nazwa_pliku.xml</b> kiedy adres nadpisany.<br/> Nazwa pliku źródłowego musi być zbudowana ze znaków alfanumerycznych (0-9a-z) plus oba separatory "_" i "-".<p>Możesz również użyć pełnego adresu URL mapy witryny wygenerowanego przez zewnętrzną aplikację, przez konfigurację pliku gym_sitemaps/sources/xml_google_zewnetrzny.php (Przeczytaj komentarze w pliku).</p><u style="color:red;">Uwaga :</u><br/> Zaleca się, włączenie opcji Włącz Caching dla tego modułu aby zapobiec bezużytecznemu parsowaniu potencjalnie duże plików xml.',
	// Main
	'GOOGLE_XML_CONFIG' => 'Ustawienia XML Sitemap',
	'GOOGLE_XML_CONFIG_EXPLAIN' => 'Niektóre ustawienia mogą być zmienione w zależności od ustawień Google Sitemaps i głównych ustawień nadpisywania.',
	'GOOGLE_XML_RANDOMIZE' => 'Losowo',
	'GOOGLE_XML_RANDOMIZE_EXPLAIN' => 'Możesz losować adresy pobierane z pliku XML. Zmiana kolejności na bieżąco może pomóc w indeksowaniu. Ta opcja jest także przydatny na przykład wtedy, gdy należy ograniczyć do 1000 adresów URL dla tego modułu i wykorzystania tekstu źródłowego plików z 5000 adresów, w takich przypadkach wszystkie 5000 adresów URL będzie regularnie wyświetlane na odpowiednich sitemapach.<br/><u>Uwaga :</u><br/>Ta opcja wymaga pełnego parsowania pliku źródłowego, zaleca się korzystanie z funkcji Włącz buforowanie.',
	'GOOGLE_XML_UNIQUE' => 'Sprawdź duplikat',
	'GOOGLE_XML_UNIQUE_EXPLAIN' => 'Uaktywnij, aby upewnić się, że jeśli pojawią się pewne adresy URL więcej niż raz w pliku źródłowym XML, będzie on wyświetlany jedynie raz w sitemap.<br/><u>Uwaga :</u><br/>Ta opcja wymaga pełnego parsowania pliku źródłowego, zaleca się korzystanie z funkcji Włącz buforowanie.',
	'GOOGLE_XML_FORCE_LASTMOD' => 'Ostatnia modyfikacja',
	'GOOGLE_XML_FORCE_LASTMOD_EXPLAIN' => 'Możesz wymusić czas ostatniej modyfikacji opierając się o czas trwania cyklu cache (nawet jeśli cache nie jest uaktywniony) dla adresów URL w mapie witryny. Moduł będzie również obliczał priorytety i zmianiał częstotliwości w oparciu o ostatni czasu moda. Domyślnie, nie dodaje tagu ostatni mod. Else the eventual lastmod, changefreq and priority tags provided in the xml source file will be used, or no lastmod tags in case the source file doe not provide with any.<br/><u>Uwaga :</u><br/>Ta opcja wymaga pełnego parsowania pliku źródłowego, zaleca się korzystanie z funkcji Włącz buforowanie.',
	'GOOGLE_XML_FORCE_LIMIT' => 'Wymuś limit',
	'GOOGLE_XML_FORCE_LIMIT_EXPLAIN' => 'Tutaj możesz się upewnić że nie jest wyświetlana większa ilość aresów niż ustawiony limit w mapie witryny.<br/><u>Uwaga :</u><br/>Ta opcja wymaga pełnego parsowania pliku źródłowego, zaleca się korzystanie z funkcji Włącz buforowanie.',
	// Reset settings
	'GOOGLE_XML_RESET' => 'Moduł XML Sitemaps',
	'GOOGLE_XML_RESET_EXPLAIN' => 'Zresetuj do domyślnych wszystkie opcje modułu  "Moduł XML Sitemaps" (główna) zakładka modułu XML Sitemap.',
	'GOOGLE_XML_MAIN_RESET' => 'Ustawienia XML Sitemap',
	'GOOGLE_XML_MAIN_RESET_EXPLAIN' => 'Zresetuj do domyślnych wszystkie opcje modułu "Ustawienia XML Sitemap" (główna) zakładka modułu XML Sitemap.',
	'GOOGLE_XML_CACHE_RESET' => 'Buforowanie XML Sitemaps',
	'GOOGLE_XML_CACHE_RESET_EXPLAIN' => 'Zresetuj do domyślnych wszystkie opcje buforowania modułu XML Sitemap.',
	'GOOGLE_XML_GZIP_RESET' => 'XML Sitemaps Gunzip',
	'GOOGLE_XML_GZIP_RESET_EXPLAIN' => 'Zresetuj do domyślnych wszystkie opcje Gunzip w module XML Sitemap.',
	'GOOGLE_XML_LIMIT_RESET' => 'XML Sitemap Limit',
	'GOOGLE_XML_LIMIT_RESET_EXPLAIN' => 'Zresetuj do domyślnych wszystkie opcje Limitu w module XML Sitemap.',
));
?>