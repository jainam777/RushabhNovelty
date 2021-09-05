<?php
    include 'includes/session.php';

    if(isset($_POST['action'])){
        if(isset($_POST['status'])){
            $con = $pdo->open();
            $stmt = $con->prepare("UPDATE sales SET order_status = :status WHERE id = :id");
            $stmt->execute(['status'=>$_POST['status'],'id'=>$_POST['id']]);
            $_SESSION['success'] = 'Order status updated successfully';
          //  header("location: sales.php");
        }
        else{
            $_SESSION['error'] = 'Try Again';
            //header("location: sales.php");
        }
    }
    else if(isset($_POST['order'])){
        if(isset($_POST['status'])){
            $con = $pdo->open();
            $stmtPreStatus = $con->prepare("SELECT order_status FROM user_order WHERE id = :id");
            $stmtPreStatus->execute(['id'=>$_POST['id']]);
            $preStatus = $stmtPreStatus->fetch();
            if($preStatus['order_status']=='Cancelled'){
                $stmtSalesID = $con->prepare("SELECT sales_id,product_id FROM user_order WHERE id=:id");
                $stmtSalesID->execute(['id'=>$_POST['id']]);
                $salesID = $stmtSalesID->fetch();
                $stmtProductAmount = $con->prepare("SELECT product_price FROM products WHERE product_id=:id");
                $stmtProductAmount->execute(['id'=>$salesID['product_id']]);
                $productAmount = $stmtProductAmount->fetch();
                $stmtSalesAmount = $con->prepare("SELECT total_amount FROM sales WHERE id=:id");
                $stmtSalesAmount->execute(['id'=>$salesID['sales_id']]);
                $SalesAmount = $stmtSalesAmount->fetch();
                $totalAmount = $SalesAmount['total_amount']+$productAmount['product_price'];
                $stmt = $con->prepare("UPDATE user_order SET order_status = :status WHERE id = :id");
                $stmt->execute(['status'=>$_POST['status'],'id'=>$_POST['id']]);
                $stmtUpdateAmount = $con->prepare("UPDATE sales SET total_amount =:total_amount WHERE id=:id");
                $stmtUpdateAmount->execute(['total_amount'=>$totalAmount,'id'=>$salesID['sales_id']]);
                $_SESSION['success'] = 'Order status updated successfully';
            }else{
                $stmt = $con->prepare("UPDATE user_order SET order_status = :status WHERE id = :id");
                $stmt->execute(['status'=>$_POST['status'],'id'=>$_POST['id']]);
                    if($_POST['status']=='Cancelled'){
                        $stmtSalesID = $con->prepare("SELECT sales_id,product_id FROM user_order WHERE id=:id");
                        $stmtSalesID->execute(['id'=>$_POST['id']]);
                        $salesID = $stmtSalesID->fetch();
                        $stmtProductAmount = $con->prepare("SELECT product_price FROM products WHERE product_id=:id");
                        $stmtProductAmount->execute(['id'=>$salesID['product_id']]);
                        $productAmount = $stmtProductAmount->fetch();
                        $stmtSalesAmount = $con->prepare("SELECT total_amount FROM sales WHERE id=:id");
                        $stmtSalesAmount->execute(['id'=>$salesID['sales_id']]);
                        $SalesAmount = $stmtSalesAmount->fetch();
                        $totalAmount = $SalesAmount['total_amount']-$productAmount['product_price'];
                        $stmtUpdateAmount = $con->prepare("UPDATE sales SET total_amount =:total_amount WHERE id=:id");
                        $stmtUpdateAmount->execute(['total_amount'=>$totalAmount,'id'=>$salesID['sales_id']]);
                        $_SESSION['success'] = 'Order status updated successfully';
                    }else{
                        $_SESSION['success'] = 'Order status updated successfully';
                    }
            }
            
            
          //  header("location: sales.php");
        }
        else{
            $_SESSION['error'] = 'Try Again';
            //header("location: sales.php");
        }
    }
    else{
        $_SESSION['error'] = 'Try Again';
        //header("location: sales.php");
    }
?>