  <?php
// if (!defined(PAGE_URL))define ('PAGE_URL', 'http://localhost/Dairy/');
// include("auth.php");
// $log = new logmein();
// $log->encrypt = FALSE; //set encryption
// //Log out
// $log->logout();
// header("location:".PAGE_URL);
?> 

<?php   
// define ('PAGE_URL', 'http://localhost/Dairy/');
session_start(); //to ensure you are using same session
session_destroy(); //destroy the session
header("location:../index.php"); //to redirect back to "index.php" after logging out
exit();

?>
