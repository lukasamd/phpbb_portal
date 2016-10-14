<?php
/**
*
* mod_thanks [Polish]
*
* @package language
* @version $Id: info_acp_thanks.php 128 2010-05-31 10:02:51Палыч $
* @copyright (c) 2008 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
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
	'acl_f_reputation' 						=> array('lang' => 'Może przyznawać punkty reputacji za posty', 'cat' => 'misc'),
	'acl_u_viewreputation' 					=> array('lang' => 'Może przeglądać listę reputacji', 'cat' => 'misc'),
	'acl_m_reputdelete'					=> array('lang' => 'Może usuwać punkty reputacji', 'cat' => 'misc'),
	
	'ACP_REPUTATION'						=> 'System reputacji',
  'ACP_REPUTATION_SETTINGS'				=> 'Ustawienia systemu reputacji',
	'ACP_REPUTATION_SETTINGS_EXPLAIN'		=> 'Tutaj możesz ustawić różne funkcje systemu reputacji.',

	'IMG_THANKPOSTS'					=> 'Naciśnij aby dodać punkt reputacji za ten post',
	'IMG_REMOVEREPUTATION'					=> 'Naciśnij aby usunąć punkt reputacji za ten post',
	
	'REPUTATION_ALLOW_REMOVE'						=> 'Usuwanie punktów reputacji',
	'REPUTATION_ALLOW_REMOVE_EXPLAIN'				=> 'Jeśli włączone użytkownicy będą mogli usuwać punkty reputacji',
	
	'REPUTATION_COUNTER_TOPIC'				=> 'Liczniki reputacji w widoku tematu',
	'REPUTATION_COUNTER_TOPIC_EXPLAIN'		=> 'Jeśli włączone, blok informacyjny o autorze będzie pokazywał ilość otrzymanych punktów reputacji',
	
	'REPUTATION_COUNTER_PROFILE'			=> 'Licznik reputacji w profilu',
	'REPUTATION_COUNTER_PROFILE_EXPLAIN'	=> 'Jeśli ta opcja jest włączona, w profilach użytkowników wyświetlany będzie licznik ich reputacji wraz z linkiem do listy punktów.',

  'REPUTATION_INFO_PAGE'					=> 'Informacja po dodaniu lub usunięciu punktu', 
	'REPUTATION_INFO_PAGE_EXPLAIN'			=> 'Jeśli włączone, po wystawieniu/usunięciu punktów reputacji wyświetla informację z automatyczny przekierowaniem',

	'REPUTATION_ONLY_FIRST_POST'			=> 'Punkty reputacji tylko dla pierwszego postu w temacie',
	'REPUTATION_ONLY_FIRST_POST_EXPLAIN'	=> 'Jeśli włączone, punkty reputacji będzie można wystawiać tylko dla pierwszego postu w temacie',

  'REPUTATION_POSTLIST_VIEW'				=> 'Lista reputacji pod postem',
	'REPUTATION_POSTLIST_VIEW_EXPLAIN'		=> 'Jeśli ta opcja jest włączona, informacje o użytkownikach którzy wręczyli punkty reputacji za dany post będą pod nim wyświetlane. ',

	'REPUTATION_RESTRICTION_TIMES'					=> 'Maksymalna ilość punktów na dzień',
	'REPUTATION_RESTRICTION_TIMES_EXPLAIN'			=> 'Określa maksymalną liczbę punktów jakie może przyznać użytkownik w ciągu dnia',
	
	'REPUTATION_RESTRICTION_MINPOINTS'					=> 'Minimalna ilość punktów do oceniania',
	'REPUTATION_RESTRICTION_MINPOINTS_EXPLAIN'			=> 'Określa minimalną ilość punktów reputacji, która pozwala użytkownikowi na ocenianie innych',
	
	'REPUTATION_RESTRICTION_INTERVAL'					=> 'Minimalna przerwa punktowa dla jednego użytkownika',
	'REPUTATION_RESTRICTION_INTERVAL_EXPLAIN'			=> 'Określa ilu użytkownikom osoba musi dodać punkt, zanim będzie mogła ocenić ponownie punkt innego użytkownika',

));
?>