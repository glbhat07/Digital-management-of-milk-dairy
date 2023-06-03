<?php

session_start();
$conn=mysqli_connect('localhost','root','','dairy_mgnt')or die ("Connection failure!!");
// if(isset($_POST['add-btn']))
{
  
    $price = $_GET['price'];
    $fat = $_GET['fat'];



   $res = mysqli_query($conn,"SELECT * from price_chart WHERE fat ='$fat'");

    if(mysqli_num_rows($res)>0){
        echo '<script>
        alert("ERROR!\nPrice details already exists with this fat\n");
        window.location = "addprice.php";
        </script>';
    }

    else{
        $insert= mysqli_query($conn,"INSERT INTO price_chart VALUES('$fat','$price')");
        if($insert){
            echo '<script>
            alert("SUCCESSFUL!\nNew Price Added");
            window.location = "addprice.php";
            </script>';
        }
        else{
            echo '<script>
            alert("ERROR!\nSomething went wrong\nTry again Later");
            window.location = "addprice.php";
            </script>';
        }
       
    }
}

?>