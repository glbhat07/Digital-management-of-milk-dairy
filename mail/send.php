
<?php
// require 'PHPMailer/PHPMailerAutoload.php';
require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

$mail = new PHPMailer;

if(isset($_POST['resetbtn']))
{
    // $username=$_POST['username'];
    // $mobilenum=$_POST['mobilenum'];

    // $to=mysqli_query($connect,"SELECT username FROM register WHERE username= '$username' AND mobilenum= '$mobilenum'");
    $to="glbhat07@gmail.com";
    $sub="Password Reset";
    $msg="Dont reply,Reset your password by clicking here.Don't share it with anybody.It is valid for 10 min";
    $from="From: ngo.web123@gmail.com";


{


//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'ngo.web123@gmail.com';                 // SMTP username
$mail->Password = 'nsqownebdgljfkad';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('ngo.web123@gmail.com', 'Mailer');
$mail->addAddress($to);     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $sub;
$mail->Body    = $msg;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
}
}
?>
