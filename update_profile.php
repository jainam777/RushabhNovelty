<?php
include 'components/session.php';

    if(isset($_POST['action']) || isset($_POST['update_address'])){
       // try{
            $name = $_POST['fname'];
            $mobile = $_POST['user_phone'];
            $alt_mobile = $_POST['alt_phone'];
            $email = $_POST['email'];
            $house_no = $_POST['house_name'];
            $street = $_POST['street'];
            $landmark = $_POST['landmark'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $pincode = $_POST['pincode'];


            if(empty($name) && empty($mobile) && empty($email)){
                header("location: user_profile.php");
                exit();
            }
            else{

                $con = $pdo->open();
                $stmt = $con->prepare("UPDATE users set name=:name, mobile=:mobile, alt_mobile=:alt_mobile, email=:email, house_name=:house, street=:street, landmark=:landmark, city=:city, state=:state_name, pincode=:pincode where user_id=:user_id");
                $stmt->execute(['name'=>$name,'mobile'=>$mobile, 'alt_mobile'=>$alt_mobile,'email'=>$email,'house'=>$house_no,'street'=>$street,'landmark'=>$landmark,'city'=>$city,'state_name'=>$state,'pincode'=>$pincode,'user_id'=>$_SESSION['rushabh_novelty_user']]);
                
                if(isset($_POST['update_address'])){
                   
                    header("location:save_order.php");
                }
                else{
                    $_SESSION['rushabh_novelty_f_success'] = 'Profile Updated Successfull';
                    header("location: user_profile.php");
                }
            }

        // }catch(PDOException $e){
        //     echo "Something went wrong" .$e.getMessage();
        // }
    }
    else{
        header("location: user_profile.php");
    }

?>