

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Password</title>
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
  <a> <button style="float:right;margin-right:8%;margin-top:6%;" onclick = "history.back()" type="button" class="back-btn">
<span class="btn-label"><i class="fa fa-arrow-alt-circle-left"></i> </span>Back</button> </a>
 <main>

 <div class="add-container">
        <form action="" method="POST" id="form" class="addform">
            <h2>Change Password</h2>
            <div class="form-control">
                <label for="password">Current Password</label>
                <input type="password" name="cur-password" id="cur-password" placeholder="Enter Current password">
                <small>Error Message</small>
            </div>
            <div class="form-control">
                <label for="password">New Password</label>
                <input type="password" name="newpassword" id="newpassword" placeholder="Enter New password">
                <small>Error Message</small>
            </div>
            <div class="form-control">
                <label for="password2">Confirm Password</label>
                <input type="password" id="password2" placeholder="Enter new password again">
                <small>Error Message</small>
            </div>
            <button name="add-btn" class="button-5">Change</button>
        </form>
    <div>
 </main>


 <script>
    const form = document.getElementById('form');
const password = document.getElementById('cur-password');
const password1 = document.getElementById('newpassword');
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
    if(i==3){
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

   var val1 = checkRequired([password, password1, password2]);
    
    var val2 =checkLength(password1,6,25);
   // checkEmail(email);
    var val3 = checkPasswordMatch(password1, password2);


    if(val1==1 && val2==1 && val3 ==1 ){
        window.location.href="change.php?curpass="+password.value+"&new-pass="+password1.value;

    }
}); 
 </script>


  </body>
</html>

