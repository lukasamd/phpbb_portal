# phpBB 3.0 Portal

This is portal / CMS based on phpBB 3.0. Created for SafeGroup.pl website, but discontinued. It's working, but some modules can be broken and installation required few manual steps. Portal has:

* Integrated forum (phpBB 3.0.x)
* Content types (default is one type)
* Content categories
* Ajax comments for users and guests with reporting
* Tags
* Sitemap generator
* Polls
* RSS
* ACL (privilages) based on phpBB
* Antispam - build-in hidden fields and Akismet
* Password generator module
* SEO-Friendly (URL, canonical, meta tags, 301 redirects)
* Search module + experimental FULLTEXT based search 
* phpBB-based templates
* Simple websockets chat
* Psuedo-MWC structure with Registry 

# Installation

* Upload all files to server
* Make domain for forum and create subdomain for portal
* Upload database
* change cookie settings (domain) in forum_config table to forum domain
* change portal_url in forum_config table to portal URL
* change server_name in forum_config table to forum domain
* change database settings connection in forum/config.php file
* generate and update password, email etc. for user "test" in forum_users table