<?php

class Orphanage {
    private $conn;
    private $table = 'orphanage';

    public $id;
    public $name = '';
    public $latitude = 0.0;
    public $longitude = 0.0;
    public $district = '';
    public $area = '';
    public $mission = '';
    public $vision = '';
    public $adminId;
    public $createdAt;
    public $updatedAt;

    public $searchStr;

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

        try {
            if ($stmt->execute())
            return $stmt;
        } catch(Exception $e){
            return false;
        }
    }

    public function read_single()
    {
        $query = 'SELECT * FROM ' 
            .$this->table 
            . ' WHERE adminId=? LIMIT 0,1';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->adminId);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->latitude = $row['latitude'];
        $this->longitude = $row['longitude'];
        $this->district = $row['district'];
        $this->area = $row['area'];
        $this->adminId = $row['adminId'];
        $this->mission = $row['mission'];
        $this->vision = $row['vision'];
        $this->createdAt = $row['createdAt'];
        $this->updatedAt = $row['updatedAt'];
    }

    public function read_where($field)
    {
        $query = "SELECT
            * FROM ".
            $this->table
            ." WHERE ".
            $field."=:".$field." LIMIT 0,1 ";

        $stmt = $this->conn->prepare($query);
        $this->{$field} = htmlspecialchars(strip_tags($this->{$field}));
        $stmt->bindParam(':'.$field, $this->{$field});

        try {
            if($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->latitude = $row['latitude'];
                $this->longitude = $row['longitude'];
                $this->district = $row['district'];
                $this->area = $row['area'];
                $this->adminId = $row['adminId'];
                $this->mission = $row['mission'];
                $this->vision = $row['vision'];
                $this->createdAt = $row['createdAt'];
                $this->updatedAt = $row['updatedAt'];

                return true;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function create()
    {
        $query = 'INSERT INTO '
            .$this->table .
            ' SET 
            name = :name,
            adminId = :adminId,
            latitude = :latitude,
            longitude = :longitude,
            district = :district,
            area = :area,
            mission = :mission,
            vision = :vision,
            createdAt = CURRENT_TIMESTAMP';

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->latitude = htmlspecialchars(strip_tags($this->latitude));
        $this->longitude = htmlspecialchars(strip_tags($this->longitude));
        $this->district = htmlspecialchars(strip_tags($this->district));
        $this->area = htmlspecialchars(strip_tags($this->area));
        $this->mission = htmlspecialchars(strip_tags($this->mission));
        $this->vision = htmlspecialchars(strip_tags($this->vision));
        $this->adminId = htmlspecialchars(strip_tags($this->adminId));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':latitude', $this->latitude);
        $stmt->bindParam(':longitude', $this->longitude);
        $stmt->bindParam(':district', $this->district);
        $stmt->bindParam(':area', $this->area);
        $stmt->bindParam(':mission', $this->mission);
        $stmt->bindParam(':vision', $this->vision);
        $stmt->bindParam(':adminId', $this->adminId);

        try {
            if ($stmt->execute())
            return true;
        } catch(Exception $e){
            return false;
        }
    }

    public function edit($field)
    {
        $query = 'UPDATE '. $this->table
                .' SET '. $field .'=:'. $field
                .' WHERE id=:id';
                
        $stmt = $this->conn->prepare($query);
                
        $this->{$field} = htmlspecialchars(trim($this->{$field}));

        $stmt->bindParam(':'.$field, $this->{$field});
        $stmt->bindParam(':id', $this->id);
        
        try {
            if ($stmt->execute())
            return true;
        } catch(Exception $e){
            return false;
        }
    }

    public function search()
    {
        $query1 = 'SET @searchTerm="'.$this->searchStr.'";';

        $query2 = ' SELECT MATCH (name) AGAINST (@searchTerm IN NATURAL LANGUAGE MODE) '
        .' id, adminId, name, district, area '
        .' FROM '.$this->table
        .' WHERE MATCH (name) AGAINST (@searchTerm IN NATURAL LANGUAGE MODE)'
        .' ORDER BY MATCH (name) AGAINST (@searchTerm IN NATURAL LANGUAGE MODE) DESC;';

        $stmt1 = $this->conn->prepare($query1);

        try {
            if( $stmt1->execute() )
                $stmt2 = $this->conn->prepare($query2);
                    if($stmt2->execute())
                        return $stmt2;
        }catch(Exception $e) {
            return false;
        }
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
        return [ 'name', 'adminId' ];
    }
}