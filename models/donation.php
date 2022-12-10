<?php

class Donation
{
    protected $conn;

    public $transId;
    public $transType;
    public $senderId;
    public $senderPhone;
    public $receiverId;
    public $amount;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function sendDonation()
    {
        $query = 'INSERT INTO sentDonation '
                .'SET '
                .'sentTransId=:transId,'
                .'userId=:senderId,'
                .'typeOfTransaction=:transType,'
                .'orphanageId=:receiverId,'
                .'amount=:amount,'
                .'createdAt=CURRENT_TIMESTAMP';

        $stmt = $this->conn->prepare($query);

        $this->transId = htmlspecialchars(strip_tags($this->transId));
        $this->senderId = htmlspecialchars(strip_tags($this->senderId));
        $this->transType = htmlspecialchars(strip_tags($this->transType));
        $this->receiverId = htmlspecialchars(strip_tags($this->receiverId));
        $this->amount = htmlspecialchars(strip_tags($this->amount));

        $stmt->bindParam(':transId', $this->transId);
        $stmt->bindParam(':senderId', $this->senderId);
        $stmt->bindParam(':transType', $this->transType);
        $stmt->bindParam(':receiverId', $this->receiverId);
        $stmt->bindParam(':amount', $this->amount);

        if ($stmt->execute())
            return true;

        return false;

    }

    public function receiveDonation()
    {
        $query = 'INSERT INTO receivedDonation '
                .'SET '
                .'receivedTransId=:transId,'
                .'senderPhone=:senderPhone,'
                .'typeOfTransaction=:transType,'
                .'orphanageId=:receiverId,'
                .'amount=:amount,'
                .'createdAt=CURRENT_TIMESTAMP';

        $stmt = $this->conn->prepare($query);

        $this->transId = htmlspecialchars(strip_tags($this->transId));
        $this->senderPhone = htmlspecialchars(strip_tags($this->senderPhone));
        $this->transType = htmlspecialchars(strip_tags($this->transType));
        $this->receiverId = htmlspecialchars(strip_tags($this->receiverId));
        $this->amount = htmlspecialchars(strip_tags($this->amount));

        $stmt->bindParam(':transId', $this->transId);
        $stmt->bindParam(':senderPhone', $this->senderPhone);
        $stmt->bindParam(':transType', $this->transType);
        $stmt->bindParam(':receiverId', $this->receiverId);
        $stmt->bindParam(':amount', $this->amount);

        try {
            if ($stmt->execute())
                return true;
        } catch(Exception $e) {
            return false;
        }
    }

    public function approveDonation()
    {
        $query = 'SELECT 
            * FROM sentDonation' 
            .' WHERE sentTransId=:transId'
            . ' LIMIT 0,1';

        $stmt = $this->conn->prepare($query);

        $this->transId = htmlspecialchars(strip_tags($this->transId));

        $stmt->bindParam(':transId', $this->transId);

        try {

            if ($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
                extract($row);
                $this->id = $id;
                $this->receiverId = $orphanageId;
                $this->transId = $sentTransId;
                $this->senderId = $userId;
                $this->amount = $amount;
                $this->createdAt = $createdAt;
                
                return true;
            }
    
        } catch(Exception $e) {
            return false;
        }

    }

    public function readReceivedDonation()
    {
        $query = 'SELECT 
            * FROM receivedDonation' 
            .' WHERE orphanageId=:receiverId'
            . ' ORDER BY createdAt ';

        $stmt = $this->conn->prepare($query);

        $this->receiverId = htmlspecialchars(strip_tags($this->receiverId));

        $stmt->bindParam(':receiverId', $this->receiverId);

        $stmt->execute();

        return $stmt;
    }

    public function readSentDonation()
    {
        $query = 'SELECT 
            * FROM sentDonation' 
            .' WHERE orphanageId=:receiverId'
            . ' ORDER BY createdAt ';

        $stmt = $this->conn->prepare($query);

        $this->receiverId = htmlspecialchars(strip_tags($this->receiverId));

        $stmt->bindParam(':receiverId', $this->receiverId);

        $stmt->execute();

        return $stmt;
    }

    public function readApprovedDonation()
    {

    }
}