<?php

class Notification 
{
    private $table = 'notification';
    private $conn;

    public $id;
    public $userId;
    public $status = 1;
    public $message;
    public $createdAt;
    public $updatedAt;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read_where($field)
    {
        $query = "SELECT
            * FROM ".
            $this->table
            ." WHERE ".
            $field."=:".$field." ORDER BY createdAt DESC";

        $stmt = $this->conn->prepare($query);

        $this->{$field} = htmlspecialchars(strip_tags($this->{$field}));
        $stmt->bindParam(':'.$field, $this->{$field});
        
        try {

            if ($stmt->execute())
                return $stmt;
        } catch(Exception $e) {
            return false;
        }

    }

    public function create()
    {
        $query = 'INSERT INTO '
            .$this->table .
            ' SET 
            userId = :userId,
            status = :status,
            message = :message,
            createdAt = CURRENT_TIMESTAMP';

        $stmt = $this->conn->prepare($query);

        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->message = htmlspecialchars(strip_tags($this->message));

        $stmt->bindParam(':userId', $this->userId);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':message', $this->message);

        try {
            if ($stmt->execute())
                return true;
        } catch(Exception $e) {
            return false;
        }
    }

    public function count()
    {
        $query = 'SELECT COUNT(*) as count FROM '.$this->table
            .' WHERE userId=:userId AND status=1';

        $stmt = $this->conn->prepare($query);
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $stmt->bindParam(':userId', $this->userId);
        
        try {
            if ($stmt->execute())
                return $stmt;
        } catch(Exception $e) {
            return false;
        }
    }
}