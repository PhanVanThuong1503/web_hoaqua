<?php
    include "../classes/adminlogin.php";
?>

<?php
    $class = new adminlogin();
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $admin_user = $_POST['admin_user'];
        $admin_pass = ($_POST['admin_pass']); 
        $login_check = $class->login_admin($admin_user, $admin_pass);
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
        <h2>Đăng nhập admin</h2>
        <br>
        <?php
           
            if(isset($login_check)){
                echo $login_check;
            }
        ?>
        </span>
        <input required type="text" placeholder="Username" name="admin_user"><br>
        <input required type="password" placeholder="Password" name="admin_pass"><br>
        <input  class="btn" type="submit" name="submit" value="Đăng nhập"></input>
        <p style="margin-top: 20px; font-size: 18px">Bạn chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
    </form>
</body>
</html>