<?php
/**
*
* @package phpBB Statistics
* @version $Id: lang_stats_acp.php 167 2011-02-09 01:07:15Z marc1706 $
* @copyright (c) 2009 - 2010 Marc Alexander(marc1706) www.m-a-styles.de
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @based on: lang_portal_acp.php included in the Board3 Portal package (www.board3.de)
* @translator (c) ( Marc Alexander - http://www.m-a-styles.de )
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
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine


$lang = array_merge($lang, array(
	'ACP_STATS_VERSION'							=> '<strong>phpBB Statistics v%s</strong>',
	// General
	'ACP_STATS_GENERAL_INFO' 					=> 'Administracja Statystykami phpBB',
	'ACP_STATS_GENERAL_INFO_EXPLAIN'			=> 'Dziękujemy za wybór Statystyk phpBB.',
	'ACP_STATS_GENERAL_SETTINGS' 				=> 'Ustawienia główne',
	'ACP_STATS_GENERAL_SETTINGS_EXPLAIN'		=> 'Na tej stronie możesz zmienić ustawienia, które dotyczą całych Statystyk phpBB',
	'ACP_STATS_ENABLE'							=> 'Włącz statystyki',
	'ACP_STATS_ENABLE_EXPLAIN'					=> 'Zdecyduj czy włączyć Statystyki phpBB',
	'ACP_BASIC_BASIC_ENABLE'					=> 'Włącz Podstawowe Statystyki',
	'ACP_BASIC_BASIC_ENABLE_EXPLAIN'			=> 'Wybierz jeśli Podstawowe Statystyki powinny zostać włączone',
	'ACP_BASIC_ADVANCED_ENABLE'					=> 'Włącz Zaawansowane Statystyki',
	'ACP_BASIC_ADVANCED_ENABLE_EXPLAIN'			=> 'Wybierz jeśli Zaawansowane Statystyki powinny zostać włączone',
	'ACP_BASIC_MISCELLANEOUS_ENABLE'			=> 'Włącz Różne Statystyki',
	'ACP_BASIC_MISCELLANEOUS_ENABLE_EXPLAIN'	=> 'Wybierz jeśli Różne Statystyki powinny zostać włączone',
	'ACP_ACTIVITY_FORUMS_ENABLE'				=> 'Włącz Statystyki Aktywności For',
	'ACP_ACTIVITY_FORUMS_ENABLE_EXPLAIN'		=> 'Wybierz jeśli Statystyki Aktywności For powinny zostać włączone',
	'ACP_ACTIVITY_TOPICS_ENABLE'				=> 'Włącz Statystyki Aktywności Tematów',
	'ACP_ACTIVITY_TOPICS_ENABLE_EXPLAIN'		=> 'Wybierz jeśli Statystyki Aktywności Tematów powinny zostać włączone',
	'ACP_ACTIVITY_USERS_ENABLE'					=> 'Włącz Statystyki Aktywności Użytkowników',
	'ACP_ACTIVITY_USERS_ENABLE_EXPLAIN'			=> 'Wybierz jeśli Statystyki Aktywności Użytkowników powinny zostać włączone',
	'ACP_CONTRIBUTIONS_ATTACHMENTS_ENABLE' 		=> 'Włącz Statystyki Załączników',
	'ACP_CONTRIBUTIONS_ATTACHMENTS_ENABLE_EXPLAIN' => 'Wybierz jeśli Statystyki załączników powinny zostać włączone',
	'ACP_CONTRIBUTIONS_POLLS_ENABLE'			=> 'Włącz Statystyki Ankiet',
	'ACP_CONTRIBUTIONS_POLLS_ENABLE_EXPLAIN'	=> 'Wybierz jeśli Statystyki Ankiet powinny zostać włączone',
	'ACP_PERIODIC_DAILY_ENABLE'					=> 'Włącz Dzienne Statystyki',
	'ACP_PERIODIC_DAILY_ENABLE_EXPLAIN'			=> 'Wybierz jeśli Dzienne Statystyki powinny zostać właczone',
	'ACP_PERIODIC_MONTHLY_ENABLE'				=> 'Włącz Miesięczne Statystyki',
	'ACP_PERIODIC_MONTHLY_ENABLE_EXPLAIN'		=> 'Wybierz jeśli Miesięczne Statystyki powinny zostać włączone',
	'ACP_PERIODIC_HOURLY_ENABLE'				=> 'Włącz Godzinowe Statystyki',
	'ACP_PERIODIC_HOURLY_ENABLE_EXPLAIN'		=> 'Wybierz jeśli Godzinowe Statystyki powinny zostać włączone',
	'ACP_SETTINGS_BOARD_ENABLE'					=> 'Włącz Panel Statystyki Ustawień',
	'ACP_SETTINGS_BOARD_ENABLE_EXPLAIN'			=> 'Wybierz jeśli Panel Statystyki Ustawień powinien zostać włączony',
	'ACP_SETTINGS_PROFILE_ENABLE'				=> 'Włącz Statystyki Ustawień Profili',
	'ACP_SETTINGS_PROFILE_ENABLE_EXPLAIN'		=> 'Wybierz jeśli Statystyki Ustawień Profili powinny zostać włączone',
	'ACP_STATS_RESYNC_TIMEFRAME'				=> 'Czas synchronizacji',
	'ACP_STATS_RESYNC_TIMEFRAME_EXPLAIN'		=> 'Wybierz ilość dni po których pamięć podręczna Statystyk zostanie odświeżona. Ustawienie 0 automatycznie wyłączy tą funkcję.',
	
	// Advanced Stats
	'ACP_BASIC_ADVANCED_INFO'					=> 'Zaawansowane Statystyki',
	'ACP_BASIC_ADVANCED_INFO_EXPLAIN'			=> 'Tutaj możesz zmienić ustawienia Zaawansowanych Statystyk',
	'ACP_BASIC_ADVANCED_SETTINGS'				=> 'Ustawienia Zaawansowanych Statystyk',
	'ACP_BASIC_ADVANCED_SECURITY'				=> 'Włącz bezpieczne Zaawansowane Statystyki',
	'ACP_BASIC_ADVANCED_SECURITY_EXPLAIN'		=> 'Wersja phpBB oraz informacje o bazie danych nie będą wyświetlane jeśli włączone',
	'ACP_BASIC_ADVANCED_PRETEND'				=> 'Symulacja zainstalowanej najnowszej wersji phpBB',
	'ACP_BASIC_ADVANCED_PRETEND_EXPLAIN'		=> 'Zaawansowane statystyki będą symulować zainstalowaną najnowszą wersję phpBB. <br /><strong>UWAGA:</strong> To działa tylko, jeśli bezpieczne Zaawansowane Statystyki są wyłączone. Ponadto, jeśli Sprawdzanie Wersji phpBB w PA nie działa, to nie będzie działać również.',
	
	// Miscellaneous Stats
	'ACP_BASIC_MISCELLANEOUS_INFO'				=> 'Pozostałe Statystyki',
	'ACP_BASIC_MISCELLANEOUS_INFO_EXPLAIN'		=> 'Tutaj możesz zmienić ustawienia Pozostałych Statystyk',
	'ACP_BASIC_MISCELLANEOUS_SETTINGS'			=> 'Ustawienia Pozostałych Statystyk',
	'ACP_BASIC_MISCELLANEOUS_WARNINGS'			=> 'Ukryj Ostrzeżenia Statystyk',
	'ACP_BASIC_MISCELLANEOUS_WARNINGS_EXPLAIN'	=> 'Jeśli włączone, Ostrzeżenia Statystyk nie będą wyświetlane',
	'ACP_BASIC_MISCELLANEOUS_BBCODES'			=> 'Przelicz BBCody i Uśmieszki',
	'ACP_BASIC_MISCELLANEOUS_BBCODES_EXPLAIN'	=> 'Ustaw na tak jeśli dodawano lub modyfikowano podstawowe bbcody i jeśli licznik był w jakiś sposób zmieniony. Opcja ta zostanie automatycznie wyłączona po ponownej synchronizacji.',
	
	// Users Activity Stats
	'ACP_ACTIVITY_USERS_INFO'				=> 'Statystyki Aktywności Użytkowników',
	'ACP_ACTIVITY_USERS_INFO_EXPLAIN'		=> 'Tutaj możesz zmienić ustawienia Statystyk Aktywności Użytkowników',
	'ACP_ACTIVITY_USERS_SETTINGS'			=> 'Ustawienia Statystyk Aktywności Użytkowników',
	'ACP_ACTIVITY_USERS_HIDE_ANONYMOUS'			=> 'Ukryj gości z listy XX Statystyk Użytkowników',
	'ACP_ACTIVITY_USERS_HIDE_ANONYMOUS_EXPLAIN' => 'Jeśli włączone, goście nie będą pokazywani na liście XX Statystyk Użytkowników',
	
	// Add-Ons
	'INSTALLED_ADDONS'						=> 'Zainstalowane Dodatki',
	'UNINSTALLED_ADDONS'					=> 'Odinstalowane Dodatki',

	));

?>