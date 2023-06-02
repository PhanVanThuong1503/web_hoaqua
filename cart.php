<?php
include "include/header.php";
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $cart_id = $_POST['cart_id'];
    $quantity = $_POST['quantity'];
    $update_quantity_cart = $cart->update_quantity_cart($quantity, $cart_id);
}

if (isset($_GET['cart_id'])) {
    $cart_id = $_GET['cart_id'];
    $delete_product_cart = $cart->delete_product_cart($cart_id);
}

// Đăng nhập trước khi thanh toán
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['thanhtoan'])) {
    $login_check = Session::get("user_login");
    $canhbao = "";
    if($login_check==false){
       $canhbao = "<br><span style='color: red; font-size: 18px'>Bạn phải đăng nhập trước khi thanh toán!</span>";
    }
    else{
        //Phải có sản phẩm trong giỏ hàng thì cho phép thanh toán
        $cart->get_product_quantity();
        $sum = Session::get('soluong');
        if($sum>0){
            header("Location:thanhtoan.php");
        }
        else{
            $canhbao = "<br><span style='color: red; font-size: 18px'>Không có sản phẩm trong giỏ hàng!</span>";
        }
        
    }
}

?>
<div class="content">
    <h2 style="text-align: center;">GIỎ HÀNG CỦA BẠN</h2>
    <div class="main">
        <div class="cart-left">
            <?php  
                if(isset($update_quantity_cart)){
                    echo $update_quantity_cart;
                }
                if(isset($delate_product_cart)){
                    echo $delate_product_cart;
                }
            ?>
            <div class="cart-left-title">
                <p>SẢN PHẨM</p>
                <p style="text-align: center">GIÁ</p>
                <p style="text-align: center">SỐ LƯỢNG</p>
                <p style="text-align: right">TẠM TÍNH</p>
            </div>

            <?php 
            $get_product_cart = $cart->get_product_cart();
            $tongphu = 0;
            $i = 0;
            if($get_product_cart){
                while($result = $get_product_cart->fetch_assoc()){
                    $i++;
            ?>
            <div class="cart-left-product">
                <div class="clp1">
                    <a onclick="return confirm('Bạn có chắc muốn xóa không?')"
                        href="?cart_id=<?php echo $result['cart_id'] ?>">Xóa</a>
                    <img src="admin/uploads/<?php echo $result['product_image'] ?>" alt="">
                    <p><?php echo $result['product_name'] ?></p>
                </div>
                <p class="clp2"><?php echo $result['product_price'] ?> <u>đ</u></p>
                <form class="clp3" action="" method="POST">
                    <div class="buttons_added">
                        <?php
                            $get_product_quantity = $product->getproductbyId($result['product_id'])->fetch_assoc();
                            $max = $get_product_quantity['product_quantity'];

                        ?>
                        <input class="minus is-form" type="button" value="-">
                        <input aria-label="quantity" class="input-qty" max="<?php echo $max ?>" min="1" name="quantity" type="number"
                            value="<?php  echo $result['quantity'] ?>">
                        <input class="plus is-form" type="button" value="+">
                        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
                        <script src="js/button_added.js"></script>
                    </div>
                    <input type="hidden" name="cart_id" value="<?php echo $result['cart_id'] ?>">
                    <input class="btn-capnhat" type="submit" name="submit" value="Cập nhật">
                </form>
                <p class="clp2" style="text-align:right">
                    <?php
                    $tonggia = $result['product_price'] * $result['quantity'];
                    echo $tonggia;
                ?> <u>đ</u></p>
            </div>
            <?php
                $tongphu += $tonggia;
                }
            }
            if($i == 0){
                echo "<br><p>Giỏ hàng đang trống!</p>";
            }
        ?>
            <div class="cart-left-btn">
                <a href="sanpham.php">TIẾP TỤC XEM SẢN PHẨM</a>
            </div>
        </div>

        <div class="cart-right">
            <p class="cart-left-title">TỔNG SỐ LƯỢNG</p>
            <div class="tongphu">
                <p>Tạm tính</p>
                <p style="color: #86ba09; font-weight: bold;text-align: right"><?php echo $tongphu ?> <u>đ</u></p>
            </div>
            <div class="tongphu">
                <p>Giao hàng</p>
                <p style="color: #86ba09;font-weight: bold ;text-align: right">0 <u>đ</u></p>
            </div>
            <div class="tongphu">
                <p>Tổng</p>
                <p style="color: #86ba09;font-weight: bold ;text-align: right"><?php echo $tongphu ?> <u>đ</u></p>
            </div>
            <form action="" method="POST">
                <input type="submit" name="thanhtoan" value="THANH TOÁN">
            </form>
            <?php 
            if(isset($canhbao))
                echo $canhbao;
          ?>
        </div>
    </div>
</div>


<?php
include "include/footer.php";
?>