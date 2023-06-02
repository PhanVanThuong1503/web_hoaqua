<?php
include "include/header.php";
?>

<?php

if (isset($_GET['danhan'])) {
    $order->update_status($_GET['danhan'], 2); 
}
if (isset($_GET['huydh'])) {
    $order->update_status($_GET['huydh'], 3);
}



if (isset($_GET['choxacnhan'])) {
    $status = $_GET['choxacnhan'];
}
if (isset($_GET['danggiaohang'])) {
    $status = $_GET['danggiaohang'];
}
if (isset($_GET['dagiao'])) {
    $status = $_GET['dagiao'];
}
if (isset($_GET['dahuy'])) {
    $status = $_GET['dahuy'];
}

?>

<div class="content">
    <h2 style="text-align: center">ĐƠN HÀNG</h2>
    <div class="main">
        <div class="danhmuc">
            <p class="ten-tieude">Đơn hàng của tôi</p>
            <ul>
                <li><a href="order.php">Tất cả các đơn</a></li>
                <li><a href="?choxacnhan=0">Đang chờ xác nhận</a></li>
                <li><a href="?danggiaohang=1">Đang giao hàng</a></li>
                <li><a href="?dagiao=2">Đã giao</a></li>
                <li><a href="?dahuy=3">Đã hủy</a></li>
            </ul>
        </div>
        <div style="width: 100%; margin-left: 30px">
            <?php
           
            $user_id = Session::get('user_id');
            if(isset($status)){
                $get_order_by_userid = $order->get_order_by_userid_status($user_id, $status);
            }
            else{
                $get_order_by_userid = $order->get_order_by_userid($user_id);
            }
            
            $i = 0;
            if($get_order_by_userid){
               
                while($result = $get_order_by_userid->fetch_assoc()){   
                    $i++;        
                    $result1 = $order->get_order_detail_by_orderid($result['order_id'])->fetch_assoc();
            ?>

            <div class="order-info">
                <p style="color: #86ba09 ;font-weight: bold; margin-bottom: 10px">Mã đơn hàng:
                    <?php echo $result1['order_id'] ?></p>
                
                <?php
                    if($result['status'] != 3 ){
                ?>
                <p style="color: #86ba09 ;font-weight: bold; margin-bottom: 10px">Giao vào
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
                <?php
                    }
                ?>
                <p style="color: #86ba09 ;font-weight: bold;">Trạng thái:
                    <span style="font-weight: bold">
                        <?php
                       if($result['status'] == 0){
                           echo "Chờ xác nhận";
                       }
                       else if($result['status'] == 1){
                           echo "Đang giao hàng";
                       }   
                       else if($result['status'] == 2){
                           echo "Đã nhận hàng";
                       }
                       else if($result['status'] == 3){
                        echo "Đã hủy";
                    }

                   ?>
                    </span>
                </p>

                <?php
               $get_order_product = $order->get_order_detail_by_orderid($result['order_id']);
               if($get_order_product){
                   while($result2 = $get_order_product->fetch_assoc()){
           ?>
                <div class="order-info-sp">
                    <div style="display: flex">
                        <img src="admin/uploads/<?php echo $result2['product_image'] ?>" alt="">
                        <p><?php echo $result2['product_name'] ?>, số lượng: <?php  echo $result2['quantity'] ?></p>
                    </div>
                    <p><?php  echo $result2['price'] ?> đ</p>
                </div>
                <?php 
                   }
               }
           ?>

                <div class="order-info-tongtien">
                    <p style="font-size: 20px;">Tổng tiền:
                        <span style="color: red;">
                            <?php  
                       $order->get_sum($result['order_id']);
                       echo Session::get('sum_price');
                   ?>
                            đ</span>
                    </p>
                </div>
                <?php
               if($result['status'] == 0){
           ?>
                <a onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này không?');"
                    style=" background-color: rgb(255, 80, 80);" href="?huydh=<?php echo $result['order_id'] ?>">Hủy đơn
                    hàng</a>
                <?php
               }
         
               else if($result['status'] == 1){
           ?>
                <a style=" background-color:  #86ba09;" href="?danhan=<?php echo $result['order_id'] ?>">Đã nhận
                    hàng</a>
                <!-- <a style=" background-color:  rgb(255, 80, 80);" href="">Trả hàng</a> -->
                <?php
               }
           ?>


                <a style=" background-color:  #86ba09;"
                    href="order_detail.php?order_id=<?php  echo $result['order_id'] ?>">Xem chi tiết</a>
            </div>
            <?php
               }
               
           }
           if($i==0){
            echo "<p style='font-size: 18p;'>Không có đơn hàng!</p>";
            }
       ?>

        </div>
    </div>
</div>

<?php
include "include/footer.php";

?>