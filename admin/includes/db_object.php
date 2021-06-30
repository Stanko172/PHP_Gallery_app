<?php

class Db_object{
    protected static $db_table = "";
    protected static $db_table_attr = array();

    public static function get_all(){
        $sql_query = "SELECT * FROM " . static::$db_table . ";";
        return static::activate_query($sql_query);
    }  
    
    public static function get_by_id($id){
        $sql_query = "SELECT * FROM " . static::$db_table .  " WHERE id=" . $id . ";";
        $result = static::activate_query($sql_query);

        return !empty($result) ? $result[0] : "User not found!";
    }

    private function has_attribute($attribute){
        if(array_key_exists($attribute, get_object_vars($this))){ return true; }
        return false;
    }

    private static function init($row){
        $called_class = get_called_class();
        $obj = new $called_class;

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
            $records[] = static::init($row);
        }

        return $records;
    }

    public function properties(){
        $properties = array();

        foreach(static::$db_table_attr as $attr){
            if(property_exists(get_called_class(), $attr)){
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

        $sql = "INSERT INTO " . static::$db_table . " (" . implode(',', array_keys($this->clean_properties())) . ")VALUES ('";
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

        $sql = "UPDATE " . static::$db_table . " SET ";
        $sql .= implode(", ", array_values($propety_pairs));
        $sql .= "WHERE id=" .$database->escaped_string($this->id);
        
        $database->query($sql);

        return mysqli_affected_rows($database->connection) ? true : false;
    }

    public function delete(){
        global $database;

        $sql = "DELETE FROM " . static::$db_table . " ";
        $sql .= " WHERE id=" . $database->escaped_string($this->id);

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }
}


?>