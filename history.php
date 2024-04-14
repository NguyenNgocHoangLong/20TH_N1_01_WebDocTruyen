<?php include_once("header.php"); ?>

<?php
require_once("entities/comic.class.php");
    $prods = Comic::read_comic();
    $count = 0;
    echo "<div class='product-list'>";
    foreach($prods as $item){
        if ($count % 4 == 0 ) {
            echo "<div class='row'>";
        }
        echo "<div class='product-item'>";
        echo "<img src='images/{$item["image"]}' alt='{$item["title"]}'>";
        echo "<p>{$item["title"]}</p>";
        echo "<a href='comic.php?id={$item["comic_id"]}'><button>Xem chi tiết</button></a>";
        echo "</div>";
        $count++;
        if ($count % 4 == 0 || $count == count($prods)) {
            echo "</div>";
        }
    }
    echo "</div>";?>
    <ul class="menu">
        <li>
            <a href="list_comic.php">Quay lại</a>
        </li>
    </ul>

<?php include_once("footer.php"); ?>