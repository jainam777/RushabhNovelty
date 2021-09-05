<?php 
    include 'components/session.php';

    $output = array('error'=>false);

    if(isset($_POST['action']) && isset($_POST['product_id']) && isset($_SESSION['rushabh_novelty_user']) && isset($_POST['rating']) && isset($_POST['review'])){
        if(!empty($_POST['product_id']) && !empty($_SESSION['rushabh_novelty_user']) && !empty($_POST['rating'])){
            if($_POST['rating']!=0){
                try{
                    $con = $pdo->open();
                    $stmtCheck = $con->prepare("SELECT count(*) as total from product_ratings WHERE user_id=:user_id and product_id=:product_id");
                    $stmtCheck->execute(['product_id'=>$_POST['product_id'],'user_id'=>$_SESSION['rushabh_novelty_user']]);
                    $total=$stmtCheck->fetch();
                    if($total['total']==0){
                        $stmt = $con->prepare("INSERT into product_ratings (product_id,user_id,rating,review,date_time) values(:product_id,:user_id,:rating,:review,NOW())");
                        $stmt->execute(['product_id'=>$_POST['product_id'],'user_id'=>$_SESSION['rushabh_novelty_user'],'rating'=>$_POST['rating'],'review'=>$_POST['review']]);
                        

                        $stmtOne = $con->prepare("SELECT count(*) rating from product_ratings WHERE product_id=:product_id AND rating=1");
                        $stmtOne->execute(['product_id'=>$_POST['product_id']]);
                        $fetchOne = $stmtOne->fetch();
                        $stmtTwo = $con->prepare("SELECT count(*) rating from product_ratings WHERE product_id=:product_id AND rating=2");
                        $stmtTwo->execute(['product_id'=>$_POST['product_id']]);
                        $fetchTwo = $stmtTwo->fetch();
                        $stmtThree = $con->prepare("SELECT  count(*) rating from product_ratings WHERE product_id=:product_id AND rating=3");
                        $stmtThree->execute(['product_id'=>$_POST['product_id']]);
                        $fetchThree = $stmtThree->fetch();
                        $stmtFour = $con->prepare("SELECT count(*) rating from product_ratings WHERE product_id=:product_id AND rating=4");
                        $stmtFour->execute(['product_id'=>$_POST['product_id']]);
                        $fetchFour = $stmtFour->fetch();
                        $stmtFive = $con->prepare("SELECT count(*) rating from product_ratings WHERE product_id=:product_id AND rating=5");
                        $stmtFive->execute(['product_id'=>$_POST['product_id']]);
                        $fetchFive = $stmtFive->fetch();

                        $array = array("5"=>$fetchFive['rating'],"4"=>$fetchFour['rating'],"3"=>$fetchThree['rating'],"2"=>$fetchTwo['rating'],"1"=>$fetchOne['rating']);
                        $finalRating = array_search(max($array),$array);

                        $stmtUpdate = $con->prepare("UPDATE products SET rating=:rating WHERE product_id=:product_id");
                        $stmtUpdate->execute(['rating'=>$finalRating,'product_id'=>$_POST['product_id']]);

                        $output['error'] = false;
                        $output['message'] = 'Thanks for rating our product';
                    }
                    else{
                        $stmt = $con->prepare("UPDATE product_ratings SET rating=:rating,review=:review,date_time=NOW() WHERE product_id=:product_id and user_id=:user_id");
                        $stmt->execute(['product_id'=>$_POST['product_id'],'user_id'=>$_SESSION['rushabh_novelty_user'],'rating'=>$_POST['rating'],'review'=>$_POST['review']]);
                        $output['error'] = false;
                        $output['message'] = 'Thanks for rating our product';
                    }
                }
                catch(PDOException $e){
                    echo "Something went wrong".$e;
                }
            }else{
                $output['error'] = true;
                $output['message'] = 'Please rate the product';
            }
        }
        else{
            $output['error'] = true;
            $output['message'] = 'Please rate the product';
            //header("location: index.php");
        }
        echo json_encode($output);
    }
    else{
        header("location: index.php");
    }

?>