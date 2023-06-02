<?php
    //include "../lib/database.php";
    //include "../helpers/format.php";
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');

    include "sendmail.php";
?>

<?php
    class user{
        private $db;
        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function register_user($data)
        {
            $password = mysqli_real_escape_string($this->db->link, $data['password']);
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $address = mysqli_real_escape_string($this->db->link, $data['address']);
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $phone = mysqli_real_escape_string($this->db->link, $data['phone']);

            $mgs = "";
            if(empty($email) || empty($name) ||empty($address) ||empty($phone) ||empty($password)){
                $mgs = "<span class='error'>Bạn phải nhập đầy đủ thông tin!</span>";
            }
            else{
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $mgs = "<span class='error'>Email không đúng định dạng!</span>";
                    return $mgs;
                }
                if (preg_match ("/^[0-9]*$/", $phone) && strlen($phone)===10 ){
                    $mgs = "";
                }
                else{
                    $mgs = "<span class='error'>Số điện thoại không đúng định dạng!</span>";
                    return $mgs;
                }
            }

            if($mgs == ""){
                $check_query = "SELECT *FROM user where email = '$email'";
                $result_check = $this->db->select($check_query);

                if($result_check == null){
                    $query = "INSERT INTO user(password, name, address , email, phone) 
                    VALUE('$password', '$name', '$address', '$email', '$phone')";
                    $this->db->insert($query);
    
                    $mgs = "<span class='success'>Đăng ký tài khoản thành công!</span>";
                }
                else{
                    $mgs = "<span class='error'>Email đã tồn tại!</span>";
                }               
            }          
            return $mgs;
        }
            

        public function login_user($data){

            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $password = mysqli_real_escape_string($this->db->link, $data['password']);

            if(empty($email) || empty($password)){
                $alert = "<span class='error'>Bạn phải nhập đủ các thông tin!</span>";;
                return $alert;
            }
            else{
                $query = "SELECT *FROM user where email = '$email' and password = '$password' ";
                $result = $this->db->select($query);
                if($result){    
                    $value = $result->fetch_assoc();
                    Session::set('user_login', true);
                    Session::set('user_id', $value['user_id']);
                    Session::set('email', $value['email']);
                    Session::set('name', $value['name']);
                    Session::set('address', $value['address']);
                    Session::set('email', $value['email']);
                    Session::set('phone', $value['phone']);
                    header ("Location:index.php"); 
                }
                else{
                    $alert = "<span class='error'>Email hoặc mật khẩu không đúng!</span>";;
                    return $alert;
                }
            }
        }

        public function show_user()
        {
            $query = "SELECT * from user";
            $result = $this->db->select($query);
            return $result;
        }

        public function getuserbyId($id)
        {
            $query = "SELECT * FROM user WHERE user_id = '$id'";
                $result = $this->db->select($query);
                return $result;
        }

        public function delete_user($id)
        {
            $query = "DELETE FROM user WHERE user_id = '$id'";
            $result = $this->db->delete($query);
            if ($result) {
                $alert = "<span class='succes'>Xóa khách hàng thành công!</span> ";
                return $alert;
            } else {
                $alert = "<span class='error'>Xóa khách hàng thất bại!</span> ";
                return $alert;
            }
        }

        public function update_user($data, $id){
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $address = mysqli_real_escape_string($this->db->link, $data['address']);

            $mgs = "";
            if( empty($name) ||empty($address) ||empty($phone)){
                $mgs = "<span class='error'>Các thông tin không được để trống!</span>";
            }
            else{
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $mgs = "<span class='error'>Email không đúng định dạng!</span>";
                    return $mgs;
                }
                if (preg_match ("/^[0-9]*$/", $phone) && strlen($phone)===10 ){
                    $mgs = "";
                }
                else{
                    $mgs = "<span class='error'>Số điện thoại không đúng định dạng!</span>";
                    return $mgs;
                }
            }

           if($mgs == ""){
                $query = "UPDATE user SET 
                phone = '$phone',
                address = '$address',
                name = '$name'
                WHERE user_id = '$id'";

                $result = $this->db->update($query);

                $mgs =  "<span class='success'>Cập nhật thông tin thành công!</span> ";
                Session::set('name', $name);
            }
            return $mgs;
        }




        public function forgot_pass($email){
            if(filter_var($email,FILTER_VALIDATE_EMAIL)){

                $check_query = "SELECT *FROM user where email = '$email'";
                $result_check = $this->db->select($check_query);
                if($result_check!=null){
                    //Random mật khẩu
                    $chars = "abcdefghijkmnopqrstuvwxyz023456789";
                    srand((double)microtime()*1000000);
                    $i = 0;
                    $pass = '' ;
    
                    while ($i <= 4) {
                        $num = rand() % 33;
                        $tmp = substr($chars, $num, 1);
                        $pass = $pass . $tmp;
                        $i++;
                    }
                    //-------///

                    //Gửi mail
                    $sendmail = new sendmail();
                    $title = "Thu gui mat khau";
                    $content = "- Chào ".$email."\n - Mật khẩu mới của bạn là: ".$pass;
                    $result = $sendmail->sendMail($title, $content, $email);

                    if($result == 1){
                        $mgs = "<span class='success'>Yêu cầu gửi mật khẩu thành công! Vui lòng kiểm tra email của bạn</span>";

                        $this->db->update("UPDATE user SET password = '$pass' where email = '$email'");
                    }
                    else{
                        $mgs = "<span class='error'>Yêu cầu gửi mật khẩu không thành công!</span>";
                    }
                
                }
                else{
                    $mgs = "<span class='error'>Tên tài khoản không chính xác!</span>";
                }
                
            }
            else{
                $mgs = "<span class='error'>Email không đúng định dạng!</span>";              
            }

            return $mgs;
        }

        public function change_pass($data){
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $current_pass = mysqli_real_escape_string($this->db->link, $data['current_pass']);
            $new_pass = mysqli_real_escape_string($this->db->link, $data['new_pass']);

            if(!empty($current_pass) || !empty($new_pass)){

                $check_query = "SELECT *FROM user where email = '$email' and password = '$current_pass'";
                $result_check = $this->db->select($check_query);
                if($result_check == null){
                    $mgs = "<span class='error'>Mật khẩu hiện tại không chính xác!</span>";
                }   
                else{
                    $this->db->update("UPDATE user SET password = '$new_pass' where email = '$email'");
                    $mgs = "<span class='success'>Đổi mật khẩu thành công!</span>";
                }

                return $mgs;
            }
            else{
                $mgs = "<span class='error'>Bạn phải điền đủ thông tin!</span>";
            }
        
        }

    }
?>