<?php

class Database
{
    private $host = 'localhost';
    private $db = 'chimvaao_test';
    private $username = 'chimvaao_nigeria';
    private $password = ',2&89rg8VA$T';
    private $conn;

    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'connecton failed' . $e->getMessage();
        }

        return $this->conn;
    }
}
