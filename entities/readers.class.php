<?php 
require_once("config/db.class.php");

class Reader{
    public $readerID;
    public $username;
    public $email;
    public $password_hash;
    public function __construct($username,$email,$password_hash){
        $this->username=$username;
        $this->email=$email;
        $this->password_hash=$password_hash;
    }
    public static function list_reader(){
        $db = new Db();
        $sql = "SELECT * FROM readers";
        $result =$db->select_to_array($sql);
        return $result;
    }
}
?>
