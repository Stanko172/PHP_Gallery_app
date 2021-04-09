<?php

class DB{

    public $connection;

    function __construct(){
        $this->open_db_connection();
    }

    public function open_db_connection(){
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if($this->connection->connect_error){
            die("Database connection failed! - " . $this->connection->connect_error);
        }
    }

    public function query($sql_query){
        $result = $this->connection->query($sql_query);

        if(!$result){
            die ("Query failed - " . $this->connection->error);
        }

        return $result;
    }

    public function escaped_string($string){
        return $this->connection->real_escape_string($string);
    }

}

$database = new DB();

?>