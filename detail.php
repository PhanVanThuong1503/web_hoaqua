<?php
include "include/header.php";
?>

<?php
    if(!isset($_GET['product_id']) || $_GET['product_id'] == null){
        echo "<script>window.location = 'sanpham.php'</script>";
    }
    else{
        $id = $_GET['product_id'];
    }

    $addtocart_message = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $quantity = $_POST['quantity'];
        $addtocart = $cart->add_to_cart($quantity,$id);
        if($addtocart == false){
            $addtocart_message = "<br><br><span style='color: red; font-size: 18px'>Sản phẩm này đã có trong giỏ hàng!</span>";
        }
    }

?>

<div class="content">
    <div class="main" style="margin-top: 0px">
        <?php
            $get_product = $product->getproductbyId($id);
            
            if($get_product){
                while($result1 = $get_product->fetch_assoc()){

        ?>
        <div class="product-img">
            <img src="admin/uploads/<?php echo $result1['product_image']?>" alt="">
        </div>
        <div class="product-txt">
            <div class="wcome">
                <a href="index.php">TRANG CHỦ</a>
                <p> / </p>
                <a href="">CHI TIẾT SẢN PHẨM</a>
            </div>
            <p class="product-name"><?php echo $result1['product_name'] ?></p>
            <p class="line-ngan"></p>
            <p class="product-price"><?php echo $result1['product_price'] ?> <u>đ</u></p>
            <p style="line-height: 24px; color: #353535;"><b><?php echo $result1['product_name']?>: <i>
            <?php echo $result1['description'] ?>
            </i> </b><br> Đây chỉ đơn giản là
                một đoạn văn bản giả, được dùng
                vào việc trình bày và dàn trang phục vụ
                cho in ấn.<br>
            </p>
            <br>

            <?php
                if($result1['product_quantity']>0){
            ?>
            <p><span style="font-weight: bold">Số lượng đang còn:</span> <?php echo $result1['product_quantity'] ?></p>
            <form class="add-soluong" action="" method="POST">
                <div class="buttons_added">
                    <input class="minus is-form" type="button" value="-">
                    <input aria-label="quantity" class="input-qty" max="<?php echo $result1['product_quantity'] ?>"
                        min="1" name="quantity" type="number" value="1">
                    <input class="plus is-form" type="button" value="+">
                    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
                    <script src="js/button_added.js"></script>
                </div>


                <input type="submit" class="btn-them" value="THÊM VÀO GIỎ" name="submit">
                <?php
                }
                else{
                    echo "<p style='color:red'>Sản phẩm này đã hết hàng!</p>";
                }
            ?>
                <?php 
                    echo $addtocart_message;
                ?>
            </form>

            <p style="font-weight: bold; margin-top: 40px">Tính phí ship tự động <span style="padding-left: 100px">Thanh
                    toán</span></p>

            <div class="logo-bank">
                <li><img src="images/logo-acb.jpg" alt=""></li>
                <li><img src="images/logo-ghn.jpg" alt=""></li>
                <li><img src="images/logo-ghtk.jpg" alt=""></li>
                <li><img src="images/logo-ninja-van.jpg" alt=""></li>
                <li><img src="images/logo-paypal.jpg" alt=""></li>
                <li><img src="images/logo-techcombank.jpg" alt=""></li>
                <li><img src="images/logo-vib.jpg" alt=""></li>
                <li><img src="images/logo-vcb.jpg" alt=""></li>
                <li><img src="images/logo-mastercard.jpg" alt=""></li>
            </div>
            <br>
            <p style="border: 1px solid #ddd"></p>
            <p style="font-size: 15px; margin-top: 10px">Danh mục: <a style="color: #86ba09;;"
                    href="category.php?cate_id=<?php echo $result1['cate_id'] ?>"><?php echo $result1['cate_name'] ?></a>
            </p>
        </div>
    </div>


    <p style="border: 1px solid #ddd; margin-top: 50px; margin-bottom: 30px"></p>
    <div class="mota">
        <a href="">MÔ TẢ</a> <br>
        <p style="font-weight: bold; font-size: 22px"><?php echo $result1['product_name']?> là gì?</p>
        <br>
        <p><b><?php echo $result1['product_name']?> </b>
            <?php echo $result1['description'] ?>
            chỉ đơn giản là một đoạn văn bản giả,
            được dùng vào việc trình bày và dàn trang phục vụ
            cho in ấn. Lorem Ipsum đã được sử dụng như một
            văn bản chuẩn cho ngành công nghiệp in ấn từ những
            năm 1500, khi một họa sĩ vô danh ghép nhiều đoạn
            văn bản với nhau để tạo thành một bản mẫu văn bản.
            Đoạn văn bản này không những đã tồn tại năm thế
            kỉ, mà khi được áp dụng vào tin học văn phòng,
            nội dung của nó vẫn không hề bị thay đổi.
            Nó đã được phổ biến trong những năm 1960
            nhờ việc bán những bản giấy Letraset in những
            đoạn Lorem Ipsum, và gần đây hơn, được sử dụng
            trong các ứng dụng dàn trang, như Aldus PageMaker.
        </p>
        <br>
        <p style="font-weight: bold; font-size: 22px">Tại sao lại sử dụng nó?</p>
        <br>
        <p>Chúng ta vẫn biết rằng, làm việc với một đoạn văn bản
            dễ đọc và rõ nghĩa dễ gây rối trí và cản trở việc
            tập trung vào yếu tố trình bày văn bản. Lorem Ipsum có ưu điểm hơn so với đoạn văn bản
            chỉ gồm nội dung kiểu “Nội dung, nội dung,
            nội dung” là nó khiến văn bản giống thật hơn,
            bình thường hơn. Nhiều phần mềm thiết kế giao
            diện web và dàn trang ngày nay đã sử dụng
            Lorem Ipsum làm đoạn văn bản giả, và nếu bạn
            thử tìm các đoạn “Lorem ipsum” trên mạng thì
            sẽ khám phá ra nhiều trang web hiện vẫn đang
            trong quá trình xây dựng. Có nhiều phiên bản
            khác nhau đã xuất hiện, đôi khi do vô tình,
            nhiều khi do cố ý (xen thêm vào những câu
            hài hước hay thông tục).
        </p>
        <br>
        <p style="font-weight: bold; font-size: 22px">Nó đến từ đâu</p>
        <br>
        <p>Trái với quan điểm chung của số đông, Lorem Ipsum
            không phải chỉ là một đoạn văn bản ngẫu nhiên.
            Người ta tìm thấy nguồn gốc của nó từ những
            tác phẩm văn học la-tinh cổ điển xuất hiện
            từ năm 45 trước Công Nguyên, nghĩa là nó
            đã có khoảng hơn 2000 tuổi. Một giáo sư
            của trường Hampden-Sydney College (bang
            Virginia -Mỹ) quan tâm tới một trong
            những từ la-tinh khó hiểu nhất, “consectetur”, trích từ một đoạn của Lorem Ipsum,
            và đã nghiên cứu tất cả các ứng dụng của
            từ này trong văn học cổ điển, để từ đó tìm
            ra nguồn gốc không thể chối cãi của
            Lorem Ipsum. Thật ra, nó được tìm thấy
            trong các đoạn 1.10.32 và 1.10.33 của
            “De Finibus Bonorum et Malorum” (Đỉnh tối thượng của
            Cái Tốt và Cái Xấu) viết bởi Cicero vào
            năm 45 trước Công Nguyên. Cuốn sách này là một luận thuyết đạo lí rất phổ
            biến trong thời kì Phục Hưng.
        </p>
    </div>


    <p style="border: 1px solid #ddd; margin-top: 50px; margin-bottom: 30px"></p>

    <div class="sanpham-tuongtu">
        <h3 style="text-align:center; margin-bottom: 40px">SẢN PHẨM TƯƠNG TỰ</h3>

        <div class="content-list-sp" style="overflow: hidden; width: 100%; margin-left: -10px">
            <?php
                $get_product_by_cate = $product->getproduct_bycateid($result1['cate_id']);
                if($get_product_by_cate){
                    $i = 0;
                    while($result2 = $get_product_by_cate->fetch_assoc()){
                        $i++;
                        if($i==9) break;
            ?>
            <li>
                <a href="detail.php?product_id=<?php echo $result2['product_id'] ?>"><img
                        src="admin/uploads/<?php echo $result2['product_image'] ?>" alt=""></a>
                <a href="" class="ten_sp"><?php echo $result2['product_name'] ?></a>
                <p class="gia"><?php echo $result2['product_price'] ?> <u>đ</u></p>
            </li>
            <?php
                    }
                }
            ?>

        </div>
    </div>

    <?php
                }
            }
    ?>
</div>


<?php
include "include/footer.php";
?>