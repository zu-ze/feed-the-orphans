<?php

class User extends DbModel
{
    const USER_ADMIN = 4;
    const USER_ORPHANAGE = 3;
    const USER_DONOR = 2;
    const USER_GUEST = 1;

    public $userId;
    public $username;
    public $email;
    public $phone;
    public $status = self::STATUS_INACTIVE;
    public $role = self::USER_GUEST;
    public $password;
    public $confirmPassword;

    public function tableName()
    {
        return 'users';
    }

    public function attributes()
    {
        return [ 'username', 'email', 'phone', 'password', 'status', 'role'];
    }

    public function save()
    {
        $this->status = self::STATUS_INACTIVE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules()
    {
        return [
            'surname' => [self::$RULE_REQUIRED],
            'email' => [self::$RULE_REQUIRED, self::$RULE_EMAIL, [
                self::$RULE_UNIQUE, 'class' => self::class
            ]],
            'password' => [self::$RULE_REQUIRED, [self::$RULE_MIN, 'min' => 8], [self::$RULE_MAX, 'max' => 24]],
        ];
    }

    public function login()
    {
        $statement = $this->prepare("SELECT * FROM ".$this->tableName()." WHERE 
                    email='$this->email'");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC)[0] ?? false;
        if(password_verify($this->password, $result['password'])){
            Application::$app->session->setUser((object)$result);
            return true;
        }else {
            return false;
        }
    }
}