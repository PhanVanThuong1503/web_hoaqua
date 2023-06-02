<?php
include "include/header.php";
include "include/sidebar.php";
include "../classes/category.php";
?>

<?php
$cate = new category();
if(!isset($_GET['cate_id']) || $_GET['cate_id'] == null){
    echo "<script>window.location = 'categories.php'</script>";
}
else{
    $id = $_GET['cate_id'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cate_name = $_POST['cate_name'];
    $updatecate = $cate->update_category($cate_name, $id);
}


?>

<div class="content">
    <p class="content-title">Sửa danh mục sản phẩm</p>
    <?php
        if (isset($updatecate)) {
            echo $updatecate;
        }
        ?>

    <?php
            $get_cate_name = $cate->getcatebyId($id);
            if($get_cate_name){
                while($result = $get_cate_name->fetch_assoc()){

               
        ?>
    <form action="" method="POST">
        <label for="">Tên danh mục</label>
        <input type="text" name="cate_name" placeholder="Tên danh mục sản phẩm"
            value="<?php echo $result['cate_name']; ?>">
        <input type="submit" class="btn" value="Cập nhật" name="submit">
    </form>

    <?php
        }
    }
    ?>
</div>


</div>
</div>

<?php
// include "include/footer.php";
?>