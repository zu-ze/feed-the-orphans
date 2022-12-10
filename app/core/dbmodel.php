<?php

abstract class DbModel extends Model 
{
    abstract public function tableName();
    abstract public function attributes();

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(function($attr){
            return ":$attr";
        }, $attributes);
        $statement = self::prepare("INSERT INTO $tableName (".implode(',',$attributes)
            .") VALUES (".implode(',', $params).")");
        
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();

        return true;
    }

    public function find($id)
    {
        $tableName = $this->tableName();

        $results = Application::$app->database->getOne("SELECT * FROM $tableName WHERE id=$id");

        if(!$results){
            return false;
        }else
            return $results;
    }

    public function all()
    {
        $tableName = $this->tableName();

        $results = Application::$app->database->getAll("SELECT * FROM $tableName;");

        if(!$results){
            return false;
        }else
            return $results;
    }

    public function update($id)
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(function($attr){
            return ":$attr";
        }, $attributes);
        $sql = "UPDATE $tableName SET ";
        foreach ($attributes as $key => $attribute) {
            $attributes[$key] = $attribute . "=" . $params[$key];
        }
        $sql .= implode(',', $attributes)." WHERE id=$id;";

        $attributes = $this->attributes();
        $statement = self::prepare($sql);
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();

        return true;
    }

    public function delete($id)
    {
        $tableName = $this->tableName();

        $statement = self::prepare("DELETE FROM $tableName WHERE id=:id;");
        $statement->bindValue(":id", $id);
        $statement->execute();

        return true;
    }

    public static function prepare($sql)
    {
        return Application::$app->database->prepare($sql);
    }
}