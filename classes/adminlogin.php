<?php

    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/session.php');
   
    session::checkLogin();
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
   
?>
<?php
    class adminlogin{ 
        private $db;
        private $fm;
        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function login_admin($admin_user, $admin_pass){
            $admin_user = $this->fm->validation($admin_user);
            $admin_pass = $this->fm->validation($admin_pass);

            $admin_user = mysqli_real_escape_string($this->db->link, $admin_user);
            $admin_pass = mysqli_real_escape_string($this->db->link, $admin_pass);

            if(empty($admin_user) || empty($admin_pass)){
                $alert = "<span class='error'>Tên đăng nhập và tài khoản không được để trống!</span>";
                return $alert;
            }
            else{
                $query = "SELECT * FROM admin WHERE admin_user = '$admin_user' AND admin_pass = '$admin_pass' LIMIT 1";
                $result = $this->db->select($query);

                if($result != false){
                    $value = $result->fetch_assoc();
                    Session::set('adminlogin',true);
                    Session::set('admin_id', $value['admin_id']);
                    Session::set('admin_user', $value['admin_user']);
                    Session::set('admin_name', $value['admin_name']);

                    header('Location:index.php');
                }
                else{
                    $alert = "<span class='error'>Tài khoản hoặc mật khẩu không đúng!</span>";
                    return $alert;
                }
            }
        }

        public function show_admin(){
            $query = "SELECT *FROM admin";
            $result = $this->db->select($query);
            return $result;
        }

        public function register_admin($data){
            $admin_name = mysqli_real_escape_string($this->db->link, $data['admin_name']);
            $admin_email = mysqli_real_escape_string($this->db->link, $data['admin_email']);
            $admin_user = mysqli_real_escape_string($this->db->link, $data['admin_user']);
            $admin_pass = mysqli_real_escape_string($this->db->link, $data['admin_pass']);
    
            $query = "INSERT INTO admin(admin_name, admin_email, admin_user, admin_pass)
            VALUE ('$admin_name', '$admin_email', '$admin_user', '$admin_pass')";
            $result = $this->db->insert($query);
            
            if($result){
                $msg = "<span class='succes'>Đăng ký tài khoản thành công!<span> <a href='login.php'>Đăng nhập</a>";
                return $msg;
            }
            else{
                $msg = "<span class='error'>Đăng ký tài khoản không thành công!<span>";
                return $msg;
            }
        }
    }
?>