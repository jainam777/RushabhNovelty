<?php
    include 'components/session.php';
    $msd="";
    if(isset($_POST['action'])){
        $email = $_POST['sub_email'];
        if(empty($email)){
            $msg="Please enter a valid email";
        }
        else{
            $con = $pdo->open();
            $stmt = $con->prepare("INSERT INTO subscriber (email) values (:email)");
            $stmt->execute(['email'=>$email]);
            $msg = 'Thanks for subscribing';
        }
    }
    else{
        $msg = 'Please enter a valid email';
    }

    echo $msg

?>