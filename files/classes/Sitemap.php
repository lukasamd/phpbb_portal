<?php
abstract class Sitemap
{
    public function __construct()
    {
        $this->Registry = Loader::load('Registry');
    }
}