<?php
      include "../classes/adminlogin.php";
?>
<?php
$admin = new adminlogin();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $register_admin = $admin->register_admin($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <form class="form-login" action="" method="POST">
        <h2>Đăng ký tài khoản admin</h2>
        <?php
           if(isset($register_admin))
            echo $register_admin;
        ?>
        </span>
        <br>
        <input required type="text" placeholder="Họ tên" name="admin_name"><br>
        <input required type="text" placeholder="Email" name="admin_email"><br>
        <input required type="text" placeholder="Username" name="admin_user"><br>
        <input required type="password" placeholder="Password" name="admin_pass"><br>
        <input class="btn" type="submit" name="submit" value="Đăng ký"></input>
    </form>
</body>