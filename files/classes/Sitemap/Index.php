<?php

class Sitemap_Index extends Sitemap
{
    public function __construct()
    {
        parent::__construct();

        define('MODULE', 'sitemap_index');
    }
    
    public function execute()
    {
        $urls = Registry::get('URLs');
        $view = Registry::get('Theme');
    
        $content = new DOMDOcument("1.0", "UTF-8");
        $xml_sitemapindex = $content->createElement('sitemapindex');
        $xml_sitemapindex->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $content->appendChild($xml_sitemapindex);

        $this->Model = new Model_News();
        $this->Model->getSitemapCats();
        if ($this->Model->numRows())
        {
            $row = $this->Model->fetchResultDB();
            $urls->newUrl('index.php');
            $urls->addToUrl('module', 'Sitemap_News');
            $url = Config::getConfig('portal_url') . htmlentities($urls->getUrl());
            
            $xml_sitemap = $content->createElement('sitemap');
            
            $xml_loc = $content->createElement('loc', $url);
            $xml_lastmod = $content->createElement('lastmod', date('c', $row['maxTime']));
            
            $xml_sitemap->appendChild($xml_loc);
            $xml_sitemap->appendChild($xml_lastmod);
            
            $xml_sitemapindex->appendChild($xml_sitemap);
        }
        
        $this->Model = new Model_Article();
        $this->Model->getSitemapCats();
        if ($this->Model->numRows())
        {
            $row = $this->Model->fetchResultDB();
            $urls->newUrl('index.php');
            $urls->addToUrl('module', 'Sitemap_Articles');
            $url = Config::getConfig('portal_url') . htmlentities($urls->getUrl());
            
            $xml_sitemap = $content->createElement('sitemap');
            
            $xml_loc = $content->createElement('loc', $url);
            $xml_lastmod = $content->createElement('lastmod', date('c', $row['maxTime']));
            
            $xml_sitemap->appendChild($xml_loc);
            $xml_sitemap->appendChild($xml_lastmod);
            
            $xml_sitemapindex->appendChild($xml_sitemap);
        }
        
        $this->Model = new Model_Program();
        $this->Model->getSitemapCats();
        if ($this->Model->numRows())
        {
            $row = $this->Model->fetchResultDB();
            $urls->newUrl('index.php');
            $urls->addToUrl('module', 'Sitemap_Programs');
            $url = Config::getConfig('portal_url') . htmlentities($urls->getUrl());
            
            $xml_sitemap = $content->createElement('sitemap');
            
            $xml_loc = $content->createElement('loc', $url);
            $xml_lastmod = $content->createElement('lastmod', date('c', $row['maxTime']));
            
            $xml_sitemap->appendChild($xml_loc);
            $xml_sitemap->appendChild($xml_lastmod);
            
            $xml_sitemapindex->appendChild($xml_sitemap);
        }
        
        $content = $content->saveXML();
        $view->outputXML($content);
    }
}