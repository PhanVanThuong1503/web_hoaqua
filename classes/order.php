<?php
    
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class order{
        private $db;
    
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_order($user_id, $data){
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $date = date("Y-m-d H:i:s");

            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $address = mysqli_real_escape_string($this->db->link, $data['address']);
            $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
            $payment_method = mysqli_real_escape_string($this->db->link, $data['payment_method']);
            $note = mysqli_real_escape_string($this->db->link, $data['note']);
            
            $query = "INSERT INTO tblorder(user_id, date, name, address, phone, payment_method, note) 
            VALUE('$user_id', '$date','$name' ,'$address', '$phone', '$payment_method', '$note')";
            $result = $this->db->insert($query);

            if($result){
                header('Location:order_success.php');
            }
            
        }

        public function insert_orderdetail(){
            $get_order_id = "SELECT order_id FROM tblorder ORDER BY order_id DESC LIMIT 1;";
            $result_order_id = $this->db->select($get_order_id)->fetch_assoc();
            $order_id = $result_order_id['order_id'];

            $session_id = session_id();

            $query_cart_product = "SELECT *FROM cart where session_id = '$session_id'";
            $result_cart_product  = $this->db->select($query_cart_product);
            
           
            while($value = $result_cart_product->fetch_assoc()){
                $product_id = $value['product_id'];
                $quantity = $value['quantity'];
                $price = $value['product_price']*$quantity;

                //Cập nhật lại sl trong bảng sản phẩm
                $query_update = "UPDATE product SET product_quantity = (product_quantity - '$quantity') where product_id = '$product_id'";
                $this->db->update($query_update);

                $query = "INSERT INTO order_detail(order_id, product_id, quantity, price) 
                VALUE('$order_id', '$product_id','$quantity' ,'$price')";
                $this->db->insert($query);
            }
        }

        public function show_order(){
           $get_order = "SELECT *FROM tblorder";
            // $get_order = "SELECT tblorder.*, order_detail.* FROM tblorder inner join order_detail on tblorder.order_id = order_detail.order_id";
            $result_order = $this->db->select($get_order);

            return $result_order;
        }
        public function get_order(){
            $get_order = "SELECT *FROM tblorder  ORDER BY order_id DESC LIMIT 1";
            $result_order = $this->db->select($get_order);
            return $result_order;
        }

        public function get_order_by_userid($user_id){
            $get_order = "SELECT * FROM tblorder WHERE user_id = '$user_id' 
            order by order_id DESC";
            $result_order = $this->db->select($get_order);
            return $result_order;
        }

        public function get_order_by_status($status){
            $get_order = "SELECT * FROM tblorder WHERE status = '$status' 
            order by order_id DESC";
            $result_order = $this->db->select($get_order);
            return $result_order;
        }

        public function get_order_by_userid_status($user_id, $status){
            $get_order = "SELECT * FROM tblorder WHERE user_id = '$user_id' and status = '$status'
            order by order_id DESC";
            $result_order = $this->db->select($get_order);
            return $result_order;
        }


        public function get_order_by_orderid($order_id){
            $get_order = "SELECT * FROM tblorder WHERE order_id = '$order_id'";
            $result_order = $this->db->select($get_order);
            return $result_order;
        }

        //Lấy tổng giá và số lượng của mỗi đơn hàng
        public function get_sum($order_id){
            $query = "SELECT *FROM order_detail WHERE order_id = '$order_id'";
            $result = $this->db->select($query);
            $sum_price = 0;
            $sum_quantity = 0;
            while($value = $result->fetch_assoc()){
                $sum_price += $value['price'];
                $sum_quantity += $value['quantity'];
            }
            Session::set('sum_price', $sum_price);
            Session::set('sum_quantity', $sum_quantity);
        }


        public function get_order_detail(){
            $get_order = "SELECT *FROM tblorder ORDER BY order_id DESC LIMIT 1;";
            $result_order = $this->db->select($get_order)->fetch_assoc();
            $order_id = $result_order['order_id'];
         

            $query = "SELECT order_detail.*, product.product_image, product.product_name FROM order_detail
            INNER JOIN product on order_detail.product_id = product.product_id WHERE  order_id = '$order_id'";
            $result = $this->db->select($query);
            return $result;

        }

        public function get_order_detail_by_orderid($order_id){
            $query = "SELECT order_detail.*, product.product_image, product.product_name, product.product_price FROM order_detail
            INNER JOIN product on order_detail.product_id = product.product_id WHERE  order_id = '$order_id'";
            $result = $this->db->select($query);
            return $result;
        }


        public function update_status($order_id, $status){
            $query = "UPDATE tblorder set status = '$status' WHERE order_id = '$order_id'";
            $this->db->update($query);
        }     
    }

?>