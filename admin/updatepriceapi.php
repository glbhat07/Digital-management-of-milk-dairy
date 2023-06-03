<?php

session_start();
$conn=mysqli_connect('localhost','root','','dairy_mgnt')or die ("Connection failure!!");
// if(isset($_POST['add-btn']))
{
  
    $price = $_GET['price'];
    $fat = $_GET['fat'];



 
        $update= mysqli_query($conn,"UPDATE price_chart SET fat='$fat',price='$price' WHERE fat='$fat'");
        if($update){
            echo '<script>
            alert("SUCCESSFUL!\nPrice Updated");
            window.location = "pricechart.php";
            </script>';
        }
        else{
            echo '<script>
            alert("ERROR!\nSomething went wrong\nTry again Later");
            window.location = "pricechart.php";
            </script>';
        }
       
    }


?>