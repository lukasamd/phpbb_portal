<?php
/**
*
* @package phpBB Statistics
* @version $Id: stats_test.php 162 2010-12-11 13:29:18Z marc1706 $
* @copyright (c) 2009 - 2010 Marc Alexander(marc1706) www.m-a-styles.de, (c) TheUniqueTiger - Nayan Ghosh
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @based on: Forum Statistics by TheUniqueTiger - Nayan Ghosh
* @translator (c) ( Marc Alexander - http://www.m-a-styles.de ), TheUniqueTiger - Nayan Ghosh
*/

if (!defined('IN_PHPBB') || !defined('IN_STATS_MOD'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}


/*	Example:
$lang = array_merge($lang, array(	
	'STATS'								=> 'Statystyki phpBB',	

));
*/

$lang = array_merge($lang, array(	
	'STATS_TEST'				=> 'Test',
	'STATS_TEST_EXPLAIN'		=> 'To jest tylko testowy dodatek',
	'STATS_TEST_SHOW'			=> 'Pokaż testowy dodatek (nic nie robi)',
	'STATS_TEST_SHOW_EXPLAIN' 	=> 'To naprawdę nic nie robi',
	'INFO'						=> 'Ten dodatek jest tylko do celów testowych. Można go usunąć, jeśli masz już dodany dodatek.',
));
?>