<?php 
include_once("header.php");
require_once("entities/comic.class.php");
require_once("config/db.class.php");

$db = new Db();
$conn = $db->connect();

$comic_id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Comic ID not found.');

$query = "SELECT comics.*, GROUP_CONCAT(genres.name SEPARATOR ', ') AS genre_name FROM comics LEFT JOIN comic_genres ON comics.comic_id = comic_genres.comic_id LEFT JOIN genres ON comic_genres.genre_id = genres.genre_id WHERE comics.comic_id = ? GROUP BY comics.comic_id LIMIT 0,1";

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
        echo "</div>";
    } else {
        echo "<div>Comic not found.</div>";
    }
} else {
    echo "Error preparing statement.";
}?>
<ul class="menu">
    <li>
        <a href="list_comic.php">Quay lại</a>
    </li>
</ul>
<?php
include_once("footer.php"); 
?>
