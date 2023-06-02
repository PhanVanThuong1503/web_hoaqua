<?php 
    include "include/header.php";
    include "include/sidebar.php";
    include "../classes/feedback.php";
?>

<?php
    $feedback = new feedback();
?>

<div class="content">
    <p class="content-title">Danh sách các phản hồi từ khách hàng</p>
    <table>
        <tr>
            <th id="stt">STT</th>
            <th>Họ tên</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th style="width: 200px">Nội dung phản hồi</th>
        </tr>
        <?php
            $fb_list = $feedback->show_feedback();
            if($fb_list){
                $i = 0;
                while($result = $fb_list->fetch_assoc()){
                    $i ++;
        ?>
        <tr>
            <td  id="stt"><?php echo $i; ?></td>
            <td ><?php  echo $result['name'] ?></td>
            <td ><?php  echo $result['address'] ?></td>
            <td ><?php  echo $result['phone'] ?></td>
            <td ><?php  echo $result['email'] ?></td>
            <td style="width: 200px" ><?php  echo $result['content'] ?></td>
        </tr>
        <?php
                }
            }
        ?>
    </table>
</div>
