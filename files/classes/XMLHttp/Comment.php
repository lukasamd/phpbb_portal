<?php
if (!defined('IN_PHPBB')) exit;

class XMLHttp_Comment extends XMLHttp
{
	
	public function __construct()
	{
		parent::__construct();
		define('MODULE', 'comment');
	}


	public function execute()
	{
		$action = $this->Registry->Input->get('action', '');
		
		
		switch ($action)
		{
		  case 'add':
		    $comments = new Comments();
		    $comments->setItem($this->Registry->Input->get('commentItemId', 0));
			$comments->setAjax(true);
		    
		    $comments->insertComment();
		  break;
		  
		  case 'report':
		    $comments = new Comment_Report();
		    $comments->setComment($this->Registry->Input->get('commentItemId', 0));
			$comments->setAjax(true);
		    
		    $comments->execute();
		  break;
		  
		  
		  default:
		  break;
		}
	}
}


		