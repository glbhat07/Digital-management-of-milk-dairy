<?php

session_start();
$conn=mysqli_connect('localhost','root','','dairy_mgnt')or die ("Connection failure!!");

$empid = $_SESSION['emp_id'];

$opt = mysqli_query($conn,"SELECT emp_name FROM employ WHERE emp_id = '$empid'");
if(mysqli_num_rows($opt)>0){ 
    $fetch=mysqli_fetch_array($opt);
    $empname=$fetch['emp_name'];
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
        <title>taluk officer sidebar</title>
	<link rel="stylesheet" href="styles.css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- SideBar-Menu CSS -->
    <link rel="stylesheet" href="../css/taluk/tlksidebarstyle.css">

	<!-- Demo CSS -->
	<link rel="stylesheet" href="../css/taluk/tlksidebardemo.css">
    
	<script>
		$(document).ready(function(){
			$(".hamburger .hamburger__inner").click(function(){
			  $(".wrapper").toggleClass("active")
			})

			$(".top_navbar .fas").click(function(){
			   $(".profile_dd").toggleClass("active");
			});
		})
	</script>
</head>
<body>

<div>
<div class="wrapper">
  <div class="top_navbar">
    <div class="hamburger">
       <div class="hamburger__inner">
         <div class="one"></div>
         <div class="two"></div>
         <div class="three"></div>
       </div>
    </div>
    <div class="menu">
      <div class="logo">
        Milk Dairy Management System
      </div>
      <div class="right_menu">
        <ul>
          <li><i class="fas fa-user"></i>
            <div class="profile_dd">
               <a href="./tlkviewprofile.php"><div class="dd_item">Profile</div></a>
               <a href="./tlkchangepassword.php"> <div class="dd_item">Change Password</div></a>
               <a href="../auth/confirmlogout.php"><div class="dd_item">Logout</div></a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  </div>
    
  <div class="main_container">
      <div class="sidebar">
          <div class="sidebar__inner">
            <div class="profile">
              <div class="img">
                <img src="../img/admin/user2.png" alt="profile_pic">
              </div>
              <div class="profile_info">
                 <p>Welcome</p>
                 <p class="profile_name"><?php echo $empname ?></p>
              </div>
            </div>
            <ul>
              <li>
                <a href="./tlkdashboard.php" class="">
                  <span class="icon"><i class="fas fa-dice-d6"></i></span>
                  <span class="title">Dashboard</span>
                </a>
              </li>
              <li>
                <a href="./employee.php">
                  <span class="icon"><i class="fab fa-delicious"></i></span>
                  <span class="title">Employee</span>
                </a>
              </li>
              <li>
                <a href="./dairy.php">
                  <span class="icon"><i class="fab fa-elementor"></i></span>
                  <span class="title">Dairy</span>
                </a>
              </li>
              <li>
                <a href="./monthlyreport.php">
                  <span class="icon"><i class="fas fa-chart-pie"></i></span>
                  <span class="title">Data Tables</span>
                </a>
              </li>
              <li>
                <a href="./pricechart.php">
                  <span class="icon"><i class="fas fa-border-all"></i></span>
                  <span class="title">Price chart</span>
                </a>
              </li>
              <li>
                <a href="./quality.php">
                  <span class="icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                  <span class="title">Quality</span>
                </a>
              </li>
            </ul>
          </div>
      </div>
      
</body>
</html>