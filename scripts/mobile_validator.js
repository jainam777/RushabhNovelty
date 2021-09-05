function validateMobileForm(){
    
    let mobile = document.getElementById('user_phone').value;
  

    
    if(mobile.length != 10){
        document.getElementById('error_message').innerHTML = "Please enter a valid mobile number";
        return false;
    }
}