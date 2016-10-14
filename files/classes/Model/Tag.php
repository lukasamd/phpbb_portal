<?php

class Model_Tag extends Model
{

    private $options = array();

    public function __construct()
    {
        parent::__construct();
    }
    
    /**
    * Get tag by URL
    * 	 
    * @param $url String tag to search
    * @return array Tag array	 
    */
    public function getTagByURL($url = '')
    {
        $this->DB_result = $this->DB->sql_query("
            SELECT * FROM " . DB_TAGS . "
            WHERE tag_clean = '{$url}'
        ");
    
        return $this->fetchResultDB();
    }
    
    /**
    * Get contents list by tag ID
    * 	 
    * @param $tag_id Int tag to search
    * @return array Contents ids array	 
    */
    public function getContents($tag_id = 0)
    {
        $tag_id = (int) $tag_id;
        
        $ids = array();
        $this->DB_result = $this->DB->sql_query("
            SELECT content_id  
            FROM " . DB_TAGS_RELATIONSHIPS . "
            WHERE tag_id = '{$tag_id}'
        ");
        
        while ($row = $this->fetchResultDB())
        {
            $ids[] = $row['content_id']; 
        }
        
        return $ids;
    }

}
