<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class feedback{
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert($data){
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
            $address = mysqli_real_escape_string($this->db->link, $data['address']);
            $content = mysqli_real_escape_string($this->db->link, $data['content']);

            $query = "INSERT INTO feedback(name, address, phone, email, content)
            VALUE('$name', '$address', '$phone', '$email', '$content')";

            $result = $this->db->insert($query);
        }

        public function show_feedback(){
            $query = "SELECT *FROM feedback";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>