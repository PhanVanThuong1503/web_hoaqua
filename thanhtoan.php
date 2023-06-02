<?php
include "include/header.php";
?>

<?php
    if(Session::get('user_login') == false){
        header('Location:cart.php');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order'])) {
        
        $user_id = Session::get('user_id');
        $insert_order = $order->insert_order($user_id, $_POST);
        $insert_order_detail = $order->insert_orderdetail();
        $cart->deleteCart();
    }

?>


<div class="content">
    <h2 style="text-align: center;">THANH TOÁN</h2>
    <form class="main" action="" method="POST">
        <div class="payment-left">
            <p style="font-weight: bold; font-size: 18px">THÔNG TIN THANH TOÁN</p>

            <?php
                $id = Session::get('user_id');
                $get_user = $user->getuserbyId($id)->fetch_assoc();

            ?>
            <div class="payment-info">
                <p>Họ và tên người nhận <span style="color: red">*</span></p>
                <input required name="name" type="text" placeholder="Họ và tên người nhận" value="<?php echo $get_user['name'] ?>">
            </div>
            <div class="payment-info">
                <p>Địa chỉ <span style="color: red">*</span></p>
                <input required name="address" type="text" placeholder="Nhập địa chỉ nhận hàng" value="<?php echo $get_user['address'] ?>">
            </div>
            <div class="payment-info">
                <p>Số điện thoại <span style="color: red">*</span></p>
                <input required name="phone" type="text" placeholder="Số điện thoại" value="<?php echo $get_user['phone'] ?>">
            </div>
            <div class="payment-info">
                <p>Địa chỉ Email</p>
                <input name="email" type="text" placeholder="Địa chỉ Email" value="<?php echo $get_user['email'] ?>">
            </div>
            <div class="payment-info">
                <p>Ghi chú đơn hàng (tùy chọn)</p>
                <textarea name="note" id="" cols="30" rows="10"
                    placeholder="Ghi chú về đơn hàng, ví dụ: thời gian hay chỉ dẫn địa chỉ giao hàng chi tiết hơn,... "></textarea>
            </div>
        </div>
        <div class="payment-right">
            <p style="font-weight: bold; font-size: 18px">ĐƠN HÀNG CỦA BẠN</p>
            <div
                style="display: flex; border-bottom: 2px solid rgb(221, 219, 219); padding-bottom:5px; margin-top: 20px; justify-content: space-between">
                <p style="font-weight: bold; font-size: 15px">SẢN PHẨM</p>
                <p style="font-weight: bold; font-size: 15px">TỔNG</p>
            </div>
            <?php  
                $get_product_cart = $cart->get_product_cart();
                $total = 0;
                if($get_product_cart){
                    while($result = $get_product_cart->fetch_assoc()){
            ?>
            <div
                style="display: flex; border-bottom: 1px solid rgb(221, 219, 219); padding-bottom:5px; margin-top: 20px; justify-content: space-between">
                <p style="font-weight: bold; font-size: 15px; color:#68ba09"><?php echo $result['product_name'] ?>
                    x<?php echo $result['quantity'] ?></p>
                <p style="font-weight: bold; font-size: 15px; color: #86ba09">
                    <?php  
                    $total_product = $result['product_price'] * $result['quantity'];
                    echo $total_product ?> <u>đ</u>
                </p>
            </div>
            <?php
                         $total += $total_product;
                    }
                }
            ?>
            <div
                style="display: flex; border-bottom: 1px solid rgb(221, 219, 219); padding-bottom:5px; margin-top: 20px; justify-content: space-between">
                <p style="font-weight: bold; font-size: 15px;">Giao hàng</p>
                <p style="font-weight: bold; font-size: 14px; color: #777">Giao hàng miễn phí</p>
            </div>
            <div
                style="display: flex; border-bottom: 1px solid rgb(221, 219, 219); padding-bottom:5px; margin-top: 20px; justify-content: space-between">
                <p style="font-weight: bold; font-size: 15px;">Tổng</p>
                <p style="font-weight: bold; font-size: 15px; color: #86ba09"><?php echo $total ?><u>đ</u></p>
            </div>
            <div style="border-bottom: 1px solid rgb(221, 219, 219); padding-bottom:5px; margin-top: 30px;">
                <input type="radio" checked="checked" value="0" name="payment_method" style="float: left; margin-right: 10px">
                <p style="font-weight: bold">Trả tiền mặt khi nhận hàng</p>
                <br>
                <input type="radio" name="payment_method" value="1" style="float: left; margin-right: 10px">
                <p style="font-weight: bold">Chuyển khoản ngân hàng</p>
            </div>
            <!-- <a href="?order_id=order">ĐẶT HÀNG</a> -->
            <input class="btn-dathang" type="submit" name="order" value="ĐẶT HÀNG">
        </div>
    </form>
</div>


<?php
include "include/footer.php";
?>