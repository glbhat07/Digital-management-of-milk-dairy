<?php

//include 'tlksidebar.php';

session_start();
$conn=mysqli_connect('localhost','root','','dairy_mgnt')or die ("Connection failure!!");

$empid = $_SESSION['emp_id'];
$region = $_GET['regcode'];


$reg_det = mysqli_query($conn,"SELECT * FROM region WHERE reg_code = '$region'");
$reg_det1 = mysqli_fetch_array($reg_det);

$farmernum = mysqli_query($conn,"SELECT COUNT(card_no) as counts from farmer WHERE region = '$region'");
$no_farmer = mysqli_fetch_array($farmernum);

$manager = mysqli_query($conn,"SELECT emp_name FROM employ WHERE emp_region = '$region'");
$mngr_name = mysqli_fetch_array($manager);

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

?>

<?php

$i = 1;
$total = 0;
$k=0;
$avg_fat = 0;



while($i<13)
{

$card = mysqli_query($conn,"SELECT card_no from farmer WHERE region = '$region'");
if(mysqli_num_rows($card)>0){ 
    while($card1 = mysqli_fetch_array($card))
    { 
    $card_no = $card1['card_no'];

$res = mysqli_query($conn,"SELECT SUM(quantity) as quantity FROM milk WHERE ((YEAR(dates) = YEAR(CURRENT_DATE - INTERVAL '$i' MONTH))) AND (MONTH(dates) = MONTH(CURRENT_DATE - INTERVAL '$i' MONTH)) AND card_no = '$card_no'");

while ($row = mysqli_fetch_array($res)) {

    $total+= $row['quantity'];


}
        }
    }

$index = $month-$i;
if($index <=0){
    $index =  $index + 12;
}

$monthly_quant[$index-1] = $total;

$total = 0;

$i++;
}



?>





<?php

$dataPoints = array( 
	array("y" => $monthly_quant[0], "label" => $months[0] ),
    array("y" => $monthly_quant[1], "label" => $months[1] ),
    array("y" => $monthly_quant[2], "label" => $months[2] ),
    array("y" => $monthly_quant[3], "label" => $months[3] ),
    array("y" => $monthly_quant[4], "label" => $months[4] ),
    array("y" => $monthly_quant[5], "label" => $months[5] ),
    array("y" => $monthly_quant[6], "label" => $months[6] ),
    array("y" => $monthly_quant[7], "label" => $months[7] ),
    array("y" => $monthly_quant[8], "label" => $months[8] ),
    array("y" => $monthly_quant[9], "label" => $months[9] ),
    array("y" => $monthly_quant[10], "label" => $months[10] ),
    array("y" => $monthly_quant[11], "label" => $months[11] ),
    array("y" => $monthly_quant[12], "label" => $months[12] ),

);


 
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Monthly Milk collected report of last 1 year"
	},
	axisY: {
		title: "Quantity(in Liters)"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## liters",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>

<div style="margin-left:19%;margin-top:5%;">
<p><br/><br/><u><h1> DAIRY DETAILS OF <?php echo $reg_det1['reg_name']  ?> </h1></u></p>
<p><br/><br/>
<b>Dairy Name: </b> <?php echo $reg_det1['reg_name']  ?> <br/><br/>
<b>Dairy Number: </b> <?php echo $reg_det1['reg_code']  ?><br/><br/>
<b>Dairy Manager: </b> <?php echo $mngr_name['emp_name']  ?><br/><br/>
<b>No. of Farmers registered: </b> <?php echo $no_farmer['counts']  ?><br/><br/>
</p>

</div>


<div id="chartContainer" style="margin-left:19%;margin-top:5%; height: 570px; width: 80%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<div style="margin-bottom:5%;margin-top:2%">
<p style="margin-left:19%;"> Above bargraph shows the graphical representation of total quantity of the Milk collected from 
   milk dairy  past one year.
    <br/>
    Farmers who offer milk gets registered at local Dairies in their region and the milk will be collected 
    from them on the daily basis and processed further. Each Dairy will contribute to the total amount of milk 
    collected. All This local Milk-Dairies are registerd under one Taluk region. The above graph depicts 
    how much quntity of milk collected in that Taluk region over past one year month wise. 
</p>
</div>


</body>
</html> 


<?php

include "tlksidebar.php";

?>
<?php include '../incl/footer.incl.php'; ?>