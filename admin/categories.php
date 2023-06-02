<?php 
include "include/header.php"; 
include "include/sidebar.php";
include "../classes/category.php"; ?>


<?php
    $cate = new category();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cate_name = $_POST['cate_name'];
        $insertcate = $cate->insert_category($cate_name);
    }
    if(isset($_GET['delid'])){
        $id = $_GET['delid'];
        $deletecate = $cate->delete_cate($id);
    }

?>

<div class="content">
    <p class="content-title">Danh mục sản phẩm</p>
    <div class="categories">
        <div class="addcat">
            <?php
            if (isset($insertcate)) {
                echo $insertcate;
            }
            if(isset($deletecate)){
                echo $deletecate;
            }   
            ?>
            <form action="categories.php" method="POST">
                <input type="text" name="cate_name" placeholder="Tên danh mục sản phẩm">
                <input class="btn" type="submit" value="Thêm mới" name="submit">
            </form>
            <br>
        </div>

        <div class="listcat">
            <table>
                <tr>
                    <th id="stt">STT</th>
                    <th>Mã danh mục</th>
                    <th>Tên danh mục</th>
                    <th>Thao tác</th>
                </tr>
                <?php
                    $show_cate = $cate->show_category();
                    if($show_cate){
                        $i = 0;
                        while($result = $show_cate->fetch_assoc()){
                            $i++;                        
                ?>
                <tr>
                    <td  id="stt"><?php echo $i; ?></td>
                    <td><?php echo $result['cate_id']; ?></td>
                    <td><?php echo $result['cate_name']; ?></td>
                    <td><a href="cateedit.php?cate_id=<?php echo $result['cate_id']; ?>">Sửa</a> 
                        <a class="xoa" onclick="return confirm('Bạn có chắc muốn xóa không?')"
                            href="?delid=<?php echo $result['cate_id']; ?>">Xóa</a>
                    </td>
                </tr>
                <?php
                        }
                    }
                ?>

            </table>
        </div>
    </div>
</div>

<?php
// include "include/footer.php";
?>