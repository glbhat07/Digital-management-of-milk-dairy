<?php

// echo $_GET['id'];



session_start();
$conn=mysqli_connect('localhost','root','','mgnt_dairy')or die ("Connection failure!!");
// if(isset($_POST['add-btn']))
{
    $emp_id = $_GET['id'];
    $password = md5($_GET['password']);
    $empname = $_GET['empname'];
    $emprole = $_GET['role'];
    $empregion = $_GET['region'];


   $res = mysqli_query($conn,"SELECT * from employ WHERE emp_id = '$emp_id'");

    if(mysqli_num_rows($res)>0){
        echo '<script>
        alert("ERROR!\nEmployee already exists with this employee id\n");
        window.location = "addemployee.php";
        </script>';
    }

    else{
        $insert= mysqli_query($conn,"INSERT INTO employ VALUES('$emp_id','$empname','$emprole','$empregion','$password')");
        if($insert){
            echo '<script>
            alert("SUCCESSFUL!\nNew Employee Added");
            window.location = "addemployee.php";
            </script>';
        }
        else{
            echo '<script>
            alert("ERROR!\nSomething went wrong\nTry again Later");
            window.location = "addemployee.php";
            </script>';
        }
       
    }
}

?>