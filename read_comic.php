<?php
    require_once("entities/comic.class.php");

    if(isset($_POST["comic_id"])) {
        $comicId = $_POST["comic_id"];
        $result = Comic::readComic($comicId);
        if($result) {
            echo json_encode(array('watchCount' => $result));
            exit;
        }
    }
?>
