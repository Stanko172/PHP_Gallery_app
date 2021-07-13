<?php

class Comment extends Db_object{
    protected static $db_table = "comments";
    protected static $db_table_attr = array('photo_id', 'author', 'body');
    public $id;
    public $photo_id;
    public $author;
    public $body;

    public static function create_comment($photo_id, $author, $body){
        if(!empty($photo_id) && !empty($author) && !empty($body)){
            $comment = new Comment();

            $comment->photo_id = $photo_id;
            $comment->author = $author;
            $comment->body = $body;

            return $comment;
        }else{
            return false;
        }
    }

    public static function get_all_comments_for_image($photo_id){
        $sql = "SELECT * FROM " . self::$db_table . " ";
        $sql .= " WHERE photo_id = " . $photo_id;
        $sql .= " ORDER BY photo_id ASC";

        return self::activate_query($sql);
    }
}


?>