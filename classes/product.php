<?php
//include "../lib/database.php";
//include "../helpers/format.php";

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');

?>
<?php
class product
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_product($data, $files)
    {
        $product_name = mysqli_real_escape_string($this->db->link, $data['product_name']);
        $product_price = mysqli_real_escape_string($this->db->link, $data['product_price']);
        $product_quantity = mysqli_real_escape_string($this->db->link, $data['product_quantity']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $ncc = mysqli_real_escape_string($this->db->link, $data['ncc']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['product_image']['name'];
        $file_size = $_FILES['product_image']['size'];
        $file_temp = $_FILES['product_image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        move_uploaded_file($file_temp, $uploaded_image);
        if ($file_name == '') {
            $alert = "<span class='error'>Bạn chưa chọn file ảnh!</span>";
        } else {
            //Kiểm tra file ảnh
            if (!empty($file_name)) {
                //nếu người dùng chọn ảnh
                if ($file_size > 2000000) {
                    $alert = "<span class='error'>Kích thước file không được quá 2MB!</span> ";
                    return $alert;
                } else if (in_array($file_ext, $permited) === false) {
                    //Người dùng up khác file ảnh
                    $alert = "<span class='error'>Bạn chỉ có thể upload file có đuôi: " . implode(', ', $permited) . "</span>";
                    return $alert;
                }
            }
            
            $query = "INSERT INTO product(product_name, product_price, product_quantity, product_image, description, cate_id, ma_ncc) 
                VALUE('$product_name', '$product_price', '$product_quantity', '$unique_image', '$description', '$category', '$ncc')";
            $result = $this->db->insert($query);

            if ($result) {
                $alert = "<span class='succes'>Thêm sản phẩm thành công!</span>";
            } else {
                $alert = "<span class='error'>Không thêm được sản phẩm!</span>";
            }
        }
        return $alert;
    }


    public function show_product()
    {
        $query = "SELECT product.*, category.cate_name, ncc.ten_ncc
                      FROM product INNER JOIN category ON product.cate_id = category.cate_id
                      INNER JOIN ncc on product.ma_ncc = ncc.ma_ncc
                      ORDER BY product.product_id desc";
        // $query = "SELECT *FROM product ORDER BY product_id desc";
        $result = $this->db->select($query);
        return $result;
    }

    /////
    public function show_category()
    {
        $query = "SELECT *FROM category ORDER BY cate_id desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function getproductbyId($id)
    {
       // $query = "SELECT *FROM product WHERE product_id = '$id'";
       $query = "SELECT product.*, category.cate_name
       FROM product INNER JOIN category ON product.cate_id = category.cate_id
       WHERE product_id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_product($data, $files, $id)
    {

        $product_name = mysqli_real_escape_string($this->db->link, $data['product_name']);
        $product_price = mysqli_real_escape_string($this->db->link, $data['product_price']);
        $product_quantity = mysqli_real_escape_string($this->db->link, $data['product_quantity']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $ncc = mysqli_real_escape_string($this->db->link, $data['ncc']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);

        $permited = array('jpg', 'jpeg', 'png', 'gif');

        $file_name = $_FILES['product_image']['name'];
        $file_size = $_FILES['product_image']['size'];
        $file_temp = $_FILES['product_image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        move_uploaded_file($file_temp, $uploaded_image);



        if (!empty($file_name)) {
            //nếu người dùng chọn ảnh
            if ($file_size > 2000000) {
                $alert = "<span class='error'>Kích thước file không được quá 2MB!</span> ";
                return $alert;
            } else if (in_array($file_ext, $permited) === false) {
                //Người dùng chọn file khác file ảnh
                $alert = "<span class='error'>Bạn chỉ có thể upload file có đuôi: " . implode(', ', $permited) . "</span>";
                return $alert;
            }
            $query = "UPDATE product SET 
                product_name = '$product_name', 
                product_price = '$product_price',
                product_quantity = '$product_quantity',
                product_image = '$unique_image',
                description = '$description',
                cate_id = '$category',
                ma_ncc = '$ncc'
                WHERE product_id = '$id' ";
        } 
        else {
            $query = "UPDATE product SET 
            product_name = '$product_name', 
            product_price = '$product_price',
            product_quantity = '$product_quantity',
            description = '$description',
            cate_id = '$category',
            ma_ncc = '$ncc'
            WHERE product_id = '$id' ";
        }

        $result = $this->db->update($query);
        if ($result) {
            $alert = "<span class='succes'>Cập nhật sản phẩm thành công!</span> ";
            return $alert;
        } else {
            $alert = "<span class='error'>Cập nhật thất bại!</span> ";
            return $alert;
        }
    }

    public function delete_product($id)
    {
        $query = "DELETE FROM product WHERE product_id = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='succes'>Xóa sản phẩm thành công!</span> ";
            return $alert;
        } else {
            $alert = "<span class='error'>Xóa sản phẩm thất bại!</span> ";
            return $alert;
        }
    }


    public function getproduct_bycateid($cate_id){
        $query = "SELECT product.*,category.cate_name
        FROM product INNER JOIN category ON product.cate_id = category.cate_id
        WHERE category.cate_id = '$cate_id' ";
        $result = $this->db->select($query);
        return $result;
    }

}
?>