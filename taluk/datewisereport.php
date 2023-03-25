<?php
include '../incl/header.incl.php';
include 'tlksidebar.php';
// include 'search.php';<?php


session_start();
$conn=mysqli_connect('localhost','root','','mgnt_dairy')or die ("Connection failure!!");

$empid = $_SESSION['emp_id'];

$opt = mysqli_query($conn,"SELECT emp_region FROM employ WHERE emp_id = '$empid'");
if(mysqli_num_rows($opt)>0){ 
    $fetch=mysqli_fetch_array($opt);
    $empreg=$fetch['emp_region'];
}

$res = mysqli_query($conn,"SELECT * FROM region WHERE upper_reg = '$empreg'");

?>

<html>
    <head>
        <title> </title>
        <style>
            strong{
                color:red;
            }
            .form-inline{
                margin-top:30px;
            }
         
        </style>
</head>

<body>

<div style="margin-left:19.5%;margin-top:5%;">
<h1>Milk Collected Reports</h1>
<form class="form-inline" method="post" action="">
    <div class="control-group">
        <label class="control-label" for="from"> From:</label >
        <div id="datetimepicker1" class="controls input-append date" style="margin-left: 5px">
            <input class="input-xlarge" type="text" data-format="yyyy-mm-dd"  placeholder="yyyy-mm-dd" name='from' value=''/> 
            <span class="add-on">
                <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                </i>
            </span>
        </div>

        <label style="margin-left: 10px" class="control-label" for="to"> To:</label >
        <div id="datetimepicker2" class="controls input-append date" style="margin-left: 5px">
            <input class="input-xlarge" type="text" data-format="yyyy-mm-dd"  placeholder="yyyy-mm-dd" name='to' value=''/> 
            <span class="add-on">
                <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                </i>
            </span>
        </div>

        
        <select name='region' id="region"  >
                
                <?php
                
                if(mysqli_num_rows($opt)>0){ 
                    echo  "<option value=''> Choose Region</option>";
                    while($fetch=mysqli_fetch_assoc($res))
                    {
                        $value = $fetch['reg_code'];
                        $value1 = $fetch['reg_name'];

                        echo  "<option value='$value'> $value ($value1) </option>";
         
                    }
                }
                else{
    
                    echo  "<option value=''> </option>";

                }
            ?>

            </select>


        <input type="submit" class="btn btn-info" value="Get Records">
    </div>
</form>
<div id="printable">
    <h5 id="farmer_details">
     <?php
        if (isset($_REQUEST['region']) && $_REQUEST['region'] != '') {
            $rgn_no = $_REQUEST['region'];
            $start = $_REQUEST['from'];
            $end = $_REQUEST['to'];



            //$sql = "SELECT * FROM `delivery` WHERE `r_dt` >= \'2013-05-01 00:00:00\' or `r_dt` <= \'2013-05-30 00:00:00\' ";
           
            $result = mysqli_query($conn,"SELECT * FROM milk WHERE(dates BETWEEN '$start' AND '$end') AND (card_no IN(SELECT card_no from farmer WHERE region = '$rgn_no') )");

            $result1 = mysqli_query($conn,"SELECT SUM(quantity) as quantity, dates FROM milk WHERE(dates BETWEEN '$start' AND '$end') AND (card_no IN(SELECT card_no from farmer WHERE region = '$rgn_no') ) GROUP BY(dates)");

            // echo "SELECT * FROM `delivery` WHERE r_f_no=$f_no $start $end";

          
            echo "Milk Collected for '$value1' from ".$_REQUEST['from'] ." to ". $_REQUEST['to'];
        }
        ?></h5>
    <table style="margin-top:20px;" class="table table-hover table-striped table-condensed table-bordered">
        <thead class="" >
        <th>#</th>
        <th>DATE</th>
        <th>QUANTITY(in Ltrs)</th>
        </thead>
        <tbody>
            <?php
            if (isset($_REQUEST['region']) && $_REQUEST['region'] != '') {


                $i = 0;
                $total = 0;
                while ($row = mysqli_fetch_array($result1)) {
                    $i+=1;
                    $total+= $row['quantity'];
                    echo "<tr>";
                    echo '<td>' . $i . '</td>';
                    //echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
                    echo "<td valign='top'>" . $row['dates'] . "</td>";
                    echo "<td valign='top'>" . $row['quantity'] . "</td>";
                    echo "</tr>";
                }
                echo "<tr><td><strong>TOTAL</strong></td><td>--</td><td><strong>$total</strong></td><td>--</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
       <!--<label for="authority">Authorized By:</label><input type="text" id="authority" name="authority" >-->
<a id="print" class="btn btn-success" >print </a>
        </div>
        </body>

        </html>
        
<script type="text/javascript">
    $(document).ready(function() {
        $(function() {
            $('#datetimepicker1,#datetimepicker2').datetimepicker({
//                language: 'pt-BR;               
                pickTime: false,
                format: 'yyyy-MM-dd'
            });
        });

        $('#print').on('click', function() {
            printDiv('printable');

        });

    });
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>

