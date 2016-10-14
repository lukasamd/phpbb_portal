<?php
class Model
{
    protected $data;
    
    protected $DB;
    protected $DB_result;
    protected $DB_sorting = '';
    private $models;
    
    public function __construct()
    {
        $this->DB = Registry::get("db");
    }
    
    public function fetchResultDB()
    {
        return $this->DB->sql_fetchrow($this->DB_result);
    }
    
    public function setDBSorting($field)
    {
      $this->DB_sorting = $field;
    }
    
    public function fetchFieldDB($field)
    {
      return $this->DB->sql_fetchfield($field);
    }
    
    public function numRows()
    {
        return $this->DB->sql_numrow($this->DB_result);
    }
    
    public function __get($name)
    {
        if (!isset($this->models[$name]))
        {
            $object = "Model_{$name}";
            $this->models[$name] = new $object;
        }

        return $this->models[$name];
    }
    
    
}