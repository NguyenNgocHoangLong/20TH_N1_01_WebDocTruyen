<?php include_once("header.php"); ?>

<h3>Tìm kiếm</h3>

<form method="GET">
    <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm">
    <button type="submit">Tìm kiếm</button>
</form>

<?php
require_once("entities/comic.class.php");

if(isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];

    // Thực hiện truy vấn SQL để tìm kiếm các mục phù hợp trong bảng comics
    $results = Comic::search_comic($keyword);

    if($results) {
        // Hiển thị kết quả
        echo "<div class='product-list'>";
        foreach($results as $item) {
            echo "<div class='product-item'>";
            echo "<img src='images/{$item["image"]}' alt='{$item["title"]}'>";
            echo "<p>{$item["title"]}</p>";
            echo "<a href='comic.php?id={$item["comic_id"]}'><button>Xem chi tiết</button></a>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        // Hiển thị thông báo nếu không có kết quả
        echo "<p>Không có truyện phù hợp</p>";
    }
}
?>

<?php include_once("footer.php"); ?>