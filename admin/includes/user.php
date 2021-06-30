<?php

class User extends Db_object{
    protected static $db_table = 'users';
    protected static $db_table_attr = array('username', 'password', 'first_name', 'last_name');
    public $id;
    public $username;
    public $first_name;
    public $last_name;
    public $password;

    public static function verify_user($username, $password){
        global $database;

        $username = $database->escaped_string($username);
        $password = $database->escaped_string($password);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE `username`='{$username}' AND `password`='{$password}'";

        $result = self::activate_query($sql);
        
        return !empty($result) ? array_shift($result) : false; 
    }
    
}

?>