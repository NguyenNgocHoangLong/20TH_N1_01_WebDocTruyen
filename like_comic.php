<?php
    require_once("entities/comic.class.php");

    if(isset($_POST["comic_id"])) {
        $comicId = $_POST["comic_id"];
        // Cập nhật số lượng lượt thích của truyện
        $result = Comic::likeComic($comicId);
        if($result) {
            // Trả về số lượng lượt thích mới
            echo json_encode(array('likeCount' => $result));
            exit;
        }
    }
?>
