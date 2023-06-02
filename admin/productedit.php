<?php
include "include/header.php";
include "include/sidebar.php";
include "../classes/product.php";
include "../classes/ncc.php";

?>

<?php
    $product = new product();

    if(!isset($_GET['product_id']) || $_GET['product_id'] == null){
        echo "<script>window.location = 'products.php'</script>";
    }
    else{
        $id = $_GET['product_id'];
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    
        $updateproduct = $product->update_product($_POST, $_FILES, $id);
    }

?>

<div class="content">
    <p class="content-title">Sửa sản phẩm</p>
    <?php
        if(isset($updateproduct)){
            echo $updateproduct;
        }
    ?>
    <?php
        $get_product_by_id = $product->getproductbyId($id);
            if($get_product_by_id){
                while($result_product = $get_product_by_id->fetch_assoc()){

    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="">Tên sản phẩm</label> <br>
        <input required type="text" name="product_name" placeholder="Tên sản phẩm" value="<?php echo $result_product['product_name'] ?>"> <br>
        <label for="">Giá</label> <br>
        <input required type="text" name="product_price" placeholder="Giá sản phẩm (VNĐ)" value="<?php echo $result_product['product_price'] ?>"><br>
        <label for="">Số lượng</label><br>
        <input type="text" name="product_quantity" value="<?php echo $result_product['product_quantity'] ?>"> <br>
        <label for="">Loại sản phẩm</label><br>
        <select required name="category" id="">
            <option value="">--Chọn danh mục sản phẩm--</option>
            <?php  
                $show_catetegory = $product->show_category();
                if($show_catetegory){
                    while($result = $show_catetegory->fetch_assoc()){  
            ?>
                        <option 
                        <?php  
                            if($result['cate_id'] == $result_product['cate_id']){ echo 'selected';  }
                        ?>

                        value="<?php echo $result['cate_id'] ?>"><?php echo $result['cate_name'] ?></option>
            <?php
                    }
                }
            ?>
        </select> <br>
        <label for="">Nhà cung cấp</label><br>
        <select required name="ncc" id="">
            <option value="">--Chọn nhà cung cấp--</option>
            <?php  
                $ncc = new ncc();
                $show_ncc = $ncc->show_ncc();
                if($show_ncc){
                    while($result_ncc = $show_ncc->fetch_assoc()){  
            ?>
                        <option 
                        <?php  
                            if($result_ncc['ma_ncc'] == $result_product['ma_ncc']){ echo 'selected';  }
                        ?>

                        value="<?php echo $result_ncc['ma_ncc'] ?>"><?php echo $result_ncc['ten_ncc'] ?></option>
            <?php
                    }
                }
            ?>
        </select> <br>
        <label for="">Ảnh minh họa</label><br>
        <img src="uploads/<?php  echo $result_product['product_image']; ?>" alt="" width="90px">
        <input class="input-file" type="file" name="product_image"> <br>
        <label for="">Mô tả</label><br>
        <textarea name="description" id="" cols="30" rows="7" placeholder="Mô tả sản phẩm"><?php echo $result_product['description'] ?></textarea>
        <br> <br>

        <input class="btn" type="submit" value="Cập nhật" name="submit">
        <input class="btn" type="reset" value="Nhập lại">

    </form>

    <?php
        }
    }
    ?>
</div>

<?php
// include "include/footer.php";
?>