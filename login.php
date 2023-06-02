<?php
include "include/header.php";
?>
<?php 
    $login_check = Session::get("user_login");
    if($login_check){
        header('Location:cart.php');
    }
    
?>

<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    
        $login_user = $user->login_user($_POST);
    }

?>

<div class="content">
    <div class="dangky">
        <h2 style="text-align:center">ĐĂNG NHẬP</h2>
        <p style="text-align:center">
        <?php
        if(isset($login_user))
            echo $login_user;
        ?>
        </p>
        
        <div class="form_dk">
            <form action="" method="POST">
                <label for="">Email</label> <span style="color:red;">*</span><br>
                <input type="text" name="email"> <br>
                <label for="">Mật khẩu</label><span style="color:red;">*</span><br>
                <input type="password" name="password">
                <br>
                <br>
                <input type="submit" class="btndk" value="Đăng Nhập" name="submit">
                <input type="reset" class="btndk" value="Nhập lại">
            </form>
            <br>
            <p><a href="forgot_pass.php">Quên mật khẩu?</a></p><br>
            <p>Bạn chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
        </div>
    </div>
</div>


<?php
include "include/footer.php";
?>