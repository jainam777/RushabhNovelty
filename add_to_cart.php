<?php
    include 'components/session.php';
    $count = 0;
    $output = array('error'=>false);
    if(isset($_POST['action'])){
        if($_POST['action']=='add'){
        if(isset($_POST['user_id']) && !empty($_POST['product_id'])){

            if($_POST['user_id'] != 0){
                // $con = $pdo->open();
                // $stmtStock = $con->prepare("SELECT stock FROM products WHERE product_id=:product_id");
                // $stmtStock->execute(['product_id'=>$_POST['product_id']]);
                // $stock=$stmtStock->fetch();

                if(isset($_POST['pro_quantity'])){
                    try{
                        $con = $pdo->open();
                        $stmt = $con->prepare("SELECT COUNT(product_quantity) as total FROM user_cart WHERE user_id =:user_id AND product_id =:product_id");
                        $stmt->execute(['user_id'=>$_POST['user_id'],'product_id'=>$_POST['product_id']]);
                        $total = $stmt->fetch();
                    }
                    catch(PDOException $e){
                        echo "There is some problem in the connection" .$e;
                    }
                    if($total['total']<1){
                        try{
                            $con = $pdo->open();

                            $proQuantity = (int)$_POST['pro_quantity'];
                            // if($_POST['pro_quantity']<=$stock['stock']){
                            if($proQuantity>0 && is_int($proQuantity) && $proQuantity<=2500){
                                $stmt = $con->prepare("INSERT into user_cart (user_id,product_id,product_quantity,cart_date) values (:user_id,:product_id,:quantity,NOW())");
                                $stmt->execute(['user_id'=>$_POST['user_id'],'product_id'=>$_POST['product_id'],'quantity'=>$_POST['pro_quantity']]);
                                
                                $output['message'] = 'Item added to cart';
                                $output['btn_message'] = 'Added to cart';

                                $stmt1 = $con->prepare("SELECT product_quantity from user_cart where user_id=:id");
                                $stmt1->execute(['id'=>$_SESSION['rushabh_novelty_user']]);
                                $count=0;
                                foreach($stmt1 as $rows){
                                    $count = $count + $rows['product_quantity'];

                                }
                            }else{
                                $output['error'] = true;
                                $output['message'] = 'Please enter a valid quantity';
                            }
                            // }else{
                            //     $output['error'] = true;
                            //     $output['message'] = 'Only '.$stock['stock'].' products available in stock';
                            // }
                        
                        }
                        catch(PDOException $e){
                            echo "There is some problem in the connection" .$e;
                        }
                        
                    }
                    else{
                        $output['error'] = true;
                        $output['message'] = 'Product already in cart';
                        
                    }
                    
                }
                else{
                    try{
                        $con = $pdo->open();
                        $stmt = $con->prepare("SELECT COUNT(*) as total FROM user_cart WHERE user_id =:user_id AND product_id =:product_id");
                        $stmt->execute(['user_id'=>$_POST['user_id'],'product_id'=>$_POST['product_id']]);
                        $total = $stmt->fetch();
                    }
                    catch(PDOException $e){
                        echo "There is some problem in the connection" .$e;
                    }
                    if($total['total']<1){
                        try{

                            // if(1<=$stock['stock']){
                                $con = $pdo->open();
                                $stmt = $con->prepare("INSERT into user_cart (user_id,product_id,cart_date) values (:user_id,:product_id,NOW())");
                                $stmt->execute(['user_id'=>$_POST['user_id'],'product_id'=>$_POST['product_id']]);

                                $output['message'] = 'Item added to cart';
                                $output['btn_message'] = 'Added to cart';

                                $stmt1 = $con->prepare("SELECT product_quantity from user_cart where user_id=:id");
                                $stmt1->execute(['id'=>$_SESSION['rushabh_novelty_user']]);
                                $count=0;
                                foreach($stmt1 as $rows){
                                    $count = $count + $rows['product_quantity'];
                                }
                            // }else{
                            //     $output['error'] = true;
                            //     $output['btn_message'] = 'Out of stock';
                            //     $output['message'] = 'Out of stock';
                            // }
                        // echo $count;
                        }
                        catch(PDOException $e){
                            echo "There is some problem in the connection" .$e;
                        }
                    }else{
                        $output['error'] = true;
                        $output['message'] = 'Product already in cart';
                        $output['btn_message'] = 'Already in cart';
                    }
                }
            }
            else{
                $output['error'] = true;
                        $output['message'] = 'Login to add item to your cart';
                        $output['btn_message'] = 'Login for cart';
            }
        }else{
            $output['error'] = true;
            $output['message'] = 'Login to add item to cart';
        }
    }


        echo json_encode($output);
       
    }
    
?>