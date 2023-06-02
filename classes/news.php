<?php
//include "../lib/database.php";
//include "../helpers/format.php";

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');

?>
<?php
class news
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_news($data, $files)
    {
        $news_name = mysqli_real_escape_string($this->db->link, $data['news_name']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['news_image']['name'];
        $file_size = $_FILES['news_image']['size'];
        $file_temp = $_FILES['news_image']['tmp_name'];

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

            $query = "INSERT INTO news(news_name, news_image, description) 
                VALUE('$news_name', '$unique_image', '$description')";
            $result = $this->db->insert($query);

            if ($result) {
                $alert = "<span class='succes'>Thêm tin tức thành công!</span>";
            } else {
                $alert = "<span class='error'>Không thêm được tin tức!</span>";
            }
        }
        return $alert;
    }


    public function show_news()
    {
        $query = "SELECT *FROM news ORDER BY news_id desc";
        $result = $this->db->select($query);
        return $result;
    }


    public function getnewsbyId($id)
    {
        $query = "SELECT *FROM news WHERE news_id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_news($data, $files, $id)
    {

        $news_name = mysqli_real_escape_string($this->db->link, $data['news_name']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);

        $permited = array('jpg', 'jpeg', 'png', 'gif');

        $file_name = $_FILES['news_image']['name'];
        $file_size = $_FILES['news_image']['size'];
        $file_temp = $_FILES['news_image']['tmp_name'];

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
            $query = "UPDATE news SET 
                news_name = '$news_name', 
                news_image = '$unique_image',
                description = '$description'
                WHERE news_id = '$id' ";
        } 
        else {
            $query = "UPDATE news SET 
                news_name = '$news_name', 
                description = '$description'
                WHERE news_id = '$id' ";
        }

        $result = $this->db->update($query);
        if ($result) {
            $alert = "<span class='succes'>Cập nhật tin tức thành công!</span> ";
            return $alert;
        } else {
            $alert = "<span class='error'>Cập nhật thất bại!</span> ";
            return $alert;
        }
    }

    public function delete_news($id)
    {
        $query = "DELETE FROM news WHERE news_id = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='succes'>Xóa tin tức thành công!</span> ";
            return $alert;
        } else {
            $alert = "<span class='error'>Xóa tin tức thất bại!</span> ";
            return $alert;
        }
    }


    ////----------------------END BACK EN--------------------//


}
?>