<?php
include "include/header.php";
?>

<?php
    $show_category = $category->show_category();
    $show_product_danhmuc = $product->show_product();
    $show_product = $product->show_product();

?>

<div class="content">
    <div class="content-title-sanpham">
        <div class="content-title-sanpham-trai">
            <a href="index.php">TRANG CHỦ</a>
            <p style="font-size: 19px;  color: rgba(102, 102, 102, 0.85);">/</p>
            <a style="color: black; font-weight: bold" href="">SẢN PHẨM</a>
        </div>
        <div class="content-title-sanpham-phai">
            <p>Hiển thị 1-12 trong 16 kết quả</p>
            <select name="" id="">
                <option value="">Thứ tự mặc định</option>
                <option value="">Mới nhất</option>
                <option value="">Giá: từ thấp đến cao</option>
                <option value="">Giá: từ cao xuống thấp</option>
            </select>
        </div>
    </div>

    <div class="main">
        <div class="sidebar">
            <div class="danhmuc">
                <p class="ten-tieude">DANH MỤC SẢN PHẨM</p>
                <ul>
                    <?php
                       
                        if($show_category){
                            while($result1 = $show_category->fetch_assoc()){
                    ?>
                    <li><a href="category.php?cate_id=<?php echo $result1['cate_id'] ?>"><?php echo $result1['cate_name'] ?></a></li>
                    <?php
                            }
                        }
                   ?> 
                </ul>
            </div>

            <div class="danhmuc">
                <p class="ten-tieude">SẢN PHẨM</p>
                <ul>
                    <?php  
                      
                        if($show_product_danhmuc){
                            $i = 0;
                            while($result2 = $show_product_danhmuc->fetch_assoc()){
                                $i++;
                                if($i == 7) break;
                    ?>
                    <li class="dm-sp">
                       <a href="detail.php?product_id=<?php echo $result2['product_id'] ?>"> 
                           <img src="admin/uploads/<?php echo $result2['product_image'] ?>" alt="">
                           <p><?php echo $result2['product_name'] ?></p>
                        </a>
                    </li>
                    <?php
                            }
                        }
                    ?>
                </ul>
            </div>
        </div>
        <div class="content-list-sp">
            <?php  
                if($show_product){
                    $i = 0;
                    while($result3 = $show_product->fetch_assoc()){
                        $i++;
                        if($i==13) break;
            ?>
            <li>
                <a href="detail.php?product_id=<?php echo $result3['product_id']?>"><img src="admin/uploads/<?php  echo $result3['product_image'] ?>" alt=""></a>
                <a href="detail.php?product_id=<?php echo $result3['product_id']?>" class="ten_sp"><?php echo $result3['product_name']  ?></a>
                <p class="gia"><?php echo $result3['product_price'] ?> <u>đ</u></p>
            </li>
            <?php
                    }
                }
            ?>
        </div>
    </div>
</div>


<?php
include "include/footer.php";
?>