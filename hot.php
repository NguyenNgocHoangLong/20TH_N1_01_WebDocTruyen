<?php
    require_once("entities/comic.class.php");
?>

<?php 
    include_once("header.php");
    $prods = Comic::list_comic_DESC();
    $count = 0;
    echo "<div class='product-list'>";
    foreach($prods as $item){
        if ($count % 4 == 0 ) {
            echo "<div class='row'>";
        }
        echo "<div class='product-item'>";
        echo "<img src='images/{$item["image"]}' alt='{$item["title"]}'>";
        echo "<p>{$item["title"]}</p>";
        echo "<p>{$item["views"]}</p>";
        echo "<a href='comic.php?id={$item["comic_id"]}'><button>Xem chi tiết</button></a>";
        echo "</div>";
        $count++;
        if ($count % 4 == 0 || $count == count($prods)) {
            echo "</div>"; // Đóng row sau mỗi 3 sản phẩm hoặc khi là sản phẩm cuối cùng
        }
    }
    echo "</div>";?>
    <ul class="menu">
        <li>
            <a href="list_comic.php">Quay lại</a>
        </li>
    </ul>
<?php include_once("footer.php"); ?>
