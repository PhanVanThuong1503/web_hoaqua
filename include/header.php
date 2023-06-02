<?php
    include "lib/session.php";
    Session::init();
?>
<?php
    include "lib/database.php";
    include "helpers/format.php";

    spl_autoload_register(function($classname){
        include_once "classes/".$classname.".php";
    });
    
    $db = new Database();
    $fm = new Format();
    $cart = new cart();
    $user = new user(); 
    $category = new category();
    $product = new product();
    $news = new news();
    $order = new order();
    $feedback = new feedback();
    

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <title>Văn Văn</title>
</head>



<body>
    <div class="header">
        <div class="logo">
            <img src="images/logo.png" alt="logo">
            <p>Văn Văn</p>
        </div>
        <div class="menu">
            <li><a href="index.php">TRANG CHỦ</a></li>
            <li><a href="gioithieu.php">GIỚI THIỆU</a></li>
            <li>
                <a href="sanpham.php">SẢN PHẨM
                    <i class="fas fa-angle-down"></i>
                </a>
                <ul>
                    <?php
                        $show_category = $category->show_category();
                        if($show_category){
                            while($result = $show_category->fetch_assoc()){
                    ?>
                    <li><a
                            href="category.php?cate_id=<?php echo $result['cate_id'] ?>"><?php echo $result['cate_name'] ?></a>
                    </li>
                    <?php  
                            }
                        }
                    ?>
                </ul>
            </li>
            <li><a href="tintuc.php">TIN TỨC</a></li>
            <li><a href="lienhe.php">LIÊN HỆ</a></li>
        </div>
        <div class="compo">
            <a href="cart.php" title="Giỏ hàng của bạn"><i class="fas fa-shopping-cart"></i></a>
            <span class="slcart">
                <?php
                    $check_cart = $cart->get_product_cart();
                    if($check_cart){
                        $cart->get_product_quantity();
                        $sum = Session::get('soluong');
                        if($sum>0)
                            echo $sum;
                    }
                ?>
            </span>


            <?php
                //Xóa giỏ hàng khi đăng xuất
                if(isset($_GET['user_id'])){
                    $deleteCart = $cart->deleteCart();
                    Session::destroy();
                }
            ?>
            <?php
                $login_check = Session::get("user_login");
                if($login_check==false){
                    echo 
                    '<div  class="account">
                    <i class="fas fa-user"></i>
                    Tài khoản
                    <i class="fas fa-angle-down" style="font-size: 18px"></i>
                    <ul class="account-child">
                        <li><a href="register.php">Đăng ký</a></li>
                        <li><a href="login.php">Đăng nhập</a></li>
                    </ul>
                    </div>
                    ';
                }
                else{
                    echo
                    '<div  class="account">
                        <i class="fas fa-user"></i> '.Session::get("name").'
                        <i class="fas fa-angle-down" style="font-size: 18px"></i>
                        <ul class="account-child">
                            <li><a href="user_info.php?u_id='.Session::get('user_id').'">Thông tin tài khoản</a></li>
                            <li><a href="order.php">Đơn hàng của tôi</a></li>
                            <li><a href="?user_id='.Session::get('user_id').'">Đăng xuất</a></li>
                        </ul>
                    </div>';
                }              
            ?>



        </div>
    </div>