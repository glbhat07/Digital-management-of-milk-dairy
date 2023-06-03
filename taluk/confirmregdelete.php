<?php
$regcode = $_GET['regcode'];
$conn=mysqli_connect('localhost','root','','dairy_mgnt')or die ("Connection failure!!");

$delete = mysqli_query($conn,"DELETE * FROM region WHERE reg_code = '$reg_code'");

if($delete){
    $delete1 = mysqli_query($conn,"DELETE * FROM employ WHERE emp_region = '$reg_code'");
    if($delete1){
        $delete2 = mysqli_query($conn,"DELETE * FROM farmer WHERE region = '$reg_code'");
        if($delete2){
    echo'<script>alert("Deleted SUCCESSFUL");
            window.location="./dairy.php";
    </script>';
        }
    }
}else{
    echo'<script>alert("Failed! Something went wrong!");
    window.location="./dairy.php";
</script>';
}
?>
<?php include '../incl/footer.incl.php'; ?>