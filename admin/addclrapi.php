<?php

session_start();
$conn=mysqli_connect('localhost','root','','dairy_mgnt')or die ("Connection failure!!");
// if(isset($_POST['add-btn']))
{
  
    $clr = $_GET['clr'];
    $fat = $_GET['fat'];



   $res = mysqli_query($conn,"SELECT * from quality WHERE fat = '$fat'");

    if(mysqli_num_rows($res)>0){
        echo '<script>
        alert("ERROR!\nCLR details already exists with this fat\n");
        window.location = "addclr.php";
        </script>';
    }

    else{
        $insert= mysqli_query($conn,"INSERT INTO quality VALUES('$fat','$clr')");
        if($insert){
            echo '<script>
            alert("SUCCESSFUL!\nNew Price Added");
            window.location = "addclr.php";
            </script>';
        }
        else{
            echo '<script>
            alert("ERROR!\nSomething went wrong\nTry again Later");
            window.location = "addclr.php";
            </script>';
        }
       
    }
}

?>