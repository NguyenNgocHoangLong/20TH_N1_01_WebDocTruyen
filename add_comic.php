<?php 
    require_once("entities/comic.class.php");
    require_once("entities/genre.class.php");
    if(isset($_POST["btnsubmit"])){
        $title = $_POST["txtName"];
        $description = $_POST["txtDescription"];
        $image = $_POST["txtImage"];
        $views = $_POST["txtViews"];
        $newComic =new Comic($title, $description, $image, $views);
        $result = $newComic->save();
        if(!$result)
        {
            header("Location: add_comic.php?failure");
        }
        else {
            header("Location: add_comic.php?inserted");
        }
           
    }
?>

<?php include_once("header.php"); ?>
<?php
    if(isset($_GET["inserted"])) {
        echo "<h2>Thêm truyện thành công</h2>";
    }
?>
<form method="post">
    <div class="row">
        <div class="lbltitle">
            <label>Tên truyện</label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtName" value="<?php echo isset($_POST["txtName"]) ? $_POST["txtName"]: ""; ?>"/>
        </div>
    </div>
    <div class="row">
        <div class="lbltitle">
            <label>Mô tả truyện</label>
        </div>
        <div class="lblinput">
            <textarea name="txtDescription" cols="21" rows="10" value="<?php echo isset($_POST["txtDescription"]) ? $_POST["txtDescription"]: ""; ?>"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="lbltitle">
            <label>Views</label>
        </div>
        <div class="lblinput">
            <textarea name="txtViews" value="<?php echo isset($_POST["txtViews"]) ? $_POST["txtViews"]: ""; ?>"></textarea>
        </div>
    </div>
    <div class="row">
    <div class="lbltitle">
        <label>Thể loại</label>
    </div>
    <div class="lblinput">
        <select name="txtGenre">
            <?php
                $genres = Genre::list_genre();
                foreach($genres as $genre) {
                    echo "<option value='".$genre["genreID"]."'>".$genre["name"]."</option>";
                }
            ?>
        </select>
    </div>

    <div class="row">
        <div class="lbltitle">
            <label>Ảnh bìa truyện</label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtImage" placeholder="Nhập đường dẫn hình ảnh từ máy tính hoặc internet">
        </div>
    </div>
    <div class="row">
        <div class="submit">
            <input type="submit" name="btnsubmit" value="Thêm truyện"/>
        </div>
    </div>
</form>
<ul class="menu">
    <li>
        <a href="index.php">Quay lại</a>
    </li>
</ul>
<?php include_once("footer.php"); ?>
