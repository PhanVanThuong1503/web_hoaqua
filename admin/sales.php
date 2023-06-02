<?php 
    include "include/header.php";
    include "include/sidebar.php";
    include "../classes/order.php";
?>

<?php

    $order = new order();

?>


<div class="content">
    <p class="content-title">Đơn hàng đã hoàn thành</p>
    <table>
        <tr>
            <th id="stt">STT</th>
            <th>Mã đơn hàng</th>
            <th>Ngày đặt mua</th>
            <th>Khách hàng</th>
            <th>Thành tiền</th>
            <th>Tháo tác</th>
        </tr>
        <?php
           $get_order = $order->get_order_by_status(3);
           $i = 0;
           $s = 0;
            if($get_order){
                while($result = $get_order->fetch_assoc()){
                    $i ++;
        ?>
        <tr>
            <td  id="stt"><?php echo $i; ?></td>
            <td ><?php  echo $result['order_id'] ?></td>
            <td ><?php  echo date('d/m/Y',  strtotime($result['date'])) ?></td>
            <td ><?php  echo $result['name'] ?></td>
            <td ><?php  
                $order->get_sum($result['order_id']);
                echo Session::get('sum_price');
                $s += Session::get('sum_price');
            ?></td>
             <td><a href="orderdetail.php?order_id=<?php echo $result['order_id'] ?>">Xem chi tiết</a></td>

        </tr>
        <?php
                }
            }
        ?>
        <tr>
            <td colspan="4" style="font-weight: bold ; padding-left: 20px">Tổng doanh thu</td>
            <td colspan="2" style="text-align:center; font-weight: bold"><?php echo $s ?></td>
        </tr>
    </table>
</div>