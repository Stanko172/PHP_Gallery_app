<?php

class User extends Db_object{
    protected static $db_table = 'users';
    protected static $db_table_attr = array('username', 'password', 'first_name', 'last_name', 'user_image');
    public $id;
    public $username;
    public $first_name;
    public $last_name;
    public $password;
    public $user_image;

    public $tmp_path;
    public $image_folder = 'images';

    public static function verify_user($username, $password){
        global $database;

        $username = $database->escaped_string($username);
        $password = $database->escaped_string($password);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE `username`='{$username}' AND `password`='{$password}'";

        $result = self::activate_query($sql);
        
        return !empty($result) ? array_shift($result) : false; 
    }

    public function image_path(){
        return empty($this->user_image) ? 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png' : $this->image_folder . DS . $this->user_image;
    }

    public function delete_user(){
        if($this->delete()){
            $target_path = ROOT_DIR . DS . $this->image_folder . DS . $this->user_image;
            unlink("$target_path") ? true : false;
        }else{
            return false;
        }
    }

    public function set_file($file){
        if(empty($file) || !is_array($file)){
            return false;
        }else if($file['error'] != 0){
            return false;
        }else{
            $this->user_image = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];

            return true;
        }
    }

    public function image_path_local(){
        return $this->image_folder . DS . $this->user_image;
    }
    
}

?>