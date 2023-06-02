<?php
include "include/header.php";
?>
<?php
    $login_check = Session::get('user_login');
    if($login_check == true){
        $name = Session::get('name');
        $address = Session::get('address');
        $phone = Session::get('phone');
        $email = Session::get('email');
    }
    else{
        $name = $address = $phone = $email = "";
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['gui'])) {
    
        $feedback->insert($_POST);
    }
?>

<div class="introduce-banner">
    <h1>LIÊN HỆ</h1>
    <p><a href="index.php">TRANG CHỦ</a> / LIÊN HỆ</p>
    <img src="images/bfooter.jpg" alt="">
</div>

<div class="content" style="margin-top: 30px">
    <div class="main">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7838.684254869503!2d106.70676642475235!3d10.785086936675276!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1547181657956"
            width="600" height="550" frameborder="0" style="border:0" allowfullscreen>
        </iframe>

        <div class="lienhe">
            <div class="diachi-lienhe">
                <img src="images/gautruc.png" alt="">
                <div class="diachi">
                    <p>Ngõ 35/47, Tu Hoàng, Nam Từ Liêm Hà Nội</p>
                    <p>000 111 222</p>
                    <p>hoaquavanvan@gmail.com</p>
                    <p>Website: https://hoaquavanva.vn/</p>
                </div>
            </div>
            <h1 style="text-align:center; margin-top: 40px">LIÊN HỆ VỚI CHÚNG TÔI</h1>
            <form action="" method="POST">
                <table>
                    <tr>
                        <td><input required type="text" name="name" placeholder="Họ và tên" value="<?php echo $name ?>"></td>
                        <td><input required type="text" name="email" placeholder="Email" value="<?php echo $email ?>"></td>
                    </tr>
                    <tr>
                        <td><input required type="text" name="phone" placeholder="Số điện thoại" value="<?php echo $phone ?>"></td>
                        <td><input required type="text" name="address" placeholder="Địa chỉ" value="<?php echo $address ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <textarea required name="content" id="" cols="30" rows="10" placeholder="Lời nhắn"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;" colspan="2">
                            <input class="btn-gui" type="submit" value="GỬI" name="gui">
                        </td>
                    </tr>
                </table>
            </form>
        </div>

    </div>
</div>

<?php
include "include/footer.php"
?>