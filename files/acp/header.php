<?php
if (!defined('IN_PHPBB')) exit;
SAC::checkPageAccess('u_sg_portal_acp');


// Check access level
require_once DIR_INCLUDES . 'functions_admin.php';
$theme    = Loader::load("Theme");
$urls     = Loader::load("URLs");
$Registry = Loader::load('Registry');


ob_start();
?><!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel Administracyjny</title>
    <base href="<?php echo DIR_ACP; ?>" />

    <link rel="stylesheet" href="<?php echo DIR_THEME; ?>jquery-ui-1.9.1.custom.min.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo DIR_THEME; ?>jMenu.jquery.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo DIR_THEME; ?>styles-admin.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo DIR_THEME; ?>jquery.fancybox.css" type="text/css" />
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src=<?php echo DIR_THEME; ?>jquery.min.js">\x3C/script>')</script>
    <script src="<?php echo DIR_THEME; ?>jquery-ui-1.9.1.custom.min.js"></script>
    <script src="<?php echo DIR_THEME; ?>jMenu.jquery.min.js"></script>
    <!-- <script src="<?php echo DIR_THEME; ?>jquery.fancybox.js"></script> -->
    <script src="<?php echo DIR_THEME; ?>ckeditor/ckeditor.js"></script>
    <script src="https://d1n0x3qji82z53.cloudfront.net/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>

    <script>
        var DIR_IMAGES = '<?php echo DIR_IMAGES; ?>';
    </script>
    

    <script src="<?php echo DIR_THEME; ?>sg_admin.js"></script>
    

     
    <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
    <div class="ajax_loading"></div>
    <div id="container">
        <div class="top">
            <a href="<?php echo URLs::ACP('main'); ?>" class="logo">Panel administracyjny</a>
            <ul id="admin-top-nawigacja">
                <li><a href="<?php echo URL_SITE; ?>">Portal</a></li>
                <li><a href="<?php echo URL_FORUM; ?>">Forum</a></li>
                <li><a href="<?php echo append_sid("{$phpbb_root_path}ucp.$phpEx", 'mode=logout', true, $user->session_id); ?>">Wyloguj</a></li>
            </ul>
        </div>
        
        
<ul id="jMenu">
	<li><a href="<?php echo URLs::ACP('main'); ?>" class="fNiv">Strona główna</a></li>


    <li><a href="<?php echo URLs::ACP('content_list'); ?>">Artykuły</a></li>  
    
    <li><a href="<?php echo URLs::ACP('categories'); ?>">Kategorie</a></li>  

    
    <li><a href="<?php echo URLs::ACP('sections'); ?>" class="fNiv">Sekcje</a></li>
	
	
	<li><a class="fNiv" href="<?php echo URLs::ACP('comments'); ?>">Komentarze</a>
		<ul>
			<li class="arrow"></li>
            <li><a href="<?php echo URLs::ACP('comments'); ?>">Komentarze</a></li>
            <li><a href="<?php echo URLs::ACP('comments', array('action=reported')); ?>">Raporty</a></li>
            <li><a href="<?php echo URLs::ACP('censor'); ?>">Cenzor słów</a></li>      
		</ul>
	</li>
    
    <li><a href="<?php echo URLs::ACP('polls'); ?>" class="fNiv">Ankiety</a></li>
	<!--
    <li><a href="<?php echo URLs::ACP('konkurs'); ?>" class="fNiv">Konkursy</a></li>
	
    <li><a class="fNiv">Inne moduły</a>
		<ul>
			<li class="arrow"></li>
            <li><a href="<?php echo URLs::ACP('forum_pages'); ?>">Strony forum</a></li>
            <li><a href="index'); ?>">Kokpit - Statystyki</a></li>
            <li><h3>Programy</h3></li>
            <li><a href="<?php echo URLs::ACP('programs'); ?>">Programy</a></li>  
            <li><a href="<?php echo URLs::ACP('programsCats'); ?>">Programy - Kategorie</a></li>   
            <li><a href="<?php echo URLs::ACP('companies'); ?>">Baza firm</a></li>  
            <li><h3>Download</h3></li>
            <li><a href="<?php echo URLs::ACP('files'); ?>">Pliki</a></li>   
            <li><a href="<?php echo URLs::ACP('files_check'); ?>">Pliki - Sprawdzanie</a></li>
            <li><h3>Screeny</h3></li>
            <li><a href="<?php echo URLs::ACP('galleries'); ?>">Galerie screenów</a></li>
      
		</ul>
	</li> -->
    
    
    
    <li><a href="<?php echo URLs::ACP('panels'); ?>" class="fNiv">Panele</a></li>
    <li><a href="<?php echo URLs::ACP('settings'); ?>">Konfiguracja</a></li> 
</ul>       

<div class="sideCenter">