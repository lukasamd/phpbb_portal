<?php

class Controller_Chat extends Controller
{

    public function __construct()
    {
        parent::__construct();
        
        define('MODULE', 'chat');
    }

    public function execute()
    {
	$view = Registry::get('Theme');
        $view->tpl->set_filenames(array('body' => 'chat.html'));
        $view->tpl->display('body');
        $view->renderPage();
    }
    
}

