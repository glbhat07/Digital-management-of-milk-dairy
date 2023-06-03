<?php

session_start();
$conn=mysqli_connect('localhost','root','','dairy_mgnt')or die ("Connection failure!!");
// if(isset($_POST['add-btn']))
{
  
    $clr = $_GET['clr'];
    $fat = $_GET['fat'];



 
        $update= mysqli_query($conn,"UPDATE quality SET fat='$fat',clr='$clr' WHERE fat='$fat'");
        if($update){
            echo '<script>
            alert("SUCCESSFUL!\nCLR Updated");
            window.location = "quality.php";
            </script>';
        }
        else{
            echo '<script>
            alert("ERROR!\nSomething went wrong\nTry again Later");
            window.location = "quality.php";
            </script>';
        }
       
    }


?>