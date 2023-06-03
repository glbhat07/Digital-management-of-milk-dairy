<?php

// echo $_GET['id'];

session_start();
$conn=mysqli_connect('localhost','root','','dairy_mgnt')or die ("Connection failure!!");

$empid = $_SESSION['emp_id'];

$opt = mysqli_query($conn,"SELECT emp_region FROM employ WHERE emp_id = '$empid'");
if(mysqli_num_rows($opt)>0){ 
    $fetch=mysqli_fetch_array($opt);
    $upperreg=$fetch['emp_region'];
}

// if(isset($_POST['add-btn']))
{
    $regcode = $_GET['regcode'];
    $regname = $_GET['regname'];
    $regtype = $_GET['regtype'];


   $res = mysqli_query($conn,"SELECT * from region WHERE reg_code = '$regcode'");

    if(mysqli_num_rows($res)>0){
        echo '<script>
        alert("ERROR!\nDairy already exists with this Region Code\n");
        window.location = "newdairy.php";
        </script>';
    }

    else{
        $insert= mysqli_query($conn,"INSERT INTO region VALUES('$regcode','$regname','$regtype','$upperreg')");
        if($insert){
            echo '<script>
            alert("SUCCESSFUL!\nNew Dairy Added");
            window.location = "newdairy.php";
            </script>';
        }
        else{
            echo '<script>
            alert("ERROR!\nSomething went wrong\nTry again Later");
            window.location = "newdairy.php";
            </script>';
        }
       
    }
}

?>
<?php include '../incl/footer.incl.php'; ?>