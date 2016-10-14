<?php

class Model_URLs extends Model
{

    public function __construct()
    {
        parent::__construct();
    }
    
    /**
    * Get URL
    * 	 
    * @param $url String url to search
    * @param $active Bool is url active and used
    * @param $id Int numer of id to search    
    * @return array URL data array	 
    */
    public function getURL($url, $active = false, $id = 0)
    {
        if (is_numeric($url))
        {
            $url = (int) $url;
            $sql_where['method'] = " url_id = '{$url}' ";
        }
        else
        {
            $sql_where['method'] = " url_url = '{$url}' ";
        }
    
        $sql_where['active'] = ($active) ? " AND url_active = 1 " : "";
        $sql_where['id'] = ($id) ? " AND url_id = '{$id}' " : "";
        
        $this->DB_result = $this->DB->sql_query("
            SELECT * FROM " . DB_URLS . "
            WHERE {$sql_where['method']}
            {$sql_where['active']} {$sql_where['id']}"
        );

        return $this->fetchResultDB();
    }
    
    /**
    * Format string to URL
    * 	 
    * @param $url String string to format
    * @param $id Int numer of id to compare duplicates    
    * @return string formatted URL
    */
    public function formatURL($url = '', $id = 0)
    {
        global $phpbb_seo;
        
        $url = $phpbb_seo->format_url($url);
        $i = 0;
        
        do 
        {
            $url_check = ($i) ? "{$url}-{$i}" : $url;
            $row = $this->getURL($url_check, $type);
        }
        while (isset($row['url_id']) && $row['url_id'] != $id);  
        
        $url = $url_check;
        return $url;
    }
    
    /**
    * Write URL to Model
    * 	 
    * @param $url URL to save
    * @param $id Int numer of id to compare duplicates 
    * @param $active Bool is url active and used    
    */
    public function setURL($url, $id, $active)
    {
        global $db;

        $sql_array = array(
            'url_url' => $this->formatURL($url, $id),
            'url_id' => (int) $id,
            'url_active' => ($active) ? 1 : 0
        );

        $sql = "REPLACE INTO " . DB_URLS . " " . $db->sql_build_array("INSERT", $sql_array);
        $this->DB->sql_query($sql);
        
        $sql = "UPDATE " . DB_URLS . " SET url_active = 0
                WHERE url_id = '{$sql_array['url_id']}'
                AND url_url <> '{$sql_array['url_url']}'";
        $this->DB->sql_query($sql);
    }
      
}