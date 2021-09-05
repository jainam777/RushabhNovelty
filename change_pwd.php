<?php 
    include 'components/session.php';

    if(isset($_POST['action'])){

    if(isset($_POST['pwd']) && isset($_POST['re_pwd'])){
        if(empty($_POST['pwd']) || empty($_POST['re_pwd'])){
            $_SESSION['error'] = 'Invalid Password';
            header("location: create_new_password.php?selector=".$_POST['selector']."&validator=".$_POST['validator']);
        }
        else if($_POST['pwd'] != $_POST['re_pwd']){
            $_SESSION['error'] = 'Passwords do not match';
            header("location: create_new_password.php?selector=".$_POST['selector']."&validator=".$_POST['validator']);
        }
        else{
            $selector = $_POST['selector'];
            $validator = $_POST['validator'];
            $password = $_POST['pwd'];
            $re_pass = $_POST['re_pwd'];

            $currentDate = date("U");

            $con = $pdo->open();
            $stmt = $con->prepare("SELECT *,count(*) as total FROM pwd_reset WHERE selector =:selector AND expires >= :expires");
            $stmt->execute(['selector'=>$selector,'expires'=>$currentDate]);

            $rows = $stmt->fetch();
            $user_email = $rows['email'];
            if($rows['total']>0){
                $tokenBin = hex2bin($validator);
                $tokenCheck = password_verify($tokenBin,$rows['token']);

                if($tokenCheck === false){
                    echo "Please resend password reset request";
                }
                else if($tokenCheck === true){
                    $newPassHash = password_hash($password,PASSWORD_DEFAULT);
                    $stmtUpdate = $con->prepare("UPDATE users SET password=:pass where email=:email");
                    $stmtUpdate->execute(['pass'=>$newPassHash,'email'=>$user_email]);

                    $stmt = $con->prepare("DELETE from pwd_reset WHERE email =:email");
            
                    if($stmt->execute(['email'=>$user_email])){
                        $_SESSION['rushabh_novelty_login_success']="Password updated sucessfully";
                        header("location:login.php");

                    }
                }
            }else{
                $_SESSION['error']="Reset Password Link is expired";
                header("location: create_new_password.php?selector=".$_POST['selector']."&validator=".$_POST['validator']);
            }

        }
    }
    }
    else{
        $_SESSION['rushabh_novelty_login_error'] = 'Invalid Password';
        header("location: change_current_pwd.php");
    }
?>