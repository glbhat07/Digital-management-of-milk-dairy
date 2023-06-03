<?php

include 'dairysidebar.php';

session_start();
    $emp_id  = $_SESSION['emp_id'];

$conn=mysqli_connect('localhost','root','','dairy_mgnt')or die ("Connection failure!!");
$reg_res = mysqli_query($conn,"SELECT * FROM employ WHERE emp_id = '$emp_id'");
$fetch_reg = mysqli_fetch_array($reg_res);
$region = $fetch_reg['emp_region'];
$name = $fetch_reg['emp_name'];
$_SESSION['region'] = $region;


?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'> 

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="../css/table/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" -->
        <!-- integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> -->
 

</head>

<body >
    <div style="margin-left:19%;margin-top:6%;">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script> -->
    <div style="width:100%;">
        <div class="justify-content-center">
            <blockquote class="blockquote text-center">
                <h2 class="mb-0 mt-4">WELCOME <?php echo $name;?>!!</h2>
            </blockquote>
        </div>
        <div class="justify-content-end">
            <p>Date/Time: <span id="datetime"></span></p>

            <script>
                var dt = new Date();
                document.getElementById("datetime").innerHTML = dt.toDateString();
            </script>
        </div>
    </div>


	<section>
		<div style="margin-left:8%" class="container">
		
			<div class="row">
				<div class="col-md-13">
					<h4 class="text-center mb-4">Verify the data details</h4>
					<div class="table-wrap">
						<table class="table">
					    <thead class="thead-primary">
					      <tr>
					        <th>Card No</th>
					        <th>Quantity</th>
					        <th>Date</th>
					        <th>LR</th>
					        <th>Fat</th>
					        <th>Price</th>
                            <th>Type</th>
                            <th>Action</th>
					      </tr>
					    </thead>
					    <tbody>
                            <?php
                        $res1 = mysqli_query($conn,"SELECT * FROM region WHERE reg_code = '$region'");
$fetch1 = mysqli_fetch_array($res1);

$res = mysqli_query($conn,"SELECT * FROM farmer WHERE region = '$region'");

if(mysqli_num_rows($res)>0)
{
        
$i=0;
while($fetch=mysqli_fetch_assoc($res))
{
    $card = $fetch['card_no'];
    $milk = mysqli_query($conn,"SELECT * FROM milk WHERE card_no = '$card' and verify = 0");
    if(mysqli_num_rows($res)>0)
{
    $i++;
    while($fetch=mysqli_fetch_assoc($milk))
{
echo"
<tr>
<td>".$fetch['card_no']."</td>
<td>".$fetch['quantity']."</td>
<td>".$fetch['dates']."</td>
<td>".$fetch['lr']."</td>
<td>".$fetch['fat']."</td>
<td>".$fetch['price']."</td>
<td>".$fetch['type']."</td>
<td> <a class='btn btn-success' href=verify.php?id=".$fetch['id'].">Verify</a> || <a class='btn btn-warning' href=milkedit.php?id=".$fetch['id'].">Edit</a></td>
</tr>";
}
}
else{
echo '<span style="color:Red"> "No records found"</span>';
}
}
}
?>
					      </tr>
					    </tbody>
					  </table>
					</div>
				</div>
			</div>
		</div>
        </div>
        
	</section>
  

	<!-- <script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script> -->

	</body>
</html>
<?php

include 'dairysidebar.php';
?>
<?php include '../incl/footer.incl.php'; ?>