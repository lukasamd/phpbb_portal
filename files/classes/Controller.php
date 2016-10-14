<?php
abstract class Controller
{
    protected $Model;
    protected $id;

	public function __construct()
	{
        $this->Registry = Loader::load('Registry');
	}
  
    public function setId($id)
    {
        $this->id = (int) $id;
    }
}