<?php
/**
*
* groups [English]
*
* @package language
* @version $Id: $
* @copyright (c) 2007 DualFusion - 2008 ..::Frans::..
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* DO NOT CHANGE
*/
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
	'ACP_WELCOME_PM'			=> 'Powitalna Prywatna Wiadomość (PPW)',
	'ACP_WPM_SETTINGS'			=> 'Ustawienia PPW',

	'LOG_WPM_SETTINGS_UPDATED'	=> '<strong>Modyfikacja PPW </strong>',

	'WPM_ALREADY_INSTALLED'	=> 'Powitalna Prywatna Wiadomość (PPW) została zainstalowana w Twojej bazie!',
	'WPM_BOARD_CONTACT'		=> 'Forum kontakt',
	'WPM_BOARD_EMAIL'		=> 'E-mail kontakt',
	'WPM_BOARD_SIG'			=> 'Podpis Forum',
	'WPM_CPF_VARS'			=> 'Niestandartowe ustawienia pół profili',
	'WPM_ENABLE'			=> 'Włącz PPW',
	'WPM_ENABLE_EXPLAIN'	=> 'Mozesz włączyć/wyłączyć tego moda w każdej chwili.',
	'WPM_ERROR_EMPTY'		=> 'Pole <strong>%s</strong> nie może być puste',
	'WPM_ERROR_USER'		=> 'Nieznana nazwa usera <strong>%s</strong> w polu Nazwa Użytkownika',
	'WPM_ERROR_DB'			=> 'Wystąpił problem podczas aktualizacji <strong>%s</strong>',
	'WPM_INSTALLED'			=> 'Powitalna Prywatna wiadomość (PPW) zastała pomyślnie zainstalowana w bazie!',
	'WPM_NOTIFY'			=> 'Powiadom',
	'WPM_NOTIFY_EXPLAIN'	=> 'Aby powiadomić użytkowników o nowych PW jeśli sądzisz, że nie chcą być informowani',
	'WPM_PREDEFINED_VARS'	=> 'Przedefiniowane zmienne',
	'WPM_SENDER'			=> 'Nazwa nadawcy',
	'WPM_SITE_NAME'			=> 'Nazwa strony',
	'WPM_SITE_DESC'			=> 'Opis strony',
	'WPM_SUBJECT_EXPLAIN'	=> 'Tytuł wiadomości, która otrzyma użytkownik',
	'WPM_TITLE'				=> 'Powitalna Prywatna wiadomość (PPW)',
	'WPM_TITLE_EXPLAIN'		=> 'Pozwala na stworzenie spersonalizowanych prywatnych wiadomości. Wiadomość zostanie wysłana do wszystkich nowo-zarejestrowanych użytkowników forum.',
	'WPM_UPDATED'			=> 'Powitalna Prywatna Wiadomość (PPW) - zmiana ustawień ',
	'WPM_USERNAME'			=> 'Użytkownik',
	'WPM_USERNAME_EXPLAIN'	=> 'Nazwa użytkownika, od którego mają być dostarczane PW.',
	'WPM_USER_ID'			=> 'ID użytkownika',
	'WPM_USER_IP'			=> 'IP użytkownika',
	'WPM_USER_EMAIL'		=> 'E-mail użytkownika',
	'WPM_USER_REGDATE'		=> 'Dara rejestracji',
	'WPM_USER_LANG_EN'		=> 'Język (POLSKI)',
	'WPM_USER_LANG_LOCAL'	=> 'Język (LOCAL)',
	'WPM_USER_TZ'			=> 'Timezone',
	'WPM_VAR_NAME'			=> 'Nazwa',
	'WPM_VAR_VAR'			=> 'Zmienna',
	'WPM_VAR_EXAMPLE'		=> 'Przykład',
));
?>