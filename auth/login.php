<?php
session_start();
$conn=mysqli_connect('localhost','root','','mgnt_dairy')or die ("Connection failure!!");

if(isset($_POST['login-btn'])){
    $emp_id = $_POST['username'];
    $password = md5($_POST['password']);

   $res = mysqli_query($conn,"SELECT * from employ WHERE emp_id = '$emp_id' AND emp_password = '$password'");

    if(mysqli_num_rows($res)>0){
        $fetch=mysqli_fetch_array($res);
        $name=$fetch['emp_name'];
        $_SESSION['emp_id']=$fetch['emp_id'];
        $_SESSION['name']=$name;
        
        if($fetch['emp_role'] == "admin"){
            header("location:../admin/admindashbrd.php");
        }
        elseif($fetch['emp_role'] == "union-manager"){
            header("location:../union/uniondashbrd.php");
        }
        elseif($fetch['emp_role'] == "taluk-manager"){
            header("location:../taluk/tlkdashboard.php");
        }
        else{
            header("location:../dairy/dairydashboard.php");
        }
    }

    else{

        // echo $password;

        echo '<script>
        alert("Login failed!\nPlease check employee-id and password\n");
        window.location = "../index.php";
        </script>';
        
    }
}
?>