<?php
session_start();
$conn=mysqli_connect('localhost','root','','dairy_mgnt')or die ("Connection failure!!");

$emp_id = $_SESSION['emp_id'];
$current = md5($_GET['curpass']);
$new = md5($_GET['new-pass']);




   $res = mysqli_query($conn,"SELECT * from employ WHERE emp_id = '$emp_id' AND emp_password = '$current'");


   if(mysqli_num_rows($res)>0){
   $update=mysqli_query($conn," UPDATE employ SET emp_password = '$new' WHERE emp_id= '$emp_id'");
   if($update)
   {
       echo '<script> 
       alert("SUCCESSFUL!\nPassword updated!")
       window.location = "changepassword.php";
       </script>';
   }
   else{
       echo '<script> 
       alert("sorry! something went wrong")
       window.location = "changepassword.php";
       </script>';
   }
}
else{
    echo $emp_id;
    echo $current;
    echo '<script> 
    alert("ERROR!\n Current password entered is wrong")
    window.location = "changepassword.php";
    </script>';
}

?>