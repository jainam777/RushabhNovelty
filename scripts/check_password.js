function CheckPassword() { 
    var decimal=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,20}$/;
    var pass = document.getElementById('password').value;
    let mobile = document.getElementById('user_phone').value;

    if(isNaN(mobile) || mobile.length != 10){
        document.getElementById('error_message').innerHTML = "Please enter a valid mobile number";
        return false;
    }else if(!(pass.match(decimal))) 
    { 
        document.getElementById('pwd_error_message').innerHTML = "Password must contain at least 1 lowercase letter, 1 uppercase letter, 1 number, 1 special character and length must be between 8-20 characters.";
        return false;
    }
} 