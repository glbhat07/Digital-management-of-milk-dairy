<?php
    include 'dairysidebar.php';


    session_start();
$conn=mysqli_connect('localhost','root','','dairy_mgnt')or die ("Connection failure!!");

$name="";
$lr=0;
$fat="";
$quantity="";
$total="";
$clr=0;
$snf=8.5;
if(isset($_GET['card_no']))
{


$cardno = $_GET['card_no'];

$name = mysqli_query($conn,"SELECT name FROM farmer WHERE card_no = '$cardno'");
$fetch=mysqli_fetch_array($name);
$name = $fetch['name'];

}

if(isset(($_GET['lr'])))
{
$lr = $_GET['lr'];
}
if(isset(($_GET['fat']))){
  $fat = $_GET['fat'];
}
if(isset(($_GET['quantity']))){
$quantity = $_GET['quantity'];
}



 if($fat!=NULL)
{
if($lr!=NULL)
{
if($quantity!=NULL)
{




$price = mysqli_query($conn,"SELECT * FROM price_chart WHERE fat = '$fat'");
$fetch=mysqli_fetch_array($price);
$price = $fetch['price'];

$total = $price * $quantity;

$clr = mysqli_query($conn,"SELECT * FROM quality WHERE fat = '$fat'");
$fetch=mysqli_fetch_array($clr);
$clr = $fetch['clr'];

$snf = ($lr + $fat +1.4)/4 ;

}
}
}






?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>data entry Form</title>
    <link rel="stylesheet" href="../css/dairy/formstyle.css">

    <style>

    .signup-form{
        margin-left:22%;
        margin-top:6%;
        height:640px;
    }
    .form-body{
        margin-top:20px;
    }
    </style>
  </head>
  <body>
    <form class="signup-form" action="" method="post">

      <!-- form header -->
      <div class="form-header">
        <h1>Enter the Data</h1>
      </div>

      <!-- form body -->
      <div class="form-body">

        <!-- card no and name -->
        <div class="horizontal-group">
          <div class="form-group left">
            <label for="Card No" class="label-title">Card Number *</label>     
            <input  type="text" id="cardno" class="form-input" placeholder="enter card number" value="<?php echo $cardno; ?>"  required onchange="selectName(this.value)" />
           
          </div>
          <div class="form-group right">
            <label for="Name" class="label-title">Farmer name</label>
            <input type="text" id="name" class="form-input"  value="<?php echo $name; ?>" placeholder="enter farmer name" />
          </div>
        </div>

   

        <!-- lr and fat -->
        <div class="horizontal-group">
          <div class="form-group left">
            <label for="lr value" class="label-title">LR Value *</label>
            <input type="number" id="lr_value" class="form-input" value="<?php echo $lr; ?>" placeholder="enter lr value" required="required" required onchange="lrReading(this.value)">
            
          </div>
          <div class="form-group right">
            <label for="fat" class="label-title">Fat *</label>
            <input type="number" class="form-input" id="fat" value="<?php echo $fat; ?>" placeholder="enter fat" required="required" required onchange="fatReading(this.value)">
          </div>
        </div>

         

        <!-- type and quantity -->
        <div class="horizontal-group">
          <div class="form-group left">
            <label class="label-title">Type:</label>
            <div class="input-group">
              <label for="buffalo"><input type="radio" name="type" value="buffalo" id="buffalo"> Buffalo-milk </label>
              <label style="margin-left:28px;" for="cow"><input type="radio" name="type" value="cow" id="cow"> Cow-milk </label>
            </div>
          </div>
          <div class="form-group right">
            <label for="quantity" class="label-title">Quantity*</label>
            <input  type="number" class="form-input" id="quantity" value="<?php echo $quantity; ?>" placeholder="enter Quantity(in ltrs)" required="required" required onchange="quantityVal(this.value)">
     
          </div>
        </div>


    <!-- Email -->
    <div class="form-group">

          <label style="color:red;" for="total" class="label-title">Total</label>
          <input type="" id="total" class="form-input" value="<?php echo $total; ?>" placeholder="" >
        
        </div>

        <?php 
        if(($snf < 8.5)or($lr < $clr))
        {
        echo '<small>
          <b>NOTE:</b> <br/>';
        }?>
          <span style="color:red">
        <?php if($snf < 8.5){
              echo "SNF VALUE IS LESS THAN 8.5";
          }?>
          <br/>
          <?php if($lr < $clr){
              echo "LR VALUE IS LESS THAN MINIMUM CLR";
          }?></span></small>

    
      <!-- form-footer -->
      <div class="form-footer">
        <span>* required</span>
       
        <button name="submit-btn" type="submit" class="btn">Enter</button>
      </div>

    </form>

    <?php
    if(isset($_POST['submit-btn'])){

      $type=$_POST['type'];
      if($type==""){
        echo '<script>alert("Please select milk-Type");</script>';
      }
  
      else{
      $insert = mysqli_query($conn,"INSERT INTO milk(card_no,quantity,dates,fat,lr,type,price) VALUES('$cardno','$quantity',current_timestamp(),'$fat','$lr','$type','$total')");
      
      if($insert){
        echo '<script>alert("Insert successful..!!");
        window.location.href="dataentry.php"</script>';
      }
    }}
    ?>

    <!-- <script  src="../js/dairy/selectname.js"></script> -->
    <script>
      var lrVal;
      var fatVal;
      var quantity;
      var cardno;
        function selectName(value){
          lrVal="";
          fatVal="";
          quantity="";
          cardno = value;
          window.location.href = 'dataentry.php?card_no='+cardno;
          

        }
        function lrReading(value){
          lrVal = value;
          window.location.href = 'dataentry.php?card_no=<?php echo $cardno; ?>&lr='+lrVal+'&fat=<?php echo $fat ?>&quantity=<?php echo $quantity?>';
        }
        function fatReading(value){
          fatVal=value;
          window.location.href = 'dataentry.php?card_no=<?php echo $cardno; ?>&lr=<?php echo $lr?>&fat='+fatVal+'&quantity=<?php echo $quantity?>';

        }
        function quantityVal(value){
          quantity=value;
          window.location.href = 'dataentry.php?card_no=<?php echo $cardno; ?>&lr=<?php echo $lr?>&fat=<?php echo $fat ?>&quantity='+quantity;
        }
      
      </script>

  </body>
</html>

<?php include '../incl/footer.incl.php'; ?>

