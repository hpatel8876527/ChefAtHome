<?php

require(dirname(__DIR__, 1) . "/config.php");

class DbConnection
{
    private $pdo;

    function __construct()
    {
        $pdo = new PDO("mysql:host=".DATABASE_HOST.";dbname=".DATABASE_NAME, DATABASE_USER, DATABASE_PASSWORD) 
        or 
        die('Database Error Occured');

        $this->pdo = $pdo;
    }


    function get_db_conn(){

        return $this->pdo;

    }

}

?>