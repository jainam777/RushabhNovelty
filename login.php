<?php include 'components/session.php'; ?>
<?php
    if(!isset($_SESSION['rushabh_novelty_user'])){
?>
<!DOCTYPE html>
<html lang="en">
    
    <?php include 'components/header.php'; ?>
    <link rel="stylesheet" href="styles/login.css">
<body>
    <header>
        <?php include 'components/login-nav.php'; ?>
    </header>
    <div class="s12 m12 l12 center">
        <?php
            if(isset($_SESSION['rushabh_novelty_login_error'])){
                echo '
                    <div>
                        <p class="red-text">'.$_SESSION['rushabh_novelty_login_error'].'</p>
                    </div>
                ';
                unset($_SESSION['rushabh_novelty_login_error']);
            }
            if(isset($_SESSION['rushabh_novelty_login_success'])){
                echo '
                    <div >
                        <p class="green-text" style="font-size:1.3em;">'.$_SESSION['rushabh_novelty_login_success'].'</p>
                    </div>
                ';
                unset($_SESSION['rushabh_novelty_login_success']);
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
                    <h4 class="head-text"><b>Login</b></h4>
                </div>
                <br>
                <form action="verify_login.php" method="POST">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">email</i>
                        <input id="email" name="email" type="text" class="validate" required>
                        <label for="email">Email/Mobile No</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">lock</i>
                        <input id="password" name="pwd" type="password" class="validate" required>
                        <label for="password">Password</label>
                    </div>
                    <br>
                    <div class="col s12 center">
                        <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                        </button>
                        <br>
                        <p><a href="forgot_password.php" class="blue-text text-darken-4">Forgot password?</a></p>
                    </div>
                </form>
                
                <div class="col s12 center">
                <br>
                    <div class="divider"></div>
                    <p>Haven't yet signed up?</p>
                    <a href="signup.php" class="btn">Sign up</a>
                </div>
              </div>
            </div>
        </div>
    </div>
    <?php include 'components/footer.php'; ?>
    <?php include 'components/script.php'; ?>
    <?php include 'scripts/nav_script.php'; ?>
</body>
</html>

<?php
    }
    else{
        header("location: index.php");
    }
?>
