<?php

class DB
{
    //properti
    public $host = '127.0.0.1';
    private $user = "root";
    private $password = "";
    private $database = 'dbrestoran';

    public function __construct()
    {
        echo 'function construct';
    }

    //method
    public function selectData()
    {
        echo 'Select Data';
    }

    public function getDataBase()
    {
        return $this->database;
    }

    public function tampil()
    {
        $this->selectData();
    }

    public static function insertData()
    {
        echo "Static Function";
    }
}

DB::insertData();

// $db = new DB;

// echo '<br>';

// $db->selectData();

// echo '<br>';

// echo $db->host;

// echo '<br>';

// echo $db->getDataBase() . '<br>';

// $db->tampil();
