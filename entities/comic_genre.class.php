<?php 
require_once("config/db.class.php");

class Comic{
    public $comic_id;
    public $genre_id;
    
    public function __construct($comic_id,$genre_id){
        $this->comic_id=$comic_id;
        $this->genre_id=$genre_id;
    }
    public function save(){
        $db = new Db();
        $sql = "INSERT INTO comic_genres (comic_id, genre_id) VALUES 
        ('$this->comic_id', '$this->genre_id')";
        $result = $db->query_execute($sql);
        return $result;
    }
    public static function list_comic_genre(){
        $db = new Db();
        $sql = "SELECT * FROM comic_genres";
        $result =$db->select_to_array($sql);
        return $result;
    }
}
?>
