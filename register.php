<?php
include "include/header.php";

?>
<?php
   
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    
        $register_user = $user->register_user($_POST);
    }
   

?>


<div class="content">
    <div class="dangky">
        <h2 style="text-align: center">ĐĂNG KÝ TÀI KHOẢN</h2>
        <p style="text-align:center">
            <?php
            if(isset($register_user)){
                echo $register_user;
            }
            ?>
        </p>
        <div class="form_dk">
            <form action="" method="POST">
                <label for="">Email</label><span style="color:red;">*</span><br>
                <input type="text" name="email"> <br>
                <label for="">Điện thoại</label><span style="color:red;">*</span><br>
                <input type="text" name="phone"> <br>             
                <label for="">Mật khẩu </label> <span style="color:red;">*</span><br>
                <input type="password" name="password"> <br>
                <label for="">Họ và tên</label> <span style="color:red;">*</span><br>
                <input type="text" name="name"> <br>
                <label for="">Địa chỉ</label><span style="color:red;">*</span><br>
                <input type="text" name="address"> <br>
                <br>
                <input type="submit" name="submit" class="btndk" value="Đăng ký">
                <input type="reset" class="btndk" value="Nhập lại">
            </form>
        </div>
    </div>
</div>

<?php
include "include/footer.php";
?>