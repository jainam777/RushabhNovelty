<?php

    include 'components/session.php';

    $output = '';
    if(isset($_POST['action'])){
        if(isset($_POST['product_id']) && isset($_SESSION['rushabh_novelty_user'])){
            try{
                $con = $pdo->open();
                $stmt = $con->prepare("DELETE FROM user_cart where product_id=:product_id AND user_id=:user_id");
                $stmt->execute(['product_id'=>$_POST['product_id'],'user_id'=>$_SESSION['rushabh_novelty_user']]);

                include 'cart_table.php';

            }
            catch(PDOException $e){
                echo "There is some problem in the connection" .$e;
            }
        }
        else{
            $output = "cancel";
        }
    }
?>