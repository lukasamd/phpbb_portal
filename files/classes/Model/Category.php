<?php

class Model_Category extends Model
{

    private $options = array();

    public function __construct()
    {
        parent::__construct();
    }
  
    /**
    * Get content from DB
    * 	 
    * @param $ids Array content ids to get, default none
    * @param $options Array options for SQL Where, default none  
    * @return array Contents array	 
    */
    public function getCategories($ids = array())
    {
        static $cache;
        
        if (empty($cache))
        {
            $urls = Registry::get('URLs');
            
            $this->DB_result = $this->DB->sql_query("
                SELECT * FROM " . DB_CATEGORIES . "
                ORDER BY cat_title
            ");
            
            $cache = array();
            while ($row = $this->fetchResultDB())
            {
                $cache[$row['cat_id']] = array(
                    'cat_title' => stripslashes($row['cat_title']),
                    'cat_url' => $urls->buildUrl('category', $row),
                );   
            }
        }

        $categories = array();
        foreach ($ids as $key => $cat_id)
        {
            $categories[$cat_id] = $cache[$cat_id];  
        }
        
        return $categories;   
    }
    
    /**
    * Get Category by URL
    * 	 
    * @param $url String category to search
    * @return array Category array	 
    */
    public function getCategoryByURL($url = '')
    {
        $this->DB_result = $this->DB->sql_query("
            SELECT * FROM " . DB_CATEGORIES . "
            WHERE cat_url = '{$url}'
        ");
    
        return $this->fetchResultDB();
    }
      
    /**
    * Get contents list by category ID
    * 	 
    * @param $cat_id Int category to search
    * @return array Contents ids array	 
    */
    public function getContents($cat_id = 0)
    {
        $cat_id = (int) $cat_id;
        
        $ids = array();
        $this->DB_result = $this->DB->sql_query("
            SELECT content_id  
            FROM " . DB_CATEGORIES_RELATIONSHIPS . "
            WHERE category_id = '{$cat_id}'
        ");
        
        while ($row = $this->fetchResultDB())
        {
            $ids[] = $row['content_id']; 
        }
        
        return $ids;
    }

}
