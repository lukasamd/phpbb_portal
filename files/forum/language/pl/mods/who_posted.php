<?php
/**
*
* Who posted [ Polish ]
*
* @package who_posted
* @version $Id$
* @copyright (c) 2007, 2008 evil3
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
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

$lang = array_merge($lang, array(
	'WHOPOSTED_TITLE'	=> 'Kto odpowiedział?',
	'WHOPOSTED_EXP'		=> 'To jest lista wszystkich użytkowników, którzy napisali w tym temacie.',
	'WHOPOSTED_SHOW'	=> 'Pokaż temat',
	'WHOPOSTED_OR'		=> 'lub',
));

?>