<?php 
require_once("config/db.class.php");

class Comic{
    public $comicID;
    public $title;
    public $description;
    public $image;
    public $views;

    public function __construct($title,$description,$views,$image){
        $this->title=$title;
        $this->description=$description;
        $this->views=$views;
        $this->image=$image;
    }
    public function save(){
        $db = new Db();
        $sql = "INSERT INTO comics (title, description, image, views) VALUES 
        ('$this->title', '$this->description', '$this->image', '$this->views')";
        $result = $db->query_execute($sql);
        return $result;
    }
    public static function list_comic(){
        $db = new Db();
        $sql = "SELECT * FROM comics";
        $result =$db->select_to_array($sql);
        return $result;
    }
}
?>