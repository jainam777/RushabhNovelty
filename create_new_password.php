<?php include 'components/session.php'; ?>
<!DOCTYPE html>
<html lang="en">

    <?php include 'components/header.php'; ?>
    <link rel="stylesheet" href="styles/login.css">
<body onload="loadingGif()">

<div id="loading"></div>
    <?php
    if(isset($_GET["selector"]) && isset($_GET["validator"])){
        $selector = $_GET["selector"];
        $validator = $_GET["validator"];

        if(empty($selector) || empty($validator)){
            echo "Could not validate your request";

        }else{
            if(ctype_xdigit($selector) !==false && ctype_xdigit($validator) !== false){
    ?>
            <header>
        <?php include 'components/login-nav.php'; ?>
    </header>
    <div class="s12 m12 l12 center">
        <?php
            if(isset($_SESSION['error'])){
                echo '
                    <div>
                        <p class="red-text">'.$_SESSION['error'].'</p>
                    </div>
                ';
                unset($_SESSION['error']);
            }
            if(isset($_SESSION['success'])){
                echo '
                    <div >
                        <p class="green-text" style="font-size:1.3em;">'.$_SESSION['success'].'</p>
                    </div>
                ';
                unset($_SESSION['success']);
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
                    <h4 class="head-text"><b>Reset Password</b></h4>
                </div>
                <br>
                <form action="change_pwd.php" method="POST" onsubmit="return CheckPassword()">
                    <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                    <input type="hidden" name="validator" value="<?php echo $validator; ?>">

                    <div class="input-field col s12">
                        <i class="material-icons prefix">lock</i>
                        <input id="password" name="pwd" type="password" class="validate" required>
                        <label for="password">Enter New Password</label>
                    </div>
                    <br>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">lock</i>
                        <input id="re_password" name="re_pwd" type="password" class="validate" required>
                        <label for="re_password">Re-Enter Password</label>
                    </div>
                    <br>
                    <div class="col s12 center">
                        <button class="btn waves-effect waves-light" onclick="CheckPassword()" type="submit" name="action">Submit
                        </button>
                    </div>
                </form>
              </div>
            </div>
        </div>
    </div>
    <?php include 'components/footer.php'; ?>
    <?php include 'components/script.php'; ?>
    <?php include 'scripts/nav_script.php'; ?>
    <script>
        var preloader = document.getElementById('loading');

        function loadingGif(){
            preloader.style.display = 'none';
        }

        function CheckPassword() { 
            var decimal=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,20}$/;
            var pass = document.getElementById('password').value;

            if(!(pass.match(decimal))) 
            { 
                document.getElementById('error_message').innerHTML = "Password must contain at least 1 lowercase letter, 1 uppercase letter, 1 number, 1 special character and length must be between 8-20 characters.";
                return false;
            }
        } 
    </script>
    <?php 
            }
        }
    }
    ?>

</body>
</html>