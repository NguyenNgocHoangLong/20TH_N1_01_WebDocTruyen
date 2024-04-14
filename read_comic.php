<?php
    require_once("entities/comic.class.php");

    if(isset($_POST["comic_id"])) {
        $comicId = $_POST["comic_id"];
        // Cập nhật số lượng lượt theo dõi của truyện
        $result = Comic::readComic($comicId);
        if($result) {
            // Trả về số lượng lượt theo dõi mới
            echo json_encode(array('watchCount' => $result));
            exit;
        }
    }
?>