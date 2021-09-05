<?php
    include 'components/session.php';


    if(isset($_POST['action'])){
        try{
            $con = $pdo->open();
            if(isset($_POST['email']) && isset($_POST['pwd'])){
                
                $email = $_POST['email'];
                $pwd = $_POST['pwd'];
                
                if(empty($email) && empty($pwd)){
                    header("location: login.php");
                }
                else{
                    $stmt = $con->prepare("SELECT *,count(*) as user from users where email=:email OR mobile=:mobile OR alt_mobile=:alt_mobile");
                    $stmt->execute(['email'=>$email,'mobile'=>$email,'alt_mobile'=>$email]);
                    $row = $stmt->fetch();
                    
                    if($row['user']>0){
                        if(password_verify($pwd,$row['password'])){
                            if($row['user_type']=="admin"){
                                $_SESSION['rushabh_novelty_admin'] = $row['user_id'];
                                header("location: admin/home.php");
                            }
                            else{
                                if($row['user_status']=='Verified'){
                                    $_SESSION['rushabh_novelty_user'] = $row['user_id'];
                                    header("location: index.php");
                                }else{
                                    $_SESSION['rushabh_novelty_login_error'] = 'Your Account is temporary deactivated';
                                    header("location: login.php");
                                }
                            }
                            
                        }
                        else{
                            $_SESSION['rushabh_novelty_login_error'] = 'Invaid Login Details';
                            header("location: login.php");
                        }
                    }else{
                        $_SESSION['rushabh_novelty_login_error'] = 'Invaid Login Details';
                        header("location: login.php");
                    }
                }

            }else{
                header("location: login.php");
            }
        }
        catch(PDOException $e){
            echo "Something went wrong" .$e.getMessage();
        }
        $pdo->close();

    }
    else{
        header("location: login.php");
    }
?>