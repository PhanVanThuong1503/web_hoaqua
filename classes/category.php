<?php
    //include "../lib/database.php";
    //include "../helpers/format.php";

    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>
<?php
    class category{
        private $db;
        private $fm;
        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_category($cate_name){
            $cate_name = $this->fm->validation($cate_name);
           
            $cate_name = mysqli_real_escape_string($this->db->link, $cate_name);
           

            if(empty($cate_name)){
                $alert = "<span class='error'>Tên danh mục không được để trống!</span>";;
                return $alert;
            }
            else{
                $query = "INSERT INTO category(cate_name) VALUE('$cate_name')";
                $result = $this->db->insert($query);

                if($result){
                    $alert = "<span class='succes'>Thêm danh mục thành công!</span>";;
                    return $alert;
                }
                else{
                    $alert = "<span class='error'>Không thể thêm danh mục!</span>";;
                    return $alert;
                }
            }
        }


        public function show_category(){
            $query = "SELECT *FROM category ORDER BY cate_id desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function getcatebyId($id){
            $query = "SELECT *FROM category WHERE cate_id = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_category($cate_name, $id){
            $cate_name = $this->fm->validation($cate_name);
           
            $cate_name = mysqli_real_escape_string($this->db->link, $cate_name);
            $id = mysqli_real_escape_string($this->db->link, $id);

            if(empty($cate_name)){
                $alert = "<span class='error'>Tên danh mục không được để trống!</span>";
                return $alert;
            }
            else{
                $query = "UPDATE category SET cate_name = '$cate_name' WHERE cate_id = '$id'";
                $result = $this->db->update($query);

                if($result){
                    $alert = "<span class='succes'>Cập nhật danh mục thành công!</span>";
                    return $alert;
                }
                else{
                    $alert = "<span class='error'>Cập nhật danh mục thất bại!</span>";;
                    return $alert;
                }
            }
        }


        public function delete_cate($id){
            $query = "DELETE FROM category WHERE cate_id = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='succes'>Xóa danh mục thành công!</span>";;
                return $alert;
            }
            else{
                $alert = "<span class='error'>Xóa danh mục thất bại!</span>";;
                return $alert;
            }
        }
    }
?>