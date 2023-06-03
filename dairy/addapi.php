<?php

// echo $_GET['id'];



session_start();
$conn=mysqli_connect('localhost','root','','dairy_mgnt')or die ("Connection failure!!");
// if(isset($_POST['add-btn']))
{
    $region = $_SESSION['region'];
    $adress = $_SESSION['adress'];
    $card_no = $_GET['card_no'];
    $name = $_GET['name'];
    $acc_no = $_GET['acc_no'];
    $phone = $_GET['phone'];
    $email = $_GET['email'];


   $res = mysqli_query($conn,"SELECT * from farmer WHERE card_no = '$card_no'");

    if(mysqli_num_rows($res)>0){
        echo '<script>
        alert("ERROR!\nFarmer already exists with this card number\n");
        window.location = "addfarmer.php";
        </script>';
    }

    else{
        $insert= mysqli_query($conn,"INSERT INTO farmer VALUES('$card_no','$name','$phone','$adress','$acc_no','$region','$email')");
        if($insert){
            echo '<script>
            alert("SUCCESSFUL!\nNew Farmer Added");
            window.location = "addfarmer.php";
            </script>';
        }
        else{
            echo '<script>
            alert("ERROR!\nSomething went wrong\nTry again Later");
            window.location = "addfarmer.php";
            </script>';
        }
       
    }
}

?>