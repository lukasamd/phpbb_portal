<?php
/**
*
* @package phpBB Statistics
* @version $Id: stats.php 162 2010-12-11 13:29:18Z marc1706 $
* @copyright (c) 2009 - 2010 Marc Alexander(marc1706) www.m-a-styles.de, (c) TheUniqueTiger - Nayan Ghosh
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @based on: Forum Statistics by TheUniqueTiger - Nayan Ghosh
* @translator (c) ( Marc Alexander - http://www.m-a-styles.de ), TheUniqueTiger - Nayan Ghosh
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(	
	'STATS'								=> 'Statystyki phpBB',	
	'STATS_EXPLAIN'						=> 'Otwórz statystyki phpBB',
	'STATS_BASIC'						=> 'Podstawowe Statystyki',
	'STATS_BASIC_BASIC'					=> 'Podstawowe Statystki Forum',
	'STATS_BASIC_ADVANCED'				=> 'Zaawansowane Statystyki Forum',
	'STATS_BASIC_MISCELLANEOUS'			=> 'Pozostałe Statystyki',
	'STATS_ACTIVITY'					=> 'Aktywność Forum',
	'STATS_ACTIVITY_FORUMS'				=> 'Statystyki For',
	'STATS_ACTIVITY_TOPICS'				=> 'Statystyki Tematów',
	'STATS_ACTIVITY_USERS'				=> 'Statystyki Użytkowników',
	'STATS_CONTRIBUTIONS'				=> 'Zasoby Forum',
	'STATS_CONTRIBUTIONS_ATTACHMENTS'	=> 'Statystyki Załączników',
	'STATS_CONTRIBUTIONS_POLLS'			=> 'Statystyki Ankiet',
	'STATS_PERIODIC'					=> 'Statystyki Czasowe',
	'STATS_PERIODIC_DAILY'				=> 'Statystyki Dzienne',
	'STATS_PERIODIC_MONTHLY'			=> 'Statystyki Miesięczne',
	'STATS_PERIODIC_HOURLY'				=> 'Statystyki Godzinowe',
	'STATS_SETTINGS'					=> 'Statystyki Ustawień',
	'STATS_SETTINGS_BOARD'				=> 'Statystyki Ustawień Forum',
	'STATS_SETTINGS_PROFILE'			=> 'Statystyki Ustawień Profilu',
	'STATS_ADDONS'						=> 'Dodatki',
	'STATS_ADDONS_MISCELLANEOUS'		=> 'ukryj',
	'STATS_DISABLED'					=> ' są obecnie wyłączone',
	
	'TOTALS'							=> 'Wszystkich',
	'OVERALL'							=> 'Ogólne',
	'NONE'								=> 'Brak',
	'LIMIT_PROMPT'						=> 'Ilość %s do pokazania',
	'GB'								=> 'GB',
	'AS_ON'								=> 'Stan na %s',	
	'DAMAGED_ADDON'						=> 'Dodatek %1$s jest zepsuty. Następujące zmienne nie istnieją: %2$s. Skontaktuj się z autorem dodatku.',
	'ADDON_DISABLED'					=> 'Dodatek, który wybrałeś/aś jest wyłączony.<br /><br />',
	'ADDON_DISABLED_TITLE'				=> 'Dodatki wyłączone',
	'NO_ADDONS'							=> 'Brak zainstalowanych dodatków.<br /><br />',
	'NO_ADDONS_TITLE'					=> 'Nie zainstalowano dodatków',
	
	//basic stats
	'TOTAL_TOPICS'						=> 'Wszystkich tematów',
	'TOTAL_USERS'						=> 'Wszystkich użytkowników',
	'TOTAL_FORUM_CAT'					=> 'Wszystkich kategorii na forum',
	'TOTAL_FORUM_POST'					=> 'Wszystkich postów na forum',
	'TOTAL_FORUM_LINK'					=> 'Wszystkich linków na forum',
	'TOTAL_FORUMS'						=> 'Wszystkich działów',
	'TOTAL_ATTACHMENTS'					=> 'Wszystkich załączników',
	'TOTAL_POLLS'						=> 'Wszystkich ankiet',
	'TOTAL_VIEWS'						=> 'Wszystkich odsłon tematów',
	'TOPICS_GLOBAL'						=> 'Globalne tematy',
	'TOPICS_ANNOUNCE'					=> 'Ogłoszenia',
	'TOPICS_STICKY'						=> 'Przyklejone tematy',
	'TOPICS_NORMAL'						=> 'Zwykłe tematy',
	'TOPICS_UNAPPROVED'					=> 'Niezatwierdzone tematy',
	'UNAPPROVED_POSTS'					=> 'Niezatwierdzone posty',
	'USERS_INACTIVE'					=> 'Nieaktywni użytkownicy',
	'USERS_INACTIVE_EXPLAIN'			=> 'Użytkownicy którzy nie odwiedzili forum w ostatnich %d dniach',
	'USERS_ACTIVE'						=> 'Aktywni użytkownicy',
	'USERS_ACTIVE_EXPLAIN'				=> 'Użytkownicy którzy odwiedzili forum co najmniej raz w ostatnich %d dniach',
	'USERS_TOTAL_BOTS'					=> 'Zarejestrowanych botów',
	'USERS_VISITED_BOTS'				=> 'Wizyty botów',
	'AVG_FILES_DAY'						=> 'Średnia ilość załączników na dzień',
	'AVERAGES'							=> 'Średnie',
	//advanced stats
	'BOARD_BACKGROUND'					=> 'Tło forum',
	'START_DATE'						=> 'Start forum',
	'BOARD_AGE'							=> 'Wiek forum',
	'SECOND'							=> 'sekunda',
	'MINUTE'							=> 'minuta',
	'HOUR'								=> 'godzina',
	'MONTHS'							=> 'miesięcy',
	'YEARS'								=> 'lat',
	'BOARD_VERSION'						=> 'Wersja forum',
	'GZIP_COMPRESSION'					=> 'Kompresja GZip',
	'ON'								=> 'Włącz',
	'OFF'								=> 'Wyłącz',
	'DATABASE'							=> 'Baza danych',
	'DATABASE_SIZE'						=> 'Wielkość bazy danych',
	'DATABASE_INFO'						=> 'Informacje o bazie danych',
	'FILESYSTEM'						=> 'Pliki',
	'ATTACHMENTS_TOTAL'					=> 'Wszystkich załączników',
	'ATTACHMENTS_SIZE'					=> 'Rozmiar załączników',
	'AVATARS_TOTAL'						=> 'Wszystkich awatarów',
	'AVATARS_SIZE'						=> 'Rozmiar awatarów',
	'CACHED_FILES_TOTAL'				=> 'Pliki tymczasowe',
	'CACHED_FILES_SIZE'					=> 'Rozmiar plików tymczasowych',
	'INSTALLED_COMPONENTS'				=> 'Zainstalowane komponenty',
	'STYLES'							=> 'Style',
	'IMAGESETS'							=> 'Zestawy obrazków',
	'TEMPLATES'							=> 'Szablony',
	'THEMES'							=> 'Motywy',
	'LANG_PACKS'						=> 'Paczki językowe',
	'BY'								=> 'przez',
	'BOARD_VERSION_SECURE'				=> '3.x.x',
	'SORT_BY_PROMPT'					=> 'Sortuj informacje o zainstalowanych komponentach przez',
	
	// miscellaneous stats
	'SMILEY'							=> 'Uśmieszki',
	'SMILEY_COUNT'						=> 'Liczba zainstalowanych uśmieszków',
	'SMILEY_POST_COUNT'					=> 'Liczba wyświetlonych uśmieszków podczas pisania',
	'TOP_SMILIES_BY_URL'				=> '%d najpopularniejszych uśmieszków',
	'TOP_BBCODES'						=> '%d najpopularniejszych bbcodów',
	'TOP_ICONS'							=> '%d najpopularniejszych ikon tematów',
	'WARNING_COUNT'						=> 'Ilość ostrzeżeń',
	'OWN_WARNINGS_COUNT'				=> 'Ostrzeżenia osobiście otrzymane',
	'WARNINGS_PER_USER'					=> 'Ilość ostrzeżeń na użytkownika',
	'WARNINGS_PER_DAY'					=> 'Ilość ostrzeżeń na dzień',
	'BBCODE'							=> 'BBCody',
	'BBCODE_COUNT'						=> 'Ilość BBCodów',
	'BBCODE_COUNT_CUSTOM'				=> 'Ilość własnych BBCodów',
	'ICONS'								=> 'Ikony tematów',
	'COMPONENTS_NAME'					=> 'Nazwa',
	'COMPONENTS_ID'						=> 'ID',
	'COMPONENTS_AUTHOR'					=> 'Prawa autorskie/Autor',
	'RECOUNT_PROGRESS'					=> '<br />%1$d z %2$d postów zostały przetworzone. Proszę zaczekać, aż skrypt zostanie ukończony.<br /><br />',
	
	//activity - forums
	'COUNT'								=> 'Ilość',
	'PERCENT'							=> 'Procent',
	'TOP_FORUMS_BY_TOPICS'				=> '%d najpopularniejszych działów (tematy)',
	'TOP_FORUMS_BY_POSTS'				=> '%d najpopularniejszych działów (posty)',
	'TOP_FORUMS_BY_POLLS'				=> '%d najpopularniejszych działów (ankiety)',
	'TOP_FORUMS_BY_STICKY'				=> '%d najpopularniejszych działów (przyklejone tematy)',
	'TOP_FORUMS_BY_VIEWS'				=> '%d najpopularniejszych działów (wyświetleń)',
	'TOP_FORUMS_BY_PARTICIPATION'		=> '%d najpopularniejszych działów (aktywność użytkowników)',
	'TOP_FORUMS_BY_SUBSCRIPTIONS'		=> '%d najpopularniejszych działów (obserwowane)',
	//activity - topics
	'TOP_TOPICS_BY_POSTS'				=> '%d najpopularniejszych tematów (posty)',
	'TOP_TOPICS_BY_POSTS_PCT_EXPLAIN'	=> 'Przedstawiony procent jest procentem postów w temacie w stosunku do wszystkich postów.',
	'TOP_TOPICS_BY_POSTS_BAR_EXPLAIN'	=> 'Przedstawiony pasek jest dla porównania z tematem z największą liczbą postów.',
	'TOP_TOPICS_BY_VIEWS'				=> '%d najpopularniejszych tematów (wyświetleń)',
	'TOP_TOPICS_BY_VIEWS_PCT_EXPLAIN'	=> 'Przedstawiony procent jest procentem odwiedzin tematów w porównaniu do wszystkich wyświetleń tematów.',
	'TOP_TOPICS_BY_PARTICIPATION'		=> '%d najpopularniejszych tematów (aktywność użytkowników)',
	'TOP_TOPICS_BY_ATTACHMENTS'			=> '%d najpopularniejszych tematów (załączniki)',
	'TOP_TOPICS_BY_BOOKMARKS'			=> '%d najpopularniejszych tematów (zakładki)',
	'TOP_TOPICS_BY_SUBSCRIPTIONS'		=> '%d najpopularniejszych tematów (obserwowane)',
	//activity - users
	'MEMBERS'							=> 'Użytkownicy',
	'TOTAL_MEMBERS'						=> 'Wszystkich użytkowników',
	'TOTAL_REG_USERS'					=> 'Zarejestrowani użytkownicy',
	'MOST_ONLINE'						=> 'Najwięcej użytkowników (online)',
	'INCLUDING_BOTS'					=> 'łącznie z botami',
	'TOTAL_ONLINE'						=> 'Wszystkich online',
	'ONLINE_ON'							=> 'było',
	'TOTAL_HIDDEN'						=> 'Wszystkich ukrytych użytkowników online',
	'TOTAL_MEMBERS_ONLINE'				=> 'Wszystkich użytkowników online',
	'TOP_USERS_BY_POSTS'				=> '%d najaktywniejszych użytkowników (posty)',
	'TOP_USERS_BY_TOPICS'				=> '%d najaktywniejszych użytkowników (tematy)',
	'TOP_FRIENDS'						=> '%d najpopularniejszych przyjaciół',
	'TOP_FOES'							=> '%d najpopularniejszych wrogów',
	'TOP_USERS_BY_RECENT_POSTS'			=> '%d najaktywniejszych użytkowników (ostatnie posty z ostanich %2$d dni)',
	'RECENT_POSTS_DAYS_LIMIT_PROMPT'	=> 'Liczba dni która jest uwzględniona dla ostatnich postów',
	'WHO_IS_ONLINE_EXPLAIN'				=> 'oparte na użytkownikach aktywnych przez ostatnie %d minut',
	'RANKS_POSTS'						=> 'Rangi (Nie znaleziono rang specjalnych opierając się na postach)',
	'RANKS'								=> 'Rangi',
	'RANK_MIN_POSTS'					=> 'Minimalna ilość postów',
	'MEMBER_COUNT'						=> 'Ilość członków',
	'DELETED_USERS'						=> 'Usuniętych użytkowników',
	//contributions - attachments
	'ATTACHMENTS_ORPHAN'				=> 'Osierocone załączniki',
	'ATTACHMENTS_ORPHAN_SIZE'			=> 'Rozmiar osieroconych załączników',
	'ATTACHMENTS_OR_USERS'				=> 'Załączników/Użytkowników',
	'RECENT_ATTACHMENTS'				=> '%d ostatnich załączników',
	'ATTACH_ON'							=> 'załączony',
	'ATTACH_DETAILS'					=> 'Szczegóły',
	'TOP_ATTACHMENTS_BY_FILETYPE'		=> '%d najpopularniejszych załączników (rozszerzenie pliku)',
	'ATTACHMENT_FILETYPES'				=> 'Typ załączników',
	'TOP_ATTACHMENTS_BY_FILESIZE'		=> '%d najpopularniejszych załączników (rozmiar)',
	'TOP_ATTACHMENTS_BY_DOWNLOAD'		=> '%d najpopularniejszych załączników (pobieranych)',
	'TOP_USERS_BY_ATTACHMENTS'			=> '%d najaktywniejszych użytkowników (załączniki)',
	'TOTAL_DOWNLOADS'					=> 'Wszystkich pobranych plików',
	'TOTAL_DOWNLOADS_SIZE'				=> 'Rozmiar pobranych plików',
	//contributions - polls
	'TOTAL_OPEN_POLLS'					=> 'Wszystkich otwartych ankiet',
	'TOTAL_POLL_VOTES'					=> 'Wszystkich głosów w ankietach',
	'RECENT_POLLS'						=> '%d ostatnich ankiet',
	'POLLS'								=> 'Ankiety',
	'TOP_POLLS_BY_VOTES'				=> '%d najpopularniejszych ankiet (głosy)',
	'TOTAL_POLLS_VOTED'					=> 'Wszystkich ankiet w których głsowałeś(aś)',
	'TOTAL_ACCESSIBLE_POLLS'			=> 'Wszystkich dostępnych ankiet',
	//periodic - daily, monthly
	'PERIODIC_DAY'						=> 'Dzień',
	'PERIODIC_MONTH'					=> 'Miesiąc',
	'AVG_POSTS_DAY'						=> 'Postów na dzień',
	'AVG_TOPICS_DAY'					=> 'Tematów na dzień',
	'AVG_USER_REGS_DAY'					=> 'Rejestracji na dzień',
	'AVG_POSTS_MONTH'					=> 'Postów na miesiąc',
	'AVG_TOPICS_MONTH'					=> 'Tematów na miesiąc',
	'AVG_USER_REGS_MONTH'				=> 'Rejestracji na miesiąc',
	'TOTAL_USER_REGS'					=> 'Wszystkich rejestracji',
	'STATS_MONTH_EXPLAIN'				=> 'Statystyki są pokazywane dla miesiąca <strong>%s</strong>',
	'STATS_YEAR_EXPLAIN'				=> 'Statystyki są pokazywane dla roku <strong>%s</strong>',
	'USER_REGS'							=> 'Rejestracja użytkowników',
	'SHOW_STATS_FOR_MONTH'				=> 'Pokaż statystyki dla wybranego miesiąca',
	'SHOW_STATS_FOR_YEAR'				=> 'Pokaż statystyki dla wybranego roku',
	'ALL'								=> 'Wszystkie',
	//periodic- hourly
	'SELECT_TIME_PERIOD'				=> 'Wybierz przedział czasu',
	'PERCENT_OF_TOTAL'					=> '%% wszystkich for %s',
	'PERIODIC_HOUR'						=> 'Godzina',
	'HOURLY_STATS_EXPLAIN'				=> 'Pokazuje statystyki dla <strong>%s</strong>',
	//settings - board
	'OVERRIDE_STYLE_EXPLAIN'			=> 'Administrator forum ustawił opcję nadpisywania stylów użytkowników domyślnym stylem.',
	'DEFAULT_STYLE_EXPLAIN'				=> 'Domyślny styl to <strong>%1$s (%2$s)</strong> który jest nadpisany dla wszystkich użytkowników (łącznie z botami).',
	'STYLE'								=> 'Styl',
	'USERS_INCL_BOTS'					=> 'Użytkownicy używający tego stylu (łącznie z botami)',
	'LANGUAGES_BY_USERS'				=> 'Języki (bazuje na użytkownikach którzy ustawili język)',
	'LANGUAGE'							=> 'Język',
	'TIMEZONES_BY_USERS' 				=> 'Strefy czasowe (bazuje na użytkownikach którzy ustawili strefę czasową)',
	'TIMEZONE'							=> 'Strefa czasowa',
	'LEGEND_BOLD_ITALIC'				=> 'Elementy wyróżnione pogrubioną czcionką oznaczają maksimum dla danej grupy. Elementy wyróżnione pochyłą czcionką oznaczają grupę do której należysz.',
	'SINGLE_LANG_EXPLAIN'				=> 'Zainstalowany jest tylko jeden pakiet językowy, który używany jest przez wszystkich użytkowników.',
	'DEFAULT_LANG_EXPLAIN'				=> 'Domyślny język to <strong>%1$s (%2$s)</strong>.',
	//settings - profile
	'AGE_RANGES'						=> 'Ilość użytkowników ze względu na przedział wiekowy',
	'AGE_RANGE'							=> 'Przedział wiekowy',
	'SEL_AGE_INTERVAL_PROMPT'			=> 'Wybierz przedział wiekowy',
	'USERS_WITH_BIRTHDAY'				=> 'Użytkownicy którzy ustawili urodziny',
	'USERS_WITH_LOCATION'				=> 'Użytkownicy którzy ustawili miejscowość',
	'USER_LOCATIONS'					=> 'Miejscowość',
	'TOP_USER_LOCATIONS'				=> '%d najpopularniejszych miejscowości',
	'CUSTOM_PROFILE_FIELD'				=> 'Własne pola profilu',
	'CPF_TOP_X'							=> '%1$d najpopularniejszych %2$s',
	'TOTAL_VALUES_SET_PROMPT'			=> 'Wszystkich użytkowników którzy ustawili %s',
	'DEFAULT'							=> 'domyślny',
	
	// viewonline
	'VIEWING_STATS'						=> 'Przegląda Statystyki phpBB',
	
	// Error message
	'STATS_NOT_ENABLED'					=> 'Statystyki phpBB są obecnie wyłączone.',
));
?>