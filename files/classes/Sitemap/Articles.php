<?php


class Sitemap_Articles extends Sitemap
{
    private $cat = 0;

    public function __construct()
    {
        parent::__construct();

        define('MODULE', 'sitemap_articles');
        $this->Model = new Model_Article();
    }
    

    public function execute()
    {
        $this->cat = Input::get('cat', 0);
        
        if ($this->cat)
        {
            $this->generateArticlesSitemap();
        }
        else
        {
            $this->generateCatsSitemap();  
        }
        
    }
    
    
    private function generateCatsSitemap()
    {
        $urls = Registry::get('URLs');
        $view = Registry::get('Theme');
    
        $content = new DOMDOcument("1.0", "UTF-8");
        $xml_sitemapindex = $content->createElement('sitemapindex');
        $xml_sitemapindex->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $content->appendChild($xml_sitemapindex);
    
        $this->Model->getSitemapCats();
        if (!$this->Model->numRows())
        {
            $view->outputMessage('404');
        }
        
        while ($row = $this->Model->fetchResultDB())
        {
            $urls->newUrl('index.php');
            $urls->addToUrl('module', 'Sitemap_Articles');
            $urls->addToUrl('cat', $row['cat_id']);
            $cat_url = Config::getConfig('portal_url') . htmlentities($urls->getUrl());
        
            $xml_sitemap = $content->createElement('sitemap');
            
            $xml_loc = $content->createElement('loc', $cat_url);
            $xml_lastmod = $content->createElement('lastmod', date('c', $row['maxTime']));
            
            $xml_sitemap->appendChild($xml_loc);
            $xml_sitemap->appendChild($xml_lastmod);
            
            $xml_sitemapindex->appendChild($xml_sitemap);
        }
        
        $content = $content->saveXML();
        $view->outputXML($content);
    }
    
    
    private function generateArticlesSitemap()
    {
        $urls = Registry::get('URLs');
        $view = Registry::get('Theme');
    
        $content = new DOMDOcument("1.0", "UTF-8");
        $xml_urlset = $content->createElement('urlset');
        $xml_urlset->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $content->appendChild($xml_urlset);
    
        $this->Model->getSitemapFromCat($this->cat);
        if (!$this->Model->numRows())
        {
            $view->outputMessage('404');
        }
        
        while ($row = $this->Model->fetchResultDB())
        {
            $url = Config::getConfig('portal_url') . $urls->buildUrl('article', $row);
        
            $xml_url = $content->createElement('url');
            
            $xml_loc = $content->createElement('loc', $url);
            $xml_lastmod = $content->createElement('lastmod', date('c', $row['time']));
            $xml_priority = $content->createElement('priority', '0.2');
            
            $xml_url->appendChild($xml_loc);
            $xml_url->appendChild($xml_lastmod);
            $xml_url->appendChild($xml_priority);
            
            $xml_urlset->appendChild($xml_url);
        }
        
        $content = $content->saveXML();
        $view->outputXML($content);
    }
}