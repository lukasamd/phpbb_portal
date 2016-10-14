<?php
include '../../core.php';
header('Content-type: text/xml');

// Odczyt danych z cache
if (($sitemapContent = $cache->get('_site_sitemapNews')) === false)
{
  $doc = new DOMDOcument("1.0", "UTF-8");
  
  $sql = 'SELECT MAX(news_datestamp) AS czas 
  				FROM ' . DB_CONTENT;
  $result = $db->sql_query($sql);
  $czas = (int) $db->sql_fetchfield('czas');

  $urlset = $doc->createElement('urlset');
  $urlset->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
  $urlset->setAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd');
  $urlset->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
  
  $url = $doc->createElement('url');
  $loc = $doc->createElement('loc', $settings['siteurl']);
  $lastmod = $doc->createElement('lastmod', date('c', $czas));
  $changefreq = $doc->createElement('changefreq', 'daily');
  $priority = $doc->createElement('priority', '1.0');
  
  $url->appendChild($loc);
  $url->appendChild($lastmod);
  $url->appendChild($changefreq);
  $url->appendChild($priority);
  $urlset->appendChild($url);
  
  // Pobieranie z bazy newsow ktore maja byc zawarte w sitemap
  $sql = 'SELECT news_id, news_url, news_datestamp
        FROM ' . DB_CONTENT . '
        WHERE news_visibility = 0
        ORDER BY news_datestamp DESC';
  $result = $db->sql_query($sql);
  
  while ($row = $db->sql_fetchrow($result))
  {
    $url = $doc->createElement('url');
    $loc = $doc->createElement('loc', $settings['siteurl'] . buildUrl('news', $row));
    $lastmod = $doc->createElement('lastmod', date('c', $row['news_datestamp']));
    $changefreq = $doc->createElement('changefreq', 'monthly');
    $priority = $doc->createElement('priority', '0.2');
  
    $url->appendChild($loc);
    $url->appendChild($lastmod);
    $url->appendChild($changefreq);
    $url->appendChild($priority);
    $urlset->appendChild($url);
  }
  $db->sql_freeresult($result);
  
  $doc->appendChild($urlset);
  $sitemapContent = $doc->saveXML();

  // Zapis cache
  $cache->put('_site_sitemapNews', $sitemapContent, 21600);
}

echo $sitemapContent;
?>