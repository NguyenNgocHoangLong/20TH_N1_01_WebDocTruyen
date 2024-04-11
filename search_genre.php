<?php
    include_once("header.php");
    require_once("entities/comic.class.php");

    $genre_id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Genre ID not found.');

    $prods = Comic::list_comic_by_genre($genre_id);
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
    echo "</div>";
?>
