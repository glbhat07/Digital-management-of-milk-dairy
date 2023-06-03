<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add new farmer</title>
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
  <a href="./farmer.php"> <button style="float:right;margin-right:8%;margin-top:6%;" type="button" class="back-btn">
<span class="btn-label"><i class="fa fa-arrow-left"></i> </span>Back</button> </a>
 <main>
 <div class="add-container">
        <form action="" method="POST" id="form" class="addform">
            <h2>ADD NEW FARMER</h2>
            <div class="form-control">
                <label for="card_no">Card_no</label>
                <input type="text" name="card_no" id="card_no" placeholder="Enter Farmer card number">
                <small>Error Message</small>
            </div>
            <div class="form-control">
                <label for="name">Farmer Name</label>
                <input type="text" name="name" id="name" placeholder="Enter Farmer name">
                <small>Error Message</small>
            </div>
            
            <div class="form-control">
                <label for="address">Farmer Address</label>
                <input type="text" name="adress" id="adress" placeholder="Enter farmer address">
                
                <small>Error Message</small>
            </div>
            <div class="form-control">
                <label for="acc_no">Farmer Account_no</label>
                <input type="text" name="acc_no" id="acc_no" placeholder="Enter farmer account number">
                <small>Error Message</small>
            </div>
            <div class="form-control">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" placeholder="Enter phone number">
                <small>Error Message</small>
            </div>
            <div class="form-control">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" placeholder="Enter Email">
                <small>Error Message</small>
            </div>
            <button name="add-btn" class="button-5">ADD</button>
        </form>
    </div>
 </main>

 <?php 
 if(isset($_POST['add-btn'])){
    $_SESSION['adress'] = $_POST['adress'];
}
     ?>

 <script>
const form = document.getElementById('form');
const card_no = document.getElementById('card_no');
const name = document.getElementById('name');
const acc_no = document.getElementById('acc_no');
const adress = document.getElementById('adress');
const phone = document.getElementById('phone');
const email = document.getElementById('email');
// const password2 = document.getElementById('password2');

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
    if(i==5){
        return 1;
    }
    else{
        return 0;
    }
}

//check email is valid
function checkEmail(input) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(re.test(input.value.trim())) {
        showSucces(input)
        return 1;
    }else {
        showError(input,'Email is not invalid');
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

    var val4 = 1
   var val1 = checkRequired([card_no,name,adress,phone,acc_no]);
    var val2 = checkLength(empname,2,15);
    var val3 =checkLength(password,6,25);
    if(email.trim()!="")
    {
        val4 = checkEmail(email);
    }
   
   // var val4 = checkPasswordMatch(password, password2);


    if(val1==1 && val2==1 && val3 ==1 && val4==1){
        
        window.location.href="addapi.php?card_no="+card_no.value+"&name="+name.value+"&phone="+phone.value+"&email="+email.value.trim()+"&acc_no="+acc_no.value;

    }
}); 
 </script>


  </body>
</html>

<?php
include 'dairysidebar.php';
?>
<?php include '../incl/footer.incl.php'; ?>