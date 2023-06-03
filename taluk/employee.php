<?php
include 'tlksidebar.php';
session_start();

$conn=mysqli_connect('localhost','root','','dairy_mgnt')or die ("Connection failure!!");

$empid = $_SESSION['emp_id'];

$opt = mysqli_query($conn,"SELECT emp_region FROM employ WHERE emp_id = '$empid'");
if(mysqli_num_rows($opt)>0){ 
    $fetch=mysqli_fetch_array($opt);
    $empreg=$fetch['emp_region'];
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>search Box</title>
    
	<!-- Demo CSS -->
	<link rel="stylesheet" href="../css/search.css">

    <!-- Bootstrap 5 CSS -->
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous"> -->
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
      
<style>
.cd-table-container{
  background: #fff;
  box-shadow: 1px 2px 26px rgba(0, 0, 0, 0.2);
  padding: 15px;
  max-width: 720px;
}
/* Table Design */
.cd-table{
  width: 100%;
  color: #666;
  margin: 10px auto;
  border-collapse: collapse;
}

.cd-table tr,
.cd-table td{
  border: 1px solid #ccc;
  padding: 10px;
}
.cd-table th{
  background: #017721;
  color: #fff;
  padding: 10px;
}

/* Search Box */
.cd-search{
  padding: 10px;
  border: 1px solid #ccc;
  width: 100%;
  box-sizing: border-box;
}

/* Search Title */
.cd-title{
  color: #666;
  margin: 15px 0;
}





</style>
  
  </head>
  <body>
    <div >
  <a href="./addemployee.php"> <button style="float:right;margin-right:5%;margin-top:2%;" type="button" class="button-64">
<span class="btn-label"><i class="fa fa-plus"></i> </span> Add Employee</button> </a>
 <header class="intro">
 
 <h1> </h1>
 <h1> Search Box </h1>
 <p> Search any employee details in the table</p>



 
 </header>
  
 <main>
<!-- partial:index.partial.html -->
<section class=" cd-table-container">
  <h2 class="cd-title">Search Record:</h2>
  <input type="text" class="cd-search table-filter" data-table="order-table" placeholder="Item to filter.." />


  <table class="cd-table order-table table">
    <thead>
      <tr>
        <th>Employee Id</th>
        <th>Employee Name</th>
        <th>Employee Role</th>
        <th>Employee Region</th>
        <th>Action</th>
      </tr>
    </thead>

    <tbody>

    <?php

$conn=mysqli_connect('localhost','root','','dairy_mgnt')or die ("Connection failure!!");

$res = mysqli_query($conn,"SELECT * FROM employ WHERE emp_region IN(SELECT reg_code from region r WHERE upper_reg = '$empreg')");

if(mysqli_num_rows($res)>0)
{
        
$i=0;
while($fetch=mysqli_fetch_assoc($res))
{
    $region=$fetch['emp_region'];
    $res1 = mysqli_query($conn,"SELECT * FROM region WHERE reg_code = '$region'");
    $fetch1 = mysqli_fetch_array($res1);
    $i++;
echo"
<tr>
<td>".$fetch['emp_id']."</td>
<td>".$fetch['emp_name']."</td>
<td>".$fetch['emp_role']."</td>
<td>".$fetch1['reg_name']."</td>
<td> <a href=confirmemploydelete.php?emp_id=".$fetch['emp_id'].">Delete</a> </td>
</tr>";
}
}
else{
echo '<span style="color:Red"> "No records found"</span>';
}
?>

     
        
    </tbody>
  </table>

</section>
<!-- partial -->
 </main>
  
<!-- Table Search JS -->
  <script  src="../../js/admin/search.js"></script>
</div>
  </body>
</html>
<?php include '../incl/footer.incl.php'; ?>