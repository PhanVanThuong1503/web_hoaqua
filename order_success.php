<?php
    include "include/header.php";
?>

<?php
    $result = $order->get_order()->fetch_assoc();
?>


<div class="content">
    <div class="main">
        <div class="os-left">
            <div class="os-title">Đặt hàng thành công!</div>
            <div class="os-left-content">
                <p style="margin-left: 20px">Phương thức thanh toán</p>
                <p style="margin-right:50px; font-weight: bold">
                    <?php
                        if($result['payment_method'] == 0){
                            echo 'Thanh toán tiền mặt';
                        }
                        else{
                            echo 'Chuyển khoản ngân hàng';
                        }
                    ?>
                </p>
            </div>
            <div class="os-left-content">
                <p style="margin-left: 20px">Tổng cộng</p>
                <p  style="margin-right: 50px;font-weight: bold; text-align:center">
                    <?php
                        $order->get_sum($result['order_id']);
                        echo Session::get('sum_price');
                    ?>
                đ</p>
            </div>
        </div>
        <div class="os-right">
            <div class="os-right-content-top">
                <p style="font-weight: bold; font-size: 17px">Mã đơn hàng: <?php echo $result['order_id']  ?></p>
                <a href="order.php">Xem đơn hàng</a>
            </div>
            <div class="os-right-content-bottom">
                <p>Giao vào
                    <?php
                        $tg_giaohang = strtotime('+7 day', strtotime($result['date']));
                        $thu = date('w', $tg_giaohang);
                        if($thu==0){
                            echo "chủ nhật";
                        }
                        else{
                            echo "thứ ";
                            echo $thu+1;
                        }
                        echo ", ";
                        echo date('d/m', $tg_giaohang);
                    ?>
                </p>
            </div>
            <?php

                $get_product = $order->get_order_detail();
                if($get_product){
                    while($result2 = $get_product->fetch_assoc()){
            ?>
            
            <div class="os-right-content-bottom">
                <img src="admin/uploads/<?php echo $result2['product_image']?>" alt="">
                <p>x<?php echo $result2['quantity'] ?></p>
                <p style="margin-left: 10px"><?php echo $result2['product_name'] ?></p>
            </div>
            <?php
                    }
                }
            ?>
            
        </div>
    </div>
</div>


<?php
    include "include/footer.php";
?>