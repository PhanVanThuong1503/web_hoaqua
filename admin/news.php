<?php 
    include "include/header.php";
    include "include/sidebar.php";
    include "../classes/news.php";
    include_once "../helpers/format.php";

?>

<?php
     $news = new news();
     $fm = new Format();

    if (isset($_GET['news_id'])) {
        $id = $_GET['news_id'];
        $deletenews = $news->delete_news($id);
    }
    
?>
<div class="content">
    <p class="content-title">Danh sách tin tức</p>
    <?php
        if(isset($deletenews)){
            echo $deletenews."<br>";
        }
    ?>
    <table>
        <tr>
            <th id="stt">STT</th>
            <th>Mã tin tức</th>
            <th>Tên tin tức</th>
            <th>Ảnh minh họa</th>
            <th>Nội dung</th>
            <th>Thao tác</th>
        </tr>
        <?php
            $news_list = $news->show_news();
            if($news_list){
                $i = 0;
                while($result = $news_list->fetch_assoc()){
                    $i ++;
        ?>
        <tr>
            <td  id="stt"><?php echo $i; ?></td>
            <td ><?php  echo $result['news_id'] ?></td>
            <td ><?php  echo $result['news_name'] ?></td>
            <td ><img src="uploads/<?php  echo $result['news_image'] ?>" alt="" width="70px"></td>
            <td><?php //echo $fm->textShorten($result['description'], 50 )
                    echo $result['description'];
            ?></td>
            <td >
                <a href="newsedit.php?news_id=<?php echo $result['news_id']?>">Sửa</a>  
                <a class="xoa" onclick="return confirm('Bạn có chắc muốn xóa không?')" href="?news_id=<?php echo $result['news_id']; ?>">Xóa</a>
            </td>
        </tr>

        <?php
                }
            }
        ?>
    </table>
</div>

<?php
    // include "include/footer.php";
?>