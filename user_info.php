<?php
include "include/header.php";
?>

<?php
    if(!isset($_GET['u_id']) || $_GET['u_id'] == null){
        echo "<script>window.location = 'index.php'</script>";
    }
    else{
        $id = $_GET['u_id'];

        $result = $user->getuserbyId($id)->fetch_assoc();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    
        $updateuser = $user->update_user($_POST, $id);
        

        
    }

?>

<div class="content">
    <div class="user_info">
        <h2 style="text-align: center">TÀI KHOẢN CỦA BẠN</h2>
        <?php
            if(isset($updateuser))
                echo $updateuser;
        ?>
        <form action="" method="POST">
            <table>
                <tr>
                    <td><label for="">Email:</label></td>
                    <td><input readonly type="text" name="email" value="<?php echo $result['email']; ?>"></td>
                </tr>
                <tr>
                    <td><label for="">Số điện thoại:</label></td>
                    <td><input type="text" name="phone" value="<?php echo $result['phone']; ?>"></td>
                </tr>
                <tr>
                    <td><label for="">Họ và tên:</label></td>
                    <td><input type="text" name="name" value="<?php echo $result['name']; ?>"></td>
                </tr>
                <tr>
                    <td><label for="">Địa chỉ:</label></td>
                    <td><input type="text" name="address" value="<?php echo $result['address']; ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><a style="color: #0f62fe; margin-left: 30px;" href="change_pass.php">Đổi mật khẩu</a></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="Cập nhật" class="btndk"></td>
                </tr>
            </table>
        </form>
    </div>
</div>



<?php
include "include/footer.php";
?>