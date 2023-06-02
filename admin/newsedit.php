<?php
    include "include/header.php";
    include "include/sidebar.php";
    include "../classes/news.php";
?>

<?php
   
    $news = new news();
    
    if(!isset($_GET['news_id']) || $_GET['news_id'] == null){
        echo "<script>window.location = 'news.php'</script>";
    }
    else{
        $id = $_GET['news_id'];
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    
        $updatenews = $news->update_news($_POST, $_FILES, $id);
    }


?>

<div class="content">
    <p class="content-title">Sửa tin tức</p>
    <?php
        if(isset($updatenews)){
            echo $updatenews;
        }
    ?>
    <?php
        $get_news_by_id = $news->getnewsbyId($id);
            if($get_news_by_id){
                while($result_news = $get_news_by_id->fetch_assoc()){

    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="">Tên tin tức</label><br>
        <input required type="text" name="news_name" placeholder="Tên tin tức" value="<?php echo $result_news['news_name']  ?>"> <br>
        <label for="">Ảnh minh họa</label> <br>
        <img src="uploads/<?php  echo $result_news['news_image']; ?>" alt="" width="90px">
        <input class="input-file" type="file" name="news_image"> <br>
        <label for="">Nội date_default_timezone_get</label><br>
        <textarea name="description" id="" cols="30" rows="10" placeholder="Nội dung tin tức"><?php echo $result_news['description']  ?></textarea>
        <br> <br>

        <input class="btn" type="submit" value="Cập nhật" name="submit">
        <input class="btn" type="reset" value="Nhập lại">
    </form>
    <?php
                }
            }
    ?>

</div>

<?php
// include "include/footer.php";
?>