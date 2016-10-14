<?php
/**
*
* @package phpBB Statistics
* @version $Id: install_stats.php 162 2010-12-11 13:29:18Z marc1706 $
* @copyright (c) 2009 - 2010 Marc Alexander(marc1706) www.m-a-styles.de
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @based on: Board3 Portal Installer (www.board3.de)
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

$lang = array_merge($lang, array(
	'INSTALL_CONGRATS_EXPLAIN'		=> 	'<p>Statystyki phpBB wersja %s zostały zainstalowane pomyślnie<br/><br/><strong>Przed użyciem forum zmień nazwę, przenieś lub usuń katalog instalacyjny „install/”. W innym przypadku dostępny będzie tylko panel administracji (PA).</strong></p>',
	'INSTALL_INTRO_BODY'			=> 	'Witamy w instalatorze Statystyk phpBB dla Twojego forum.',

	'MISSING_CONSTANTS'			=> 	'Przed uruchomienie skryptu instalacyjnego, musisz przesłać edytowanr pliki, zwłaszcza /includes/constants.php.',
	'MODULES_CREATE_PARENT'		=> 	'Utwórz standardowy moduł rodzica',
	'MODULES_PARENT_SELECT'		=> 	'Wybierz moduł rodzica',
	'MODULES_SELECT_4ACP'		=> 	'Moduł rodzica dla panelu administracji (PA)',
	'MODULES_SELECT_NONE'		=> 	'Brak modułu rodzica',

	'STAGE_ADVANCED_EXPLAIN'        =>  'Moduły Statystyk phpBB nie zostały utworzone.',
	'STAGE_CREATE_TABLE_EXPLAIN'	=> 	'Tabele Statystyk phpBB zostały utworzone w bazie danych i uzupełnione podstawowymi danymi. Przejdź do następnego kroku aby zakończyć instalację Statystyk phpBB.',
	'STAGE_ADVANCED_IN_PROGRESS'	=> 	'BBCody i Uśmieszki w postach są obecnie zliczane. Może to chwilę potrwać a strona będzie się odswieżać automatycznie co 5 sekund.<br />Prosimy zachować cierpliwość i pozwolić ukończyć skrypt.',
	'STAGE_ADVANCED_SUCCESSFUL'		=> 	'Utworzono moduł Statystyk phpBB. Przejdź dalej aby zakończyć instalację Statystyk phpBB.',
	'STAGE_UNINSTALL'				=> 	'Odinstaluj',

	'FILES_EXISTS'				=> 	'Plik nadal istnieje',
	'FILES_OUTDATED'			=> 	'Nieaktualne pliki',
	'FILES_OUTDATED_EXPLAIN'	=> 	'<strong>Nieaktualne pliki</strong> - usuń te pliki aby uniknąć problemów z bezpieczeństwem.',
	'FILES_CHANGE'				=> 	'Plik został zmieniony wraz z obecnym wydaniem',
	'FILES_CHANGED'				=> 	'Zmienione pliki',
	'FILES_CHANGED_EXPLAIN'	=> 	'<strong>Zmienione pliki</strong> - upewnij się, że skopiowałeś zmienione pliki do swojego forum.',
	'REQUIREMENTS_EXPLAIN'		=> 	'Usuń nieaktualne pliki ze swojego serwera przed dokonaniem aktualizacji.',
	'NOT_REQUIREMENTS_EXPLAIN'	=> 	'Nie znaleziono nieaktualnych plików. Możesz rozpocząć aktualizację.',

	'UPDATE_INSTALLATION'			=> 	'Aktualizacja Statystyk phpBB',
	'UPDATE_INSTALLATION_EXPLAIN'	=> 	'Ta opcja zaktualizuje Statystyki phpBB do bierzącej wersji.',
	'UPDATE_CONGRATS_EXPLAIN'		=> 	'<p>Uaktualniłeś Statystyki phpBB pomyślnie do wersji %s<br/><br/><strong>Teraz usuń, przenieś lub zmień nazwę katalogu "install" przed użyciem forum. Tak długo, jak ten folder będzie się istniał, będziesz miał dostęp tylko do panelu administracji (PA).</strong></p>',
 	
	'UNINSTALL_INTRO'				=> 	'Witamy na stronie deistalacji',
	'UNINSTALL_INTRO_BODY'			=> 	'Ten program instalacyjny poprowadzi Cię przez proces deinstalacji Statystyk phpBB z Twojego forum phpBB.',
	'CAT_UNINSTALL'					=> 	'Odinstaluj',
	'UNINSTALL_CONGRATS'			=> 	'<h1>Usunięto Statystyki phpBB.</h1>
									Pomyślnie odinstalowałeś Statystyki phpBB.',
	'UNINSTALL_CONGRATS_EXPLAIN'	=> 	'<strong>Teraz usuń, przenieś lub zmień nazwę katalogu "install" przed użyciem forum. Tak długo, jak ten folder będzie się istniał, będziesz miał dostęp tylko do panelu administracji (PA)<br /><br />Upewnij się, że usunąłeś pliki edytowane z forum i odwróciłeś wszystkie zmiany w bazowych plikach phpBB.</strong></p>',
 
	'SUPPORT_BODY'		=> 	'Wsparcie dla najnowszej wersji Statystyk phpBB jest dostępne bezpłatnie dla:</p><ul><li>Instalacji</li><li>Kwestii technicznych</li><li>Kwestie związanych z programem</li><li>Aktualizacji statystk lub wersji beta do najnowszej wersji phpBB Statistics</li></ul><p>Wsparcie znajdziesz na forum:</p><ul><li><a href="http://www.m-a-styles.de/"></a></li><li><a href="http://www.phpbb.de/">phpbb.de</a></li><li><a href="http://www.phpbb.com/">phpbb.com</a></li><li><a href="http://www.bbcode.pl/">bbcode.pl</a></li></ul><p>',
	'GOTO_INDEX'		=> 	'Przejdź do strony głównej',
	'GOTO_STATS'		=> 	'Przejdź do Statystyk phpBB',
	'UNSUPPORTED_DB'	=>	'Przepraszamy, odnaleziono niewspieraną bazę danych',
	'UNSUPPORTED_VERSION' => 'Przepraszamym, odnaleziono niewspieraną wersję',
	
));

?>