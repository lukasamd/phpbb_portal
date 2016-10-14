<?php
if (!defined('IN_PHPBB')) exit;

/*
* Directories
*
*/
define('DIR_INCLUDES', DIR_BASE . 'includes/');
define('DIR_PANELS', DIR_BASE . 'panels/');
define('DIR_ACP', DIR_BASE . 'acp/');

define('DIR_IMAGES', DIR_BASE . 'images/uploads/');
define('DIR_ICONS', '/' . DIR_BASE . 'images/icons/');
define('DIR_SCREENSHOTS', DIR_BASE . 'images/screenshots/');
define('DIR_THEME', DIR_BASE . 'theme/');
define('DIR_FILES', DIR_BASE . 'downloads/');
define('DIR_TEMPLATES', DIR_BASE . 'templates/');


/*
* Database tables
*
*/
define('DB_PREFIX', 'portal_');
define('DB_POLLS', DB_PREFIX . 'polls');
define('DB_POLLS_OPTIONS', DB_PREFIX . 'polls_options');
define('DB_POLLS_VOTES', DB_PREFIX . 'polls_votes');
define('DB_COMPANIES', DB_PREFIX . 'companies');
define('DB_SOFTWARE', DB_PREFIX . 'programs');
define('DB_SOFTWARE_CATS', DB_PREFIX . 'programs_cats');
define('DB_FILES', DB_PREFIX . 'files');
define('DB_CONTENT', DB_PREFIX . 'content');
define('DB_CONTENT_AUTHORS', DB_PREFIX . 'content_authors');
define('DB_CATEGORIES', DB_PREFIX . 'categories');
define('DB_CATEGORIES_RELATIONSHIPS', DB_PREFIX . 'categories_relationships');
define('DB_CENSOR', DB_PREFIX . 'censor');
define('DB_COMMENTS', DB_PREFIX . 'comments');
define('DB_PAGES', DB_PREFIX . 'pages');
define('DB_PHOTOS', DB_PREFIX . 'photos');
define('DB_ALBUMS', DB_PREFIX . 'albums');
define('DB_PANELS', DB_PREFIX . 'panels');
define('DB_WEBLINKS','portal_weblinks');
define('DB_NEWSLETTER_QUEUE', DB_PREFIX . 'newsletter_queue');
define('DB_SECTIONS','portal_sections');
define('DB_TAGS', DB_PREFIX . 'tags');
define('DB_TAGS_RELATIONSHIPS', DB_PREFIX . 'tags_relationships');
define('DB_URLS', DB_PREFIX . 'urls');

/*
* URLS
*
*/
define('URL_SITE', Config::getConfig('portal_url'));
define('URL_FORUM', 'http://' . Config::getConfig('server_name'));


/*
* Other settings
*
*/
define('FILE_SELF', $_SERVER['PHP_SELF']);
define('FILE_REQUEST', $_SERVER['REQUEST_URI']);

define('TIME_NOW', time());

