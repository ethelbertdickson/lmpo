<?php

class Lgas
{
    //db stuffs
    private $conn;
    private $table = 'lga';

    //state
    public $lga_id;
    public $state_id;
    public $lga_name;

    //constructor with db
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = 'SELECT lga_id, state_id, lga_name FROM ' . $this->table;

        //Prepare statement
        $stmt = $this->conn->prepare($query);
        //Execute query
        $stmt->execute();
        return $stmt;
    }
}
