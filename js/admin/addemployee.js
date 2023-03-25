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
        window.location.href="add.php?id="+empid.value+"&role="+role.value+"&region="+region.value+"&password="+password.value+"&empname="+empname.value;

    }
}); 