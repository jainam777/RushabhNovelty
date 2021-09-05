<?php
    include 'components/session.php';

    if(isset($_POST['action'])){
        try{
            $con = $pdo->open();
            $name = $_POST['fname'];
            $mobile = $_POST['user_phone'];
            $email = $_POST['email'];
            $pwd = $_POST['pwd'];
    
            if(empty($name) || empty($mobile) || empty($email) || empty($pwd)){
                header("location: signup.php");
                exit();
            }
            else{
                $stmt = $con->prepare("SELECT count(*) as email from users where email=:email");
                $stmt->execute(['email'=>$email]);
                $row = $stmt->fetch();

                $stmtMobile = $con->prepare("SELECT count(*) as mobile from users where mobile=:mobile");
                $stmtMobile->execute(['mobile'=>$mobile]);
                $rowMobile = $stmtMobile->fetch();

                if($row['email']>0){
                    $_SESSION['rushabh_novelty_signup_error'] = "Email is already registered";
                    header("location: signup.php");
                }
                else if($rowMobile['mobile']>0){
                    $_SESSION['rushabh_novelty_signup_error'] = "Mobile Number is already registered";
                    header("location: signup.php");
                }
                else{
                    $password = password_hash($pwd, PASSWORD_DEFAULT);
                    $stmt = $con->prepare("INSERT INTO users(email, password, name, mobile, account_created_on) values (:email, :pwd, :name, :mobile, NOW())");
                    $stmt->execute(['email'=>$email, 'pwd'=>$password, 'name'=>$name, 'mobile'=>$mobile]);
                    
                    $_SESSION['rushabh_novelty_login_success'] = 'Registered Successfully';

                    header("location: login.php");
                }
            }
        }
        catch(PDOException $e){
            echo "Something went wrong" .$e;
        }
        $pdo->close();
    }
    else{
        header("location: signup.php");
    }
?>