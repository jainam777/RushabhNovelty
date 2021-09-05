<?php
    include 'components/session.php';

    if(isset($_POST['action'])){
        if(!empty($_POST['email'])){
            
            $selector = bin2hex(random_bytes(8));
            $token = random_bytes(32);

            $url = "https://rushabhnovelty.com/create_new_password.php?selector=".$selector."&validator=".bin2hex($token);

            $expires = date("U")+ 1800;

            $user_email = $_POST['email'];

            try{
                $con = $pdo->open();

                $stmtCheck = $con->prepare("SELECT count(email) as total from users WHERE email =:email");
                $stmtCheck->execute(['email'=>$user_email]);
                $rows=$stmtCheck->fetch();

                if($rows['total']>0){

                    $stmt = $con->prepare("DELETE from pwd_reset WHERE email =:email");
                
                    if($stmt->execute(['email'=>$user_email])){
                        
                        $hashedToken = password_hash($token,PASSWORD_DEFAULT);

                        $stmt = $con->prepare("INSERT INTO pwd_reset (email,selector,token,expires) values(:email,:selector,:token,:expires)");
                        $stmt->execute(['email'=>$user_email,'selector'=>$selector,'token'=>$hashedToken,'expires'=>$expires]);

                        $to = $user_email;
                        $subject = "Reset the password for Rushabh Novelty";
                        $message = "<p>Click the link to reset your password. If you did not made this request, you can ignore this email</p>";
                        $message .= "<p>Click here: ".$url;
                        //$message .= "<a href='.$url.'>$url</a></p>";
                        
                        $headers = "From: Rushabh Novelty <contact@rushabhnovelty.com>\r\n";
                        $headers .= "Content-type: text/html\r\n";

                        mail($to,$subject,$message,$headers);

                        $_SESSION['error'] = 'An E-Mail has been sent to reset the password';
                        header("location: forgot_password.php");

                    }
                    else{
                        //echo "no";
                         exit();
                    }
                }
                else{
                    $_SESSION['error'] = 'Email not registered';
                        header("location: forgot_password.php");
                }

                
                $pdo->close();
            }
            catch(PDOException $e){
                echo "There is some problem" .$e;
            }

        }
        else{
            header("location:forgot_password.php");
        }
    }
    else{
        header("location:forgot_password.php");
    }
?>