<?php

    include 'components/session.php';

    $output = '';
    if(isset($_POST['action'])){
        if(isset($_POST['product_id']) && isset($_SESSION['rushabh_novelty_user']) && isset($_POST['quantity'])){
            try{
                $con = $pdo->open();

                // $stmtStock = $con->prepare("SELECT stock FROM products WHERE product_id=:product_id");
                // $stmtStock->execute(['product_id'=>$_POST['product_id']]);
                // $stock=$stmtStock->fetch();

                // if($_POST['quantity']<=$stock['stock']){

                    $stmt = $con->prepare("UPDATE user_cart SET product_quantity=:quantity where product_id=:product_id AND user_id=:user_id");
                    $stmt->execute(['quantity'=>$_POST['quantity'],'product_id'=>$_POST['product_id'],'user_id'=>$_SESSION['rushabh_novelty_user']]);
                    include 'cart_table.php';
                // }
               // header("location:product_cart.php");

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