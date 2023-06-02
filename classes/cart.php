<?php
    //include "../lib/database.php";
    //include "../helpers/format.php";

    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class cart{
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        
        //thêm sản phẩm vào giỏ hàng
        public function add_to_cart($quantity, $id){
            $quantity = $this->fm->validation($quantity);
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $id = mysqli_real_escape_string($this->db->link, $id);
            $session_id = session_id();

            $query = "SELECT * FROM product WHERE   product_id = '$id'";
            $result = $this->db->select($query)->fetch_assoc();
            
            
            $query_check_cart = "SELECT * FROM cart WHERE   product_id = '$id'  AND session_id = '$session_id'";
            // $query_check_cart = "SELECT * FROM cart WHERE   product_id = '$id'";
            $result_check_cart = $this->db->select($query_check_cart);
            if($result_check_cart != null){
                return false;
            }
            else{
                $query_insert = "INSERT INTO cart(product_id, product_name, product_price, quantity, product_image, session_id) 
                    VALUE('$id', '$result[product_name]', '$result[product_price]', '$quantity', '$result[product_image]', '$session_id')";
                $insert_cart = $this->db->insert($query_insert);

                if ($insert_cart) {
                    header('Location:cart.php');
                } else {
                    header('Location:404.php');
                }
            }
        }



        public function get_product_cart(){
            $session_id = session_id();
            $query = "SELECT * FROM cart WHERE session_id = '$session_id'";
            $result = $this->db->select($query);
            return $result;
        }


        // Cập nhật giỏ hàng
        public function update_quantity_cart($quantity, $cart_id){
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $cart_id = mysqli_real_escape_string($this->db->link, $cart_id);

            $query = "UPDATE cart SET 
            quantity = $quantity
            WHERE cart_id = '$cart_id' ";
            
            $result = $this->db->update($query);
            if($result){
                $msg = "<span style='color: #86ba09; font-size: 18px'>Cập nhật số lượng thành công!</span>";
                return $msg;
            }
            else{
                $msg = "<span style='color: red; font-size: 18px'>Cập nhật số lượng không thành công!</span>";
                return $msg;
            }
        }

        //Xóa sản phẩm trong giỏ hàng
        public function delete_product_cart($cart_id){
            $cart_id = mysqli_real_escape_string($this->db->link, $cart_id);

            $query = "DELETE FROM cart WHERE  cart_id = '$cart_id'";
            $result = $this->db->delete($query);
            if($result){
               header('Location:cart.php');
            }
            else
            {
                $msg = "<span style='color: red; font-size: 18px'>Xóa sản phẩm khỏi giỏ hàng không thành công!</span>";
                return $msg;
            }
        }

        //Lấy số lượng sản phẩm trong giỏ hàng
        public function get_product_quantity(){
            $session_id = session_id();
            $query = "SELECT COUNT(*) AS'soluong' FROM cart WHERE session_id = '$session_id'";
            $result = $this->db->select($query);
            
            $value = $result->fetch_assoc();
            Session::set('soluong', $value['soluong']);
            return $result;
        }

        // public function check_cart(){
        //     $session_id = session_id();
        //     $query = "SELECT * FROM cart WHERE session_id = '$session_id'";
        //     $result = $this->db->select($query);
        //     return $result;
        // }

        //Xóa giỏ hàng
        public function deleteCart(){
            $session_id = session_id();
            $query = "DELETE FROM cart WHERE session_id = '$session_id'";
            $this->db->delete($query);
        }
    }

?>