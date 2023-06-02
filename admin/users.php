<?php 
    include "include/header.php";
    include "include/sidebar.php";
    include "../classes/user.php";
    include_once "../helpers/format.php";

?>

<?php
     $user = new user();
     $fm = new Format();

    if (isset($_GET['user_id'])) {
        $id = $_GET['user_id'];
        $deleteuser = $user->delete_user($id);
    }
    
?>

<div class="content">
    <p class="content-title">Danh sách khách hàng</p>
    <?php
        if(isset($deleteuser)){
            echo $deleteuser."<br>";
        }
    ?>
    <table>
        <tr>
            <th id="stt">STT</th>
            <th>Mã khách hàng</th>
            <th>Họ tên</th>
            <th>Địa chỉ</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Thao tác</th>
        </tr>
        <?php
            $user_list = $user->show_user();
            if($user_list){
                $i = 0;
                while($result = $user_list->fetch_assoc()){
                    $i ++;
        ?>
        <tr>
            <td  id="stt"><?php echo $i; ?></td>
            <td ><?php  echo $result['user_id'] ?></td>
            <td ><?php  echo $result['name'] ?></td>
            <td ><?php  echo $result['address'] ?></td>
            <td ><?php  echo $result['email'] ?></td>
            <td ><?php  echo $result['phone'] ?></td>
            <td >
                <a class="xoa" onclick="return confirm('Bạn có chắc muốn xóa không?')" href="?user_id=<?php echo $result['user_id']; ?>">Xóa</a>
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