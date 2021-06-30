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

    public function properties(){
        $properties = array();

        foreach(self::$db_table_attr as $attr){
            if(property_exists('User', $attr)){
                $properties[$attr] = $this->$attr;
            }
        }

        return $properties;
    }

    public function clean_properties(){
        global $database;

        $clean_properties = array();

        foreach($this->properties() as $key => $value){
            $clean_properties[$key] = $database->escaped_string($value);
        }

        return $clean_properties;
    }

    public function save(){
        isset($this->id) ? $this->update() : $this->create();
    }

    public function create(){
        global $database;

        $sql = "INSERT INTO " . self::$db_table . " (" . implode(',', array_keys($this->clean_properties())) . ")VALUES ('";
        $sql .= implode("','", array_values($this->properties()));
        $sql .= "');";

        if(!$database->query($sql)){
            return false;
        }else{
            $this->id = mysqli_insert_id($database->connection);
            return true;
        }
    }

    public function update(){
        global $database;

        $propety_pairs = array();

        foreach($this->clean_properties() as $key => $value){
            $propety_pairs[] = "$key='$value'";
        }

        $sql = "UPDATE " . self::$db_table . " SET ";
        $sql .= implode(", ", array_values($propety_pairs));
        $sql .= "WHERE id=" .$database->escaped_string($this->id);
        
        $database->query($sql);

        return mysqli_affected_rows($database->connection) ? true : false;
    }

    public function delete(){
        global $database;

        $sql = "DELETE FROM " . self::$db_table . " ";
        $sql .= " WHERE id=" . $database->escaped_string($this->id);

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }
    
}

?>