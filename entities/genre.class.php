<?php 
require_once("config/db.class.php");

class Genre{
    public $genreID;
    public $name;
    public function __construct($name){
        $this->name=$name;
    }
    public static function list_genre(){
        $db = new Db();
        $sql = "SELECT * FROM genres";
        $result =$db->select_to_array($sql);
        return $result;
    }
}
?>
