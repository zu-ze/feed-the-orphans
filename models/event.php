<?php

class Event 
{
    private $table = 'event';
    private $conn;

    public $id;
    public $orphanageId;
    public $eventDate;
    public $title;
    public $description;
    public $createdAt;
    public $updatedAt;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = 'SELECT * FROM ' 
            .$this->table 
            . ' ORDER BY createdAt DESC';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function read_single()
    {
        $query = 'SELECT * FROM ' 
            .$this->table 
            . ' WHERE id=? LIMIT 0,1';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->orphanageId = $row['orphanageId'];
        $this->eventDate = $row['eventDate'];
        $this->title = $row['title'];
        $this->description = $row['description'];
        $this->createdAt = $row['createdAt'];
        $this->updatedAt = $row['updatedAt'];
    }

    public function read_where($str)
    {
        $query = "SELECT
            * FROM ".
            $this->table
            ." WHERE ".
            $str." ORDER BY createdAt DESC";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function create()
    {
        $query = 'INSERT INTO '
            .$this->table .
            ' SET 
            orphanageId = :orphanageId,
            eventDate = :eventDate,
            title = :title,
            description = :description,
            createdAt = CURRENT_TIMESTAMP';

        $stmt = $this->conn->prepare($query);

        $this->orphanageId = htmlspecialchars(strip_tags($this->orphanageId));
        $this->eventDate = htmlspecialchars(strip_tags($this->eventDate));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(trim($this->description));


        $stmt->bindParam(':orphanageId', $this->orphanageId);
        $stmt->bindParam(':eventDate', $this->eventDate);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);

        if ($stmt->execute())
            return true;

        return false;
    }
}