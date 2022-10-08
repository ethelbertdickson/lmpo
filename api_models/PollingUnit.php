<?php

class PollingUnit
{
    //db stuffs
    private $conn;
    private $table = 'polling_unit';

    //state
    public $state_id;
    public $state_name;
    public $status;

    //constructor with db
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = ' SELECT pu_id, pu_name, status FROM ' . $this->table;

        //Prepare statement
        $stmt = $this->conn->prepare($query);
        //Execute query
        $stmt->execute();
        return $stmt;
    }
}
