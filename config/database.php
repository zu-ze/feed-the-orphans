<?php

class Database{
    private $host = "localhost";
    private $db_name = "fto_api";
    private $username = "root";
    private $password = "admin123";
    private $conn;

    public function connect()
    {
        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name, 
            $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            // echo "Connection Error" . $e->getMessage();
            return false;
        }

        return $this->conn;
    }

    public function prepare($sql)
    {
        return $this->conn->prepare($sql);
    }

}