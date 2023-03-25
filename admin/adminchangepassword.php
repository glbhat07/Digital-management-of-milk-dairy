<?php

include 'adminsidebar.php';
include '../auth/changepassword.php';
session_start();
$conn=mysqli_connect('localhost','root','','mgnt_dairy')or die ("Connection failure!!");

?>