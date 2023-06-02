<?php
    include "include/header.php";
    include "include/sidebar.php";
    include "../classes/news.php";
?>

<?php
    //$cate = new category();
    $news = new news();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    
        $insertnews = $news->insert_news($_POST, $_FILES);
    }


?>

<div class="content">
    <p class="content-title">Thêm tin tức mới</p>
    <?php
        if(isset($insertnews)){
            echo $insertnews;
        }
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="">Tên tin tức</label> <br>
        <input required type="text" name="news_name" placeholder="Tên tin tức"> <br>
        <label for="">Ảnh min họa</label><br>
        <input class="input-file" type="file" name="news_image"> <br>
        <label for="">Nội dung</label><br>
        <textarea name="description" id="" cols="30" rows="10" placeholder="Nội dung tin tức"></textarea>
        <br> <br>

        <input class="btn" type="submit" value="Thêm" name="submit">
        <input class="btn" type="reset" value="Nhập lại">
    </form>


</div>

<?php
//include "include/footer.php";
?>