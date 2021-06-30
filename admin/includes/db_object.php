<?php

class Db_object{
    protected static $db_table = "";

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
}


?>