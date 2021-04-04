<?php

class User{

    public static function get_all_users(){
        global $database;

        $sql_query = "SELECT * FROM users;";
        return $database->query($sql_query);
    }  
    
    public static function get_user($user_id){
        global $database;

        $sql_query = "SELECT * FROM users WHERE id=$user_id";
        $result = $database->query($sql_query);
        $user = $result->fetch_array();

        return $user;
    }
    
}

?>