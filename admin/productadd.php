<?php
    include "include/header.php";
    include "include/sidebar.php";
    include "../classes/product.php";
    include "../classes/ncc.php";
?>

<?php
    $product = new product();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    
        $insertproduct = $product->insert_product($_POST, $_FILES);
    }


?>

<div class="content">
<p class="content-title">Thêm sản phẩm mới</p>
    <?php 
        if(isset($insertproduct)){
            echo $insertproduct;
        }
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for=""> Tên sản phẩm</label><br>
        <input required type="text" name="product_name" placeholder="Tên sản phẩm"> <br>
        <label for="">Giá</label><br>
        <!-- <input required type="text" name="product_price" placeholder="Giá sản phẩm (VNĐ)"><br> -->
        <input type="number" name="product_price" min="1" placeholder="Giá sản phẩm (VNĐ)"><br>
        <label for="">Số lượng</label><br>
        <!-- <input type="text" name="product_quantity"> <br> -->
        <input type="number" name="product_quantity" min="1" placeholder="Số lượng sản phẩm"><br>
        <label for="">Loại sản phẩm</label><br>
        <select required name="category" id="">
            <option value="">--Chọn danh mục sản phẩm</option>
            <?php  
                $show_catetegory = $product->show_category();
                if($show_catetegory){
                    while($result = $show_catetegory->fetch_assoc()){
                   
            ?>
            <option value="<?php echo $result['cate_id'] ?>"><?php echo $result['cate_name'] ?></option>

            <?php
                    }
                }
            ?>
        </select> <br>
        <label for="">Nhà cung cấp</label><br>
        <select required name="ncc" id="">
            <option value="">--Chọn nhà cung cấp</option>
            <?php  
                $ncc = new ncc();
                $show_ncc = $ncc->show_ncc();
                if($show_ncc){
                    while($result_ncc = $show_ncc->fetch_assoc()){
                   
            ?>
            <option value="<?php echo $result_ncc['ma_ncc'] ?>"><?php echo $result_ncc['ten_ncc'] ?></option>

            <?php
                    }
                }
            ?>
        </select> <br>
        <label for="">Ảnh minh họa</label><br>
        <input class="input-file" type="file" name="product_image"> <br>
        <label for="">Mô tả</label><br>
        <textarea name="description" id="" cols="30" rows="10" placeholder="Mô tả sản phẩm"></textarea>
        <br> <br>

        <input class="btn" type="submit" value="Thêm" name="submit">
        <input class="btn" type="reset" value="Nhập lại">

    </form>


</div>

<?php
// include "include/footer.php";
?>