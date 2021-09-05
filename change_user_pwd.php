<?php 
    include 'components/session.php';

    if(isset($_POST['change'])){
        if(isset($_POST['pwd']) && isset($_POST['re_pwd']) && isset($_POST['current_pwd'])){
            if(empty($_POST['pwd']) && empty($_POST['re_pwd']) && empty($_POST['current_pwd'])){
                $_SESSION['error'] = 'Invalid Password';
                header("location: change_current_pwd.php");
            }
            else{
                $pwd = $_POST['current_pwd'];
                $con = $pdo->open();
                $stmt = $con->prepare("SELECT password from users where user_id=:user_id");
                $stmt->execute(['user_id'=>$_SESSION['rushabh_novelty_user']]);
                $row = $stmt->fetch();

                if(password_verify($pwd,$row['password'])){
                    if($_POST['pwd'] != $_POST['re_pwd']){
                        $_SESSION['error'] = 'Passwords do not match';
                        header("location: change_current_pwd.php");
                    }
                    else{
                        $password = $_POST['pwd'];
                        $newPassHash = password_hash($password,PASSWORD_DEFAULT);
                        $stmtUpdate = $con->prepare("UPDATE users SET password=:pass where user_id=:user_id");
                        $stmtUpdate->execute(['pass'=>$newPassHash,'user_id'=>$_SESSION['rushabh_novelty_user']]);
                        $_SESSION['success'] = 'Password changed successfully';
                        header("location: change_current_pwd.php");
                    }
                }
                else{
                    $_SESSION['error'] = 'Invaid Current Password';
                    header("location: change_current_pwd.php");
                }
            }
        }
    }
    else{
        echo "no";
    }
?>