<?php include_once("header.php");?>
<div class="chapter_content">
    <?php
    $comic_id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Comic ID not found.');
    if($comic_id==1){
        $directory = 'images/oshi-no-ko/chap1';
    }elseif($comic_id==2){
        $directory = 'images/chanto-uenai-kyuuketsuki-chan/chap1';
    }elseif($comic_id==3){
        $directory = 'images/one-piece/chap1';
    }elseif($comic_id==4){
        $directory = 'images/onepunch-man/chap1';
    }elseif($comic_id==5){
        $directory = 'images/kimetsu-no-yaiba/chap1';
    }elseif($comic_id==6){
        $directory = 'images/dragon-quest/chap1';
    }elseif($comic_id==7){
        $directory = 'images/slam-dunk/chap1';
    }elseif($comic_id==8){
        $directory = 'images/jujutsu-kaisen/chap1';
    }elseif($comic_id==9){
        $directory = 'images/chainsawman/chap1';
    }elseif($comic_id==10){
        $directory = 'images/yozakura-san-chi-no-daisakusen/chap1';
    }elseif($comic_id==11){
        $directory = 'images/tensei-shitara-slime-datta-ken/chap1';
    }elseif($comic_id==12){
        $directory = 'images/no-game-no-life/chap1';
    }
    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
    $file_parts = array();
    $ext = '';
    $title = '';
    $i = 0;

    $dir_handle = @opendir($directory) or die("There is an error with your image directory!");

    while ($file = readdir($dir_handle)) {  
        if ($file == '.' || $file == '..') continue;

        $file_parts = explode('.', $file);
        $ext = strtolower(array_pop($file_parts));

        if (in_array($ext, $allowed_types)) {
            echo '<div id="page_'.$i.'" class="page-chapter">';
            echo '<img src="'.$directory.'/'.$file.'" alt="Image '.$i.'">';
            echo '</div>';
            $i++;
        }
    }

    closedir($dir_handle); 
    ?>
</div>

<?php include_once("footer.php");?>
