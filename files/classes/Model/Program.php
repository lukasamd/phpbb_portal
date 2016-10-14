<?php

class Model_Program extends Model
{

  public function __construct()
  {
      parent::__construct();
  }
  

  public function getProgram($id)
  {
    $this->DB_result = $this->DB->sql_query("
        SELECT tcon.*, tcat.*
				FROM " . DB_SOFTWARE . " AS tcon
  			INNER JOIN " . DB_SOFTWARE_CATS . " AS tcat ON tcon.cat = tcat.cat_id
  			WHERE id = '{$id}'
    ");
    
    return $this->fetchResultDB();
  }

  public function getProgramCat($id)
  {
    $this->DB_result = $this->DB->sql_query("
      SELECT * FROM " . DB_SOFTWARE_CATS . "
      WHERE cat_id = '{$id}'
    ");
    
    return $this->fetchResultDB();
  }

    
    
  public function getProgramsFromCat($cat)
  {
    $pagination = Registry::get('Pagination');
    
    $this->DB_result = $this->DB->sql_query("
      SELECT * FROM " . DB_SOFTWARE . " 
      WHERE cat = '{$cat}' 
        AND " . SAC::SQLWhere("access") . "
      ORDER BY {$this->DB_sorting}
      LIMIT " . $pagination->getPageSQL(Config::getConfig("portal_news_display"))
    );
  }
  
  
  public function countProgramsFromCat($cat)
  {
    $pagination = Registry::get('Pagination');
    
    $this->DB_result = $this->DB->sql_query("
      SELECT COUNT(id) AS num_rows 
      FROM " . DB_SOFTWARE . " 
      WHERE cat = '{$cat}' 
        AND " . SAC::SQLWhere("access") . "
    ");

    return $this->fetchFieldDB('num_rows');
  }


  public function getProgramsCats()
  {
    $pagination = Registry::get('Pagination');
    
    $this->DB_result = $this->DB->sql_query("
      SELECT * FROM " . DB_SOFTWARE_CATS . "
      WHERE cat_parent = 0
      AND " . SAC::SQLWhere('cat_access') . " 
			ORDER BY cat_title
    "); 
  }

  public function getProgramsSubcats()
  {
    $this->DB_result = $this->DB->sql_query("
      SELECT * FROM " . DB_SOFTWARE_CATS . "
      WHERE cat_parent <> 0
      AND " . SAC::SQLWhere("cat_access") . " 
			ORDER BY cat_title
    ");
  }
  
  public function updateViews($id)
  {
    $this->DB_result = $this->DB->sql_query("
      UPDATE " . DB_SOFTWARE . "
      SET views = views + 1 
      WHERE id = {$id}
    ");
  }


  public function getProgramsRss()
  {
      $this->DB_result = $this->DB->sql_query('
          SELECT * FROM ' . DB_SOFTWARE . '
          WHERE cat IN (SELECT cat_id FROM ' . DB_SOFTWARE_CATS . ' WHERE cat_access = 0)
          ORDER BY time DESC 
          LIMIT 10'
      );
  }
  
  public function getMaxPublicTime()
  {
      $this->DB_result = $this->DB->sql_query('
        SELECT MAX(time) AS maxTime FROM ' . DB_SOFTWARE . '
        WHERE cat IN (SELECT cat_id FROM ' . DB_SOFTWARE_CATS . ' WHERE cat_access = 0)'
      );
      
      return $this->fetchFieldDB('maxTime'); 
  }
  
    /*
    * Public cats with max public content time
    * 
    */        
    public function getSitemapCats()
    {
        $this->DB_result = $this->DB->sql_query('
            SELECT tnc.cat_id,  MAX(tn.time) AS maxTime
            FROM ' . DB_SOFTWARE_CATS . ' AS tnc
            INNER JOIN ' . DB_SOFTWARE . ' AS tn ON tnc.cat_id = tn.cat
            WHERE cat_access = 0
            AND (cat_parent = 0 OR cat_parent IN (
                SELECT cat_id 
                FROM ' . DB_SOFTWARE_CATS . '
                WHERE cat_parent = 0 
                AND cat_access = 0
            ))
            GROUP BY cat'  
        );
    }
    
    /*
    * Get public content from cat
    * 
    */   
    public function getSitemapFromCat($cat)
    {
        $this->DB_result = $this->DB->sql_query("
            SELECT * FROM " . DB_SOFTWARE . "
            WHERE cat = '{$cat}'
            ORDER BY time DESC"
        );
    }

}
