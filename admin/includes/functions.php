<?php

    function __autoload($class){
        $class = strtolower($class);

        $file_path = "includes/$class.php";

        !file_exists($file_path) ? die("File $class.php does not exist!") : require_once($file_path);
    }

    function redirect($location){
        header("Location:$location");
    }

?>