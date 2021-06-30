<?php

class Photo extends Db_object{
    protected static $db_table = "photos";
    protected static $db_table_attr = array('title', 'description', 'filename', 'type', 'size');
    public $id;
    public $title;
    public $description;
    public $filename;
    public $type;
    public $size;

    public $tmp_path;
    public $upload_dir = 'images';
    public $errors = array();
    public $upload_errors_array = array(
        0 => 'There is no error, the file uploaded with success.',
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form. ',
        3 => ' The uploaded file was only partially uploaded. ',
        4 => 'No file was uploaded. ',
        6 => 'Missing a temporary folder.',
        7 => 'Failed to write file to disk. ',
        8 => 'A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop'
    );

    public function image_path(){
        return $this->upload_dir . DS . $this->filename;
    }


    public function set_file($file){
        if(empty($file) || !is_array($file)){
            $this->errors[] = "Datoteka se nije uspjela prenijeti na poslužitelj";
            return false;
        }else if($file['error'] != 0){
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        }else{
            $this->filename = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];

            return true;
        }
    }

    public function save(){
        if($this->id){
            $this->update();
        }else{
            if(!empty($errors)){
                return false;
            }

            if(empty($this->filename) || empty($this->tmp_path)){
                $this->errors[] = "Datoteka nije dostupna";
                return false;
            }

            $target_path = ROOT_DIR . DS . $this->upload_dir . DS . $this->filename;

            if(move_uploaded_file($this->tmp_path, $target_path)){
                echo $this->tmp_path . "..." . $target_path;
                if($this->create()){
                    unset($this->tmp_path);
                    return true;
                }else{
                    $this->errors[] = "Dogodila se greška prilikom ubacivanja slike u bazu podataka";
                    return false;
                }
            }

        }


    }

}


?>