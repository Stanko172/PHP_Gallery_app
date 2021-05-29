<?php

class User{
    public $id;
    public $username;
    public $first_name;
    public $last_name;
    public $password;

    public static function get_all_users(){
        $sql_query = "SELECT * FROM users;";
        return self::activate_query($sql_query);
    }  
    
    public static function get_user($user_id){
        $sql_query = "SELECT * FROM users WHERE id=$user_id";
        $result = self::activate_query($sql_query);

        return !empty($result) ? $result[0] : "User not found!";
    }

    private function has_attribute($attribute){
        if(array_key_exists($attribute, get_object_vars($this))){ return true; }
        return false;
    }

    private static function init($row){
        $obj = new self;

        foreach($row as $attribute => $value){
            if($obj->has_attribute($attribute)){
                $obj->$attribute = $value;
            }
        }

        return $obj;
    }

    public static function activate_query($sql_query){
        global $database;
        $records = array();

        $result = $database->query($sql_query);

        while($row = $result->fetch_assoc()){
            $records[] = self::init($row);
        }

        return $records;
    }

    public static function verify_user($username, $password){
        global $database;

        $username = $database->escaped_string($username);
        $password = $database->escaped_string($password);

        $sql = "SELECT * FROM users WHERE `username`='{$username}' AND `password`='{$password}'";

        $result = self::activate_query($sql);
        
        return !empty($result) ? array_shift($result) : false; 
    }

    public function create(){
        global $database;

        $sql = "INSERT INTO users (`username`, `password`, `first_name`, `last_name`) VALUES ('";
        $sql .= $database->escaped_string($this->username) . "', '";
        $sql .= $database->escaped_string($this->password) . "', '";
        $sql .= $database->escaped_string($this->first_name) . "', '";
        $sql .= $database->escaped_string($this->last_name) . "'";
        $sql .= ");";

        if(!$database->query($sql)){
            return false;
        }else{
            $this->id = mysqli_insert_id($database->connection);
            return true;
        }
    }
    
}

?>