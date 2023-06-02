<?php
    include "include/header.php";
    include "include/slider.php";
   
?>

<div class="img-inner">
    <li><img src="images/anhqc1.jpg" alt=""></li>
    <li><img src="images/anhqc2.jpg" alt=""></li>
    <li><img src="images/anhqc3.jpg" alt=""></li>
    <li><img src="images/anhqc4.jpg" alt=""></li>
</div>

<div class="sp-noibat">
    <h1>Sản phẩm nổi bật   <?php
?></h1>
    <div class="sp-noibat-menu">
        <li><a href="">MỚI NHẤT</a></li>
        <li><a href="">GIẢM GIÁ</a></li>
        <li><a href="">BÁN CHẠY</a></li>
    </div>

    <div class="list-sp-noibat">
        <?php
            $show_product = $product->show_product();
            if($show_product){
                $i = 0;

                while($result = $show_product->fetch_assoc()){
                    $i++;
                    if($i == 9) break;
        ?>
        <div class="sanpham">
            <a href="detail.php?product_id=<?php echo $result['product_id'] ?>"><img src="admin/uploads/<?php echo $result['product_image'] ?>" alt=""></a>
            <a  class="ten_sp"><?php echo $result['product_name'] ?></a>
            <p class="gia"><?php echo $result['product_price'] ?> <u>đ</u></p>
        </div>
        <?php       
                }
            }
        ?>
    </div>
</div>


<?php
   include "include/footer.php";
?>