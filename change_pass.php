<?php
include "include/header.php";
?>
<?php
    $user = new user();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $change_pass = $user->change_pass($_POST);
    }

?>


<div class="content">
    <h2 style="text-align:center">Đổi mật khẩu</h2>
    <p style="text-align:center">
    <?php
       if(isset($change_pass)){
            echo $change_pass;
       }
    ?>
    </p>

    <?php $email = $user->getuserbyId(Session::get('user_id'))->fetch_assoc(); ?>
    <div class="form_dk">
        <form action="" method="POST">
            <label for="">Email</label> <br>
            <input readonly required type="text" name="email" placeholder="Email" value="<?php echo $email['email'] ?>" > <br>
            <label for="">Mật khẩu hiện tại</label>
            <input required type="password" name="current_pass">
            <label for="">Mật khẩu mới</label>
            <input required type="text" name="new_pass">

            <input class="btndk" type="submit" style="width: 200px !important; margin-top: 30px" value="Đổi mật khẩu" name="submit">

        </form>

    </div>
</div>

<?php
include "include/footer.php";
?>