<?php include 'components/session.php'; ?>
<?php
    if(!isset($_SESSION['rushabh_novelty_user'])){
?>
<!DOCTYPE html>

<html lang="en">
    
    <?php include 'components/header.php'; ?>
    <link rel="stylesheet" href="styles/login.css">
<body onload="loadingGif()">
    <div id="loading"></div>
    <header>
        <?php include 'components/login-nav.php'; ?>
    </header>
    <div class="s12 m12 l12 center">
            <?php
                if(isset($_SESSION['rushabh_novelty_signup_error'])){
                    echo '
                        <div>
                            <p class="red-text">'.$_SESSION['rushabh_novelty_signup_error'].'</p>
                        </div>
                    ';
                    unset($_SESSION['rushabh_novelty_signup_error']);
                }
                if(isset($_SESSION['rushabh_novelty_signup_success'])){
                    echo '
                        <div >
                            <p class="green-text" style="font-size:1.3em;">'.$_SESSION['rushabh_novelty_signup_success'].'</p>
                        </div>
                    ';
                    unset($_SESSION['rushabh_novelty_signup_success']);
                }
            ?>
    </div>
    <div class="s12 m12 l12 center">
            <p id="error_message" class="red-text" style="font-size:1.3em;"></p>
    </div>
    <div class="container">
        <div style="padding:20px;max-width:450px; min-width:350px;">
            <div class="card-panel center neu">
              <div class="row">
                <div class="col s12 m12 l12 center">
                    <h4 class="head-text"><b>Sign Up</b></h4>
                </div>
                <br>
                <!-- validateContactForm() -->
                <form action="register_user.php" method="POST" onsubmit="return CheckPassword()">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">person</i>
                        <input type="text" name="fname" id="fname" class="validate" required>
                        <label for="fname">Name</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">local_phone</i>
                        <input type="text" name="user_phone" id="user_phone" class="validate" required>
                        <label for="user_phone">Mobile Number</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">email</i>
                        <input id="email" name="email" type="email" class="validate" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">lock</i>
                        <input id="password" name="pwd" type="password" class="validate" required>
                        <label for="password">Password</label>
                        <p id="pwd_error_message" class="red-text"></p>
                    </div>
                    <br>
                    <div class="col s12 center">
                        <button class="btn waves-effect waves-light" onclick="CheckPassword()" type="submit" name="action">Submit
                        </button><br>
                        <!-- validateContactForm() -->
                        <!-- <a href="#" class="btn">Sign Up</a><br> -->
                        <p>By registering you agree to the <a href="terms_and_conditions.html" class="blue-text text-darken-4">Terms & Conditions</a> and <a href="privacy_policy.html" class="blue-text text-darken-4">Privacy Policy</a></p>
                    </div>
                </form>
                
                <div class="col s12 center">
                <br>
                    <div class="divider"></div>
                    <p>Already Registered!</p>
                    <a href="login.php" class="btn">Login</a>
                </div>
              </div>
            </div>
        </div>
    </div>
    <script src="scripts/signup.js"></script>
    <script src="scripts/check_password.js"></script>
    <?php include 'components/footer.php'; ?>
    <?php include 'components/script.php'; ?>
    <?php include 'scripts/nav_script.php'; ?>

    <script>
    var preloader = document.getElementById('loading');

    function loadingGif(){
        preloader.style.display = 'none';
    }

    function validateForm(){
    
    let mobile = document.getElementById('user_phone').value;
    
    if(isNaN(mobile) || mobile.length != 10){
        document.getElementById('rushabh_novelty_signup_error').innerHTML = "Please enter a valid mobile number";
        return false;
        }
    }

    </script>
</body>  
</html>

<?php
    }
    else{
        header("location: index.php");
    }
?>
