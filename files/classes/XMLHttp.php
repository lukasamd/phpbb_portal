<?php
abstract class XMLHttp
{
	public function __construct()
	{

		$this->Registry = Loader::load('Registry');
	}
}