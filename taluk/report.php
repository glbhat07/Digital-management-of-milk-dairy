<?php

// include 'tlksidebar.php';

session_start();
$conn=mysqli_connect('localhost','root','','mgnt_dairy')or die ("Connection failure!!");

$empid = $_SESSION['emp_id'];

$opt = mysqli_query($conn,"SELECT emp_region FROM employ WHERE emp_id = '$empid'");
if(mysqli_num_rows($opt)>0){ 
    $fetch=mysqli_fetch_array($opt);
    $empreg=$fetch['emp_region'];
}

$month = date('m');

$months = array(
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July ',
    'August',
    'September',
    'October',
    'November',
    'December',
);

$monthly_quant = array(0,0,0,0,0,0,0,0,0,0,0,0);
$dairyno=array();
$dairyquant=array();
$reg_names=array();
?>

<?php


$total = 0;

    $res1 = mysqli_query($conn,"SELECT * FROM region WHERE upper_reg = '$empreg'");
    if(mysqli_num_rows($res1)>0){ 
        $j = 0;
        while($row1 = mysqli_fetch_array($res1))
        { 
        $rgn_no = $row1['reg_code'];
$card = mysqli_query($conn,"SELECT card_no from farmer WHERE region = '$rgn_no'");
if(mysqli_num_rows($card)>0){ 
    while($card1 = mysqli_fetch_array($card))
    { 
    $card_no = $card1['card_no'];

$i =1;
while($i<13)
{
$res = mysqli_query($conn,"SELECT SUM(quantity) as quantity FROM milk WHERE ((YEAR(dates) = YEAR(CURRENT_DATE - INTERVAL '$i' MONTH))) AND (MONTH(dates) = MONTH(CURRENT_DATE - INTERVAL '$i' MONTH)) AND card_no = '$card_no'");

while ($row = mysqli_fetch_array($res)) {

    $total+= $row['quantity'];
    

}
$i++;
}
        }
    }
    $dairyno[$j] = $rgn_no;
    $dairyquant[$j] = $total;
    $total = 0;
    $j++;
}}


?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>per dairy table</title>
    
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


.custom-btn {
  display: inline-block;
  background-color: #7b38d8;
  width:150px;
  padding:5px;
  color: #ffffff;
  text-align: center;
  border: 4px double #cccccc;
  border-radius: 10px;
  font-size: 15px;
  cursor: pointer;
  margin: 5px;
  -webkit-transition: all 0.5s; /* add this line, chrome, safari, etc */
  -moz-transition: all 0.5s; /* add this line, firefox */
  -o-transition: all 0.5s; /* add this line, opera */
  transition: all 0.5s; /* add this line */
}
.custom-btn:hover {
  background-color: green;
}





</style>
  
  </head>
  <body>

    <?php


        
$i=0;
while($i < $j)
{
    $reg = mysqli_query($conn,"SELECT * FROM region WHERE reg_code = '$dairyno[$i]'");
    $fetch = mysqli_fetch_array($reg);
    $region=$fetch['reg_name'];
    $reg_names[$i] =  $region;
   
    
$i++;
}
?>

     
        
    </tbody>
  </table>

</section>
<!-- partial -->
</div>
 </main>
  
<!-- Table Search JS -->
  <script  src="../js/admin/search.js"></script>
  
  </body>
</html>




<?php
	
$i=0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>report</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>


	<div style="margin-left:19%;margin-top:5%;"class="container">
		<div class="row">
			<div class="col-md-6">
				<h1 style="align:center">Contribution of different Milk-Dairies</h1>
			</div>
		</div>
	</div>
	 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Dairy','Quantiry'],
          <?php
          	while ($i<$j) {
          		//echo "<pre>";print_r($row); die;
          		echo "['".$reg_names[$i]."',".$dairyquant[$i]."],  ";
                $i++;
          	}
          ?>
        ]);
        var options = {
          title: 'Milk Collected Data in chart',
         // pieHole: 0.4,
          is3d:true,
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>
    <div id="piechart" style="margin-left:19%;width: 79%; height: 500px;"></div>
    <p style="margin-left:19%;margin-top:3%;margin-right:1%"> The above pie chart depicts the visual 
        representation of Milk collected data from different dairies 
        across your Taluk region over past one year.
        <br/>
        Each society has milk collection centre either in an owned or hired premise. 
        Each morning and evening, the milk producers bring milk in their own containers (stainless steel) 
        to the society. A representative sample of milk is drawn for testing the quality milk. Milk is collected 
        in milk cans or directly to the cooler as the case may be. The collection accessories are made up of 
        stainless steel (AISI 304). The measurement of milk is done carefully so as to avoid foam, shortage etc. 
        Quantity of milk supplied by each individual along with the sample bottle of milk is recorded against 
        her/his name in the purchase register and the card/pass book of the pourer. In many of the societies 
        the process is semi automatic with the help of computer and Electronic Milko Tester placed on line. 
        A printed slip is generated for each member giving details about the date, shift, type of milk, 
        producer identification number, weight and fat% of milk, rate, price etc.
    </p>
</body>
</html>

<?php
include 'monthlyreport.php';
// include 'seasonalreport.php';
include 'tlksidebar.php';

?>













