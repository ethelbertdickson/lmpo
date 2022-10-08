<?php

class Wards
{
    //db stuffs
    private $conn;
    private $table = 'ward';

    //state
    public $ward_id;
    public $ward_name;

    //constructor with db
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = 'SELECT ward_id, ward_name FROM ' . $this->table;

        //Prepare statement
        $stmt = $this->conn->prepare($query);
        //Execute query
        $stmt->execute();
        return $stmt;
    }
}
