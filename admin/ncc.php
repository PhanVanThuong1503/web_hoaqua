<?php 
    include "include/header.php";
    include "include/sidebar.php";
    include "../classes/ncc.php";


?>

<?php
     $ncc = new ncc();

    if (isset($_GET['ma_ncc'])) {
        $ma_ncc = $_GET['ma_ncc'];
        $deletencc = $ncc->delete_ncc($ma_ncc);
    }
    
?>

<div class="content">
    <p class="content-title">Danh sách nhà cung cấp</p>
    <?php
        if(isset($deletencc)){
            echo $deletepncc."<br>";
        }
    ?>
    <table>
        <tr>
            <th id="stt">STT</th>
            <th>Mã nhà cung cấp</th>
            <th>Tên nhà cung cấp</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Thao tác</th>
        </tr>
        <?php
            $ncc_list = $ncc->show_ncc();
            if($ncc_list){
                $i = 0;
                while($result = $ncc_list->fetch_assoc()){
                    $i ++;
        ?>
        <tr>
            <td  id="stt"><?php echo $i; ?></td>
            <td ><?php  echo $result['ma_ncc'] ?></td>
            <td ><?php  echo $result['ten_ncc'] ?></td>
            <td ><?php  echo $result['diachi'] ?></td>
            <td ><?php  echo $result['sodt'] ?></td>
            <td >
                <a href="nccedit.php?ma_ncc=<?php echo $result['ma_ncc']?>">Sửa</a> 
                <a class="xoa" onclick="return confirm('Bạn có chắc muốn xóa không?')"
                    href="?ma_ncc=<?php echo $result['ma_ncc']; ?>">Xóa</a>
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