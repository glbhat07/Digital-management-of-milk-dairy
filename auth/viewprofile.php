<?php
   
session_start();
$conn=mysqli_connect('localhost','root','','mgnt_dairy')or die ("Connection failure!!");
$id = $_SESSION['emp_id'];
$res = mysqli_query($conn,"SELECT * from employ WHERE emp_id = '$id'");

if(mysqli_num_rows($res)>0){
  $fetch=mysqli_fetch_array($res);
  // $id = $fetch['emp_id'];
  $name=$fetch['emp_name'];
  $role=$fetch['emp_role'];
  $region = $fetch['emp_region'];

}



?>

<!doctype html>
 <html>
  <head>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
 <title>view profile</title>
 <!-- <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet'> -->
 <link href='https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css' rel='stylesheet'>
 <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
 <link rel="stylesheet" href="../css/admin/profile/viewprofile.css">
</head>
<body className='snippet-body'>




<div  class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
<div class="col-xl-6 col-md-12">
<div class="card user-card-full">
    <div class="row m-l-0 m-r-0">
<div class="col-sm-4 bg-c-lite-green user-profile">
 <div class="card-block text-center text-white">
<div class="m-b-25">
<img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image">
 </div>
<h6 class="f-w-600"><?php echo $name; ?></h6>
 <p><?php echo $id; ?></p>
 <!-- <a href="editprofile.php"> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i></a> -->
  </div>
 </div>
<div class="col-sm-8">
 <div class="card-block">
 <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
 <div class="row">
  <div class="col-sm-6">
  <p class="m-b-10 f-w-600">Employee ID</p>
 <h6 class="text-muted f-w-400"><?php echo $id; ?></h6>
 </div>
 <div class="col-sm-6">
 <p class="m-b-10 f-w-600">Employee Name</p>
 <h6 class="text-muted f-w-400"><?php echo $name; ?></h6>
   </div>
 </div>
  <div class="row">
   <div class="col-sm-6">
  <p class="m-b-10 f-w-600">Role</p>
 <h6 class="text-muted f-w-400"><?php echo $role; ?></h6>
  </div>
  <div class="col-sm-6">
  <p class="m-b-10 f-w-600">Region</p>
  <h6 class="text-muted f-w-400"><?php echo $region; ?></h6>
 </div>
</div>
   </div>
  </div>
 </div>
  </div>
  </div>
  </div>
   </div>
  </div>