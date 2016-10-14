<?php
/** 
*
* acp_forums [Polish]
* translated originally by PhpBB-fr.com <http://www.phpbb-fr.com/> and phpBB.biz <http://www.phpBB.biz>
*
* @package language
* @version $Id: forums.php,v 1.21 2008/04/10 12:53:34 elglobo Exp $
* @copyright (c) 2005 phpBB Group 
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
	'ADP_DOUBLE_POST'		=> 'Nie możesz dodać postu ponieważ ostatni post w tym wątku jest napisany przez Ciebie.<br /><br />%sEdytuj swojego posta%y.',

	'FORUM_ADP'				=> 'Anti-Double Posts MOD',
	'ADP_ENABLE'			=> 'Aktywacja MODa',
	
	'ADP_ADMINS'			=> 'Administratorzy mogą pisać podwójne posty',
	'ADP_MODOS'				=> 'Moderatorzy mogą pisać podwójne posty',
	
	'ADP_AUTO_EDIT'			=> 'Dodaj do ostatniej wiadomości',
	'ADP_AUTO_EDIT_EXPLAIN'	=> '<strong>Tak</strong> : podwójne posty zostały dodane do tego tematu\ów.<br/><strong>Nie</strong> : pokaż wiadomość błąd.', 
	'ADP_TEXT_EDIT'			=> 'Separator',
	'ADP_TEXT_EDIT_EXPLAIN'	=> 'Ten tekst jest wstawiany pomiędzy ostatni post i zdublowany post.<br />Użyj <strong>%D</strong> aby wstawić czas w podwójnym poście\postach.', 
	
	'ADP_ALWAYS'			=> 'Zabroń podwójnych postów.',
	'ADP_ALWAYS_EXPLAIN'	=> 'Tak : podwójne posty będą zawsze zabronione. Następne ustawienie nie będą brane pod uwagę.',
	'ADP_DAYS'				=> 'Ilość dni',
	'ADP_DAYS_EXPLAIN'		=> 'Ilość dni podczas których podwójne posty będą zabronione.',
	'ADP_HOURS'				=> 'Ilość godzin',
	'ADP_HOURS_EXPLAIN'		=> 'Ilość godzin podczas których podwójne posty będą zabronione.',
	'ADP_MINS'				=> 'Ilość minut',
	'ADP_MINS_EXPLAIN'		=> 'Ilość minut podczas których podwójne posty będą zabronione.',
	'ADP_SECS'				=> 'Ilość sekund',
	'ADP_SECS_EXPLAIN'		=> 'Ilość sekund podczas których podwójne posty będą zabronione.',
	'ADP_APPLY_TO_ALL'				=> 'Zastosuj dla wszystkich działów',
	'ADP_APPLY_TO_ALL_EXPLAIN'		=> '<strong>UWAGA :</strong> Jeśli zaznaczysz tę opcję, zostanie ona aktywowana dla wszystkich działów.',	
	
	'ADDED_PERMISSIONS'		=> 'Opcje uprawnień Anti Double Post MOD zostały dodane do bazy danych.',	
));

?>