<?php

class Model_Search extends Model
{
    private $options = array();

    public function __construct()
    {
        parent::__construct();
    }
    
    /**
    * Set options before get data
    * 	 
    * @param $options Array options to set
    */
    public function setOptions($options)
    {
        if (!is_array($options) || empty($options))
        {
            return;
        }
    
        foreach ($options as $option => $value)
        {
            $this->options[$option] = $value;
        }
    }
  
    /**
    * Do search action
    * 	 
    * @return array Contents ids array	 
    */
    public function doSearch()
    {
        $ids = array();
        
        // Check options
        $this->options = array(
            'keywords'              =>  isset($this->options['keywords']) ? explode(' ', $this->options['keywords']) : '',
            'search_in_content'     =>  isset($this->options['search_in_content']) ? (int) $this->options['search_in_content'] : 0,
        );
        
        // TODO
        // Search temp table for high speed - results like MyBB

        // Do it now!
        $this->DB_result = $this->DB->sql_query("
            SELECT id FROM " . DB_CONTENT . "
            WHERE " . $this->prepareKeywords()
        );

        // Build table with data
        while ($row = $this->fetchResultDB())
        {
            $ids[] = $row['id']; 
        }
        
        return isset($ids[0]) ? $ids : false;  
    }
    
    /**
    * Prepare keywords to SQL WHERE
    * 	 
    * @return string SQL WHERE content
    */
    private function prepareKeywords()
    {
        $sql_where = '';
        
        // Title search
        $tmp = array_map(array($this,'sqlLikeTitle'), $this->options['keywords']);
        $sql_where = implode(' OR ', $tmp);
        
        // Content search
        if ($this->options['search_in_content'])
        {
            $tmp = array_map(array($this,'sqlLikeContent'), $this->options['keywords']);
            $sql_tmp = implode(' OR ', $tmp);
            
            $sql_where = "{$sql_where} OR " . implode(' OR ', $tmp);
        }
    
        return $sql_where;
    }
    
    
    /**
    * Map keyword in LIKE-title statement
    * 	 
    * @param $keyword String keyword to map 
    * @return string mapped keyword
    */
    private function sqlLikeTitle($keyword)
    {
        return "(title LIKE '%{$keyword}%')";
    }
    
    /**
    * Map keyword in LIKE-content statement
    * 	 
    * @param $keyword String keyword to map 
    * @return string mapped keyword
    */
    private function sqlLikeContent($keyword)
    {
        return "(content LIKE '%{$keyword}%')";
    }

}
