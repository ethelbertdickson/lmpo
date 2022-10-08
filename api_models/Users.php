<?php

class Post
{
    //db stuffs
    private $conn;
    private $table = 'users';

    //post properties
    public $user_id;
    public $first_name;
    public $last_name;
    public $phone;
    public $email;

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
        $query = 'SELECT user_id, first_name, last_name, phone, email FROM ' . $this->table;

        //Prepare statement
        $stmt = $this->conn->prepare($query);
        //Execute query
        $stmt->execute();
        return $stmt;
    }
}
