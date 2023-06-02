<?php
    include "include/header.php";
    include "include/sidebar.php";
    include "../classes/ncc.php";
?>

<?php
    $ncc = new ncc();

    if(!isset($_GET['ma_ncc']) || $_GET['ma_ncc'] == null){
        echo "<script>window.location = 'ncc.php'</script>";
    }
    else{
        $id = $_GET['ma_ncc'];
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    
        $updatencc = $ncc->update_ncc($_POST, $id);
    }

?>

<div class="content">
<p class="content-title">Sửa nhà cung cấp</p>
    <?php
        if(isset($updatencc)){
            echo $updatencc;
        }
    ?>

    <?php
        $result = $ncc->get_ncc_byid($id)->fetch_assoc();
    ?>
    <form action="" method="POST">
        <label for=""> Tên nhà cung cấp</label><br>
        <input required type="text" name="ten_ncc" placeholder="Tên nhà cung cấp" value="<?php echo $result['ten_ncc'] ?>"> <br>
        <label for="">Địa chỉ</label><br>
        <input required type="text" name="diachi" placeholder="Địa chỉ" value="<?php echo $result['diachi'] ?>"><br>
        <label for="">Số điện thoại</label><br>
        <input type="text" name="sodt" value="<?php echo $result['sodt'] ?>"> <br>
        <br>
        <input class="btn" type="submit" value="Cập nhật" name="submit">
        <input class="btn" type="reset" value="Nhập lại">

    </form>


</div>

<?php
// include "include/footer.php";
?>