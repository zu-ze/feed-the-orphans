<?php

class Contact
{
    protected $conn;
    protected $table = 'contact';

    public $id;
    public $orphanageId;
    public $name;
    public $type;
    public $number;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = 'INSERT INTO '
            .$this->table .
            ' SET 
            name = :name,
            orphanageId = :orphanageId,
            type = :type,
            number = :number,
            createdAt = CURRENT_TIMESTAMP';

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->orphanageId = htmlentities(strip_tags($this->orphanageId));
        $this->type = htmlentities(strip_tags($this->type));
        $this->number = htmlentities(strip_tags($this->number));


        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':orphanageId', $this->orphanageId);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':number', $this->number);


        try {
            if ($stmt->execute())
                return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function read()
    {
        $query = 'SELECT * FROM '. $this->table
            .' WHERE orphanageId='. $this->orphanageId;

        $stmt = $this->conn->prepare($query);

        try {
            if( $stmt->execute())
                return $stmt;
        } catch(Exception $e) {
            return false;
        }
    }

    public function delete()
    {
        $query = '';

        $stmt = $this->conn->prepare($query);

        try {
            if( $stmt->execute())
                return true;
        } catch(Exception $e) {
            return false;
        }
    }
}