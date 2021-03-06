<?php
/**
*
* viewtopic [Polski]
*
* @package language
* @version $Id: viewtopic.php 9972 2009-08-14 08:42:46Z Kellanved $
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @Polish locale 9972 2009-09-25 18:24:32 Zespół Olympus.pl $
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
	'ATTACHMENT'						=> 'Załącznik',
	'ATTACHMENT_FUNCTIONALITY_DISABLED'	=> 'Funkcje załączników zostały wyłączone.',

	'BOOKMARK_ADDED'		=> 'Zakładka została dodana do tematu.',
	'BOOKMARK_ERR'			=> 'Nie udało się dodać zakładki. Proszę spróbować ponownie.',
	'BOOKMARK_REMOVED'		=> 'Zakładka została usunięta.',
	'BOOKMARK_TOPIC'		=> 'Dodaj zakładkę',
	'BOOKMARK_TOPIC_REMOVE'	=> 'Usuń zakładkę',
	'BUMPED_BY'				=> 'Ostatnio przesunięty w górę %2$s przez: %1$s.',
	'BUMP_TOPIC'			=> 'Przesuń temat w górę',

	'CODE'					=> 'Kod',
	'COLLAPSE_QR'			=> 'Ukryj szybką odpowiedź',

	'DELETE_TOPIC'			=> 'Usuń temat',
	'DOWNLOAD_NOTICE'		=> 'Nie masz wymaganych uprawnień, aby zobaczyć pliki załączone do tego postu.',

	'EDITED_TIMES_TOTAL'	=> 'Notatka od moderatora %1$s, %2$s:',
	'EDITED_TIME_TOTAL'		=> 'Notatka od moderatora %1$s, %2$s:',
	'EMAIL_TOPIC'			=> 'Powiadom znajomego o tym temacie',
	'ERROR_NO_ATTACHMENT'	=> 'Wybrany załącznik już nie istnieje',

	'FILE_NOT_FOUND_404'	=> 'Plik <strong>%s</strong> nie istnieje.',
	'FORK_TOPIC'			=> 'Kopiuj temat',
	'FULL_EDITOR'			=> 'Pełny edytor',

	'LINKAGE_FORBIDDEN'		=> 'Nie masz uprawnień do przeglądania, pobierania lub wstawiania odnośników z/do tej strony.',
	'LOGIN_NOTIFY_TOPIC'	=> 'Powiadomienie o tym temacie zostało ci dostarczone. Zaloguj się, aby go przejrzeć.',
	'LOGIN_VIEWTOPIC'		=> 'Aby przejrzeć ten temat, musisz się zalogować.',

	'MAKE_ANNOUNCE'				=> 'Zmień na ogłoszenie',
	'MAKE_GLOBAL'				=> 'Zmień na ogłosz. globalne',
	'MAKE_NORMAL'				=> 'Zmień na zwykły temat',
	'MAKE_STICKY'				=> 'Zmień na przyklejony',
	'MAX_OPTIONS_SELECT'		=> 'Maksymalna liczba opcji do wybrania: <strong>%d</strong>',
	'MAX_OPTION_SELECT'			=> 'Liczba opcji do wybrania: <strong>1</strong>',
	'MISSING_INLINE_ATTACHMENT'	=> 'Załącznik <strong>%s</strong> nie jest już dostępny',
	'MOVE_TOPIC'				=> 'Przenieś temat',

	'NO_ATTACHMENT_SELECTED'=> 'Nie wybrano załącznika do pobrania lub przeglądania.',
	'NO_NEWER_TOPICS'		=> 'Na tym forum nie ma nowszych tematów.',
	'NO_OLDER_TOPICS'		=> 'Na tym forum nie ma starszych tematów.',
	'NO_UNREAD_POSTS'		=> 'Na tym forum nie ma nowych nieprzeczytanych postów.',
	'NO_VOTE_OPTION'		=> 'Aby zagłosować musisz wybrać opcję.',
	'NO_VOTES'				=> 'Brak głosów',

	'POLL_ENDED_AT'			=> 'Czas głosowania minął %s',
	'POLL_RUN_TILL'			=> 'Czas głosowania minie %s',
	'POLL_VOTED_OPTION'		=> 'Oddano głos na tę opcję',
	'PRINT_TOPIC'			=> 'Podgląd wydruku',

	'QUICK_MOD'				=> 'Moderowanie',
	'QUICKREPLY'			=> 'Szybka odpowiedź',
	'QUOTE'					=> 'Cytuj',

	'REPLY_TO_TOPIC'		=> 'Odpowiedz w temacie',
	'RETURN_POST'			=> '%sPowrót do postu%s',

	'SHOW_QR'				=> 'Szybka odpowiedź',
	'SUBMIT_VOTE'			=> 'Wyślij',

	'TOTAL_VOTES'			=> 'Liczba głosów',

	'UNLOCK_TOPIC'			=> 'Odblokuj temat',

	'VIEW_INFO'				=> 'Szczegóły postu',
	'VIEW_NEXT_TOPIC'		=> 'Następny temat',
	'VIEW_PREVIOUS_TOPIC'	=> 'Poprzedni temat',
	'VIEW_RESULTS'			=> 'Pokaż wyniki',
	'VIEW_TOPIC_POST'		=> 'Posty: 1',
	'VIEW_TOPIC_POSTS'		=> 'Posty: %d',
	'VIEW_UNREAD_POST'		=> 'Pierwszy nieprzeczytany post',
	'VISIT_WEBSITE'			=> 'WWW',
	'VOTE_SUBMITTED'		=> 'Twój głos został zarejestrowany.',
	'VOTE_CONVERTED'		=> 'W skonwertowanych ankietach nie ma możliwości zmiany oddanego głosu.',


    // Post number in viewtopic
    'POST_DIRECT_LINK'		=> 'Bezpośredni link do postu:',
    
    // Quick edit
    'QUICKEDIT_POST_SHORT' => 'Szybka edycja',
    'FULLEDIT_POST_SHORT' => 'Pełna edycja',
    'QUICKEDIT_POST' => 'Szybka edycja postu',
    'FULLEDIT_POST' => 'Pełna edycja postu',
    
    // Unread post info
    'UNREAD_POST_INFO'  => 'Nieczytany post',
));

?>
