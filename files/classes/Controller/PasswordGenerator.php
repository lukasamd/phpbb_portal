<?php
class Controller_PasswordGenerator extends Controller
{
	public function __construct()
	{
		parent::__construct();
		define('MODULE', 'passwordGenerator');
	}
	
	public function execute()
	{	
    $view = Registry::get('Theme');
    
		$view->setMeta('title', 'Generator haseł');
		$view->setMeta('description', '');
		$view->setMeta('canonical', 'generator-hasel.html');
		$view->setOption('panels', 'passwordGenerator');
		
		
		$errors = array();
		$countErrors = 0;
		$generate = Input::get('generate', '');
		$password = array(
			'length' => Input::get('length', 8), 
			'types' => isset($_POST['chars']) ? count($_POST['chars']) : 0,
			'password' => '',  
		);
		
		$checkedList = array(
		  'upper' => true,
		  'lower' => true,
		  'numeric' => true,
		  'punctuation' => false,
		  'special' => false,
		);
		
		
		if ($generate)
		{
		  $chars = array();
		  $checkedList = array();
		 
		  // Sprawdzanie poprawnosci wpisanego hasla
		  if (($password['length'] == 0) || ($password['length'] > 255))
		  {
		    $errors[] = 'Niepoprawna długość hasła!<br />';  
		  }
		  if ($password['types'] == 0)
		  {
		    $errors[] = 'Nie podano żadnego zbioru danych!'; 
		  }
		  
		  
		  // START - Generowanie tablicy zawierajacej wszystkie wymagane kody ASCII  
		  if (!$countErrors = count($errors))
		  {
		    $tempChars = array(
		      'upper' => array('Q', 'W', 'E', 'R', 'T', 'Y', 'U', 'I', 'O', 'P', 'A', 'S', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'Z', 'X', 'C', 'V', 'B', 'N', 'M'),
		      'lower' => array('q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p', 'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'z', 'x', 'c', 'v', 'b', 'n', 'm'),
		      'numeric' => array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0'),
		      'punctuation' => array('.', ',', ':', ';', '!', '?', '-', '_', '[', ']', '(', ')', '{', '}'),
		      'special' => array('@', '#', '$', '%', '^', '*', '+', '=', '/', '\\'),
		    );
		    
		    foreach ($_POST['chars'] as $key => $val)
		    {
		      $checkedList[$key] = true;
		      $chars = array_merge($chars, $tempChars[$key]); 
		    }
		    unset($tempChars);
		    // END - Generowanie tablicy zawierajacej wszystkie wymagane kody ASCII       
		  
		    $password['types'] = count($chars) - 1;
		    for ($i = 0; $i < $password['length']; $i++)
		    {
		      $password['password'] .= $chars[rand(0, $password['types'])]; 
		    } 
		  }
		}
		
		
		
		$view->tpl->assign_vars(array(
			'CHECK_UPPER' => isset($_POST['chars']['upper']),
			'CHECK_LOWER' => isset($_POST['chars']['lower']),
			'CHECK_SPECIAL' => isset($_POST['chars']['special']),
			'CHECK_NUMERIC' => isset($_POST['chars']['numeric']),
			'CHECK_PUNCTUATION' => isset($_POST['chars']['punctuation']),
			'LENGTH' => $password['length'],
			'PASSWORD' => $password['password'], 
			'GENERATE_DONE' => (!$countErrors && $password['password'] != ''), 
			'GENERATE_ERROR' => $countErrors, 		
		));
		
		foreach ($errors as $error)
		{
		  $view->tpl->assign_block_vars('error', array(
		    'INFO' => $error,
		  )); 
		}
		
		$view->tpl->set_filenames(array('body' => 'page_password_generator.html'));
		$view->tpl->display('body');
		
		$view->renderPage();
	}
}