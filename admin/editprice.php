<?php
    session_start();

    $price = $_GET['price'];
    $fat = $_GET['fat'];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit clr</title>
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
  <body style="margin-top:6.5%">
  <a href="./pricechart.php"> <button style="float:right;margin-right:8%;" type="button" class="back-btn">
<span class="btn-label"><i class="fa fa-arrow-left"></i> </span>Back</button> </a>
 <main>
 <div class="add-container">
        <form action="" method="POST" id="form" class="addform">
            <h2>EDIT CLR DETAILS</h2>
            <div class="form-control">
                <label for="card_no">Fat</label>
                <input type="" name="fat" value="<?php echo $fat; ?>" id="fat" placeholder="Enter Fat content">
                <small>Error Message</small>
            </div>
            <div class="form-control">
                <label for="name">Price/Ltr</label>
                <input type="" name="clr" value="<?php echo $price;?>" id="price" placeholder="Enter Minimum CLR">
                <small>Error Message</small>
            </div>
            
            <button name="add-btn" class="button-5">EDIT</button>
        </form>
    </div>
 </main>



 <script>
const form = document.getElementById('form');
const fat = document.getElementById('fat');
const price = document.getElementById('price');


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
    if(i==2){
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

   
   var val1 = checkRequired([fat,price]);




    if(val1==1){
        
        window.location.href="updatepriceapi.php?fat="+fat.value+"&price="+price.value;

    }
}); 
 </script>


  </body>
</html>

<?php
include 'dairysidebar.php';
?>
<?php include '../incl/footer.incl.php'; ?>