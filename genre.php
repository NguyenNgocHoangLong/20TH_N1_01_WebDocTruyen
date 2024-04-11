<?php
    require_once("entities/genre.class.php");
?>

<?php 
    include_once("header.php");
    $prods = Genre::list_genre();
    $count = 0;
    echo "<div class='product-list'>";
    foreach($prods as $item){
        if ($count % 4 == 0 ) {
            echo "<div class='row'>";
        }
        echo "<div class='product-item'>";
        //echo "<p>{$item["name"]}</p>";
        echo "<a href='search_genre.php?id={$item["genre_id"]}'><button><p>{$item["name"]}</p></button></a>";
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
<?php
    include_once("footer.php");
?>