<?php
   include "../lib/session.php";
    Session::checkSession();
?>

<?php
    

?>
<!-- ?php
   header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    header("Cache-Control: max-age=2592000");
?> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" type="text/css">

    <title>Admin</title>
</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="../images/logo.png" alt="">
            <h2>Văn Văn</h2>
        </div>
        <div class="compo">
            <a class="notifi" href=""><i class="fas fa-bell"></i></a>
            <a class="user" href=""><i class="fas fa-user-circle"></i></a>
            <p class="admin_name">
            <?php 
                $admin_name =  session::get('admin_name');
                if($admin_name){
                    echo $admin_name;
                }
                if (isset($_GET['action']) && $_GET['action'] == 'logout') {
                    Session::destroy();
                }
            ?>
            </p>
            <a href='?action=logout'>Logout</a>
            
        </div>
    </div>