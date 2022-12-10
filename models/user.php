<?php

class User {
    private $conn;
    private $table = 'user';

    public $id;
    public $role;
    public $status = 'active';
    public $userName;
    public $email;
    public $phone = 'xxxx-xxx-xxx';
    public $password;
    public $createdAt;
    public $updatedAt;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = 'SELECT 
            * FROM ' 
            .$this->table 
            . ' ORDER BY createdAt DESC';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function read_where($str)
    {
        $query = "SELECT
            * FROM ".
            $this->table
            ." WHERE ".
            $str." ORDER BY userName";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function read_single()
    {
        $query = 'SELECT 
            id,
            role,
            status,
            userName,
            email,
            phone,
            password,
            createdAt,
            updatedAt FROM ' 
            .$this->table 
            . ' WHERE id=? LIMIT 0,1';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->role = $row['role'];
        $this->status = $row['status'];
        $this->userName = $row['userName'];
        $this->email = $row['email'];
        $this->phone = $row['phone'];
        $this->password = $row['password'];
        $this->createdAt = $row['createdAt'];
        $this->updatedAt = $row['updatedAt'];
    }

    public function create()
    {
        $query = 'INSERT INTO '
            .$this->table .
            ' SET 
            role = :role,
            status = :status,
            userName = :userName,
            email = :email,
            phone = :phone,
            password = :password,
            createdAt = CURRENT_TIMESTAMP';

        $stmt = $this->conn->prepare($query);

        $this->role = htmlspecialchars(strip_tags($this->role));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->userName = htmlspecialchars(strip_tags($this->userName));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':userName', $this->userName);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':password', $this->password);

        if ($stmt->execute())
            return true;

        return false;
    }

    public function login()
    {
        $query = 'SELECT * FROM '
            . $this->table 
            . ' WHERE 
            email = :email
            LIMIT 0,1';

        $stmt = $this->conn->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));
        // $this->password = htmlspecialchars((strip_tags($this->password)));

        $stmt->bindParam(':email', $this->email);
        // $stmt->bindParam(':password', $this->password);

        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            $this->id = $row['id'];
            $this->role = $row['role'];
            $this->status = $row['status'];
            $this->userName = $row['userName'];
            $this->email = $row['email'];
            $this->phone = $row['phone'];
            // $this->password = ;
            $this->createdAt = $row['createdAt'];
            $this->updatedAt = $row['updatedAt'];

            if (password_verify($this->password, $row['password']))
                return true;
                
        }

        return false;
    }

    public function validate()
    {
        foreach ( $this->attributes() as $attribute) {
            if($this->{$attribute} === "")
                return false;
        }

        return true;
    }

    public function attributes()
    {
        return [ 'email', 'password'];
    }
}