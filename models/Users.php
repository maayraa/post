<?php
require_once 'DbConnect.php';

class Users
{
    public $table = 'users';
    static public function findUser($item, $value)
    {
        $stmt = DbConnect::connect()->prepare(
            'SELECT * FROM users WHERE '. $item . ' = :value'
        );
        $stmt->bindParam(':value', $value, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }
}