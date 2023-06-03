<?php

 include 'adminsidebar.php';
// include 'search.php';<?php

session_start();
$conn=mysqli_connect('localhost','root','','dairy_mgnt')or die ("Connection failure!!");

if(isset($_GET['regtype']))
{

$regtype = $_GET['regtype'];

if($regtype == "dairy"){
    $regupper = "taluk";
}
elseif($regtype == "taluk"){
    $regupper = "union";
}
else{
    $regupper = "admin";
}
$opt = mysqli_query($conn,"SELECT * FROM region WHERE reg_type = '$regupper'");

}
else{
    $regtype = "";
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add new Region</title>
    <link rel="stylesheet" href="../css/admin/addemployee.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <style>
  .back-btn{
    background-clip: padding-box;
    background-color: #00fa9a;
    border: 1px solid transparent;
    border-radius: .30rem;
    box-shadow: rgba(0, 0, 0, 0.02) 0 1px 3px 0;
    box-sizing: border-box;
    /* color: #fff; */
    cursor: pointer;
    /* display: inline-flex; */
    font-family: system-ui,-apple-system,system-ui,"Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 16px;
    font-weight: 600;
    padding:10px;

  }
</style>
    
    

  </head>
  <body onload=disableselect();>
  <a href="./union.php"> <button style="float:right;margin-right:8%;margin-top:6%;" type="button" class="back-btn">
<span class="btn-label"><i class="fa fa-arrow-alt-circle-left"></i> </span>Back</button> </a>
 <main>
 <div class="add-container">
        <form action="add.php" method="POST" id="form" class="addform">
            <h2>ADD NEW REGION</h2>
            <div class="form-control">
                <label for="regiontype">Region Type</label>
                 <!-- <select name="regiontype" id="regiontype" onchange="reload()"> -->
                 <select name = "regiontype" id="regiontype" onchange="window.location.href = 'newunion.php?regtype='+options[selectedIndex].value">

            
                        <option value=<?php echo $regtype ?> > <?php echo $regtype ?> </option>
                        <option value="union">Union</option>
                        <option value="taluk">Taluk</option>
                        <option value="dairy">Dairy</option>
                </select>
                <small>Error Message</small>
            </div>
            <div class="form-control">
                <label for="regioncode">Region Code</label>
                <input type="number" name="regioncode" id="regioncode" placeholder="Enter Region Code">
                <small>Error Message</small>
            </div>
            <div class="form-control">
                <label for="regionname">Region Name</label>
                <input type="text" name="regionname" id="regionname" placeholder="Enter Region name">
                <small>Error Message</small>
            </div>
            <div class="form-control">
                <label for="upperregion">Upper Region Code</label>


                <select name='upperregion' id="upperregion"  >
                
                    <?php
                    
                    if(mysqli_num_rows($opt)>0){ 
                        while($fetch=mysqli_fetch_assoc($opt))
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

                <!-- <input type="number" name="upperregion" id="upperregion" placeholder="Enter Upper Region Code"> -->
                <small>Error Message</small>
                
            </div>
            <button type="submit" name="union-btn" class="button-5">ADD</button>
        </form>
    </div>
 </main>


 <script>

// function reload()
// {
// // var val=form.cat.options[form.cat.options.selectedIndex].value;
// var val=document.getElementById('regiontype').value;
// window.location.href = 'newunion.php?regtype=' + val ;
// }
function disableselect()
{
const upper = document.getElementById('upperregion');
<?Php
if(isset($regtype) and strlen($regtype) > 0){
echo "upper.disabled=false;";}
else{echo "upper.disabled = true;";}
?>
}


    const form = document.getElementById('form');
const regcode = document.getElementById('regioncode');
const regname = document.getElementById('regionname');
const regtype = document.getElementById('regiontype');
const upperreg = document.getElementById('upperregion');

//Show input error messages
function showError(input, message) {
    const formControl = input.parentElement;
    formControl.className = 'form-control error';
    const small = formControl.querySelector('small');
    small.innerText = message;
}

//show success colour
function showSucces(input) {
    const formControl = input.parentElement;
    formControl.className = 'form-control success';
}


//checkRequired fields
function checkRequired(inputArr) {
    var i = 0;
    inputArr.forEach(function(input){
        if(input.value.trim() === ''){
            showError(input,`${getFieldName(input)} is required`)
            return 0;
        }else {
            showSucces(input);
            i++;
            
        }
    
    });
    if(i==4){
        return 1;
    }
    else{
        return 0;
    }
}

//check input Length
function checkLength(input, min ,max) {
    if(input.value.length < min) {
        showError(input, `${getFieldName(input)} must be at least ${min} characters`);
        return 0;
    }else if(input.value.length > max) {
        showError(input, `${getFieldName(input)} must be les than ${max} characters`);
        return 0;
    }else {
        showSucces(input);
        return 1
    }
}

//get FieldName
function getFieldName(input) {
    return input.id.charAt(0).toUpperCase() + input.id.slice(1);
}

// check passwords match
function checkPasswordMatch(input1, input2) {
    if(input1.value !== input2.value) {
        showError(input2, 'Passwords do not match');
        return 0;
    }
    else{
        return 1;
    }
}

//Event Listeners
form.addEventListener('submit',function(e) {
    e.preventDefault();

   var val1 = checkRequired([regcode,regname,regtype,upperreg]);
    var val2 = checkLength(regname,2,15);
    var val3 =checkLength(upperreg,2,15);
    var val4 = checkLength(regcode,2,15);


    if(val1==1 && val2==1 && val3 ==1 && val4==1){
        window.location.href="addunion.php?regcode="+regcode.value+"&regname="+regname.value+"&regtype="+regtype.value+"&upperreg="+upperreg.value;

    }
}); 
 </script>


  </body>
</html>
<?php include '../incl/footer.incl.php'; ?>

