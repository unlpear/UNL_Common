<?php

class UNL_Common
{
    static public $db_file = 'unl_common.sqlite';
    
    static private $db;
    
    /**
     * Get the database.
     * 
     * @return PDO
     */
    static function getDB()
    {
        if (!isset(self::$db)) {
            return self::__connect();
        }
        return self::$db;
    }

    static public function getDataDir()
    {
        if ('@@DATA_DIR@@' == '@@DATA'.'_DIR@@') {
            return dirname(dirname(dirname(__FILE__))) . '/data/';
        }
        return '@@DATA_DIR@@/UNL_Common/data/';
    }
    
    static protected function __connect()
    {
        $dsn = 'sqlite:'.self::getDataDir().self::$db_file;
        if (self::$db = new PDO($dsn)) {
            return self::$db;
        }
        throw new Exception('Cannot connect to database!');
    }
    
    static function tableExists($table)
    {
        $db = self::getDB();
        $result = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='$table'");
        return $result->rowCount() > 0;
    }
    
    static function importCSV($table, $filename)
    {
        $db = self::getDB();
        if ($h = fopen($filename,'r')) {
            while ($line = fgets($h)) {
                $db->exec("INSERT INTO ".$table." VALUES ($line);");
            }
        }
    }
}

?>