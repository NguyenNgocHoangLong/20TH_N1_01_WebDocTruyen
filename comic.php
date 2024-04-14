<?php 
include_once("header.php");
require_once("entities/comic.class.php");
require_once("config/db.class.php");

$db = new Db();
$conn = $db->connect();

$comic_id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Comic ID not found.');

$query = "SELECT comics.*, GROUP_CONCAT(genres.name SEPARATOR ', ') AS genre_name FROM comics LEFT JOIN comic_genres ON comics.comic_id = comic_genres.comic_id LEFT JOIN genres ON comic_genres.genre_id = genres.genre_id WHERE comics.comic_id = ? GROUP BY comics.comic_id LIMIT 0,1";
$comic_id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Comic ID not found.');
if($stmt = $conn->prepare($query)){
    $stmt->bind_param("i", $comic_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        echo "<div class='comic-detail'>";
        echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
        echo "<img src='images/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['title']) . "' />";
        echo "<p>Genre: " . htmlspecialchars($row['genre_name']) . "</p>";
        echo "<p>" . htmlspecialchars($row['description']) . "</p>";
        echo "<p>Views: " . htmlspecialchars($row['views']) . "</p>";
        echo "<p>Likes: " . htmlspecialchars($row['like']) . "</p>";
        echo "<p>Follows: " . htmlspecialchars($row['watch']) . "</p>";
        echo "<p>Reads: " . htmlspecialchars($row['readed']) . "</p>";
        echo "<p><button onclick='likeComic({$row['comic_id']})'>Thích</button></p>"; 
        echo "<p><button onclick='watchComic({$row['comic_id']})'>Theo dõi</button></p>";
        echo "<p><button onclick='readedComic({$row['comic_id']})'>Đọc</button></p>";
        echo "<a href='chapter.php?id={$row["comic_id"]}'><button>chap 1</button></a>";
        echo "</div>";?>
    <?php } else {
        echo "<div>Comic not found.</div>";
    }
} else {
    echo "Error preparing statement.";
}?>
<script>
    function likeComic(comicId) {
        $.post('like_comic.php', {comic_id: comicId}, function(data) {
            $('p#likeCount').text(data.likeCount);
        }, 'json');
    }

    function watchComic(comicId) {
        $.post('watch_comic.php', {comic_id: comicId}, function(data) {
            $('p#watchCount').text(data.watchCount);
        }, 'json');
    }

    function readedComic(comicId) {
        $.post('read_comic.php', {comic_id: comicId}, function(data) {
            $('p#likeCount').text(data.likeCount);
        }, 'json');
    }

    public static function likeComic($comicId) {
        $comic = self::getComicById($comicId);
        if($comic) {
            $comic->like++;
            if($comic->save()) {
                return $comic->like;
            }
        }
        return false;
    }

    public static function watchComic($comicId) {
        $comic = self::getComicById($comicId);
        if($comic) {
            $comic->watch++;
            if($comic->save()) {
                return $comic->watch;
            }
        }
        return false;
    }

    public static function readedComic($comicId) {
        $comic = self::getComicById($comicId);
        if($comic) {
            $comic->readed++;
            if($comic->save()) {
                return $comic->readed;
            }
        }
        return false;
    }
</script>
<ul class="menu">
    <li>
        <a href="list_comic.php">Quay lại</a>
    </li>
</ul>
<?php
include_once("footer.php"); 
?>