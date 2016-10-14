<?php

class Model_Content extends Model
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
    * Get content
    * 	 
    * @param $ids Array content ids to get, default none
    * @param $options Array options for SQL Where, default none  
    * @return array Contents array	 
    */
    public function getContent($ids = array(), $options = array())
    {
        $sql_where = '';
        $contents = array();
        $authors = $categories = $tags = array();
        
        if (is_numeric($ids) && $ids > 0)
        {
            $ids = array($ids);
        }
        if (empty($ids) && func_num_args() > 0)
        {
            return false;
        }

        $id = 0;
        $ids = array_map('intval', $ids);
        $pagination = Registry::get('Pagination');

        // Prepare options
        $field = "*";
        $sql_where = array(
            'access'    =>  isset($this->options['access']) ? $this->options['access'] : SAC::SQLWhere('access'),
            'draft'     =>  isset($this->options['draft']) ? $this->options['draft'] : 0,
            'trash'     =>  isset($this->options['trash']) ? $this->options['trash'] : 0,
            'start'     =>  isset($this->options['start']) ? $this->options['start'] : TIME_NOW,
            'limit'      =>  "LIMIT " . (isset($this->options['limit']) ? $this->options['limit'] : $pagination->getPageSQL(Config::getConfig('portal_news_display'))),
            
            'where'     =>  isset($this->options['where']) ? " AND {$this->options['where']} " : '',
            'ids'       =>  !empty($ids) ? ' AND id IN (' . implode(',', $ids) . ') ' : '',
            'count'     =>  isset($this->options['count']) ? $this->options['count'] : 0,
            'order'     =>  isset($this->options['order']) ? $this->options['order'] : 'time DESC',
            //'cat'       =>  isset($this->options['cat']) ? ? ' AND id IN (' . implode(',', $this->options['cat']) . ') ' : '',
        );
        
        // Addition for SELECT COUNT
        if ($sql_where['count'])
        {
            $field = "COUNT(id) as num_rows";
            $sql_where['limit'] = '';
        }

        // Do it now!
        $this->DB_result = $this->DB->sql_query("
            SELECT {$field} FROM " . DB_CONTENT . "
            WHERE {$sql_where['access']}
                {$sql_where['where']}
                AND draft = '{$sql_where['draft']}' 
                AND trash = '{$sql_where['trash']}' 
                AND (start = '0' || start < '{$sql_where['start']}')
                {$sql_where['ids']}
            ORDER BY {$sql_where['order']}
            {$sql_where['limit']}"
        );
        
        // Addition for SELECT COUNT
        if ($sql_where['count'])
        {
            return (int) $this->fetchFieldDB('num_rows');
        }

        // Build table with data
        while ($row = $this->fetchResultDB())
        {
            $id = &$row['id'];
            $contents[$id] = $row;
            $contents[$id]['categories'] = array();
            $contents[$id]['tags'] = '';
            $contents[$id]['author'] = '';
            $contents[$id]['url'] = '';
        }
        $ids = array_keys($contents);

        // Get authors
        $authors = $this->getContentAuthors($ids);
        foreach ($authors as $id => $author)
        {
            $contents[$id]['author'] = $author;    
        }
        
        // Get tags
        $tags = $this->getContentTags($ids);
        foreach ($tags as $id => $tag)
        {
            $contents[$id]['tags'] = $tag;    
        }
        
        // Get urls
        $urls = $this->getContentURLs($ids);
        foreach ($urls as $id => $url)
        {
            $contents[$id]['url'] = $url;    
        }
        
        // Get categories
        $categories = $this->getContentCategories($ids);
        foreach ($categories as $id => $category)
        {
            $contents[$id]['categories'] = $category;    
        }

        return $contents;   
    }
    
    /**
    * Get content authors
    * 	 
    * @param $ids Array content ids to get, default none
    * @return array Authors array	 
    */
    public function getContentAuthors($ids = array())
    {
        if (is_int($ids))
        {
            $ids = array($ids);
        }

        if (empty($ids))
        {
            return array();
        }
        
        $authors = array();
        /*
        $this->DB_result = $this->DB->sql_query("
            SELECT ta.*, tu.user_id, tu.username, tpf.pf_imie, tpf.pf_nazwisko   
            FROM " . DB_CONTENT_AUTHORS . " AS ta
            LEFT JOIN " . USERS_TABLE . " AS tu ON ta.author_id = tu.user_id 
            LEFT JOIN " . PROFILE_FIELDS_DATA_TABLE . " AS tpf ON ta.author_id = tpf.user_id
            WHERE ta.content_id IN (" . implode(",", $ids) . ")"
        );
        */
        $this->DB_result = $this->DB->sql_query("
            SELECT ta.*, tu.user_id, tu.username
            FROM " . DB_CONTENT_AUTHORS . " AS ta
            LEFT JOIN " . USERS_TABLE . " AS tu ON ta.author_id = tu.user_id 
            WHERE ta.content_id IN (" . implode(",", $ids) . ")"
        );
        
        while ($row = $this->fetchResultDB())
        {
            
            if (!isset($row['username'])) 
            {
                $authors[$row['content_id']] = $row['author_name'];
                continue;
            }

            if (!empty($row['pf_imie']) && !empty($row['pf_nazwisko']))
            { 
                $row['username'] = $row['pf_imie'] . ' ' . $row['pf_nazwisko'] . ' (' . $row['username'] . ')';
            }
            $authors[$row['content_id']] = get_username_string('full', $row['user_id'], $row['username']);
        }

        return $authors;
    }
    
    /**
    * Get content categories
    * 	 
    * @param $ids Array content ids to get, default none
    * @return array Categories array	 
    */
    public function getContentCategories($ids = array())
    {
        if (is_int($ids))
        {
            $ids = array($ids);
        }
        
        if (empty($ids))
        {
            return array();
        }

        $categories = array();
        $this->DB_result = $this->DB->sql_query("
            SELECT tc.cat_id, tcr.content_id  
            FROM " . DB_CATEGORIES_RELATIONSHIPS . " AS tcr
            LEFT JOIN " . DB_CATEGORIES . " AS tc ON tcr.category_id = tc.cat_id
            WHERE tcr.content_id IN (" . implode(",", $ids) . ")
            ORDER BY cat_title"
        );
        
        while ($row = $this->fetchResultDB())
        {
            $categories[$row['content_id']][] = $row['cat_id'];
        }

        return $categories;
    }

    /**
    * Get content urls
    * 	 
    * @param $ids Array content ids to get, default none
    * @return array URLs array	 
    */
    public function getContentURLs($ids = array())
    {
        if (is_int($ids))
        {
            $ids = array($ids);
        }

        if (empty($ids))
        {
            return array();
        }
        
        $urls = array();
        $this->DB_result = $this->DB->sql_query("
            SELECT url_id, url_url  
            FROM " . DB_URLS . "
            WHERE url_id IN (" . implode(",", $ids) . ")
            AND url_active = 1"
        );
        
        while ($row = $this->fetchResultDB())
        {
            $urls[$row['url_id']] = $row['url_url'];
        }

        return $urls;
    }
    
    /**
    * Get content tags
    * 	 
    * @param $ids Array content ids to get, default none
    * @return array Tags array	 
    */
    public function getContentTags($ids = array())
    {
        if (is_int($ids))
        {
            $ids = array($ids);
        }
        
        if (empty($ids))
        {
            return array();
        }

        $tags = array();
        $this->DB_result = $this->DB->sql_query("
            SELECT tt.*, ttr.content_id  
            FROM " . DB_TAGS_RELATIONSHIPS . " AS ttr
            LEFT JOIN " . DB_TAGS . " AS tt ON ttr.tag_id = tt.tag_id
            WHERE ttr.content_id IN (" . implode(",", $ids) . ")"
        );
        
        while ($row = $this->fetchResultDB())
        {
            $tags[$row['content_id']][] = $row;
        }

        return $tags;
    }

    /**
    * Update content views counter
    * 	 
    * @param $id Int content id to update
    */
    public function updateViews($id)
    {
        $this->DB_result = $this->DB->sql_query("
            UPDATE " . DB_CONTENT . "
            SET views = views + 1 
            WHERE id = {$id}
        ");
    }

}
