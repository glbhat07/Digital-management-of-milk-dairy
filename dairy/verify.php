<?php
session_start();
$conn=mysqli_connect('localhost','root','','dairy_mgnt')or die ("Connection failure!!");

$id = $_GET['id'];
$_SESSION['id_for_mail'] = $id;


$update= mysqli_query($conn,"UPDATE milk SET verify=1 WHERE id='$id'");
if($update){
    echo '<script>
      window.location = "../mail/send-email.php";
    </script>';
}
else{
    echo '<script>
    alert("ERROR!\nSomething went wrong\nTry again Later");
    window.location = "dairydashboard.php";
    </script>';
}


?>
<?php include '../incl/footer.incl.php'; ?>