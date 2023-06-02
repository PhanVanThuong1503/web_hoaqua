<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class ncc{
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_ncc($data){
            $ten_ncc = mysqli_real_escape_string($this->db->link, $data['ten_ncc']);
            $diachi = mysqli_real_escape_string($this->db->link, $data['diachi']);
            $sodt = mysqli_real_escape_string($this->db->link, $data['sodt']);
            if(empty($ten_ncc) || empty($diachi) || empty($sodt)){
                $mgs = "<span class='error'>Bạn phải nhập đủ thông tin!</span>";
            }
            else{
                if (preg_match ("/^[0-9]*$/", $sodt) && strlen($sodt)===10 )
                {
                    $query = "INSERT INTO ncc(ten_ncc, diachi, sodt) value('$ten_ncc', '$diachi', '$sodt')";
                    $result = $this->db->insert($query);
                    if ($result) {
                        $mgs = "<span class='succes'>Thêm nhà cung cấp thành công!</span>";
                    } else {
                        $mgs = "<span class='error'>Không thêm được nhà cung cấp!</span>";
                    }
                }
                else{
                    $mgs = "<span class='error'>Số điện thoại không đúng định dạng!</span>";
                }
            }
            
            return $mgs;
        }


        public function show_ncc(){
            $query = "SELECT *FROM ncc order by ma_ncc desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function delete_ncc($ma_ncc){
            $query = "DELETE FROM ncc WHERE ma_ncc = '$ma_ncc'";
            $result = $this->db->delete($query);
            if ($result) {
                $alert = "<span class='succes'>Xóa nhà cung cấp thành công!</span> ";
                return $alert;
            } else {
                $alert = "<span class='error'>Xóa nhà cung cấp thất bại!</span> ";
                return $alert;
            }
        }

        public function update_ncc($data, $id){
            $ten_ncc = mysqli_real_escape_string($this->db->link, $data['ten_ncc']);
            $diachi = mysqli_real_escape_string($this->db->link, $data['diachi']);
            $sodt = mysqli_real_escape_string($this->db->link, $data['sodt']);
            if(empty($ten_ncc) || empty($diachi) || empty($sodt)){
                $mgs = "<span class='error'>Bạn phải nhập đủ thông tin!</span>";
            }
            else{
                if (preg_match ("/^[0-9]*$/", $sodt) && strlen($sodt)===10 )
                {
                    $query = "UPDATE ncc 
                    SET ten_ncc = '$ten_ncc',
                    diachi = '$diachi',
                    sodt = '$sodt'
                    where ma_ncc = '$id'";
                    $result = $this->db->update($query);
                    if ($result) {
                        $mgs = "<span class='succes'>Cập nhật nhà cung cấp thành công!</span>";
                    } else {
                        $mgs = "<span class='error'>Không cập nhật được nhà cung cấp!</span>";
                    }
                }
                else{
                    $mgs = "<span class='error'>Số điện thoại không đúng định dạng!</span>";
                }
            }
            
            return $mgs;
        }


        public function get_ncc_byid($id){
            $query = "SELECT *FROM ncc where ma_ncc = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
    }




?>