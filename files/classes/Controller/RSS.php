<?php

class Controller_RSS extends Controller
{

    public function __construct()
    {
        parent::__construct();
        
        define('MODULE', 'content');
    }

    public function execute()
    {
        $urls = Registry::get('URLs');
        $view = Registry::get('Theme');
        $model = Registry::get('Model');

        $model->Content->setOptions(array('limit' => 10));
        $contents = $model->Content->getContent();
        if (empty($contents))
        {
            $view->outputMessage('404');
        }

        $public_time = 0;
        $output = new DOMDOcument("1.0", "UTF-8");

        $xml_rss = $output->createElement('rss');
        $xml_rss->setAttribute('version', '2.0');
        $output->appendChild($xml_rss);

        $xml_channel = $output->createElement('channel');
        $xml_rss->appendChild($xml_channel);
        
        $xml_row = $output->createElement('generator', 'RSS Generator');
        $xml_channel->appendChild($xml_row);
        
        $xml_row = $output->createElement('title', Config::getConfig('portal_name') . ' - Aktualności');
        $xml_channel->appendChild($xml_row);
        
        $xml_row = $output->createElement('link', Config::getConfig('portal_url'));
        $xml_channel->appendChild($xml_row);
        
        $xml_row = $output->createElement('description');
        $xml_channel->appendChild($xml_row);
        
        $xml_row = $output->createElement('language', 'pl');
        $xml_channel->appendChild($xml_row);

        foreach ($contents as $content)
        {
            if (0 == $public_time)
            {
                $public_time = $content['time'];
            }
            $title = stripslashes($content['title']);
            $url = $urls->buildUrl('content', $content);
            $meta = htmlspecialchars(html_entity_decode(stripslashes($content['meta'])));

            $xml_item = $output->createElement('item');
            $xml_guid = $output->createElement('guid', $url);
            $xml_guid->setAttribute('isPermaLink', 'false');
            
            $xml_row = $output->createElement('title', $title);
            $xml_item->appendChild($xml_row);
            
            $xml_row = $output->createElement('link', $url);
            $xml_item->appendChild($xml_row);
            
            $xml_row = $output->createElement('description', $meta);
            $xml_item->appendChild($xml_row);
            
            // TODO - categories foreach
            $xml_row = $output->createElement('category', 'News');
            $xml_item->appendChild($xml_row);
            
            // TODO - author info
            $xml_row = $output->createElement('author', 'administracja@jacenter.pl (Administracja Jagged-Alliance.pl)');
            $xml_item->appendChild($xml_row);
            
            $xml_row = $output->createElement('pubDate', date('r', $content['time']));
            $xml_item->appendChild($xml_row);

            $xml_channel->appendChild($xml_item);
        }
        
        $xml_row = $output->createElement('pubDate', date('r', $public_time));
        $xml_channel->appendChild($xml_row);
        
        $view->outputXML($output->saveXML());
    }
    
}

