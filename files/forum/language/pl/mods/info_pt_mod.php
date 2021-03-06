<?php
/**
 *
 * @author RmcGirr83 (Rich McGirr)
 * @version $Id$
 * @copyright (c) 2011 phpbbmodders.net
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
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
	'INSTALL_PT_MOD'			=> 'Install Posting Template Mod',
	'PT_NOTHING_TO_UPDATE'		=> 'Nothing to do',
	'PT_FORUM_TABLE_UPDATED'	=> 'The forum table has been updated',
	'PT_DB_ENTRY_REMOVED'		=> 'The database column has been removed',
	'FORUM_POST_TPL'					=> 'Posting template',
	'FORUM_POST_TPL_EXPLAIN'			=> 'The posting template is the text that appears in the textarea when starting a new topic in this forum. If you don’t wish to use it, just leave it blank.',	
));

?>