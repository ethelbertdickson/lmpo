<?php

class States
{
    //db stuffs
    private $conn;
    private $table = 'states';

    //state
    public $state_id;
    public $state_name;

    //constructor with db
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = 'SELECT state_id, state_name FROM ' . $this->table;

        //Prepare statement
        $stmt = $this->conn->prepare($query);
        //Execute query
        $stmt->execute();
        return $stmt;
    }
}
