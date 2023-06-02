<?php 
    include "include/header.php";
    include "include/sidebar.php";
    include "../classes/order.php";
    include_once "../helpers/format.php";

?>

<?php
    $order = new order();

    if(isset($_GET['xacnhan'])){
        $order_id = $_GET['xacnhan'];
        $order->update_status($order_id, 1);
        echo "<script>window.location = 'orders.php'</script>";
    }
   
    
?>

<div class="content">
    <p class="content-title">Danh sách đơn hàng</p>
    <table>
        <tr>
            <th id="stt">STT</th>
            <th>Mã đơn hàng</th>
            <th>Ngày đặt hàng</th>
            <th>Phương thức thanh toán</th>
            <th>Số lượng SP</th>
            <th>Khách hàng phải trả</th>
            <th>Ghi chú</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
        <?php
            $order_list = $order->show_order();
            if($order_list){
                $i = 0;
                while($result = $order_list->fetch_assoc()){
                    $i ++;
        ?>
        <tr>
            <td   id="stt"><?php echo $i; ?></td>
            <td  ><?php  echo $result['order_id'] ?></td>
            <td  ><?php  echo date('d/m/y', strtotime($result['date'])) ?></td>
            <td  >
                <?php  
                    if($result['payment_method']==0){
                        echo "Trả tiền mặt";
                    }
                    else{
                        echo "Chuyển khoản ngân hàng";
                    }
                ?>
            </td>
            <td  ><?php  
                $order->get_sum($result['order_id']);
                echo Session::get('sum_quantity');
            ?></td>
            <td  ><?php  echo Session::get('sum_price') ?></td>
            <td><?php echo $result['note'] ?></td>
            <td  >
                <?php  
                    if($result['status'] == 0){
                        echo "Chờ xác nhận";
                    }
                    else if($result['status'] == 1){
                        echo "Đang giao hàng";
                    }
                    else if($result['status'] == 2){
                        echo "Đã giao hàng";
                    }
                    else if($result['status'] == 3){
                        echo "Đã hủy";
                    }

                ?>
            </td>
            <td  >
                <a href="orderdetail.php?order_id=<?php echo $result['order_id'] ?>" style=" width: 110px; margin-bottom: 5px; margin-top: 5px">Xem chi tiết</a><br>
                <?php
                    if($result['status'] == 0){
                ?>
                <a href="?xacnhan=<?php echo $result['order_id'] ?>" style=" width: 110px;margin-bottom: 5px; margin-top: 5px; background-color: red">Xác nhận</a>
                <?php
                    }
                ?>
            </td>
        </tr>
        <?php
                }
            }
        ?>
    </table>
</div>

<?php
    // include "include/footer.php";
?>