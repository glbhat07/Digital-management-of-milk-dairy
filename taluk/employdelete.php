<?php
$empid = $_GET['emp_id'];
$conn=mysqli_connect('localhost','root','','mgnt_dairy')or die ("Connection failure!!");

$delete = mysqli_query($conn,"DELETE * FROM employ WHERE emp_id = '$empid'");
if($delete){
    echo'<script>alert("Deleted SUCCESSFUL");
            window.location="./employee.php";
    </script>';
}else{
    echo'<script>alert("Failed! Something went wrong!");
    window.location="./employee.php";
</script>';
}
?>