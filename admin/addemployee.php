<?php

include 'adminsidebar.php';
// include 'search.php';<?php


session_start();
$conn=mysqli_connect('localhost','root','','dairy_mgnt')or die ("Connection failure!!");

if(isset($_GET['roletype']))
{


$roletype = $_GET['roletype'];

if($roletype == "union-manager"){
    $regtype = "union";
}
elseif($roletype == "taluk-manager"){
    $regtype = "taluk";
}
else{
    $regtype = "dairy";
}
$opt = mysqli_query($conn,"SELECT * FROM region WHERE reg_type = '$regtype'");

}
else{
    $roletype = "";
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add new employee</title>
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
  <body>
  <a href="./search.php"> <button style="float:right;margin-right:8%;margin-top:6%;" type="button" class="back-btn">
<span class="btn-label"><i class="fa fa-arrow-alt-circle-left"></i> </span>Back</button> </a>
 <main>
 <div class="add-container">
        <form action="add.php" method="POST" id="form" class="addform">
            <h2>ADD NEW EMPLOYEE</h2>
            <div class="form-control">
                <label for="role">Employee Role</label>
                <select name="role" id="role" onchange="window.location.href = 'addemployee.php?roletype='+options[selectedIndex].value">

                <option value=<?php echo $roletype ?> > <?php echo $roletype ?> </option>

                        <option value="union-manager">Union Manager</option>
                         <option value="taluk-manager">Taluk Manager</option>
                        <option value="dairy-manager">Dairy Manager</option>
                </select>
                <small>Error Message</small>
            </div>
            <div class="form-control">
                <label for="empid">Employee id</label>
                <input type="text" name="empid" id="empid" placeholder="Enter Employee id">
                <small>Error Message</small>
            </div>
            <div class="form-control">
                <label for="name">Employee Name</label>
                <input type="text" name="name" id="name" placeholder="Enter Emplyoee name">
                <small>Error Message</small>
            </div>
     
            <div class="form-control">
                <label for="region">Employee Region</label>

                <select name='region' id="region"  >
                
                <?php
                
                if(mysqli_num_rows($opt)>0){ 
                    echo  "<option value=''> Choose Region</option>";
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
                <small>Error Message</small>
            </div>
            <div class="form-control">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter password">
                <small>Error Message</small>
            </div>
            <div class="form-control">
                <label for="password2">Confirm Password</label>
                <input type="password" id="password2" placeholder="Enter password again">
                <small>Error Message</small>
            </div>
            <button name="add-btn" class="button-5">ADD</button>
        </form>
    </div>
 </main>


 <script>
    const form = document.getElementById('form');
const empid = document.getElementById('empid');
const empname = document.getElementById('name');
const role = document.getElementById('role');
const region = document.getElementById('region');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');

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
    if(i==6){
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

   var val1 = checkRequired([empid,empname,role,region, password, password2]);
    var val2 = checkLength(empname,2,15);
    var val3 =checkLength(password,6,25);
   // checkEmail(email);
    var val4 = checkPasswordMatch(password, password2);


    if(val1==1 && val2==1 && val3 ==1 && val4==1){
        window.location.href="../add.php?id="+empid.value+"&role="+role.value+"&region="+region.value+"&password="+password.value+"&empname="+empname.value;

    }
}); 
 </script>


  </body>
</html>

<?php include '../incl/footer.incl.php'; ?>
