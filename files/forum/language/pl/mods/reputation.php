<?php
/**
*
* thanks_mod[Polish]
*
* @package language
* @version $Id: @version $Id: thanks.php,v 127 2010-04-17 10:02:51Палыч $
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
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'REPUTATION'					=> 'Reputacja',

    'REPUTATION_POST'				=> 'Kliknij aby przyznać punkt za post',
    'REPUTATION_ADD_INFO_OK'			=> 'Przynałeś punkt reputacji za ten post.',
    'REPUTATION_ADD_INFO_WAIT'			=> 'Przynałeś punkt reputacji za ten post, zostanie on sprawdzony przez moderatora.',
    'REPUTATION_ERROR'       => 'Przyznanie punktu za ten post nie jest już możliwe!',
    'RETURN_POST'				=> 'Wróć do postu',

    'REPUT_PM_SUBJECT'		=> 'Zmiana reputacji',
    'REPUT_PM_MESSAGE'		=> 'Nastąpiła zmiana Twojej reputacji.',
    
    'REPUTATION_LIST'				=> 'Reputacja użytkowników',
    
    'REPUTATION_ACCESS_DENIED'   => 'Nie masz uprawnień do przeglądania reputacji',
    'REPUT_BACK'            => 'Powrót do listy reputacji',
    
    'REPUTATION_ADD_TITLE' => 'Potwierdzenie dodania punktu użytkownikowi',
    'REPUTATION_ADD_DESC'  => 'Poniżej wpisz komentarz dotyczący tego punktu reputacji dla użytkownika. Jego dodanie jest opcjonalne i możesz pominąć ten krok po prostu dodając punkt bez zbędnych wyjaśnień.',

    'REPUTATION_BUTTON_ADD' => 'Dodaj punkt',
    'REPUTATION_BUTTON_BACK' => 'Wróć do tematu',
    
    'REPUTATION_ERROR_USERS' => 'Możesz dodać punkt temu samemu użytkownikowi dopiero po dodaniu punktów 1 innemu użytkownikowi.',
    'REPUTATION_ERROR_TIME' => 'Możesz dodać maksymalnie 5 punktów reputacji w ciągu 24 godzin.',
    'REPUTATION_ERROR_POINTS' => 'Musisz posiadać minimum 5 punktów reputacji aby samemu móc je przyznawać.',
));
?>