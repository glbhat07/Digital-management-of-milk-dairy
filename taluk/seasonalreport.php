<?php

include 'tlksidebar.php';

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
$monthly_fat = array(0,0,0,0,0,0,0,0,0,0,0,0);

?>

<?php

$i = 1;
$total = 0;
$k=0;
$avg_fat = 0;



while($i<13)
{
    $res1 = mysqli_query($conn,"SELECT * FROM region WHERE upper_reg = '$empreg'");
    if(mysqli_num_rows($res1)>0){ 
        while($row1 = mysqli_fetch_array($res1))
        { 
        $rgn_no = $row1['reg_code'];
$card = mysqli_query($conn,"SELECT card_no from farmer WHERE region = '$rgn_no'");
if(mysqli_num_rows($card)>0){ 
    while($card1 = mysqli_fetch_array($card))
    { 
    $card_no = $card1['card_no'];

$res = mysqli_query($conn,"SELECT SUM(quantity) as quantity,CAST(AVG(fat)AS DECIMAL(6,5))as fat FROM milk WHERE ((YEAR(dates) = YEAR(CURRENT_DATE - INTERVAL '$i' MONTH))) AND (MONTH(dates) = MONTH(CURRENT_DATE - INTERVAL '$i' MONTH)) AND card_no = '$card_no'");

while ($row = mysqli_fetch_array($res)) {

    $total+= $row['quantity'];
    $avg_fat+=$row['fat'];

    if($row['fat']>0){
    $k++;
    }

}
        }
    }
}}

if($k>0){
 

$avg_fat1 = $avg_fat/$k;

}
$index = $month-$i;
if($index <=0){
    $index =  $index + 12;
}

$monthly_quant[$index-1] = $total;
$monthly_fat[$index-1] = $avg_fat1;
$total = 0;
$avg_fat = 0;
$avg_fat1 = 0;
$k=0;
$i++;
}



$monsoon = $monthly_quant[5] + $monthly_quant[6] + $monthly_quant[7] + $monthly_quant[8];
$autumn = $monthly_quant[9] + $monthly_quant[10];
$winter = $monthly_quant[11]+$monthly_quant[0]+$monthly_quant[1];
$summer = $monthly_quant[2]+$monthly_quant[3]+$monthly_quant[4];

$monsoonfat = $monthly_fat[5] + $monthly_fat[6] + $monthly_fat[7] + $monthly_fat[8];
$autumnfat = $monthly_fat[9] + $monthly_fat[10];
$winterfat = $monthly_fat[11]+$monthly_fat[0]+$monthly_fat[1];
$summerfat = $monthly_fat[2]+$monthly_fat[3]+$monthly_fat[4];

$m=5;
$n=0;
while($m<9)
{
    if($monthly_fat[$m]>0){
        $n++;
    }
    $m++;
}
if($n>0){
    $monsoonfat = ($monthly_fat[5] + $monthly_fat[6] + $monthly_fat[7] + $monthly_fat[8])/$n;
}


$m=9;
$n=0;
while($m<11)
{
    if($monthly_fat[$m]>0){
        $n++;
    }
    $m++;
}
if($n>0){
    $autumnfat = ($monthly_fat[9] + $monthly_fat[10])/$n; 
}



$n=0;
if($monthly_fat[11]>0){
    $n++;
}
if($monthly_fat[0]>0){
    $n++;
}
if($monthly_fat[1]>0){
    $n++;
}
if($n>0){
$winterfat = ($monthly_fat[11]+$monthly_fat[0]+$monthly_fat[1])/$n;
}



$m=2;
$n=0;
while($m<5)
{
    if($monthly_fat[$m]>0){
        $n++;
    }
    $m++;
}
if($n>0){
$summerfat = ($monthly_fat[2]+$monthly_fat[3]+$monthly_fat[4])/$n;
}


$season_quant=array($monsoon,$autumn,$winter,$summer);
$season_fat=array($monsoonfat,$autumnfat,$winterfat,$summerfat);
$seasons = array("Monsoon","Autumn","Winter","Summer");


?>





<html>

    <head>

        <!--chart js -->

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    </head>

    <body>


    <script type="text/javascript">

      google.charts.load('current', {'packages':['Line']});

      google.charts.setOnLoadCallback(drawChart);

 

      function drawChart() {

        var data = google.visualization.arrayToDataTable([

           ['<----------------------------SEASONS--------------------------->','Quantity(in Ltrs)'],

         <?php

     
        $i=0;
        while($i<4){

            

           echo "['".$seasons[$i]."',".$season_quant[$i]."],";
            $i++;
          }

         ?>

        ]);

        var options = {

          chart: {

            title: 'Seasonal Variations',          

          },

          bars: 'vertical',

          vAxis: {format: 'decimal'},

          height: 450,

          colors: ['#d95f02']

        };

 

        var chart = new google.charts.Line(document.getElementById('line-chart-location'));

 

        chart.draw(data, google.charts.Line.convertOptions(options));

      }

    </script>



       <div style="margin-left:19%;margin-top:5%;width:80%">
       <h2>Seasonal Variations in Quantity of Milk collected </h2> 

        </div>

        <!--location where the line chart will be displayed-->

        <div style="margin-left:19%;margin-top:2%;height:450px;width:80%" id="line-chart-location">

        </div>
        <div style="margin-bottom:5%;margin-top:2%">
        <p style="margin-left:19%;"> Above graph shows the graphical representation of seasonal variations in quantity of the Milk collected 
        from all different milk dairies of Your Taluk region over the past one year.
    <br/>
    In India there are mainly four different seasons divided across the year according to climatic conditions.
    They are Monsoon/Rainy season from mid-June to mid-September where it has average temperature between 23°C-28°C.
    Second is Autumn/post monsoon from mid-september to November where it has average temperature between 22°C-27°C.
    Next comes Winter season from December to February where it has average temperature of 20°C-26°C.
    Fourth season of the year is Summer season from March to June  where it has average temperature of 24°C-34°C.
    <br/>
    This seasonal variation affect the quantity of Milk yeild directly or indirectly by affecting the food conditions of the animals.
    </p>
    </div>

    </body>

</html>




<html>

    <head>

        <!--chart js -->

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    </head>

    <body>


    <script type="text/javascript">

      google.charts.load('current', {'packages':['Line']});

      google.charts.setOnLoadCallback(drawChart);

 

      function drawChart() {

        var data = google.visualization.arrayToDataTable([

           ['<----------------------------SEASONS--------------------------->','Fat content'],

         <?php

     
        $i=0;
        while($i<4){

            

           echo "['".$seasons[$i]."',".$season_fat[$i]."],";
            $i++;
          }

         ?>

        ]);

        var options = {

          chart: {

            title: 'Seasonal Fat Variations',          

          },

          bars: 'vertical',

          vAxis: {format: 'decimal'},

          height: 450,

          colors: ['#d95f02']

        };

 

        var chart = new google.charts.Line(document.getElementById('line-chart-location1'));

 

        chart.draw(data, google.charts.Line.convertOptions(options));

      }

    </script>



       <div style="margin-left:19%;margin-top:4%;width:80%">
       <h2>Seasonal Variations in Fat Content of Milk collected </h2> 

        </div>

        <!--location where the line chart will be displayed-->

        <div style="margin-left:19%;margin-top:2%;height:450px;width:80%" id="line-chart-location1">

        </div>
        <div style="margin-bottom:5%;margin-top:2%">
        <p style="margin-left:19%;"> Above graph shows the graphical representation of seasonal variations in Fat content of the Milk collected 
        from all different milk dairies of Your Taluk region over the past one year.
    <br/>
    In India there are mainly four different seasons divided across the year according to climatic conditions.
    They are Monsoon/Rainy season from mid-June to mid-September where it has average temperature between 23°C-28°C.
    Second is Autumn/post monsoon from mid-september to November where it has average temperature between 22°C-27°C.
    Next comes Winter season from December to February where it has average temperature of 20°C-26°C.
    Fourth season of the year is Summer season from March to June  where it has average temperature of 24°C-34°C.
    <br/>
    This seasonal variation affect the Fat content of the milk directly or indirectly by affecting the food conditions of the animals.
    </p>
    </div>
    <?php



?>
    </body>

</html>


