
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../PHPMailer-master/src/PHPMailer.php');
// include_once ($filepath.'/../PHPMailer-master/src/Exception.php');
include_once ($filepath.'/../PHPMailer-master/src/OAuth.php');
include_once ($filepath.'/../PHPMailer-master/src/POP3.php');
include_once ($filepath.'/../PHPMailer-master/src/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;

class sendmail{
    public $title;
    public $content;
    public $ToEmail;
    public function __construct()
    {
            
    }
    public function sendMail($title, $content, $ToEmail){
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'ctrl1612@gmail.com';               // SMTP username
        $mail->Password = 'rglgrlygujqvtyga';                 // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;   

        $mail->setFrom('ctrl1612@gmail.com', 'Hoa qua Van Van');

        $mail->Subject = $title;
        $mail->Body    = $content;

        $mail->addAddress($ToEmail, $ToEmail);

        $result = $mail->send();
        if($result){
            return 1; // Gửi thành công
        }
        else{
            return 0; // Lỗi
        }
    }
}

?>