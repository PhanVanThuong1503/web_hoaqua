<?php 
    include "include/header.php";
    include "include/sidebar.php";
    include "../classes/product.php";
    include_once "../helpers/format.php";

?>

<?php
     $product = new product();
     $fm = new Format();

    if (isset($_GET['product_id'])) {
        $id = $_GET['product_id'];
        $deleteproduct = $product->delete_product($id);
    }
    
?>

<div class="content">
    <p class="content-title">Danh sách sản phẩm</p>
    <?php
        if(isset($deleteproduct)){
            echo $deleteproduct."<br>";
        }
    ?>
    <table>
        <tr>
            <th id="stt">STT</th>
            <th>Mã sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Danh mục sản phẩm</th>
            <th>Ảnh minh họa</th>
            <th>Mô tả</th>
            <th>Tên nhà cung cấp</th>
            <th>Thao tác</th>
        </tr>
        <?php
            $product_list = $product->show_product();
            if($product_list){
                $i = 0;
                while($result = $product_list->fetch_assoc()){
                    $i ++;
        ?>
        <tr>
            <td  id="stt"><?php echo $i; ?></td>
            <td ><?php  echo $result['product_id'] ?></td>
            <td ><?php  echo $result['product_name'] ?></td>
            <td ><?php  echo $result['product_price'] ?></td>
            <td ><?php  echo $result['product_quantity'] ?></td>
            <td ><?php  echo $result['cate_name'] ?></td>
            <td ><img src="uploads/<?php  echo $result['product_image'] ?>" alt=""
                    width="70px"></td>
            <td><?php //echo $fm->textShorten($result['description'], 50 )
                    echo $result['description'];
            ?></td>
            <td><?php echo $result['ten_ncc'] ?></td>
            <td >
                <a href="productedit.php?product_id=<?php echo $result['product_id']?>">Sửa</a> 
                <a class="xoa" onclick="return confirm('Bạn có chắc muốn xóa không?')"
                    href="?product_id=<?php echo $result['product_id']; ?>">Xóa</a>
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