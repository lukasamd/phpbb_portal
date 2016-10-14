<?php
/**
*
* acp_phpbb_seo [english]
*
* @package Ultimate SEO URL phpBB SEO
* @version $Id: phpbb_seo_related_install.php 202 2009-12-20 12:04:05Z dcz $
* @copyright (c) 2006 - 2009 www.phpbb-seo.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License v2
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
	// ACP
	'SEO_RELATED' => 'Aktywacja podobnych tematów',
	'SEO_RELATED_EXPLAIN' => 'Pokaż lub nie listę podobnych tematów na stronie tematu.<br/><b style="color:red;">Uwaga :</b><br/>MYSQL >=4.1 i tabele tematów używają MyISAM, podobne tematy będą uzyskiwane poprzez FullText index tytuł tematu i będą sortowane według trafności. W innych przypadkach, zostanie użyte SQL LIKE, i wyniki będą sortowane ze względu na czas publikacji',
	'SEO_RELATED_CHECK_IGNORE' => 'Ignoruj filter słów',
	'SEO_RELATED_CHECK_IGNORE_EXPLAIN' => 'Zastosuj lub nie, wyłączenie search_ignore_words.php podczas wyszukiwania podobnych tematów',
	'SEO_RELATED_LIMIT' => 'Limit podobnych tematów',
	'SEO_RELATED_LIMIT_EXPLAIN' => 'Maksymalna ilość podobnych tematów do wyświetlenia',
	'SEO_RELATED_ALLFORUMS' => 'Szukaj we wszystkich działach',
	'SEO_RELATED_ALLFORUMS_EXPLAIN' => 'Wyszukuje we wszystkich działach zamiast w aktualnym.<br/><b style="color:red;">Uwaga :</b><br/>Przeszukiwanie wszystkich działów jest troche wolniejsze i niekoniecznie zakończy się lepszym rezultatem',
	// Install
	'INSTALLED' => 'Zainstalowano moda phpBB SEO Related Topics',
	'ALREADY_INSTALLED' => 'phpBB SEO Related Topics mod jest już zainstalowany',
	'FULLTEXT_INSTALLED' => 'Mysql FullText Index zainstalowany',
	'FULLTEXT_NOT_INSTALLED' => 'Mysql FullText Index jest niedostępny na tym serwerze, będzie użyty SQL LIKE',
	'INSTALLATION' => 'phpBB SEO Related Topics mod instalacja',
	'INSTALLATION_START' => '&rArr; <a href="%1$s" ><b>Kontynuuj instalację moda</b></a><br/><br/>&rArr; <a href="%2$s" ><b>Spróbuj ponownie ustawić FullText Index</b></a> (Mysql >= 4.1 używa Myisam tylko dla tabeli tematów)<br/><br/>&rArr; <a href="%3$s" ><b>Kontynuuj deinstalację moda</b></a>',
	// un-install
	'UNINSTALLED' => 'phpBB SEO Related Topics mod odinstalowany',
	'ALREADY_UNINSTALLED' => 'phpBB SEO Related Topics mod jest już odinstalowany',
	'UNINSTALLATION' => 'Deinstalacja phpBB SEO Related Topics mod',
	// SQL message
	'SQL_REQUIRED' => 'Użytkownik bazy danych nie posiada wymaganych uprawnień aby wykońać operację na tabelach, musisz wykonać to polecenie ręcznie aby dodać lub usunąć Mysql FullText index :<br/>%1$s',
	// Security
	'SEO_LOGIN'		=> 'Musisz być zarejestrowany i zalogowany aby przeglądać tę stronę.',
	'SEO_LOGIN_ADMIN'	=> 'Musisz być zalogowany jako administrator aby przeglądać tę stronę.<br/>Twoja sesja została zniszczona ze względu na bezpieczeństwo.',
	'SEO_LOGIN_FOUNDER'	=> 'Musisz być zalogowany jako założyciel aby przeglądać tę stronę.',
	'SEO_LOGIN_SESSION'	=> 'Sprawdzanie sesji nie powiodło się.<br/>Ustawienia nie zostały zmienione.<br/>woja sesja została zniszczona ze względu na bezpieczeństwo.',
));
?>