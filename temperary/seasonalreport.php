<?php
 
$dataPoints = array(
	array("y" => $monsoon, "label" => "Monsoon"),
	array("y" => $autumn, "label" => "Autumn"),
	array("y" => $winter, "label" => "Winter"),
	array("y" => $summer, "label" => "Summer")
);
 
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Seasonal Variation in Milk Quantity"
	},
	axisY: {
		title: "Quantity(in Ltrs)"
	},
    axisX: {
		title: "<---------------------------------Seasons---------------------------------->"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="margin-left:19%;margin-top:5%; height: 570px; width: 80%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<div style="margin-bottom:5%;margin-top:2%">
<p style="margin-left:19%;"> Above bargraph shows the graphical representation of total quantity of the Milk collected from all different 
   milk dairies of Your Taluk region over the past one year.
    <br/>
    Farmers who offer milk gets registered at local Dairies in their region and the milk will be collected 
    from them on the daily basis and processed further. Each Dairy will contribute to the total amount of milk 
    collected. All This local Milk-Dairies are registerd under one Taluk region. The above graph depicts 
    how much quntity of milk collected in that Taluk region over past one year month wise. 
</p>
</div>

</body>
</html> 