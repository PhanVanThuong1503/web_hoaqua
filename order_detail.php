<?php
    include "include/header.php";
?>

<?php
    if(!isset($_GET['order_id']) || $_GET['order_id'] == null){
        echo "<script>window.location = 'order.php'</script>";
    }
    else{
        $id = $_GET['order_id'];

        $result = $order->get_order_detail_by_orderid($id)->fetch_assoc();
        $result1 = $order->get_order_by_orderid($id)->fetch_assoc();
    }
?>
<div class="content">
    <div class="main">
        <div class="order-detail">
            <h3>Chi tiết đơn hàng #<?php echo $result['order_id'] ?> - 
            <?php
                if($result1['status'] == 0){
                    echo "Chờ xác nhận";
                    }
                else if($result1['status'] == 1){
                    echo "Đang giao hàng";
                }   
                else if($result1['status'] == 2){
                    echo "Đã nhận hàng";
                }
                else if($result1['status'] == 3){
                    echo "Đã hủy";
                }

            ?>
            </h3>
            <br>
            <p>Ngày đặt hàng: <?php echo date('d/m/Y',strtotime($result1['date'])) ?></p>
            <div class="order-detail-top">
                <div class="odt">
                    <p>ĐỊA CHỈ NGƯỜI NHẬN</p>
                    <div class="odt-detail">
                        <p style="font-weight: bold"><?php echo $result1['name'] ?></p> <br>
                        <p>Địa chỉ: <?php echo $result1['address'] ?></p>
                        <br>
                        <p>Điện thoại: <?php echo $result1['phone'] ?></p>
                    </div>
                </div>
                <div class="odt">
                    <p>HÌNH THỨC GIAO HÀNG</p>
                    <div class="odt-detail">
                        <p>Giao hàng miễn phí</p>
                    </div>
                </div>
                <div class="odt">
                    <p>HÌNH THỨC THANH TOÁN</p>
                    <div class="odt-detail">
                        <p>
                            <?php
                            if($result1['payment_method'] == 0){
                                echo 'Thanh toán tiền mặt khi nhận hàng';
                            }
                            else{
                                echo 'Chuyển khoản ngân hàng';
                            }
                    ?>
                        </p>
                    </div>
                </div> 
            </div>
            <?php
                if($result1['note'] != ""){
                    echo '<p class="order-note">Ghi chú:' .$result1["note"].'</p>';
                }
            ?>
            <div class="order-detail-bottom">
                <div class="odb-title">
                    <p style="width: 400px">Sản phẩm</p>
                    <p style="width: 100px">Giá</p>
                    <p style="width: 100px">Số lượng</p>
                    <p style="width: 100px; text-align:right;">Tạm tính</p>
                </div>
                <?php
                    $get_product = $order->get_order_detail_by_orderid($id);
                    if($get_product){
                        while($result2 = $get_product->fetch_assoc()){      

                ?>
                <div class="odb-sp">
                    <div style="width: 400px; display: flex">
                        <img src="admin/uploads/<?php echo $result2['product_image'] ?>" alt="">
                        <p><?php echo $result2['product_name'] ?></p>
                    </div>
                    <p style="width: 100px"><?php echo $result2['product_price'] ?> đ</p>
                    <p style="width: 100px"><?php  echo $result2['quantity'] ?></p>
                    <p style="width: 100px; text-align:right;"><?php echo $result2['price'] ?> đ</p>
                </div>
                <?php
                        }
                    }

                ?>
                <div style="text-align: right; overflow: auto; margin-top: 15px">
                    <div style="float: left; margin-left: 70%;  color: #646769; line-height: 30px;">
                        <p>Tạm tính</p>
                        <p>Phí vận chuyển</p>
                        <p>Tổng cộng</p>
                    </div>
                    <div style="line-height: 30px;">
                        <p><?php echo Session::get('sum_price') ?> đ</p>
                        <p>0 đ</p>
                        <p style="color: red; font-size: 18px"><?php echo Session::get('sum_price') ?> đ</p>
                    </div>
                </div>              
            </div>
            <a href="order.php" style="color: blue; font-size: 17px; margin-top: 30px; display: inline-block"><< Quay lại đơn hàng</a>
        </div>
    </div>
</div>


<?php
    include "include/footer.php";

?>