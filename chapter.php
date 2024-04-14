<?php include_once("header.php");?>

<div class="chapter_content">
    <?php
    $directory = 'images/vampire-chan-cant-suck-properly/chap1'; // Đường dẫn đến thư mục chứa các hình ảnh
    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');  // Các định dạng file được phép
    $file_parts = array();
    $ext = '';
    $title = '';
    $i = 0;

    // Mở thư mục
    $dir_handle = @opendir($directory) or die("There is an error with your image directory!");

    while ($file = readdir($dir_handle)) {  // đọc thư mục
        if ($file == '.' || $file == '..') continue;

        $file_parts = explode('.', $file);  // tách tên file để lấy phần mở rộng
        $ext = strtolower(array_pop($file_parts));

        if (in_array($ext, $allowed_types)) {
            echo '<div id="page_'.$i.'" class="page-chapter">';
            echo '<img src="'.$directory.'/'.$file.'" alt="Image '.$i.'">';
            echo '</div>';
            $i++;
        }
    }

    closedir($dir_handle);  // Đóng thư mục
    ?>
</div>

<?php include_once("footer.php");?>