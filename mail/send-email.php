<?php
session_start();
$conn=mysqli_connect('localhost','root','','dairy_mgnt')or die ("Connection failure!!");

$setmail=0;
$mailto="bhatgl17@gmail.com";
$toname="";
$id = $_SESSION['id_for_mail'];

$milk = mysqli_query($conn,"SELECT * FROM milk WHERE id = '$id'");
    if(mysqli_num_rows($milk)>0)
{
    $fetch=mysqli_fetch_array($milk);
    $card = $fetch['card_no'];
    $to = mysqli_query($conn,"SELECT * FROM farmer WHERE card_no = '$card'");
    if(mysqli_num_rows($to)>0){
        $fetch1=mysqli_fetch_array($to);
        
        $toname = $fetch1['name'];
        {
            if($fetch1['email']!= NULL){
                $setmail = 1;
                $mailto = $fetch1['email'];
            }
        }

       


    }

$quant = $fetch['quantity'];
$date = $fetch['dates'];
$lr = $fetch['lr'];
$fat = $fetch['fat'];
$price = $fetch['price'];
$type = $fetch['type'];


}


$message = "Hello <b>$toname</b><br/>Milk Collected details of the day are as follows:<br/><br/><b>CARD_NO: </b>$card<br/><b>DATE: </b>$date<br/><b>QUANTITY: </b>$quant<br/><b>LR VALUE: </b>$lr<br/><b>FAT: </b>$fat<br/><b>TYPE: </b>$type<br/><b>PRICE: </b> $price";

// $message = "Hello <b>$toname</b><br/>Milk Collected details of the day are as follows:<br/><br/><table><tr><th>CARD_NO</th><th>DATE</th><th>QUANTITY</th><th>LR VALUE</th><th>FAT</th><th>TYPE</th><th>PRICE</th></tr><tr><td>$card</td><td>$date</td><td>$quant</td><td>$lr</td><td>$fat</td><td>$type</td><td>$price</td></table>";
$name = "KMF-MILK-DAIRY";
$email = "ngo.web123@gmail.com";
$subject = "Milk Collected Details";



require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->Username = "ngo.web123@gmail.com";
$mail->Password = "nsqownebdgljfkad";

$mail->setFrom($email, $name);
$mail->addAddress($mailto);

$mail->Subject = $subject;
$mail->Body = $message;
$mail->isHTML(true);

// $mail->send();

// header("Location: sent.html");
if($setmail!=0)
{
if($mail->send()) {
    echo '<script>
    window.location = "../dairy/dairydashboard.php";
    </script>';
}
else{
    echo '<script>
    alert("Email not sent! Something went wrong!")
    window.location = "../dairy/dairydashboard.php";
    </script>';
}
}
else{
    echo '<script>
    window.location = "../dairy/dairydashboard.php";
    </script>';
}

?>