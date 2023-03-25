<?php

// echo $_GET['id'];



session_start();
$conn=mysqli_connect('localhost','root','','mgnt_dairy')or die ("Connection failure!!");
// if(isset($_POST['add-btn']))
{
    $regcode = $_GET['regcode'];
    $regname = $_GET['regname'];
    $upperreg = $_GET['upperreg'];
    $regtype = $_GET['regtype'];


   $res = mysqli_query($conn,"SELECT * from region WHERE reg_code = '$regcode'");

    if(mysqli_num_rows($res)>0){
        echo '<script>
        alert("ERROR!\nRegion already exists with this Region Code\n");
        window.location = "newunion.php";
        </script>';
    }

    else{
        $insert= mysqli_query($conn,"INSERT INTO region VALUES('$regcode','$regname','$regtype','$upperreg')");
        if($insert){
            echo '<script>
            alert("SUCCESSFUL!\nNew Region Added");
            window.location = "newunion.php";
            </script>';
        }
        else{
            echo '<script>
            alert("ERROR!\nSomething went wrong\nTry again Later");
            window.location = "newunion.php";
            </script>';
        }
       
    }
}

?>