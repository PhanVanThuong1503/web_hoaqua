<?php 
    include "include/header.php";
    include "include/sidebar.php";
    include "../classes/order.php";
?>

<?php

    $order = new order();
    if(isset($_GET['order_id'])){
        $order_id = $_GET['order_id'];
        $result = $order->get_order_by_orderid($order_id)->fetch_assoc();
    }

?>


<div class="content">
    <p class="content-title">Chi tiết đơn hàng</p>
    <div style="float: left; margin-bottom: 20px">
        <label for="">Họ tên khách hàng: <?php echo $result['name'] ?></label><br>
        <label for="">Số điện thoại: <?php echo $result['phone'] ?></label><br>
        <label for="">Địa chỉ: <?php echo $result['address'] ?></label><br>

    </div>
    <div style="margin-left: 450px;">
        <label for="">Mã đơn hàng: <?php echo $result['order_id'] ?></label><br>
        <label for="">Ngày đặt hàng: <?php echo date('d/m/y', strtotime($result['date'])) ?></label>
    </div>
    <table style="clear: both;">
        <tr>
            <th id="stt">STT</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng </th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
        </tr>
        <?php
            $get_order_detail = $order->get_order_detail_by_orderid($order_id);
            if($get_order_detail){
                $i = 0;
                while($result1 = $get_order_detail->fetch_assoc()){
                    $i ++;
        ?>
        <tr>
            <td  id="stt"><?php echo $i; ?></td>
            <td ><?php  echo $result1['product_name'] ?></td>
            <td ><?php  echo $result1['quantity'] ?></td>
            <td ><?php  echo $result1['product_price'] ?></td>
            <td ><?php  echo $result1['quantity']*$result1['product_price'] ?></td>

        </tr>
        <?php
                }
            }
        ?>
        <tr>
            <td colspan="4" style="font-weight: bold ; padding-left: 20px">Tổng cộng</td>
            <td style="text-align:center; font-weight: bold"><?php 
                $order->get_sum($order_id);
                echo Session::get('sum_price') ?></td>
        </tr>
    </table>
</div>