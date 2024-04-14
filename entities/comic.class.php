<?php 
require_once("config/db.class.php");

class Comic{
    public $comicID;
    public $title;
    public $description;
    public $image;
    public $views;
    public $like;
    public $watch;
    public $readed;

    public function __construct($title,$description,$views,$image,$like,$watch,$readed){
        $this->title=$title;
        $this->description=$description;
        $this->views=$views;
        $this->image=$image;
        $this->like=$like;
        $this->watch=$watch;
        $this->readed=$readed;
    }
    public function save(){
        $db = new Db();
        $sql = "INSERT INTO comics (title, description, image, views,like,watch,readed) VALUES 
        ('$this->title', '$this->description', '$this->image', '$this->views','$this->like','$this->watch','$this->readed')";
        $result = $db->query_execute($sql);
        return $result;
    }
    public static function list_comic(){
        $db = new Db();
        $sql = "SELECT * FROM comics";
        $result =$db->select_to_array($sql);
        return $result;
    }
    public static function list_comic_DESC(){
        $db = new Db();
        $sql = "SELECT * FROM comics ORDER BY views DESC";
        $result =$db->select_to_array($sql);
        return $result;
    }
    public static function list_comic_DESC_rank(){
        $db = new Db();
        $sql = "SELECT * FROM comics ORDER BY views DESC LIMIT 4";
        $result =$db->select_to_array($sql);
        return $result;
    }
    public static function list_comic_by_genre($genre_id){ //chưa làm xong
        $list = array();
        $db = new PDO('your_dsn', 'your_username', 'your_password');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM comics WHERE genre_id = :genre_id";
        
        try {
            $stmt = $db->prepare($query);
            $stmt->bindParam(':genre_id', $genre_id, PDO::PARAM_INT);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $list[] = $row;
            }

            return $list;
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    public static function search_comic($keyword) {
        $db = new Db();
        $sql = "SELECT * FROM comics WHERE title LIKE '%$keyword%'";
        $results = $db->select_to_array($sql);
        return $results;
    }
    public static function watch_comic() {
        $db = new Db();
        $sql = "SELECT * FROM comics WHERE watch >= '1'";
        $results = $db->select_to_array($sql);
        return $results;
    }
    public static function read_comic() {
        $db = new Db();
        $sql = "SELECT * FROM comics WHERE readed >= '1'";
        $results = $db->select_to_array($sql);
        return $results;
    }
    public static function getComicById($comicId) {
        $db = new Db();
        $sql = "SELECT * FROM comics WHERE comicID = ?";
        $connection = $db->connect();
        $stmt = $connection->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $comicId);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $comicData = $result->fetch_assoc();
                return $comicData;
            } else {
                return null;  // No comic found with that ID
            }
        } else {
            return null;  // Failed to prepare the statement
        }
    }
}
?>