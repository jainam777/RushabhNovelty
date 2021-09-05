<?php
    include 'components/session.php';

    if(isset($_POST['action'])){
        $name = $_POST['customer_name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $message = $_POST['message'];
        $query = $_POST['query'];


        try{
            $con = $pdo->open();
            $date = new DateTime();
            $date->format('Y-m-d H:i:s');
            $stmt = $con->prepare("INSERT INTO customer_messages (customer_name, customer_email, customer_mobile, reason, cust_message, msg_date) values (:cust_name, :cust_email, :cust_mobile, :reason, :cust_message, NOW())");
            $stmt->execute(['cust_name'=>$name, 'cust_email'=>$email, 'cust_mobile'=>$mobile, 'reason'=>$query, 'cust_message'=>$message]);
            $_SESSION['rushabh_novelty_f_success'] = 'Your message was submited successfully';
            if(isset($_POST['contact_page'])){
                header('location: contact_us_form.php');
            }else{
            header('location: index.php#contact_us');}
        }
        catch(PDOException $e){
            echo "Something went wrong" .$e.getMessage();
        }

        $pdo->close();
    }
    else{
        $_SESSION['rushabh_novelty_f_failed'] = 'Please fill all the required fields properly!';
        header('location: index.php#contact_us');
    }
?>