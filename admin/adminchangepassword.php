<?php

include 'adminsidebar.php';
include '../auth/changepassword.php';
session_start();
$conn=mysqli_connect('localhost','root','','dairy_mgnt')or die ("Connection failure!!");

?>
<?php include '../incl/footer.incl.php'; ?>