<?php
    session_start();
    $card_no  = $_GET['card_no'];

$conn=mysqli_connect('localhost','root','','dairy_mgnt')or die ("Connection failure!!");

$res = mysqli_query($conn,"SELECT * FROM farmer WHERE card_no = '$card_no'");

if(mysqli_num_rows($res)>0)
{
        
$fetch=mysqli_fetch_array($res);
}
?>


<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit farmer</title>
    <link rel="stylesheet" href="../css/admin/addemployee.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <style>
  .back-btn{
    background-clip: padding-box;
    background-color: #00fa9a;
    border: 1px solid transparent;
    border-radius: .30rem;
    box-shadow: rgba(0, 0, 0, 0.02) 0 1px 3px 0;
    box-sizing: border-box;
    /* color: #fff; */
    cursor: pointer;
    /* display: inline-flex; */
    font-family: system-ui,-apple-system,system-ui,"Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 16px;
    font-weight: 600;
    padding:10px;

  }
        </style>
    
    

  </head>
  <body>
  <a href="./farmer.php"> <button style="float:right;margin-right:8%;margin-top:6%;" type="button" class="back-btn">
<span class="btn-label"><i class="fa fa-arrow-left"></i> </span>Back</button> </a>
 <main>
 <div class="add-container">
        <form action="" method="POST" id="form" class="addform">
            <h2>EDIT FARMER DETAILS</h2>
            <div class="form-control">
                <label for="name">Farmer Name</label>
                <input type="text" name="name" id="name" value="<?php echo $fetch['name']; ?>" placeholder="Enter Farmer name">
                <small>Error Message</small>
            </div>
            
            <div class="form-control">
                <label for="address">Farmer Address</label>
                <input type="text" name="address" id="adress" value="<?php echo $fetch['address'];?>" placeholder="Enter farmer address">
                
                <small>Error Message</small>
            </div>
            <div class="form-control">
                <label for="acc_no">Farmer Account_no</label>
                <input type="text" name="acc_no" id="acc_no" value="<?php echo $fetch['acc_no'];?>" placeholder="Enter farmer account number">
                <small>Error Message</small>
            </div>
            <div class="form-control">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" value="<?php echo $fetch['phone'];?>" placeholder="Enter phone number">
                <small>Error Message</small>
            </div>
            <div class="form-control">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="<?php echo $fetch['email'];?>" placeholder="Enter Email">
                <small>Error Message</small>
            </div>
            <button name="add-btn" class="button-5">EDIT</button>
        </form>
    </div>
 </main>

 <?php 
 if(isset($_POST['add-btn'])){
    $name = $_POST['name'];
    $address = $_POST['address'];
    $acc_no = $_POST['acc_no'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $update= mysqli_query($conn,"UPDATE farmer SET name='$name',address='$address',acc_no='$acc_no',phone='$phone',email='$email' WHERE card_no='$card_no'");
        if($update){
            echo '<script>
            alert("SUCCESSFUL!\nDetails Updated");
            window.location = "farmer.php";
            </script>';
        }
        else{
            echo '<script>
            alert("ERROR!\nSomething went wrong\nTry again Later");
            window.location = "farmer.php";
            </script>';
        }
       
    }
     ?>


  </body>
</html>

<?php
include 'dairysidebar.php';
?>
<?php include '../incl/footer.incl.php'; ?>