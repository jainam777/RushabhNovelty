<?php
    include 'components/session.php';
    $output = array('pro_id'=>0,'category_name'=>'no');
    if(isset($_POST['action'])){
        if(isset($_POST['category']) && isset($_POST['product_name']) && isset($_POST['colour'])){
            if(!empty($_POST['category']) && !empty($_POST['product_name']) && !empty($_POST['colour'])){
                try{
                    $con = $pdo->open();
                    $stmt = $con->prepare("SELECT products.product_id,category.category_name from products,category WHERE category.catergory_id=products.category_id AND products.product_name=:product_name AND products.colour=:colour");
                    $stmt->execute(['product_name'=>$_POST['product_name'],'colour'=>$_POST['colour']]);
                    $row=$stmt->fetch();
                    $output['pro_id'] = $row['product_id'];
                    $output['category_name'] = $row['category_name'];
                    echo json_encode($output);
                    //echo "product_details.php?category=".$row['category_name']."&&id=".$row['product_id'];
                    
                }
                catch(PDOException $e){
                    echo "Something went wrong".$e;
                }
            }
            else{
                header("location: index.php");
            }
        }
        else{
            header("location: index.php");
        }
        
    }else{
        header("location: index.php");
    }

?>