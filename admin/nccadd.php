<?php
    include "include/header.php";
    include "include/sidebar.php";
    include "../classes/ncc.php";
?>

<?php
    $ncc = new ncc();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    
        $insertncc = $ncc->insert_ncc($_POST);
    }


?>

<div class="content">
<p class="content-title">Thêm nhà cung cấp mới</p>
    <?php
        if(isset($insertncc)){
            echo $insertncc;
        }
    ?>
    <form action="" method="POST">
        <label for=""> Tên nhà cung cấp</label><br>
        <input required type="text" name="ten_ncc" placeholder="Tên nhà cung cấp"> <br>
        <label for="">Địa chỉ</label><br>
        <input required type="text" name="diachi" placeholder="Địa chỉ"><br>
        <label for="">Số điện thoại</label><br>
        <input type="text" name="sodt"> <br>
        <br>
        <input class="btn" type="submit" value="Thêm" name="submit">
        <input class="btn" type="reset" value="Nhập lại">

    </form>


</div>

<?php
// include "include/footer.php";
?>