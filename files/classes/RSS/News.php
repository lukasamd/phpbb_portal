<?php


class Rss_News extends Rss
{
    public function __construct()
    {
        parent::__construct();

        define('MODULE', 'rss_news');
        $this->Model = new Model_News();
    }
    

    public function execute()
    {
        $urls       = Registry::get('URLs');
        $view       = Registry::get('Theme');
    
        $maxTime = $this->Model->getMaxPublicTime();
        $content = new DOMDOcument("1.0", "UTF-8");

        $xml_rss = $content->createElement('rss');
        $xml_rss->setAttribute('version', '2.0');
        $content->appendChild($xml_rss);

        $xml_channel = $content->createElement('channel');
        $xml_rss->appendChild($xml_channel);
        
        $xml_row = $content->createElement('generator', 'RSS Generator');
        $xml_channel->appendChild($xml_row);
        
        $xml_row = $content->createElement('title', Config::getConfig('portal_name') . ' - Aktualności');
        $xml_channel->appendChild($xml_row);
        
        $xml_row = $content->createElement('link', Config::getConfig('portal_url'));
        $xml_channel->appendChild($xml_row);
        
        $xml_row = $content->createElement('description');
        $xml_channel->appendChild($xml_row);
        
        $xml_row = $content->createElement('language', 'pl');
        $xml_channel->appendChild($xml_row);
        
        $xml_row = $content->createElement('pubDate', date('r', $maxTime));
        $xml_channel->appendChild($xml_row);

        $this->Model->getNewsRss();
        while ($row = $this->Model->fetchResultDB())
        {
            $title = stripslashes($row['title']);
            $url = Config::getConfig('portal_url') . $urls->buildUrl('news', $row);
            $meta = htmlspecialchars(mb_substr(stripslashes(strip_tags($row['content'])), 0, 400));
            
            $xml_item = $content->createElement('item');
            $xml_guid = $content->createElement('guid', $url);
            $xml_guid->setAttribute('isPermaLink', 'false');
            
            $xml_row = $content->createElement('title', $title);
            $xml_item->appendChild($xml_row);
            
            $xml_row = $content->createElement('link', $url);
            $xml_item->appendChild($xml_row);
            
            $xml_row = $content->createElement('description', $meta);
            $xml_item->appendChild($xml_row);
            
            $xml_row = $content->createElement('category', 'Newsa');
            $xml_item->appendChild($xml_row);
            
            $xml_row = $content->createElement('author', 'administracja@jacenter.pl (Administracja Jagged-Alliance.pl)');
            $xml_item->appendChild($xml_row);
            
            $xml_row = $content->createElement('pubDate', date('r', $row['time']));
            $xml_item->appendChild($xml_row);


            $xml_channel->appendChild($xml_item);
        }
        
        $content = $content->saveXML();
        $view->outputXML($content);
    }
}