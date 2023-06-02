<?php
include "include/header.php";
?>
<?php
    $user = new user();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $get_newpass = $user->forgot_pass($_POST['email']);
    }

?>


<div class="content">
    <h2 style="text-align:center">Quên mật khẩu</h2>
    <p style="text-align:center">
    <?php
       if(isset($get_newpass)){
            echo $get_newpass;
       }
    ?>
    </p>

    <div class="form_dk">
        <form action="" method="POST">
            <label for="">Email</label> <br>
            <input required type="text" name="email" placeholder="Email"> <br>

            <input class="btndk" type="submit" style="width: 200px !important; margin-top: 30px" value="Gửi mật khẩu mới" name="submit">

        </form>

    </div>
</div>

<?php
include "include/footer.php";
?>