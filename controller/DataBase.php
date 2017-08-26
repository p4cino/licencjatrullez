<?php
class DataBase
{
    public $db;
    /**
     * @return PDO
     */
    static public function getDB()
    {
        if(!isset($db) || $db==null)
        {
            $dsn = 'mysql:dbname=licencjat;host=localhost;port=3306';
            $username = 'developer';
            $password = 'developer';
            try {
                $db = new PDO($dsn, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                $db->exec("set names utf8");
            } catch (PDOException $e)
            {
                echo $e->getMessage();
            }
        }
        return $db;
    }
}