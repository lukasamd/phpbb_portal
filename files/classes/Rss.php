<?php
abstract class Rss
{
    public function __construct()
    {
        $this->Registry = Loader::load('Registry');
    }
}