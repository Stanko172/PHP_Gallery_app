<?php

class DB{

    public $connection;

    function __construct(){
        $this->open_db_connection();
    }

    public function open_db_connection(){

        $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if($this->connection){
            
            echo "Connection established!";

        }else{
            die("Database connection failed!");
        }

    }

}

$database = new DB();

?>